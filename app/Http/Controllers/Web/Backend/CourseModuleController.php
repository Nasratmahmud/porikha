<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CourseModuleController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( $request->ajax() ) {

            $data = CourseModule::with( 'course' )->latest();

            return DataTables::of( $data )
                ->addIndexColumn()
                ->addColumn( 'course_title', function ( $data ) {
                    return $data->course->course_title;
                } )
                ->addColumn( 'status', function ( $data ) {
                    $status = ' <div class="form-check form-switch d-flex justify-content-center align-items-center">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ( $data->status == 1 ) {
                        $status .= "checked";
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                } )
                ->addColumn( 'action', function ( $data ) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="#" onclick="showEditModalWithData(' . $data->id . ')" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                    class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                    <i class="bx bxs-trash"></i>
                                </a>
                            </div>';
                } )
                ->rawColumns( ['course_title', 'status', 'action'] )
                ->make( true );
        }
        $courses = Course::orderBy( 'course_title' )->get();
        return view( 'backend.layout.course_module.index', compact( 'courses' ) );
    }

    // Edit Category
    public function edit( Request $request ) {
        if ( $request->ajax() ) {
            $course = CourseModule::where( 'id', $request->id )->first();
            return response()->json( [
                'success' => true,
                'data'    => $course,
            ] );
        }
    }

    /**
     * Insert Or Update
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function addAndUpdate( Request $request ) {
        if ( $request->ajax() ) {
            $validate = Validator::make( $request->all(), [
                'course_module_name' => 'required|string|unique:course_modules,course_module_name,' . $request->id . 'id,',
            ] );
            if ( $validate->fails() ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Module name is required',
                ] );
            }
            if ( $request->course_id == 0 ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Please Select Course',
                ] );
            }

            // Slug Exist Check
            $slug = CourseModule::where( 'course_module_slug', Str::slug( $request->course_module_name ) )->whereNot( 'id', $request->id )->first();
            $slug_data = '';
            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->course_module_name ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->course_module_name );
            }

            try {
                CourseModule::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'course_module_slug' => $slug_data,
                        'course_module_name' => $request->course_module_name,
                        'course_id'          => $request->course_id,
                    ],
                );
                return response()->json( [
                    'success' => true,
                    'message' => 'Success',
                ] );
            } catch ( Exception $e ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Something went wrong',
                    'data'    => $e->getMessage(),
                ] );
            }
        }

    }

    /**
     * Delete selected item
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( Request $request, $id ) {
        if ( $request->ajax() ) {
            CourseModule::findOrFail( $id )->delete();
            return response()->json( [
                'success' => true,
                'message' => 'Course Module Deleted Successfully.',
            ] );
        }
    }

    /**
     * Change Data the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status( $id ) {
        $data = CourseModule::where( 'id', $id )->first();
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
