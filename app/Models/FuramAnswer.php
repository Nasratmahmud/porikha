<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuramAnswer extends Model {
    use HasFactory;

    protected $table = 'furam_answers';

    public function user() {
        return $this->belongsTo( User::class );
    }
}
