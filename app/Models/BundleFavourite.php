<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleFavourite extends Model {
    use HasFactory;
    protected $guarded = [];
    public function bundle() {
        return $this->belongsTo( Bundle::class, 'bundle_id' );
    }
}
