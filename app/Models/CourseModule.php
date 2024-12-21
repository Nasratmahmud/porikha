<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model {
    use HasFactory;
    protected $guarded = [];
    public function course() {
        return $this->belongsTo( Course::class, 'course_id' );
    }
    public function course_contents() {
        return $this->hasMany( CourseContent::class );
    }
}
