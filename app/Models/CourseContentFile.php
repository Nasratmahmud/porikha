<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContentFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_content_id',
        'file_path',
        'file_type',
    ];

    public function courseContent()
    {
        return $this->belongsTo(CourseContent::class);
    }
}
