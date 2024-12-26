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

            if ($request->ajax()) {
                $data = Question::with('options')->get();
                return DataTables::of($data)
                    ->addIndexColumn()

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
        }
        return redirect()->back();

    }

    public function create()
    {
        $categories = QuestionCategory::get();
        return view('backend.layout.question.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
        
        $request->validate([
            'category_id' => 'required|exists:question_categories,id',
            'question_title' => 'required',
            'options' => 'required|array|min:4',
            'options.*.option_text' => 'required',
            'corrects' => 'required',
            'note' => 'nullable',
        ]);

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

        }catch (\Exception $e) {
            return redirect()->back()->with('t-error','error');
        }
    }

    public function edit($id)
    {
        $categories = QuestionCategory::get();
        $question = Question::with('options')->findOrFail($id);
        return view('backend.layout.question.edit', compact('question', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            
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
