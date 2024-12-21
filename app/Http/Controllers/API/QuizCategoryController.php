<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use App\Traits\apiresponse;

class QuizCategoryController extends Controller
{
    use apiresponse;
    public function index()
    {
        $quizCategories=QuestionCategory::all();
        return $this->success($quizCategories, 'Courses with total lessons retrieved successfully', 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:quiz_categories']);
        return QuestionCategory::create(['name' => $request->name]);
    }
}
