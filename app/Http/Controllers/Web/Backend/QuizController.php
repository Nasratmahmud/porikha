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
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */


     public function view1(){
        $quizzes = Quiz::all();
        return view("backend.layout.quizzes.view",compact("quizzes"));
     }


     public function view(Request $request)
     {
         if (auth()->user()->id) {
             // $data = Course::with( 'category' );
             // dd($data);
 
             if ($request->ajax()) {
                //  $data = Question::with('options')->get();
                $data = Quiz::with('questions')->get();
                 return DataTables::of($data)
                     ->addIndexColumn()
 
                     // ->addColumn('status', function ($data) {
                     //     $status = ' <div class="form-check form-switch d-flex justify-content-center align-items-center">';
                     //     $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                     //     if ($data->status == 1) {
                     //         $status .= 'checked';
                     //     }
                     //     $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';
 
                     //     return $status;
                     // })
 
                    //  ->addColumn('category', function ($data) {
                    //      return $data->questions->category->name;
                    //  })
                     ->addColumn('action', function ($data) {
                         $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
 
                         $html .= '<a href="' . route('quizzes.edit', $data->id) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
 
                         $html .='<a href="#" onclick="showDeleteConfirm(' .$data->id .')" type="button"
                                         class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                         <i class="bx bxs-trash"></i>
                                     </a>';
 
                         $html .= '</div>';
                         return $html;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
             }
             return view('backend.layout.quizzes.view');
             // return redirect()->route('some.route')->with('success', 'Data has been saved!');
         }
         return redirect()->back();
 
         // return view("backend.layout.question_category.index");
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
                    ->addColumn('action', function ($data) {
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        $html .= '<a href="#" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger btn-sm text-white" title="Delete" readonly><i class="bx bxs-trash"></i></a>';
                        $html .= '</div>';
                        return $html;
                    })
                    ->rawColumns(['action', 'is_correct', 'category'])
                    ->make(true);
            }
    
            return view('backend.layout.quizzes.index', compact('courses', 'quizzes', 'categories'));
        }
    
        return redirect()->back();
 }
    

     

     public function store(Request $request)
     {
         $request->validate([
            //  'quiz_id' => 'nullable|exists:quizzes,id',  
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
         
        //  if ($request->has('quiz_id')) {
        //      $quiz = Quiz::findOrFail($request->quiz_id);
        //      $quiz->update($quizData);
        //  } else {
        //      $quiz = Quiz::create($quizData);
        //  }

        if (isset($quizData)) {
            $quiz = Quiz::create($quizData);
        } else {
            return redirect()->back()->with('t-error','Not all data provided, please fillup all and try again.');
        }
         $quiz->questions()->sync($request->input('question_ids'));
     
        return redirect()->back()->with('t-success', 'successful create quiz');
     }
     
    /**
     * Get Selected item data
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit quiz' ) ) {
            $quiz = Quiz::with( 'quistions' )->where( 'id', $id )->first();
            $courses = Course::all();
            $modules = CourseModule::all();
            return view( 'backend.layout.quiz.update', compact( 'quiz', 'courses', 'modules' ) );
        }
        return redirect()->back();
    }

   
    /**
     * Change Data the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status( $id ) {
        $data = Quiz::where( 'id', $id )->first();
        if ( $data->status == 1 ) {
            $data->status = '0';
            $data->save();
            return response()->json( [
                'success' => false,
                'message' => 'Unpublished Successfully.',
            ] );
        } else {
            $data->status = '1';
            $data->save();
            return response()->json( [
                'success' => true,
                'message' => 'Published Successfully.',
            ] );
        }
    }
 
}
