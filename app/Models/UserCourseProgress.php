<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseProgress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'course_id', 'course_content_id', 'is_completed'];

    public function content()
    {
        return $this->belongsTo(CourseContent::class, 'course_content_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
