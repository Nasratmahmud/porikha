<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Guide;
use App\Models\User;
use App\Notifications\UserNotification;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class GuideController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'guide menu' ) ) {
            if ( $request->ajax() ) {

                $data = Guide::with( 'category' )->latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'feature_image', function ( $data ) {
                        $feature_image = url( $data->feature_image );
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data->book_name . '"></div>';
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
                    ->addColumn( 'category_name', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1'>" . $data->category['category_name'] . "</span>";
                    } )
                    ->addColumn( 'action', function ( $data ) {
                        $user = User::find( auth()->user()->id );
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        if ( !$user->hasPermissionTo( 'edit guide' ) && !$user->hasPermissionTo( 'delete guide' ) ) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ( $user->hasPermissionTo( 'edit guide' ) ) {
                            $html .= '<a href="' . route( 'guide.edit', $data->id ) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ( $user->hasPermissionTo( 'delete guide' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                            class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                            <i class="bx bxs-trash"></i>
                                        </a>';
                        }
                        $html .= '</div>';
                        return $html;
                    } )
                    ->rawColumns( ['feature_image', 'category_name', 'status', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.guide.index' );
        }
        return redirect()->back();

    }
    /**
     * Insert View
     *
     * @param Request $request
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create guide' ) ) {
            $categories = Category::where( 'status', '1' )->orderBy( 'category_name' )->get();
            return view( 'backend.layout.guide.create', compact( 'categories' ) );
        }
        return redirect()->back();

    }

    /**
     * Store data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create guide' ) ) {
            $request->validate( [
                'guide_name'        => 'required|string|unique:guides,guide_name',
                'category_id'       => 'required',
                'tag'               => 'required|string',
                'guide_description' => 'required|string',
                'feature_image'     => 'required|file|mimes:jpeg,png,gif|max:5120',
            ] );

            // Slug Check
            $slug = Guide::where( 'guide_slug', Str::slug( $request->guide_name ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->guide_name ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->guide_name );
            }
            // random string generator
            $randomString = Str::random( 20 );
            // Image store in local
            $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'guide', $request->feature_image . '_' . $randomString );

            // Store data in database
            try {
                $users = User::all();

                $guide = new Guide();
                $guide->guide_name = $request->guide_name;
                $guide->guide_slug = $slug_data;
                $guide->category_id = $request->category_id;
                $guide->tag = $request->tag;
                $guide->guide_description = $request->guide_description;
                $guide->feature_image = $featuredImage;
                $guide->save();

                foreach ( $users as $user ) {
                    if ( $user->id != Auth::user()->id && 2 == $user->user_type ) {
                        $user->notify( new UserNotification( "Admin: Write a Guide", " $guide->guide_name", route( 'guidances.single', $guide->guide_slug ) ) );
                    }
                }

                return redirect( route( 'guide.index' ) )->with( 't-success', 'Guide added successfully.' );

            } catch ( Exception $e ) {
                return redirect( route( 'guide.create' ) )->with( 't-error', 'Something Went Wrong' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit guide' ) ) {
            $categories = Category::where( 'status', '1' )->orderBy( 'category_name' )->get();
            $guide = Guide::where( 'id', $id )->first();
            return view( 'backend.layout.guide.update', compact( 'guide', 'categories' ) );
        }
        return redirect()->back();

    }

    /**
     * Update selected item in database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit guide' ) ) {
            $request->validate( [
                'guide_name'        => 'required|string|unique:guides,guide_name,' . $request->id . 'id',
                'category_id'       => 'required',
                'tag'               => 'required|string',
                'guide_description' => 'required|string',
                'feature_image'     => 'file|mimes:jpeg,png,gif|max:5120',
            ] );

            // Slug Check
            $slug = Guide::where( 'guide_slug', Str::slug( $request->guide_name ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->guide_name ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->guide_name );
            }

            // Store data in database
            try {
                $guide = Guide::where( 'id', $request->id )->first();
                $guide->guide_name = $request->guide_name;
                $guide->guide_slug = $slug_data;
                $guide->category_id = $request->category_id;
                $guide->tag = $request->tag;
                $guide->guide_description = $request->guide_description;

                // random string generator
                $randomString = Str::random( 20 );
                // Check Image Update
                if ( $request->feature_image != null ) {

                    // Remove old image
                    if ( File::exists( $guide->feature_image ) ) {
                        File::delete( $guide->feature_image );
                    }
                    // Image store in local
                    $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'guide', $request->feature_image . '_' . $randomString );
                    $guide->feature_image = $featuredImage;
                }
                $guide->save();

                return redirect( route( 'guide.index' ) )->with( 't-success', 'Guide Edit successfully.' );

            } catch ( Exception $e ) {
                return redirect( route( 'guide.index' ) )->with( 't-error', 'Something Went Wrong' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete guide' ) ) {
            if ( $request->ajax() ) {
                $guide = Guide::findOrFail( $id );
                if ( $guide->feature_image != null ) {
                    // Remove image
                    if ( File::exists( $guide->feature_image ) ) {
                        File::delete( $guide->feature_image );
                    }
                }
                $guide->delete();
                return response()->json( [
                    'success' => true,
                    'message' => 'Guide Deleted Successfully.',
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
        $data = Guide::where( 'id', $id )->first();
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
