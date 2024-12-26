<?php

namespace App\Http\Controllers\API;

use App\Models\Course;
use App\Models\Purchase;
use App\Traits\apiresponse;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseContent;
use App\Models\CourseUserPurchase;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CourseController extends Controller
{
    //$data = Course::with( 'category' )->latest();
    use apiresponse;

    public function index()
    {
        // Fetch all courses
        // $courses = Course::all();
        $courses = Course::all();

        // Add total course_contents count dynamically for each course
        $courses->each(function ($course) {
            $course->total_lessons = $course->course_modules->sum(function ($module) {
                return $module->course_contents()->count();
            });
            // Hide course_modules from the response
            $course->setHidden(['course_modules']);
        });

        // Return the response
        return $this->success($courses, 'Courses with total lessons retrieved successfully', 200);
    }

    public function courseModulesUnderCourseId(Request $request, $courseId)
    {
        //$userId = $request->user()->id; // Get the authenticated user's ID
        $userId = $userId = Auth::id();
        //dd($userId);

        // Retrieve the course with its associated course_modules and filter purchases for the authenticated user
        $course = Course::with([
            'course_modules',
            'purchases' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            },
        ])->find($courseId);

        // Check if the course exists
        if (!$course) {
            return $this->error('Course not found', 404);
        }

        // Determine if the user has purchased the course
        $isPurchased = $course->purchases->isNotEmpty(); // Check if there are any purchases for the user

        $course->course_modules->each(function ($module) {
            // Dynamically add 'lesson_count' property to each module
            $module->lesson_count = $module->course_contents()->count();
        });

        // Add the 'is_purchased' flag to the course object
        $course->purchases->is_purchased = $isPurchased;

        // Return the response with the specific course and its modules
        return $this->success($course, 'Course and Modules retrieved successfully', 200);
    }

    public function courseContentsUnderModuleId($moduleId)
    {
        // Retrieve the module with its associated contents by module ID
        $module = CourseModule::with('course_contents')->find($moduleId);

        // Check if the module exists
        if (!$module) {
            return $this->error('Course Module not found', 404);
        }

        // Return the response with the specific module and its contents
        return $this->success($module, 'Course Module and Contents retrieved successfully', 200);
    }

    public function courseFilesUnderCourseContentId($moduleId)
    {
        // Retrieve the module with its associated files through course contents
        $module = CourseModule::with(['course_contents.files'])->find($moduleId);

        // Check if the module exists
        if (!$module) {
            return $this->error('Course Module not found', 404);
        }

        // Collect all files under the module
        $files = $module->course_contents->flatMap(function ($content) {
            return $content->files;
        });

        // Return the response with module info and its files
        return $this->success(
            [
                'module_id' => $module->id,
                'module_name' => $module->name,
                'files' => $files,
            ],
            'Course Module and Files retrieved successfully',
            200,
        );
    }

    public function getPurchasedCourses(Request $request)
    {
        // Step 1: Fetch all purchased courses for the logged-in user
        $userId = $request->user()->id;

        // Assuming there's a `purchases` table or relationship that tracks purchased courses
        $purchasedCourses = Course::whereHas('purchases', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('course_modules.course_contents.progress')
            ->get();

        // Step 2: Calculate progress for each course
        $purchasedCourses->each(function ($course) {
            $totalDuration = 0;
            $watchedDuration = 0;

            foreach ($course->course_modules as $module) {
                foreach ($module->course_contents as $content) {
                    $contentDuration = $this->convertToSeconds($content->content_length);
                    $totalDuration += $contentDuration;

                    // Sum up watched duration from progress
                    foreach ($content->progress as $progress) {
                        if ($progress->is_completed) {
                            $watchedDuration += $contentDuration;
                        }
                    }
                }
            }

            // Add progress rate to the course
            $course->progress_rate = $totalDuration > 0 ? round(($watchedDuration / $totalDuration) * 100, 2) : 0;

            // Hide unnecessary data for a cleaner response
            $course->setHidden(['course_modules']);
        });

        // Step 3: Return the response
        return response()->json([
            'message' => 'Purchased courses with progress retrieved successfully',
            'data' => $purchasedCourses,
        ]);
    }

    /**
     * Convert HH:MM:SS to total seconds.
     *
     * @param string $time
     * @return int
     */
    private function convertToSeconds($time)
    {
        if (!$time) {
            return 0;
        }

        $duration = Carbon::createFromFormat('H:i:s', $time);
        return $duration->hour * 3600 + $duration->minute * 60 + $duration->second;
    }
}
