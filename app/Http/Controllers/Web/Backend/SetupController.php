<?php

namespace App\Http\Controllers\Web\Backend;


use App\Helper\Helper;
use App\Http\Controllers\Controller;

use App\Models\Setting;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class SetupController extends Controller
{
    /**
     * Display a very simple welcome screen to start the setup process.
     *
     * @return View
     */
    public function welcome()
    {
        return view('setup.welcome');
    }

    /**
     * Display all requirements that must be fulfilled to run the setup.
     *
     * @return View
     */
    public function requirements()
    {
        $results = [
            [
                'item' => "PHP Version",
                'value' => PHP_VERSION_ID >= 70400,
            ],
            [
                'item' => "Extension Bcmath",
                'value' => extension_loaded('bcmath'),
            ],
            [
                'item' => "Extension Ctype",
                'value' => extension_loaded('ctype'),
            ],
            [
                'item' => "Extension Json",
                'value' => extension_loaded('json'),
            ],
            [
                'item' => "Extension Mbstring",
                'value' => extension_loaded('mbstring'),
            ],

            [
                'item' => "Extension Openssl",
                'value' => extension_loaded('openssl'),
            ],

            [
                'item' => "Extension Pdo Mysql",
                'value' => extension_loaded('pdo_mysql'),
            ],

            [
                'item' => "Extension Tokenizer",
                'value' => extension_loaded('tokenizer'),
            ],
            [
                'item' => "Extension XML",
                'value' => extension_loaded('xml'),
            ],
            [
                'item' => "ENV Writable",
                'value' => File::isWritable(base_path('.env')),
            ],
            [
                'item' => "Storage Writable",
                'value' => File::isWritable(storage_path()) && File::isWritable(storage_path('logs')),
            ],
        ];

        // Check Array Value
        if (array_search(false, array_column($results, 'value')) !== FALSE) {
            $success = true;
        } else {
            $success = false;
        }


        return view('setup.requirements', compact('results','success'));
    }



    /**
     * Display the form for configuration of the database.
     *
     * @return View
     */
    public function databaseConfiguration()
    {
        return view('setup.database');
    }


    /**
     * Handle the test and configuration of a new database connection.
     *
     * @param SetupDatabaseRequest $request
     * @return RedirectResponse
     */
    public function databaseConfigurationStore(Request $request)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required|numeric',
            'db_name' => 'required',
            'db_user' => 'required',
            'db_password' => 'nullable',
        ]);

        $this->createTempDatabaseConnection($request->all());

        if ($this->databaseHasData() && !$request->has('overwrite_data')) {
            return redirect()->back()->with('data_present', true)->with('alert-error','Sorry, database setup not completed!')->withInput();
        }
        $migrationResult = $this->migrateDatabase();
        if ($migrationResult === false) {
            return redirect()->back()->withInput();
        }
        $this->storeConfigurationInEnv();
        return redirect()->route('setup.account');
    }

    /**
     * Accepts new credentials for a database and sets them accordingly.
     *
     * @param array $credentials
     */
    protected function createTempDatabaseConnection(array $credentials)
    {
        $this->dbConfig = config('database.connections.mysql');
        $this->dbConfig['host'] = $credentials['db_host'];
        $this->dbConfig['port'] = $credentials['db_port'];
        $this->dbConfig['database'] = $credentials['db_name'];
        $this->dbConfig['username'] = $credentials['db_user'];
        $this->dbConfig['password'] = $credentials['db_password'];
        Config::set('database.connections.setup', $this->dbConfig);
    }

    /**
     * Instead of trying to manually detect if the database connection is
     * working we try to run the migration of the database scheme. If it fails
     * we get the exact error we can display to the user, e.g. SQLSTATE[HY000]
     * [2002] Connection refused which implies wrong credentials.
     *
     * @return bool
     */
    protected function migrateDatabase()
    {
        try {
            Artisan::call('migrate:fresh', [
                '--database' => 'setup', // Specify the correct connection
                '--force' => true, // Needed for production
                '--no-interaction' => true,
            ]);
        } catch (\Exception $e) {
            Session::put('alert-error',$e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * At this point we write the database credentials to the .env file.
     * We can ignore the FileNotFoundException exception as we already checked
     * the presence and write-ability of the file in the previous setup step.
     */
    protected function storeConfigurationInEnv()
    {
        $envContent = File::get(base_path('.env'));

        $lineBreak = "\n";

        $envContent = preg_replace([
            '/DB_HOST=(.*)\s/',
            '/DB_PORT=(.*)\s/',
            '/DB_DATABASE=(.*)\s/',
            '/DB_USERNAME=(.*)\s/',
            '/DB_PASSWORD=(.*)\s/',
        ], [
            'DB_HOST=' . $this->dbConfig['host'].$lineBreak,
            'DB_PORT=' . $this->dbConfig['port'].$lineBreak,
            'DB_DATABASE=' . $this->dbConfig['database'].$lineBreak,
            'DB_USERNAME=' . $this->dbConfig['username'].$lineBreak,
            'DB_PASSWORD=' . $this->dbConfig['password'].$lineBreak,
        ], $envContent);

        if ($envContent !== null) {
            File::put(base_path('.env'), $envContent);
        }
    }

    /**
     * To prevent unwanted data loss we check for data in the database. It does
     * not matter which data, because users may accidentally enter the
     * credentials for a wrong database.
     *
     * @return bool
     */
    protected function databaseHasData()
    {
        try {
            $present_tables = DB::connection('setup')
                ->getDoctrineSchemaManager()
                ->listTableNames();
        } catch (\PDOException $e) {
            Session::put('alert-error',$e->getMessage());
            return false;
        }catch (\Exception $e){
            Session::put('alert-error',$e->getMessage());
            return false;
        }

        return count($present_tables) > 0;
    }

    /**
     * Display the registration form for the first user account.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function accountCreate()
    {
        // Config Clear Command Run
        Artisan::call('config:clear');
        // Cache Clear Command Run
        Artisan::call('cache:clear');
        return view('setup.account');
    }

    /**
     * Validate and create the new user, then login him, and redirect him to the dashboard
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function accountStore(Request $request){

        // User account data validation.
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password'     => 'required|string|min:6',
            'password_confirmation' => 'required|string|same:password|min:6',
            'user_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Store new user data.
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        // Upload User Avatar
        if(!empty($request['user_avatar'])){
            if(empty($user->user_avatar)){
                // Upload New User Avatar
                $user_avatar = Helper::fileUpload($request->user_avatar,'user',$user->name.'_'.$user->id);
            }else{
                // Remove Old File
                @unlink(public_path('/') . $user->user_avatar);

                // Upload New User Avatar
                $user_avatar = Helper::fileUpload($request->user_avatar,'user',$user->name.'_'.$user->id);
            }
            $user->user_avatar = $user_avatar;
        }
        $user->password = Hash::make($request->password);
        $user->save();

        // Login user
        Auth::login($user, true);

        return view('setup.setting');
    }

    /**
     * Display the Setting form for the enter setting data store.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function settingCreate(){
        return view('setup.setting');
    }

    /**
     * Validate and create the new setting, and redirect him to the dashboard
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function settingStore(Request $request){

        // Setting data validation
        $request->validate([
            'title'       => 'required|string',
            'address'     => 'required|string',
            'description' => 'required|string',
            'logo'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Store setting data
        $setting = new Setting();
        $setting->title = $request->title;
        $setting->address = $request->address;
        $setting->description = $request->description;

        // Upload Logo
        $logo = Helper::fileUpload($request->logo,'setting','logo');
        $setting->logo = $logo;

        // Upload Favicon
        $favicon = Helper::fileUpload($request->favicon,'setting','favicon');
        $setting->favicon = $favicon;
        $setting->save();

        return redirect()->route('setup.complete');
    }


    /**
     * Display a final screen after the setup was successful.
     *
     * @return View
     */
    public function complete()
    {
        $data = new SystemSetting();
        $data->user_id = Auth::user()->id;
        $data->system_key = 'system_setup_completed';
        $data->value = true;
        $data->save();

        // Setup Complete
        $this->storeSetupConfigurationInEnv();

        Cache::forget('systemsettings');

        return view('setup.complete');
    }

    /**
     * At this point we write the setup credentials to the .env file.
     * We can ignore the FileNotFoundException exception as we already checked
     * the presence and write-ability of the file in the previous setup step.
     */
    protected function storeSetupConfigurationInEnv()
    {
        $envContent = File::get(base_path('.env'));

        $lineBreak = "\n";

        $envContent = preg_replace([
            '/APP_SETUP=(.*)\s/',
        ], [
            'APP_SETUP='.'True'.$lineBreak,
        ], $envContent);

        if ($envContent !== null) {
            File::put(base_path('.env'), $envContent);
        }
    }
}
