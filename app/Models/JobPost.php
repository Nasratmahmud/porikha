<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function facilities() {
        return $this->hasMany( JobPostFacilities::class );
    }
    public function company() {
        return $this->hasOne( Company::class );
    }
    public function favorate() {
        return $this->hasOne( FavoriteJob::class );
    }

    public function applyed() {
        return $this->hasMany( JobApplication::class );
    }

    
}
