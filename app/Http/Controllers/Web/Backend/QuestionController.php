<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use App\Http\Controllers\Controller;
use App\Models\Option;
use PhpParser\Node\Stmt\Continue_;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    //
    public function index(Request $request)
    {
        if (auth()->user()->id) {
            // $data = Course::with( 'category' );
            // dd($data);

            if ($request->ajax()) {
                $data = Question::with('options')->get();
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

                    ->addColumn('is_correct', function ($data) {
                        $correctOption = $data->options->firstWhere('is_correct', 1);
                        return $correctOption ? $correctOption->option_text : null;
                    })
                    ->addColumn('action', function ($data) {
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';

                        $html .= '<a href="' . route('questions.edit', $data->id) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';

                        $html .='<a href="#" onclick="showDeleteConfirm(' .$data->id .')" type="button"
                                        class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                        <i class="bx bxs-trash"></i>
                                    </a>';

                        $html .= '</div>';
                        return $html;
                    })
                    ->rawColumns(['action', 'is_correct'])
                    ->make(true);
            }
            return view('backend.layout.question.index');
            // return redirect()->route('some.route')->with('success', 'Data has been saved!');
        }
        return redirect()->back();

        // return view("backend.layout.question_category.index");
    }

    public function create()
    {
        $categories = QuestionCategory::get();
        return view('backend.layout.question.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // try {
        //   dd($request->all());
        // $request->validate([
        //     'category_id' => 'required|exists:questions,id',
        //     'question_title' => 'required',
        //     'options' => 'required|array|min:4',
        //     'options.*.option_text' => 'required',
        //     'corrects' => 'required',
        //     'note' => 'nullable',
        // ]);

        $question = new Question();

        $question->category_id = $request->category_id;
        $question->question_text = $request->question_title;
        $question->note = $request->note;
        $question->save();

        foreach ($request->options as $key => $option) {
            $isCorrect = $key == $request->corrects ? true : false;

            $question->options()->create([
                'option_text' => $option['option_text'],
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->back()->with('t-success', 'successful add');

        // }catch (\Exception $e) {
        //     return redirect()->back()->with('t-error','error');
        // }
    }

    public function edit($id)
    {
        $categories = QuestionCategory::get();
        $question = Question::with('options')->findOrFail($id);
        //dd($question);
        return view('backend.layout.question.edit', compact('question', 'categories'));
    }

    //     public function update(Request $request, $id)
    //     {
    //         //dd($request->all());

    //         // try {
    //                 // $request->validate([
    //                 //     'category_id' => 'required|exists:questions,id',
    //                 //     'question_title' => 'required',
    //                 //     'options' => 'required|array|min:4',
    //                 //     'options.*.option_text' => 'required',
    //                 //     'corrects' => 'required',
    //                 //     'note' => 'nullable',
    //                 // ]);
    // // dd($request->all());

    //                 $question = Question::findOrFail($id);
    //                 $option_ids = Option::where('question_id',$id)->get();
    //                 $question->category_id = $request->category_id;
    //                 $question->question_text = $request->question_title;
    //                 $question->note = $request->note;
    //                 $question->save();

    //                 // foreach ($request->options as $key => $option) {
    //                 //     $questionOption = $question->options()->find($option_ids->id);

    //                 //     if ($questionOption) {
    //                 //         // Determine if this option is the correct one
    //                 //         $isCorrect = $key == $request->corrects ? true : false;

    //                 //         // Update the option with the new values
    //                 //         $questionOption->update([
    //                 //             'option_text' => $option['option_text'],
    //                 //             'is_correct' => $isCorrect,
    //                 //         ]);
    //                 //     }
    //                 // }
    //                 foreach ($option_ids as $option_id) {
    //                     $questionOption = $question->options()->find($option_id->id);
    //                     foreach ($request->options as $key => $option) {

    //                         // dd($questionOption->id);
    //                         if($questionOption->id == $option_id->id) {
    //                             if($questionOption){
    //                                 $isCorrect = $key == $request->corrects ? true : false;
    //                                 // dd($questionOption);
    //                                 $questionOption->update([

    //                                     'option_text' => $option['option_text'],
    //                                     'is_correct' => $isCorrect,

    //                                 ]);

    //                             }
    //                         }
    //                         // break;
    //                     }
    //                 }

    //                 // foreach ($option_ids as $option_id) {
    //                 //     // Find the option from the database using the ID
    //                 //     $questionOption = $question->options()->find($option_id->id);

    //                 //     // Check if the option is found
    //                 //     if ($questionOption) {
    //                 //         // Iterate over the options from the request to update them one by one
    //                 //         foreach ($request->options as $key => $option) {
    //                 //             // If the current option ID matches the option in the database
    //                 //             if ($questionOption->id == $option['id']) {
    //                 //                 // Determine if this option is the correct one
    //                 //                 $isCorrect = ($key == $request->corrects) ? true : false;

    //                 //                 // Update the option with the new data
    //                 //                 $questionOption->update([
    //                 //                     'option_text' => $option['option_text'],
    //                 //                     'is_correct' => $isCorrect,
    //                 //                 ]);

    //                 //                 // After updating, break out of the inner loop to move to the next option in the outer loop
    //                 //                 break;
    //                 //             }
    //                 //         }
    //                 //     }
    //                 // }

    //                 return redirect()->back()->with('t-success','successful update');

    //             // }catch (\Exception $e) {
    //             //     return redirect()->back()->with('t-error','error');
    //             // }
    //     }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'question_title'=> 'required|string|unique:question_categories,name',
    //         ]) ;

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         if($request->question_title != null){
    //             $questionCategory = QuestionCategory::findOrFail($id);
    //             $questionCategory->name = $request->question_title;
    //             $questionCategory->save();

    //             return redirect()->route('question.category.index')->with('t-success', 'Question Category Updated!');
    //         }
    //         else{
    //             return redirect()->route('question.category.edit')->with('t-warning', 'Null not allow!');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('question.category.index')->with('t-error', 'Something goes wrong to edit category!');
    //     }
    // }

    // public function destroy($id)
    // {
    //     try {
    //     $questionCategory = QuestionCategory::findOrFail($id);
    //     $questionCategory->delete();
    //     return redirect()->back()->with('t-error', 'Question Category Deleted!');
    //     } catch (\Exception $e)
    //         {
    //             return redirect()->back()->with('t-error', 'Something Goes Wrong to Delete Question Category!');
    //         }
    // }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'category_id' => 'required|exists:question_categories,id', // Assuming `category_id` belongs to `question_categories`
                'question_title' => 'required',
                'options' => 'required|array|min:4',
                'options.*.option_text' => 'required',
                'corrects' => 'required|integer',
                'note' => 'nullable',
            ]);

            $question = Question::findOrFail($id);

            $question->category_id = $request->category_id;
            $question->question_text = $request->question_title;
            $question->note = $request->note;
            $question->save();

            foreach ($request->options as $key => $option) {
                $questionOption = $question->options()->find($option['id']);

                if ($questionOption) {
                    $isCorrect = $key == $request->corrects ? true : false;

                    $questionOption->update([
                        'option_text' => $option['option_text'],
                        'is_correct' => $isCorrect,
                    ]);
                }
            }

            return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error updating the question!');
        }
    }


    public function destroy($id)
    {
        try {
            $question = Question::findOrFail($id);

            $question->options()->delete();

            $question->delete();

            return redirect()->route('questions.index')->with('t-success', 'Question and its options were successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->route('questions.index')->with('t-error', 'Error deleting the question. Please try again.');
        }
    }

}
