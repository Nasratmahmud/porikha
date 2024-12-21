<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUserPurchase extends Model
{
    use HasFactory;

    // Define fillable attributes to allow mass assignment
    protected $fillable = [
        'user_id',
        'course_id',
        'is_purchased',
    ];

    // Define relationships (if needed)
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
