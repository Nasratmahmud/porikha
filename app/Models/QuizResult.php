<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'user_id', 'score', 'total_questions', 'percentage','answers'];
    protected $casts = [
        'answers' => 'array', // Automatically cast JSON column to an array
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
