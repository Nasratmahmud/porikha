<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class ForumPost extends Model {
    use HasFactory, Commentable;

    protected $guarded = [];

    public function categories() {
        return $this->belongsToMany( Category::class );
    }

    public function category() {
        return $this->belongsTo( Category::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }

}
