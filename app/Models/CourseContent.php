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

    public function progress()
    {
        return $this->hasMany(UserCourseProgress::class);
    }
}
