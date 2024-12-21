<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;
    protected $guarded = [];

    public function forumPosts() {
        return $this->belongsToMany( ForumPost::class );
    }
    public function books() {
        return $this->hasMany( Book::class );
    }
    public function guides() {
        return $this->hasMany( Guide::class );
    }
}
