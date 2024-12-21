<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::with('options')
            ->when($request->quiz_category_id, function ($query, $quizCategoryId) {
                $query->where('quiz_category_id', $quizCategoryId);
            })
            ->get();

        return $questions;
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_category_id' => 'required|exists:quiz_categories,id',
            'question_text' => 'required',
            'options' => 'required|array|min:4',
            'options.*.option_text' => 'required',
            'options.*.is_correct' => 'required|boolean',
            'note' => 'nullable',
        ]);

        $question = Question::create([
            'quiz_category_id' => $request->quiz_category_id,
            'question_text' => $request->question_text,
            'note' => $request->note,
        ]);

        foreach ($request->options as $option) {
            $question->options()->create($option);
        }

        return $question;
    }
}
