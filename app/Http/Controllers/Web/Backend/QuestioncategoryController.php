<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class QuestioncategoryController extends Controller
{
    //

    public function index(Request $request){

        if (auth()->user()->id) {
            if ($request->ajax()) {
                $data = QuestionCategory::all();

                return DataTables::of($data)
                    ->addIndexColumn()

                    ->addColumn('action', function ($data) {
                        
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                       
                        $html .= '<a href="' . route('question.category.edit', $data->id) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                       
                        
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
            return view('backend.layout.question_category.index');
        }
        return redirect()->back();

    }


    public function create(){
        return view('backend.layout.question_category.create');
    }


    public function store(Request $request)
    {
        try {

        $validator = Validator::make($request->all(), [
            'question_title'=> 'required|string|unique:question_categories,name',
        ]) ;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
        $questionCategory = new QuestionCategory();
        $questionCategory->name = $request->question_title;
        $questionCategory->save();

    return redirect()->route('question.category.index')->with('t-success', 'New Question Category Create!');
        } catch (\Exception $e) {
            return redirect()->route('question.category.index')->with('t-error', 'Something goes wrong to create category!');
        }
    }


    public function edit($id){
        $questionCategory = QuestionCategory::findOrFail($id);
        return view('backend.layout.question_category.edit', compact('questionCategory'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'question_title'=> 'required|string|unique:question_categories,name',
            ]) ;

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
   
            if($request->question_title != null){
                $questionCategory = QuestionCategory::findOrFail($id);
                $questionCategory->name = $request->question_title;
                $questionCategory->save();

                return redirect()->route('question.category.index')->with('t-success', 'Question Category Updated!');
            }
            else{
                return redirect()->route('question.category.edit')->with('t-warning', 'Null not allow!');
            }
        } catch (\Exception $e) {
            return redirect()->route('question.category.index')->with('t-error', 'Something goes wrong to edit category!');
        }
    }

    public function destroy($id)
    {
        try {
        $questionCategory = QuestionCategory::findOrFail($id);
        $questionCategory->delete();
        return redirect()->back()->with('t-error', 'Question Category Deleted!');
        } catch (\Exception $e) 
            {
                return redirect()->back()->with('t-error', 'Something Goes Wrong to Delete Question Category!');
            }
    }

}