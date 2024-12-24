<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller {
   


     public function view(){
        $quizzes = Quiz::all();
        
        return view("backend.layout.quizzes.view",compact("quizzes"));
        // exit();
     }

     public function index(Request $request) {
        $cates = $request->input('category');
        $courses = Course::orderBy("id", "desc")->get();
        $quizzes = Quiz::orderBy("id", "desc")->get();
        $categories = QuestionCategory::orderBy("id", "desc")->get();
    
        if (auth()->user()->id) {
            if ($request->ajax()) {
                $categoriesWiseData = Question::with('options', 'category');
                if($cates && !empty($cates)){
                    $categoriesWiseData->whereIn('category_id', $cates);
                }
                $data = $categoriesWiseData->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function ($data) {
                        return $data->category->name;
                    })
                    ->addColumn('is_correct', function ($data) {
                        $correctOption = $data->options->firstWhere('is_correct', 1);
                        return $correctOption ? $correctOption->option_text : null;
                    })
                    ->rawColumns([ 'is_correct', 'category'])
                    ->make(true);
            }
            return view('backend.layout.quizzes.index', compact('courses', 'quizzes', 'categories'));
        }
        return redirect()->back();
     }
    
     public function store(Request $request)
     {
         $request->validate([
             'quiz_title' => 'required|string|max:255|unique:quizzes,title',
             'time' => 'required|integer|min:5',  
             'course_id' => 'required|exists:courses,id', 
             'question_ids' => 'required|array',  
             'question_ids.*' => 'exists:questions,id',  
         ]);

         $quizData = [
             'title' => $request->input('quiz_title'),
             'total_time' => $request->input('time'),
             'course_id' => $request->input('course_id'),
         ];

        if (isset($quizData)) {
            $quiz = Quiz::create($quizData);
        } else {
            return redirect()->back()->with('t-error','Not all data provided, please fillup all and try again.');
        }
         $quiz->questions()->sync($request->input('question_ids'));
     
        return redirect()->back()->with('t-success', 'successful create quiz');
     }



     public function edit(Request $request,$id) {
        $quizzes = Quiz::findOrFail( $id );
        $courses = Course::get();
        $categories = QuestionCategory::orderBy("id", "desc")->get();
        $selectedQuestions = $quizzes->questions->pluck('id')->toArray();
        if (auth()->user()->id) {
            if ($request->ajax()) {
                $data = Question::with('options');
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function ($data) {
                        return $data->category->name;
                    })
                    ->addColumn('is_correct', function ($data) {
                        $correctOption = $data->options->firstWhere('is_correct', 1);
                        return $correctOption ? $correctOption->option_text : null;
                    })
                    ->rawColumns(['is_correct', ])
                    ->make(true);
            }
            return view('backend.layout.quizzes.edit', compact( 'courses', 'quizzes','selectedQuestions'));
        }
        return redirect()->back();
    }




    public function update(Request $request, $id)
     {
        $request->validate([
            'quiz_title' => 'required|string|max:255',
            'time' => 'required|integer|min:5',
            'course_id' => 'required|exists:courses,id',
            'question_ids' => 'required|array',  
            'question_ids.*' => 'exists:questions,id',  
        ]);

         $quizData = [
             'title' => $request->input('quiz_title'),
             'total_time' => $request->input('time'),
             'course_id' => $request->input('course_id'),
         ];
         
         if (isset($id)) {
             $quiz = Quiz::findOrFail($id);
            
             $quiz->update($quizData);
             
         } 
        else {
            return redirect()->back()->with('t-error','Id not found.');
        }

         $quiz->questions()->sync($request->input('question_ids'));
         
        return redirect()->back()->with('t-success', 'successful create quiz');
        
     }
    
     
    public function destroy($id){
        try{
            $quiz = Quiz::findOrFail($id);
            // $quiz->questions()->delete();
            $quiz->delete();
        
            return redirect()->back()->with('t-error','deleted successfully');
        }
        catch (Exception $e){
            return redirect()->back()->with('t-error','delete quiz unsuccessful');
        }
    }
 
}
