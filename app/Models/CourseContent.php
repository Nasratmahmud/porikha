<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function course_module()
    {
        return $this->belongsTo(CourseModule::class, 'course_module_id');
    }

    // Define the relationship to CourseContentFile
    public function files()
    {
        return $this->hasMany(CourseContentFile::class,'course_content_id', 'id');
    }

    public function courseFilesUnderCourseId($courseId)
    {
        // Retrieve the course along with its nested relationships: modules, contents, and files
        $course = Course::with('modules.contents')->find($courseId);

        // Check if the course exists
        if (!$course) {
            return $this->error('Course not found', 404);
        }

        // Return the course with its modules, contents, and files
        return $this->success($course, 'Course files retrieved successfully', 200);
    }
}
