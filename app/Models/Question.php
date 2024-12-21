<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'question_text', 'note'];

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id');
    }

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }
}
