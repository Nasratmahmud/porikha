<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'receipt_url',
    ];


    public function course() {
        return $this->belongsTo( Course::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }


}
