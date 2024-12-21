<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'category menu' ) ) {
            if ( $request->ajax() ) {

                $data = Category::latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'category_image', function ( $data ) {
                        $feature_image = url( $data['category_image'] ?? "backend/images/no-image.jpg" );
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data['category_name'] . '"></div>';
                    } )
                    ->addColumn( 'category_name', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1 text-capitalize'>" . $data['category_name'] . "</span>";
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
                        $user = User::find( auth()->user()->id );
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        if ( !$user->hasPermissionTo( 'edit category' ) && !$user->hasPermissionTo( 'delete category' ) ) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ( $user->hasPermissionTo( 'edit category' ) ) {
                            $html .= '<a  href="#" onclick="showEditModalWithData(' . $data->id . ')" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ( $user->hasPermissionTo( 'delete category' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                <i class="bx bxs-trash"></i>
                            </a>';
                        }
                        $html .= '</div>';
                        return $html;
                    } )
                    ->rawColumns( ['category_image', 'category_name', 'status', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.category.index' );
        }
        return redirect()->back();

    }
    // Edit Category
    public function edit( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit category' ) ) {
            if ( $request->ajax() ) {
                $category = Category::where( 'id', $request->id )->first();
                return response()->json( [
                    'success' => true,
                    'data'    => $category,
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create category' ) ) {
            if ( $request->ajax() ) {
                $validate = Validator::make( $request->all(), [
                    'category_name'  => 'required|string|unique:categories,category_name,' . $request->id . 'id,',
                    'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                ] );
                if ( $validate->fails() ) {
                    return response()->json( [
                        'success' => false,
                        'message' => 'Category name is required',
                        'data'    => $validate->errors(),
                    ] );
                }

                // Slug Exist Check
                $slug = Category::where( 'category_slug', Str::slug( $request->category_name ) )->whereNot( 'id', $request->id )->first();
                $slug_data = '';
                if ( $slug ) {
                    // random string generator
                    $randomString = Str::random( 5 );
                    $slug_data = Str::slug( $request->category_name ) . $randomString;
                } else {
                    $slug_data = Str::slug( $request->category_name );
                }
                $msg = 'Category Created Successfully';
                $category = Category::find( $request->id );
                if ( $category != null ) {
                    $msg = 'Category Update Successfully';
                }

                $imageUrl = $category->category_image ?? null;
                if ( $request->file( 'category_image' ) != null ) {
                    // Remove old image
                    if ( $imageUrl && File::exists( $imageUrl ) ) {
                        File::delete( $imageUrl );
                    }
                    // Image store in local
                    $imageUrl = Helper::fileUpload( $request->file( 'category_image' ), 'category', $slug_data );
                }

                try {
                    Category::updateOrCreate(
                        ['id' => $request->id],
                        [
                            'category_slug'  => $slug_data,
                            'category_name'  => $request->category_name,
                            'category_image' => $imageUrl,
                        ],
                    );
                    return response()->json( [
                        'success' => true,
                        'message' => $msg,
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete category' ) ) {
            try {
                if ( $request->ajax() ) {
                    $category = Category::findOrFail( $id );
                    if ( File::exists( $category->category_image ) ) {
                        File::delete( $category->category_image );
                    }
                    $category->delete();
                    return response()->json( [
                        'success' => true,
                        'message' => 'Category Deleted Successfully.',
                    ] );
                }
            } catch ( Exception $th ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Can\'t Delete because this category use somewhere.',
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
        $data = Category::where( 'id', $id )->first();
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
