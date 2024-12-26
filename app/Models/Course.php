<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    use HasFactory;
    protected $guarded = [];
    public function category() {
        return $this->belongsTo( Category::class, 'category_id' );
    }
    public function course_modules() {
        return $this->hasMany( CourseModule::class );
    }
    public function course_purchases() {
        return $this->hasMany( CoursePurchase::class );
    }

    public function purchases()
    {
        return $this->hasMany(CourseUserPurchase::class);
    }

    public function handcashpurchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
