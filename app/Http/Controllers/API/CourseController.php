<?php

namespace App\Http\Controllers\API;

use App\Models\Course;
use App\Models\Purchase;
use App\Traits\apiresponse;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseUserPurchase;

class CourseController extends Controller
{
    //$data = Course::with( 'category' )->latest();
    use apiresponse;

    public function index()
    {
        // Fetch all courses
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
        $userId = $request->user()->id; // Get the authenticated user's ID

        // Retrieve the course with its associated course_modules and the is_purchase flag for the user
        $course = Course::with('course_modules','purchases')->find($courseId);

        // Check if the course exists
        if (!$course) {
            return $this->error('Course not found', 404);
        }


        // Add the lesson count to each module without storing it in the database
        $course->course_modules->each(function ($module) {
            // Dynamically add 'lesson_count' property to each module
            $module->lesson_count = $module->course_contents()->count();
        });

        // Add 'is_purchased' flag to the response data (don't include the purchases array)


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

    public function courseFilesUnderCourseId($courseId)
    {
        // $course = Course::with('course_modules.course_contents.files')->find($courseId);

        // if (!$course) {
        //     return $this->error('Course not found', 404);
        // }

        // return $this->success($course, 'Course files retrieved successfully', 200);

        $course = Course::with('course_modules.course_contents.files')->find($courseId);

        // Check if the course exists
        if (!$course) {
            return $this->error('Course not found', 404);
        }

        // Extract only the files from the nested structure
        $files = $course->course_modules->flatMap(function ($module) {
            return $module->course_contents->flatMap(function ($content) {
                return $content->files;
            });
        });

        // Return the files information
        return $this->success($files, 'Course files retrieved successfully', 200);
    }
}
