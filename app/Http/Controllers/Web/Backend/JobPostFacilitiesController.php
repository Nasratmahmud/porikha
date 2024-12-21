<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobPostFacilities;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JobPostFacilitiesController extends Controller {
    /**
     *
     * Facilities Index
     *
     */
    public function index( Request $request, $id ) {
        if ( $request->ajax() ) {
            $data = JobPostFacilities::where( 'job_post_id', $id )->latest();
            return DataTables::of( $data )
                ->addIndexColumn()
                ->addColumn( 'action', function ( $data ) {
                    $user = User::find( auth()->user()->id );
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                    if ( $user->hasPermissionTo( 'edit jobpost' ) ) {
                        $html .= '<button onclick="editFacilities(' . $data->id . ', \'' . $data->facility . '\')" type="button" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></button>';
                    }

                    if ( $user->hasPermissionTo( 'delete jobpost' ) ) {
                        $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                        class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                        <i class="bx bxs-trash"></i>
                    </a>';
                    }
                    $html .= '</div>';

                    return $html;
                } )
                ->rawColumns( ['action'] )
                ->make( true );
        }
        return view( 'backend.layout.facilties.index', compact( 'id' ) );
    }

    public function create( $id ) {
        return view( 'backend.layout.facilties.create', compact( 'id' ) );
    }

    public function store( Request $request ) {
        $validate = Validator::make( $request->all(), [
            'facility' => 'required|string',
            'id'       => 'nullable|numeric',
            'post_id'  => 'required|numeric|exists:job_posts,id',
        ] );
        if ( $validate->fails() ) {
            return response()->json( [
                'success' => false,
                'data'    => $validate->errors(),
            ] );
        }

        try {
            JobPostFacilities::updateOrCreate(
                ['id' => $request->id],
                [
                    'job_post_id' => $request->post_id,
                    'facility'    => $request->facility,
                ]
            );
            return response()->json( [
                'success' => true,
                'message' => 'Successfull Stored',
            ] );
        } catch ( Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e,
            ] );
        }

    }

    /**
     *
     * Delete Specific record
     *
     */
    public function destroy( Request $request, $id ) {
        if ( $request->ajax() ) {
            $data = JobPostFacilities::findOrFail( $id );
            if ( $data ) {
                $data->delete();
            }
            return response()->json( [
                'success' => true,
                'message' => 'Facility Deleted Successfully.',
            ] );
        }
    }
}
