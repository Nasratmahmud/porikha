<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SocialMediaController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'social setting' ) ) {
            if ( $request->ajax() ) {

                $data = SocialMedia::latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'title', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1 text-capitalize'><i class='bi bi-" . strtolower( $data['title'] ) . " me-2'></i>" . $data['title'] . "</span>";
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
                    ->rawColumns( ['title', 'status', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.setting.social_media' );
        }
        return redirect()->back();

    }
    // Edit Category
    public function edit( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'social setting' ) ) {
            if ( $request->ajax() ) {
                $social_media = SocialMedia::where( 'id', $request->id )->first();
                return response()->json( [
                    'success' => true,
                    'data'    => $social_media,
                ] );
            }
        }
        return redirect()->back();

    }
    /**
     * Insert Or Update
     *
     * @param Request $request
     *
     */
    public function addAndUpdate( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'social setting' ) ) {
            if ( $request->ajax() ) {
                $validate = Validator::make( $request->all(), [
                    'title' => 'required|string|unique:social_media,title,' . $request->id . 'id,',
                    'url'   => 'required|url',
                ] );
                if ( $validate->fails() ) {
                    return response()->json( [
                        'success' => false,
                        'message' => 'Title is required',
                        'data'    => $validate->errors(),
                    ] );
                }

                try {
                    SocialMedia::updateOrCreate(
                        ['id' => $request->id],
                        [
                            'title' => $request->title,
                            'url'   => $request->url,
                        ],
                    );
                    return response()->json( [
                        'success' => true,
                        'message' => 'Social Media Created',
                    ] );
                } catch ( Exception $e ) {
                    return response()->json( [
                        'success' => false,
                        'message' => 'Something went wrong',
                    ] );
                }
            }
        }
        return redirect()->back();

    }

    /**
     * Delete selected item
     * @param Request $request
     * @param $id
     */
    public function destroy( Request $request, $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'social setting' ) ) {
            try {
                if ( $request->ajax() ) {
                    SocialMedia::findOrFail( $id )->delete();
                    return response()->json( [
                        'success' => true,
                        'message' => 'Social Media Deleted Successfully.',
                    ] );
                }
            } catch ( Exception $th ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Something went Wrong',
                ] );
            }
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
        $data = SocialMedia::where( 'id', $id )->first();
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
