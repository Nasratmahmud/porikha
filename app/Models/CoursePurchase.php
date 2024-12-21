<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePurchase extends Model {
    use HasFactory;
    protected $guarded = [];
    public function course() {
        return $this->belongsTo( Course::class );
    }
    public function user() {
        return $this->belongsTo( User::class );
    }
    public static function module_compete( $courseId ) {
        return CourseComplete::where( ['user_id' => auth()->user()->id, 'course_id' => $courseId] )->distinct()->pluck( 'course_module_id' )->toArray();
    }
}
