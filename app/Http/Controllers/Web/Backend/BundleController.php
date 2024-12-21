<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Bundle;
use App\Models\BundleItem;
use App\Models\Course;
use App\Models\Journal;
use App\Models\User;
use App\Notifications\UserNotification;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BundleController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'bundle menu' ) ) {
            if ( $request->ajax() ) {
                $data = Bundle::with( 'bundle_items' )->latest();
                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'feature_image', function ( $data ) {
                        $feature_image = url( $data->feature_image );
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data->course_title . '"></div>';
                    } )
                    ->addColumn( 'title', function ( $data ) {
                        return "<span class='text-capitalize'>" . $data['title'] . "</span>";
                    } )
                    ->addColumn( 'sub_title', function ( $data ) {
                        return "<span class='text-capitalize'>" . $data['sub_title'] . "</span>";
                    } )
                    ->addColumn( 'total_items', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1'>" . count( $data['bundle_items'] ) . "</span>";
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
                        if ( !$user->hasPermissionTo( 'edit bundle' ) && !$user->hasPermissionTo( 'delete bundle' ) ) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ( $user->hasPermissionTo( 'edit bundle' ) ) {
                            $html .= '<a href="' . route( 'bundle.edit', $data->id ) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ( $user->hasPermissionTo( 'delete bundle' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                    class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                    <i class="bx bxs-trash"></i>
                                </a>';
                        }
                        $html .= '</div>';
                        return $html;
                    } )
                    ->rawColumns( ['feature_image', 'title', 'sub_title', 'total_items', 'status', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.bundle.index' );
        }
        return redirect()->back();

    }
    /**
     * Find Select item By type
     *
     */
    public function findItemByType( $type ) {
        if ( $type == '1' ) {
            $data = Journal::orderBy( 'journal_title' )->get();
            $dataType = 'journal';
        } else if ( $type == '2' ) {
            $data = Course::orderBy( 'course_title' )->get();
            $dataType = 'course';
        } else if ( $type == '3' ) {
            $data = Book::orderBy( 'book_name' )->get();
            $dataType = 'book';
        } else {
            $data = null;
            $dataType = 'content';
        }
        return response()->json( [
            'success' => true,
            'type'    => $dataType,
            'data'    => $data,
        ] );
    }
    /**
     * Insert View
     *
     * @param Request $request
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create bundle' ) ) {
            return view( 'backend.layout.bundle.create' );
        }
        return redirect()->back();

    }
    /**
     * Store data
     *
     * @param Request $request
     */
    public function store( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create bundle' ) ) {
//validation rules array
            $rules = [
                'title'         => 'required|string|max:255|unique:bundles,title',
                'sub_title'     => 'required|string|max:255|unique:bundles,sub_title',
                'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'item_number.*' => 'required|integer',
            ];
            //bundle item validation rules added into rules array
            foreach ( $request->item_number as $item_number ) {
                $rules["item_{$item_number}_title"] = "required|string|max:255";
                $rules["item_{$item_number}_type"] = "required|integer";
                $rules["select_{$item_number}_item"] = "required|integer";
                $rules["item_{$item_number}_sub_description"] = "nullable|string";
                $rules["item_{$item_number}_description"] = "nullable|string";
            }
            $validation = Validator::make( $request->all(), $rules );
            if ( $validation->validated() ) {
                // Slug Check
                $slug = Bundle::where( 'slug', Str::slug( $request->title ) )->first();
                $slug_data = '';

                if ( $slug ) {
                    // random string generator
                    $randomString = Str::random( 5 );
                    $slug_data = Str::slug( $request->title ) . $randomString;
                } else {
                    $slug_data = Str::slug( $request->title );
                }

                // random string generator
                $randomString = Str::random( 20 );
                // Image store in local
                $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'bundle', $request->feature_image . '_' . $randomString );

                // Store data in database
                try {
                    $users = User::all();
                    DB::beginTransaction();
                    //store Bundle
                    $bundle = new Bundle();
                    $bundle->title = $request->title;
                    $bundle->slug = $slug_data;
                    $bundle->sub_title = $request->sub_title;
                    $bundle->feature_image = $featuredImage;
                    $bundle->save();
                    //store bundle item
                    foreach ( $request->item_number as $item_number ) {
                        $bundleItem = new BundleItem();
                        $bundleItem->bundle_id = $bundle->id;
                        $bundleItem->title = $request["item_{$item_number}_title"];
                        $bundleItem->sub_description = $request["item_{$item_number}_sub_description"];
                        $bundleItem->description = $request["item_{$item_number}_description"];
                        $type = $request["item_{$item_number}_type"];
                        $bundleItem->type = $type;

                        if ( $type == "1" ) {
                            $bundleItem->journal_id = $request["select_{$item_number}_item"];
                        } else if ( $type == "2" ) {
                            $bundleItem->course_id = $request["select_{$item_number}_item"];
                        } else if ( $type == "3" ) {
                            $bundleItem->book_id = $request["select_{$item_number}_item"];
                        }
                        $bundleItem->save();
                    }
                    foreach ( $users as $user ) {
                        if ( $user->id != Auth::user()->id && 2 == $user->user_type ) {
                            $user->notify( new UserNotification( "Admin: Release New Bundle", " $bundle->title", route( 'single.bundle', $bundle->id ) ) );
                        }
                    }
                    DB::commit();
                    return redirect( route( 'bundle.index' ) )->with( 't-success', 'Bundle Create successfully.' );

                } catch ( Exception $e ) {
                    DB::rollBack();
                    return redirect( route( 'bundle.create' ) )->with( 't-error', 'Something went wrong' );
                }
            }
        }
        return redirect()->back();

    }

    /**
     * Get Selected item data
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit bundle' ) ) {
            $journals = Journal::orderBy( 'journal_title' )->get();
            $courses = Course::orderBy( 'course_title' )->get();
            $books = Book::orderBy( 'book_name' )->get();
            $bundle = Bundle::with( 'bundle_items' )->where( 'id', $id )->first();
            // return $bundle;
            return view( 'backend.layout.bundle.update', compact( 'bundle', 'journals', 'courses', 'books' ) );
        }
        return redirect()->back();

    }
    /**
     * Update selected item in database
     *
     * @param Request $request
     */
    public function update( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit bundle' ) ) {
//validation rules array
            $rules = [
                'title'         => 'required|string|max:255|unique:bundles,title,' . $request->id . 'id,',
                'sub_title'     => 'required|string|max:255|unique:bundles,sub_title,' . $request->id . 'id,',
                'feature_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'item_number.*' => 'required|integer',
            ];
            //bundle item validation rules added into rules array
            foreach ( $request->item_number as $item_number ) {
                $rules["item_{$item_number}_title"] = 'required|string|max:255';
                $rules["item_{$item_number}_type"] = "required|integer";
                $rules["select_{$item_number}_item"] = "required|integer";
                $rules["item_{$item_number}_sub_description"] = "nullable|string";
                $rules["item_{$item_number}_description"] = "nullable|string";
            }
            $validation = Validator::make( $request->all(), $rules );

            if ( $validation->validated() ) {
                // Slug Check
                $slug = Bundle::where( 'slug', Str::slug( $request->title ) )->first();
                $slug_data = '';

                if ( $slug ) {
                    // random string generator
                    $randomString = Str::random( 5 );
                    $slug_data = Str::slug( $request->title ) . $randomString;
                } else {
                    $slug_data = Str::slug( $request->title );
                }

                // Update data in database
                try {
                    DB::beginTransaction();
                    //update Bundle
                    $bundle = Bundle::where( 'id', $request->id )->first();
                    $bundle->title = $request->title;
                    $bundle->slug = $slug_data;
                    $bundle->sub_title = $request->sub_title;

                    // Check Image Update
                    if ( $request->feature_image != null ) {
                        // Remove old image
                        if ( File::exists( $bundle->feature_image ) ) {
                            File::delete( $bundle->feature_image );
                        }
                        // random string generator
                        $randomString = Str::random( 20 );
                        // Image store in local
                        $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'bundle', $request->feature_image . '_' . $randomString );
                        $bundle->feature_image = $featuredImage;
                    }
                    $bundle->save();

                    //store bundle item
                    foreach ( $request->item_number as $item_number ) {
                        $type = $request["item_{$item_number}_type"];
                        $journal_id = $course_id = $book_id = null;
                        if ( $type == "1" ) {
                            $journal_id = $request["select_{$item_number}_item"];
                        } else if ( $type == "2" ) {
                            $course_id = $request["select_{$item_number}_item"];
                        } else if ( $type == "3" ) {
                            $book_id = $request["select_{$item_number}_item"];
                        }

                        BundleItem::updateOrCreate( [
                            'id' => $request["item_{$item_number}_id"],
                        ], [
                            'title'           => $request["item_{$item_number}_title"],
                            'sub_description' => $request["item_{$item_number}_sub_description"],
                            'description'     => $request["item_{$item_number}_description"],
                            'type'            => $type,
                            'journal_id'      => $journal_id,
                            'course_id'       => $course_id,
                            'book_id'         => $book_id,
                            'bundle_id'       => $bundle->id,
                        ] );
                    }
                    DB::commit();
                    return redirect( route( 'bundle.index' ) )->with( 't-success', 'Bundle Edit successfully.' );

                } catch ( Exception $e ) {
                    DB::rollBack();
                    dd( $e->getMessage() );
                    return redirect( back() )->with( 't-error', 'Something Went Wrong' );
                }
            }
        }
        return redirect()->back();

    }

    /**
     * Delete selected Course item
     * @param Request $request
     * @param $id
     */
    public function destroy( Request $request, $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete bundle' ) ) {
            try {
                if ( $request->ajax() ) {
                    DB::beginTransaction();
                    BundleItem::where( 'bundle_id', $id )->delete();
                    Bundle::where( 'id', $id )->delete();
                    DB::commit();
                    return response()->json( [
                        'success' => true,
                        'message' => 'Bundle Deleted Successfully.',
                    ] );
                }
            } catch ( Exception $th ) {
                DB::rollBack();
                return response()->json( [
                    'success' => false,
                    'message' => 'Something went wrong',
                ] );
            }
        }
        return redirect()->back();

    }

    /**
     * Delete bundle item
     * @param Request $request
     * @param $id
     */
    public function bundleItemDestroy( Request $request, $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete bundle' ) ) {
            try {
                if ( $request->ajax() ) {
                    BundleItem::where( 'id', $id )->delete();
                    return response()->json( [
                        'success' => true,
                        'message' => 'Item Deleted Successfully.',
                    ] );
                }
            } catch ( Exception $th ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Something went wrong',
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
        $data = Bundle::where( 'id', $id )->first();
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
