<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingRequest;
use App\Models\DynamicPage;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingController extends Controller {
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'system setting' ) ) {
            // Get Setting Data
            $setting = Setting::latest( 'id' )->first();

            return view( 'backend.layout.setting.system_setting', compact( 'setting' ) );
        }
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( SettingRequest $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'system setting' ) ) {
            $setting = Setting::latest( 'id' )->first();

            // Check Exit Of Setting
            if ( $setting == null ) {
                $setting = new Setting();
            }

            $setting->title = $request->title;
            $setting->address = $request->address;
            $setting->description = $request->description;

            // Upload Logo
            if ( !empty( $request['logo'] ) ) {
                if ( empty( $setting->logo ) ) {
                    // Upload New Logo
                    $logo = Helper::fileUpload( $request->logo, 'setting', 'logo' );

                } else {
                    // Remove Old File
                    @unlink( public_path( '/' ) . $setting->logo );

                    // Upload New Logo
                    $logo = Helper::fileUpload( $request->logo, 'setting', 'logo' );

                }
                $setting->logo = $logo;
            }

            // Upload Favicon
            if ( !empty( $request['favicon'] ) ) {
                if ( empty( $setting->favicon ) ) {
                    // Upload New Favicon
                    $favicon = Helper::fileUpload( $request->favicon, 'setting', 'favicon' );

                } else {
                    // Remove Old File
                    @unlink( public_path( '/' ) . $setting->favicon );

                    // Upload New Favicon
                    $favicon = Helper::fileUpload( $request->favicon, 'setting', 'favicon' );
                }
                $setting->favicon = $favicon;
            }
            $setting->save();
            return redirect()->route( 'setting' )->with( 't-success', 'Update successfully.' );
        }
        return redirect()->back();

    }

    /**
     *
     * Dynamic Pages
     *
     */

    public function dynamicPageCreate() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            return view( 'backend.layout.setting.profile_setting' );
        }
        return redirect()->back();

    }

    public function dynamicPageStore( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            $request->validate( [
                'page_title'   => 'required|string|max:100',
                'page_content' => 'required|string',
            ] );

            $data = new DynamicPage();
            $data->page_title = $request->page_title;
            $data->page_slug = Str::slug( $request->page_title );
            $data->page_content = $request->page_content;
            $data->save();

            return redirect()->route( 'dynamic_page.create' )->with( 't-success', 'New pages added successfully.' );
        }
        return redirect()->back();

    }

    public function dynamicPageEdit( $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            return view( 'backend.layout.setting.profile_setting' );
        }
        return redirect()->back();

    }

    public function dynamicPageUpdate( Request $request, $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            $request->validate( [
                'page_title'   => 'required|string|max:100',
                'page_content' => 'required|string',
            ] );

            $data = DynamicPage::findOrFail( $id );
            $data->page_title = $request->page_title;
            $data->page_slug = Str::slug( $request->page_title );
            $data->page_content = $request->page_content;
            $data->update();

            return redirect()->route( 'dynamic_page.create' )->with( 't-success', 'Selected pages updated successfully.' );
        }
        return redirect()->back();

    }

    public function dynamicPageDelete( $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            DynamicPage::findOrFail( $id )->delete();
            return redirect()->route( 'dynamic_page.create' )->with( 't-success', 'Selected pages deleted successfully.' );
        }
        return redirect()->back();

    }

    /**
     * Display Stripe resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function stripeSetting() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            return view( 'backend.layout.setting.profile_setting' );
        }
        return redirect()->back();

    }
    /**
     * Update Stripe Setting
     *
     */
    public function stripeSettingUpdate( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            $request->validate( [
                'stripe_key'    => 'required|string',
                'stripe_secret' => 'required|string',
            ] );
            try {
                $envContent = File::get( base_path( '.env' ) );
                $lineBreak = "\n";
                $envContent = preg_replace( [
                    '/STRIPE_KEY=(.*)\s/',
                    '/STRIPE_SECRET=(.*)\s/',
                ], [
                    'STRIPE_KEY=' . $request->stripe_key . $lineBreak,
                    'STRIPE_SECRET=' . $request->stripe_secret . $lineBreak,
                ], $envContent );

                if ( $envContent !== null ) {
                    File::put( base_path( '.env' ), $envContent );
                }
                return redirect()->back()->with( 't-success', 'Stripe Setting Update successfully.' );
            } catch ( \Throwable $th ) {
                return redirect( route( 'book.index' ) )->with( 't-error', 'Stripe Setting Update Failed' );
            }
        }
        return redirect()->back();

    }

    /**
     * Display Pusher resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function pusherSetting() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            return view( 'backend.layout.setting.profile_setting' );
        }
        return redirect()->back();

    }
    /**
     * Update Pusher Setting
     *
     */
    public function pusherSettingUpdate( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            $request->validate( [
                'pusher_app_id'     => 'required|string',
                'pusher_app_key'    => 'required|string',
                'pusher_app_secret' => 'required|string',
            ] );
            try {
                $envContent = File::get( base_path( '.env' ) );
                $lineBreak = "\n";
                $envContent = preg_replace( [
                    '/PUSHER_APP_ID=(.*)\s/',
                    '/PUSHER_APP_KEY=(.*)\s/',
                    '/PUSHER_APP_SECRET=(.*)\s/',
                ], [
                    'PUSHER_APP_ID=' . $request->pusher_app_id . $lineBreak,
                    'PUSHER_APP_KEY=' . $request->pusher_app_key . $lineBreak,
                    'PUSHER_APP_SECRET=' . $request->pusher_app_secret . $lineBreak,
                ], $envContent );

                if ( $envContent !== null ) {
                    File::put( base_path( '.env' ), $envContent );
                }
                return redirect()->back()->with( 't-success', 'Pusher Setting Update successfully.' );
            } catch ( \Throwable $th ) {
                return redirect( route( 'book.index' ) )->with( 't-error', 'Pusher Setting Update Failed' );
            }
        }
        return redirect()->back();

    }
    /**
     * Display Mail resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function mailSetting() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            return view( 'backend.layout.setting.profile_setting' );
        }
        return redirect()->back();

    }
    /**
     * Update Mail Setting
     *
     */
    public function mailSettingUpdate( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'profile setting' ) ) {
            $request->validate( [
                'mail_mailer'       => 'required|string',
                'mail_host'         => 'required|string',
                'mail_port'         => 'required|string',
                'mail_username'     => 'nullable|string',
                'mail_password'     => 'nullable|string',
                'mail_encryption'   => 'nullable|string',
                'mail_from_address' => 'required|string',
            ] );
            try {
                $envContent = File::get( base_path( '.env' ) );
                $lineBreak = "\n";
                $envContent = preg_replace( [
                    '/MAIL_MAILER=(.*)\s/',
                    '/MAIL_HOST=(.*)\s/',
                    '/MAIL_PORT=(.*)\s/',
                    '/MAIL_USERNAME=(.*)\s/',
                    '/MAIL_PASSWORD=(.*)\s/',
                    '/MAIL_ENCRYPTION=(.*)\s/',
                    '/MAIL_FROM_ADDRESS=(.*)\s/',
                ], [
                    'MAIL_MAILER=' . $request->mail_mailer . $lineBreak,
                    'MAIL_HOST=' . $request->mail_host . $lineBreak,
                    'MAIL_PORT=' . $request->mail_port . $lineBreak,
                    'MAIL_USERNAME=' . $request->mail_username . $lineBreak,
                    'MAIL_PASSWORD=' . $request->mail_password . $lineBreak,
                    'MAIL_ENCRYPTION=' . $request->mail_encryption . $lineBreak,
                    'MAIL_FROM_ADDRESS=' . '"' . $request->mail_from_address . '"' . $lineBreak,
                ], $envContent );

                if ( $envContent !== null ) {
                    File::put( base_path( '.env' ), $envContent );
                }
                return redirect()->back()->with( 't-success', 'Mail Setting Update successfully.' );
            } catch ( \Throwable $th ) {
                return redirect( route( 'book.index' ) )->with( 't-error', 'Mail Setting Update Failed' );
            }
        }
        return redirect()->back();

    }
}
