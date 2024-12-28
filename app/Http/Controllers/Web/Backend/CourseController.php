<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use Carbon\Carbon;
use Vimeo\Vimeo;
use App\Models\User;
use App\Helper\Helper;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Models\CourseContentFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Notifications\UserNotification;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if (User::find(auth()->user()->id)->hasPermissionTo('course menu')) {
            // $data = Course::with( 'category' );
            // dd($data);
            if ($request->ajax()) {
                $data = Course::all();

                return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('course_feature_image', function ($data) {
                        $feature_image = url($data->course_feature_image);
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data->course_title . '"></div>';
                    })
                    ->addColumn('last_update', function ($data) {
                        return Carbon::parse($data->last_update)->format('m-d-Y');
                    })
                    ->addColumn('course_price', function ($data) {
                        return "<span class='bg-info rounded py-1 px-3 text-light me-1'>$" . $data->course_price . '</span>';
                    })
                    ->addColumn('status', function ($data) {
                        $status = ' <div class="form-check form-switch d-flex justify-content-center align-items-center">';
                        $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                        if ($data->status == 1) {
                            $status .= 'checked';
                        }
                        $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                        return $status;
                    })
                    ->addColumn('action', function ($data) {
                        $user = User::find(auth()->user()->id);
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        if (!$user->hasPermissionTo('edit course') && !$user->hasPermissionTo('delete course')) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ($user->hasPermissionTo('edit course')) {
                            $html .= '<a href="' . route('course.edit', $data->id) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ($user->hasPermissionTo('delete course')) {
                            $html .=
                                '<a href="#" onclick="showDeleteConfirm(' .
                                $data->id .
                                ')" type="button"
                                        class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                        <i class="bx bxs-trash"></i>
                                    </a>';
                        }
                        $html .= '</div>';
                        return $html;
                    })
                    ->rawColumns(['course_price', 'course_feature_image', 'last_update', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.layout.course.index');
        }
        return redirect()->back();
    }
    /**
     * Insert View
     *
     * @param Request $request
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        if (User::find(auth()->user()->id)->hasPermissionTo('create course')) {
            $categories = Category::where('status', '1')->orderBy('category_name')->get();
            return view('backend.layout.course.create', compact('categories'));
        }
        return redirect()->back();
    }
  
    /**
     * Get Selected item data
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function store(Request $request)
    {
        //dd($request->all());
        // EXECUTION TIME
        set_time_limit(220);

        if (User::find(auth()->user()->id)->hasPermissionTo('create course')) {
            $rules = [
                'course_title' => 'required|string|unique:courses,course_title',
                'ai_name' => 'required|string|unique:courses,ai_name',
                'course_price' => 'required|numeric',
                'summary' => 'required|string',
                'ai_url' => 'nullable|string',
                'ai_description' => 'nullable|string',
                'course_feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ai_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'course_pdf.*.*' => 'nullable|file|mimes:pdf|max:10000',
                'module_number.*' => 'required|integer',
                'module_titles.*' => 'required|string',
            ];

            foreach ($request->module_number as $key => $moduleNumber) {
                $rules["module_{$moduleNumber}_content_title.*"] = 'required|string';
                $rules["module_{$moduleNumber}_video_url.*"] = 'nullable|file|mimes:mp4,mov,avi,flv';
                $rules["module_{$moduleNumber}_content_length.*"] = 'required|nullable|string';
                $rules["module_{$moduleNumber}_files.*.*"] = 'nullable|file|mimes:pdf,xlsx,xls,doc,docx,mp4,avi,mkv,webm|max:51200';
            }

            $validation = Validator::make($request->all(), $rules);

            if ($validation->passes()) {
                $users = User::all();
                $slug = Course::where('course_slug', Str::slug($request->course_title))->first();
                $slug_data = $slug ? Str::slug($request->course_title) . Str::random(5) : Str::slug($request->course_title);

                $randomString = Str::random(20);
                // IMAGE STORE HELPER
                $featuredImage = Helper::fileUpload($request->file('course_feature_image'), 'course', $request->course_feature_image . '_' . $randomString);

                $aiImage = Helper::fileUpload($request->file('ai_image'), 'course', $request->ai_image . '_' . $randomString);

                // VIMEO ENV SETUP
                $vimeo = new Vimeo(env('VIMEO_CLIENT_ID'), env('VIMEO_CLIENT_SECRET'), env('VIMEO_ACCESS_TOKEN'));
                //dd($vimeo);

                // try {
                DB::beginTransaction();

                // Store course
                $course = new Course();
                $course->course_title = $request->course_title;
                $course->course_slug = $slug_data;
                $course->course_price = $request->course_price;
                $course->summary = $request->summary;
                $course->course_feature_image = $featuredImage;
                $course->ai_name = $request->ai_name;
                $course->ai_url = $request->ai_url;
                $course->ai_picture = $aiImage;
                $course->ai_description = $request->ai_description;
                $course->save();

                $contentLengthArray = [];

                foreach ($request->module_titles as $index => $title) {
                    $moduleNumber = $request['module_number'][$index];
                    $courseModule = new CourseModule();
                    $courseModule->course_module_name = $title;
                    $courseModule->course_id = $course->id;
                    $courseModule->save();

                    foreach ($request["module_{$moduleNumber}_content_title"] as $i => $title) {
                        $moduleVideoPath = $request->file("module_{$moduleNumber}_video_url")[$i]->getPathname();
                        $moduleVideoResponse = $vimeo->upload($moduleVideoPath, [
                            'name' => $title,
                            'description' => $request->summary,
                            'privacy' => [
                                'view' => 'disable',
                            ],
                            'embed' => [
                                'title' => [
                                    'name' => 'hide',
                                    'owner' => 'hide',
                                    'portrait' => 'hide',
                                ],
                                'buttons' => [
                                    'like' => false,
                                    'watchlater' => false,
                                    'share' => false,
                                    'embed' => false,
                                ],
                                'logos' => [
                                    'vimeo' => false,
                                ],
                            ],
                        ]);
                        $moduleVideoData = $vimeo->request($moduleVideoResponse, [], 'GET')['body'];
                        $moduleVideoId = trim($moduleVideoData['uri'], '/videos/');
                        $moduleVideoEmbedUrl = 'https://player.vimeo.com/video/' . $moduleVideoId . '?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=58479';

                        $moduleVideoDuration = 0;
                        $retryCount = 0;
                        while ($moduleVideoDuration == 0 && $retryCount < 5) {
                            sleep(5);
                            $moduleVideoData = $vimeo->request($moduleVideoResponse, [], 'GET')['body'];
                            $moduleVideoDuration = $moduleVideoData['duration'];
                            $retryCount++;
                        }

                        // FORMAT DURATION AS HH:MM:SS
                        $formattedDuration = gmdate('H:i:s', $moduleVideoDuration);

                        $courseContent = new CourseContent();
                        $courseContent->content_title = $title;
                        $courseContent->video_file = $moduleVideoEmbedUrl;
                        $courseContent->content_length = $formattedDuration;
                        $courseContent->course_id = $course->id;
                        $courseContent->course_module_id = $courseModule->id;

                        $contentLengthArray[] = $formattedDuration;

                        $courseContent->save();

                        //course content multiple file add option started
                        //if ($request->hasFile("module_{$moduleNumber}_files") && isset($request["module_{$moduleNumber}_files"][$i])) {
                        $files = $request->file("module_{$moduleNumber}_files")[$i]; // Multiple files
                        //dd($files);

                        if (is_array($files)) {
                            foreach ($files as $fileindex => $file) {
                                if ($file->isValid()) {
                                    $randomString = Str::random(20);
                                    $fileExtension = $file->getClientOriginalExtension();
                                    $fileName = $randomString . '_' . Str::uuid() . '.' . $fileExtension;
                                    $filePath = Helper::fileUpload($file, 'course_files', $fileName);

                                    // Store file in the `course_content_files` table
                                    CourseContentFile::create([
                                        'course_content_id' => $courseContent->id,
                                        'file_path' => $filePath,
                                        'file_type' => $fileExtension, // PDF, Excel, etc.
                                    ]);
                                }
                            }
                        }
                    }
                }
                //course content multiple file add option end

                // COURSE CONTENT CONTENT_LENGTH HELPER
                $courseDuration = Helper::addDurationsArray($contentLengthArray);

                // COURSE DURATIO UPDATE
                $course->update(['duration' => $courseDuration]);

                foreach ($users as $user) {
                    if ($user->id != Auth::user()->id && $user->user_type == 2) {
                        $user->notify(new UserNotification('Admin: Release New Course', "$course->course_title", route('course.enrollment', $course->id)));
                    }
                }

                DB::commit();
                return redirect(route('course.index'))->with('t-success', 'Course Added Successfully');
            } else {
                return redirect()->back()->withErrors($validation)->withInput();
            }
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        if (User::find(auth()->user()->id)->hasPermissionTo('edit course')) {
            //$categories = Category::where('status', '1')->orderBy('category_name')->get();
            $course = Course::with('course_modules')->where('id', $id)->first();
            // return $course;
            return view('backend.layout.course.update', compact('course'));
        }
        return redirect()->back();
    }

    /**
     * Update selected item in database
     *
     * @param Request $request
     */

    public function update(Request $request, $id)
    {
        //dd($request->all());
        // MAXIMUM EXECUTION TIME
        set_time_limit(220);

        if (User::find(auth()->user()->id)->hasPermissionTo('edit course')) {
            $course = Course::findOrFail($id);

            $rules = [
                'course_title' => 'required|string|unique:courses,course_title,' . $course->id,
                'course_price' => 'required|numeric',
                'summary' => 'required|string',
                'course_feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'course_pdf.*.*' => 'nullable|file|mimes:pdf|max:10000',
                'ai_name' => 'required|string',
                'ai_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ai_url' => 'nullable|string',
                'ai_description' => 'nullable|string',
                'module_number.*' => 'required|integer',
                'module_titles.*' => 'required|string',
            ];

            foreach ($request->module_number as $key => $moduleNumber) {
                $rules["module_{$moduleNumber}_content_title.*"] = 'required|string|max:255';
                $rules["module_{$moduleNumber}_video_url.*"] = 'nullable|file|mimes:mp4,mov,avi,flv';
                $rules["module_{$moduleNumber}_content_length.*"] = 'nullable|string|max:255';
                $rules["module_{$moduleNumber}_files.*"] = 'nullable|file|mimes:pdf,xlsx,xls,doc,docx,mp4,avi,mkv,webm|max:51200';
                //$rules["course_pdf.{$moduleNumber}.*"] = 'nullable';
            }

            $validation = Validator::make($request->all(), $rules);

            if ($validation->passes()) {
                DB::beginTransaction();

                // UPDATE FEATURE IMAGE
                if ($request->hasFile('course_feature_image')) {
                    $randomString = Str::random(20);
                    $featuredImage = Helper::fileUpload($request->file('course_feature_image'), 'course', $request->course_feature_image . '_' . $randomString);
                    $course->course_feature_image = $featuredImage;
                }

                if ($request->hasFile('ai_image')) {
                    $randomString = Str::random(20);
                    $aiImage = Helper::fileUpload($request->file('ai_image'), 'course', $request->ai_image . '_' . $randomString);
                    $course->ai_picture = $aiImage;
                    // dd($aiImage);
                }

                // SETUP VIMEO CLIENT
                $vimeo = new Vimeo(env('VIMEO_CLIENT_ID'), env('VIMEO_CLIENT_SECRET'), env('VIMEO_ACCESS_TOKEN'));

                // UPDATE FEATURE VIDEO ON VIMEO

                // UPDATE COURSE DATA
                $course->course_title = $request->course_title;
                $course->course_slug = Str::slug($request->course_title);
                $course->course_price = $request->course_price;
                $course->summary = $request->summary;
                $course->ai_name = $request->ai_name;
                $course->ai_url = $request->ai_url;
                // $course->ai_picture =  $aiImage;
                $course->ai_description = $request->ai_description;
                $course->save();

                foreach ($request->module_titles as $index => $title) {
                    $moduleNumber = $request['module_number'][$index];

                    // Get module ID if it's provided
                    $moduleId = $request->module_ids[$index] ?? null;

                    // Find or create/update the course module
                    $courseModule = CourseModule::updateOrCreate(
                        [
                            'id' => $moduleId, // Use the module ID to ensure updating the correct module
                            'course_id' => $course->id,
                        ],
                        [
                            'course_module_name' => $title,
                        ],
                    );

                    foreach ($request["module_{$moduleNumber}_content_title"] as $i => $contentTitle) {
                        $contentId = $request["module_{$moduleNumber}_content_id_list"][$i] ?? null;
                        $courseContent = null;

                        // If content ID is provided, attempt to find the existing content
                        if ($contentId) {
                            $courseContent = CourseContent::find($contentId);
                        }

                        // If no content ID is provided or content is not found, create a new instance
                        if (!$courseContent) {
                            $courseContent = new CourseContent();
                            $courseContent->course_module_id = $courseModule->id;
                            $courseContent->course_id = $course->id;
                        }


                        // Check if a new video is uploaded
                        if ($request->hasFile("module_{$moduleNumber}_video_url") && isset($request->file("module_{$moduleNumber}_video_url")[$i])) {
                            // If video is uploaded, handle Vimeo update
                            if (!empty($courseContent->video_file)) {
                                $moduleVideoId = basename(parse_url($courseContent->video_file, PHP_URL_PATH));
                                $vimeo->request("/videos/{$moduleVideoId}", [], 'DELETE');
                            }

                            $moduleVideoPath = $request->file("module_{$moduleNumber}_video_url")[$i]->getPathname();
                            //$moduleVideoResponse = $vimeo->upload($moduleVideoPath);
                            $moduleVideoResponse = $vimeo->upload($moduleVideoPath, [
                                'name' => $title,
                                'description' => $request->summary,
                                'privacy' => [
                                    'view' => 'disable',
                                ],
                                'embed' => [
                                    'title' => [
                                        'name' => 'hide',
                                        'owner' => 'hide',
                                        'portrait' => 'hide',
                                    ],
                                    'buttons' => [
                                        'like' => false,
                                        'watchlater' => false,
                                        'share' => false,
                                        'embed' => false,
                                    ],
                                    'logos' => [
                                        'vimeo' => false,
                                    ],
                                ],
                            ]);

                            $moduleVideoData = $vimeo->request($moduleVideoResponse, [], 'GET')['body'];
                            $moduleVideoId = trim($moduleVideoData['uri'], '/videos/');
                            $moduleVideoEmbedUrl = 'https://player.vimeo.com/video/' . $moduleVideoId . '?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=58479';
                            $courseContent->video_file = $moduleVideoEmbedUrl;
                        }

                        // Update content title and save
                        $courseContent->content_title = $contentTitle;
                        $courseContent->save();

                        \Log::debug("Content title '{$contentTitle}' saved/updated.");
                        //star
                        if ($request->hasFile("module_{$moduleNumber}_files")) {

                            // Add new files

                            foreach ($request->file("module_{$moduleNumber}_files") as $content_id => $file) {

                                if ($file->isValid()) {
                                    $fileExtension = $file->getClientOriginalExtension();
                                    $fileName = Str::random(20) . '_' . Str::uuid() . '.' . $fileExtension;
                                    $filePath = Helper::fileUpload($file, 'course_files', $fileName);
                                    $existingContent = CourseContent::where('id',$content_id)->first();
                                    if($existingContent){
                                        CourseContentFile::create([
                                            'course_content_id' => $content_id,
                                            'file_path' => $filePath,
                                            'file_type' => $fileExtension,
                                        ]);
                                    }else{
                                        CourseContentFile::create([
                                            'course_content_id' => $courseContent->id,
                                            'file_path' => $filePath,
                                            'file_type' => $fileExtension,
                                        ]);
                                    }
                                }
                            }
                        }
                        //end
                    }
                }

                DB::commit();
                return redirect(route('course.index'))->with('t-success', 'Course Updated Successfully');
            } else {
                return redirect()->back()->withErrors($validation)->withInput();
            }
        }
        return redirect()->back();
    }


    public function fileDelete($id){
        // dd($id);  
        if(isset($id)){
            try{
                $file = CourseContentFile::find($id);
    
            if ($file->file_path != null) {
                // Remove image
                if (File::exists($file->file_path)) {
                    File::delete($file->file_path);
                }
                
            }
                $file->delete();
    
            // dd($file->id);
            return redirect()->back()->with('t-success','Successfully deleted the file.');
            }
            catch(Exception $e){
                return redirect(route('course.index'))->with('t-error','Find problem to delete the file.');
            }
        }  
        else{
            return redirect(route('course.index'))->with('t-error','File not exist.');
        }
        
    }

    /**
     * Delete selected Course item
     * @param Request $request
     * @param $id
     */
    public function destroy(Request $request, $id)
    {
        if (User::find(auth()->user()->id)->hasPermissionTo('delete course')) {
            try {
                if ($request->ajax()) {
                    DB::beginTransaction();
                    CourseContent::where('course_id', $id)->delete();
                    CourseModule::where('course_id', $id)->delete();
                    $course = Course::findOrFail($id);
                    if ($course->course_feature_image != null) {
                        // Remove image
                        if (File::exists($course->course_feature_image)) {
                            File::delete($course->course_feature_image);
                        }
                    }
                    $course->delete();
                    DB::commit();
                    return response()->json([
                        'success' => true,
                        'message' => 'Course Deleted Successfully.',
                    ]);
                }
            } catch (Exception $th) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Course Status Change.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id)
    {
        $data = Course::where('id', $id)->first();
        if ($data->status == 1) {
            $data->status = '0';
            $data->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
            ]);
        } else {
            $data->status = '1';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
            ]);
        }
    }

    /**
     * Delete Module item
     * @param Request $request
     * @param $id
     */
   
    public function moduleDestroy(Request $request)
    {
        if (User::find(auth()->user()->id)->hasPermissionTo('delete course')) {
            //try {
            if ($request->ajax()) {
                DB::beginTransaction();
                $contents = CourseContent::where(['course_id' => $request->course_id, 'course_module_id' => $request->module_id])->get();
                $vimeo = new Vimeo(env('VIMEO_CLIENT_ID'), env('VIMEO_CLIENT_SECRET'), env('VIMEO_ACCESS_TOKEN'));
                foreach ($contents as $content) {
                    if ($content->video_file) {
                        $existingVideoId = basename(parse_url($content->video_file, PHP_URL_PATH));
                        $vimeo->request("/videos/{$existingVideoId}", [], 'DELETE');
                    }
                    $contentLengthArray[] = $content['content_length'];
                    $content->delete();
                }
                //$courseDuration = Helper::addDurationsArray($contentLengthArray);
                $course = Course::where('id', $request->course_id)->first();

                //$updateDuration = Helper::subtractDuration($course->duration, $courseDuration);
                //$course->update(["duration" => $updateDuration]);

                CourseModule::where(['course_id' => $request->course_id, 'id' => $request->module_id])->delete();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Module Deleted Successfully.',
                ]);
            }
            //} //catch (Exception $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
            //}
        }
        return redirect()->back();
    }

    /**
     * Content Status Change.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function contentStatus($id)
    {
        $data = CourseContent::where('id', $id)->first();
        if ($data->status == 1) {
            $data->status = '0';
            $data->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
            ]);
        } else {
            $data->status = '1';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
            ]);
        }
    }

    /**
     * Delete Content item
     * @param Request $request
     * @param $id
     */
    public function contentDestroy(Request $request)
    {
        if (User::find(auth()->user()->id)->hasPermissionTo('delete course')) {
            //try {
            if ($request->ajax()) {
                //DB::beginTransaction();
                $content = CourseContent::where('id', $request->id)->first();
                $course = Course::where('id', $request->course_id)->first();

                // DELETE VIDEO FROM VIMEO
                if ($content->video_file) {
                    $vimeo = new Vimeo(env('VIMEO_CLIENT_ID'), env('VIMEO_CLIENT_SECRET'), env('VIMEO_ACCESS_TOKEN'));
                    $existingVideoId = basename(parse_url($content->video_file, PHP_URL_PATH));
                    $vimeo->request("/videos/{$existingVideoId}", [], 'DELETE');
                }

                //$updateDuration = Helper::subtractDuration($course->duration, $content->content_length);

                //course->update(["duration" => $updateDuration]);
                $content->delete();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Content Deleted Successfully.',
                ]);
            }
            //} //catch (Exception $th) {
            //DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong',
            ]);
            //}
        }
        return redirect()->back();
    }
}
