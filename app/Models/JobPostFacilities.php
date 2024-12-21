<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPostFacilities extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['job_post_id', 'facility'];
}
