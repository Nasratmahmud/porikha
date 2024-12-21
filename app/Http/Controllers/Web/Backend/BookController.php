<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Notifications\UserNotification;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'book menu' ) ) {
            if ( $request->ajax() ) {
                $data = Book::with( 'category' )->latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'feature_image', function ( $data ) {
                        $feature_image = url( $data->feature_image );
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data->book_name . '"></div>';
                    } )
                    ->addColumn( 'category_name', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1'>" . $data->category['category_name'] . "</span>";
                    } )
                    ->addColumn( 'book_author', function ( $data ) {
                        if ( $data->book_author ) {
                            return "<span class='bg-info rounded py-1 px-3 text-light me-1'>" . $data->book_author . "</span>";
                        } else {
                            return "<span class='bg-danger rounded py-1 px-3 text-light me-1'>No Author</span>";
                        }

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
                        if ( !$user->hasPermissionTo( 'edit book' ) && !$user->hasPermissionTo( 'delete book' ) ) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ( $user->hasPermissionTo( 'edit book' ) ) {
                            $html .= '<a href="' . route( 'book.edit', $data->id ) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ( $user->hasPermissionTo( 'delete book' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                <i class="bx bxs-trash"></i>
                            </a>';
                        }
                        $html .= '</div>';
                        return $html;
                    } )
                    ->rawColumns( ['feature_image', 'category_name', 'book_author', 'status', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.book.index' );
        }
        return redirect()->back();
    }

    /**
     * Insert View
     *
     * @param Request $request
     */
    public function create(): View {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create book' ) ) {
            $categories = Category::where( 'status', '1' )->orderBy( 'category_name' )->get();
            return view( 'backend.layout.book.create', compact( 'categories' ) );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create book' ) ) {
            $request->validate( [
                'book_name'     => 'required|string|unique:books,book_name',
                'book_author'   => 'required|string',
                'publish_date'  => 'required|string',
                'book_summary'  => 'required|string',
                'category_id'   => 'required',
                'tag'           => 'required|string',
                'feature_image' => 'required|file|mimes:jpeg,png,gif|max:5120',
                'file'          => 'required|file|mimes:pdf',
            ] );

            // Slug Check
            $slug = Book::where( 'book_slug', Str::slug( $request->book_name ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->book_name ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->book_name );
            }

            // random string generator
            $randomString = Str::random( 20 );

            // Image store in local
            $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'books/image', $request->feature_image . '_' . $randomString );
            // Image store in local
            $bookFile = Helper::fileUpload( $request->file( 'file' ), 'books/file', $request->file . '_' . $randomString );

            // Store data in database
            try {
                $users = User::all();

                $book = new Book();
                $book->book_name = $request->book_name;
                $book->book_slug = $slug_data;
                $book->book_author = $request->book_author;
                $book->category_id = $request->category_id;
                $book->publish_date = $request->publish_date;
                $book->tag = $request->tag;
                $book->book_summary = $request->book_summary;
                $book->feature_image = $featuredImage;
                $book->file = $bookFile;
                $book->save();
                foreach ( $users as $user ) {
                    if ( $user->id != Auth::user()->id && 2 == $user->user_type ) {
                        $user->notify( new UserNotification( "Admin: Upload New Book", " $book->book_name", route( 'book.collection' ) ) );
                    }
                }

                return redirect( route( 'book.index' ) )->with( 't-success', 'Book added successfully.' );

            } catch ( Exception $e ) {
                return redirect( route( 'book.create' ) )->with( 't-error', 'Something Went Wrong' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit book' ) ) {
            $categories = Category::where( 'status', '1' )->orderBy( 'category_name' )->get();
            $book = Book::where( 'id', $id )->first();
            return view( 'backend.layout.book.update', compact( 'book', 'categories' ) );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit book' ) ) {
            $request->validate( [
                'book_name'     => 'required|string|unique:books,book_name,' . $request->id . 'id,',
                'book_author'   => 'required|string',
                'publish_date'  => 'required|string',
                'book_summary'  => 'required|string',
                'category_id'   => 'required',
                'tag'           => 'required|string',
                'feature_image' => 'file|mimes:jpeg,png,gif|max:5120',
                'file'          => 'file|mimes:pdf',
            ] );

            // Slug Check
            $slug = Book::where( 'book_slug', Str::slug( $request->book_name ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->book_name ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->book_name );
            }

            // Store data in database
            try {
                $users = User::all();

                $book = Book::where( 'id', $request->id )->first();
                $book->book_name = $request->book_name;
                $book->book_slug = $slug_data;
                $book->book_author = $request->book_author;
                $book->category_id = $request->category_id;
                $book->publish_date = $request->publish_date;
                $book->tag = $request->tag;
                $book->book_summary = $request->book_summary;

                // random string generator
                $randomString = Str::random( 20 );
                // Check Image Update
                if ( $request->feature_image != null ) {

                    // Remove old image
                    if ( File::exists( $book->feature_image ) ) {
                        File::delete( $book->feature_image );
                    }
                    // Image store in local
                    $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'books/image', $request->feature_image . '_' . $randomString );
                    $book->feature_image = $featuredImage;
                }

                // Check File Update
                if ( $request->file != null ) {

                    // Remove old file
                    if ( File::exists( $book->file ) ) {
                        File::delete( $book->file );
                    }
                    $bookFile = Helper::fileUpload( $request->file( 'file' ), 'books/file', $request->file . '_' . $randomString );
                    $book->file = $bookFile;
                }
                $book->save();
                foreach ( $users as $user ) {
                    if ( $user->id != Auth::user()->id && 2 == $user->user_type ) {
                        $user->notify( new UserNotification( "Admin: Update Book", " $book->book_name", route( 'book.collection' ) ) );
                    }
                }

                return redirect( route( 'book.index' ) )->with( 't-success', 'Book Edit successfully.' );

            } catch ( Exception $e ) {
                return redirect( route( 'book.index' ) )->with( 't-error', 'Something Went Wrong' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete book' ) ) {
            if ( $request->ajax() ) {
                $book = Book::findOrFail( $id );
                if ( $book->feature_image != null ) {
                    // Remove image
                    if ( File::exists( $book->feature_image ) ) {
                        File::delete( $book->feature_image );
                    }
                }
                if ( $book->file != null ) {
                    // Remove file
                    if ( File::exists( $book->file ) ) {
                        File::delete( $book->file );
                    }
                }
                $book->delete();
                return response()->json( [
                    'success' => true,
                    'message' => 'Book Deleted Successfully.',
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
        $data = Book::where( 'id', $id )->first();
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
