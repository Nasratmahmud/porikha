<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class JournalController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'journal menu' ) ) {
            if ( $request->ajax() ) {

                $data = Journal::with( 'user' )->latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'feature_image', function ( $data ) {
                        $feature_image = url( $data->journal_featured_image );
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data->journal_title . '"></div>';
                    } )
                    ->addColumn( 'tags', function ( $data ) {
                        $tags = explode( ",", $data->tag );
                        $dataTag = "";
                        foreach ( $tags as $tag ) {
                            $dataTag .= "<span class='bg-primary rounded py-1 px-3 text-light me-1'>$tag</span>";
                        }
                        return $dataTag;
                    } )
                    ->addColumn( 'privacy', function ( $data ) {
                        if ( $data->journal_type == 2 ) {
                            return "<span class='bg-danger rounded py-1 px-3 text-light'>Private</span>";
                        } else {
                            return "<span class='bg-info rounded py-1 px-3 text-light'>Public</span>";
                        }

                    } )
                    ->addColumn( 'action', function ( $data ) {
                        $user = User::find( auth()->user()->id );
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        if ( !$user->hasPermissionTo( 'edit journal' ) && !$user->hasPermissionTo( 'delete journal' ) ) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ( $user->hasPermissionTo( 'edit journal' ) ) {
                            $html .= '<a href="' . route( 'admin.journal.edit', $data->id ) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ( $user->hasPermissionTo( 'delete journal' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                            class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                            <i class="bx bxs-trash"></i>
                        </a>';
                        }
                        $html .= '</div>';

                        return $html;
                    } )
                    ->addColumn( 'username', function ( $data ) {
                        if ( $data->user->name ) {
                            return "<span class='text-capitalize'>{$data->user->name}</span>";
                        } else {
                            return "<span class='text-capitalize'>{$data->user->username}</span>";
                        }

                    } )

                    ->rawColumns( ['feature_image', 'tags', 'privacy', 'username', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.journal.index' );
        }
        return redirect()->back();

    }

    /**
     *
     * Create Page
     */
    public function create() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create journal' ) ) {
            return view( 'backend.layout.journal.create' );
        }
        return redirect()->back();
    }

    /**
     *
     * Store The Resource
     */
    public function store( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create journal' ) ) {
            $request->validate( [
                'journal_title' => 'required|string',
                'description'   => 'required|string',
                'tag'           => 'required|string',
                'type'          => 'required|min:1|max:2',
                'feature_image' => 'required|file|mimes:jpeg,png,gif|max:5120',
            ] );

            // type 1 Is Public, Type 2 Is Private

            // Slug Check
            $slug = Journal::where( 'journal_slug', Str::slug( $request->journal_title ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->journal_title ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->journal_title );
            }

            try {
                $users = User::all();

                $journal = new Journal();
                $journal->journal_title = $request->journal_title;
                $journal->journal_slug = $slug_data;
                $journal->description = $request->description;

                // random string generator
                $randomString = Str::random( 20 );

                // Image store in local
                $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'journal', $request->feature_image . '_' . $randomString );

                $journal->journal_featured_image = $featuredImage;
                $journal->journal_type = $request->type;
                $journal->tag = $request->tag;
                $journal->user_id = Auth::user()->id;
                $journal->save();
                foreach ( $users as $user ) {
                    if ( $user->id != Auth::user()->id && 2 == $user->user_type ) {
                        $user->notify( new UserNotification( "Admin: Write a Journal", " $journal->journal_title", route( 'single.journal', $journal->journal_slug ) ) );
                    }
                }

                return redirect()->route( 'admin.journal.index' )->with( 't-success', "Journal Publish Successfully" );

            } catch ( \Exception $e ) {
                return redirect()->back()->with( 't-error', 'Something Went Wrong' );
            }
        }
        return redirect()->back();

    }

    /**
     *
     * Edit Journal Page
     */
    public function edit( $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit journal' ) ) {
            $journal = Journal::find( $id );
            return view( 'backend.layout.journal.update', compact( 'journal' ) );
        }
        return redirect()->back();

    }

    /**
     *
     * Store The Resource
     */
    public function update( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit journal' ) ) {
            $request->validate( [
                'journal_title' => 'required|string',
                'description'   => 'required|string',
                'tag'           => 'required|string',
                'feature_image' => 'nullable|file|mimes:jpeg,png,gif|max:5120',
                'update_id'     => 'required|numeric',
            ] );

            // type 1 Is Public, Type 2 Is Private

            // Slug Check
            $slug = Journal::where( 'journal_slug', Str::slug( $request->journal_title ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->journal_title ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->journal_title );
            }

            try {

                $journal = Journal::where( 'id', $request->update_id )->first();
                $journal->journal_title = $request->journal_title;
                $journal->journal_slug = $slug_data;
                $journal->description = $request->description;

                if ( $request->feature_image ) {

                    // Remove old image
                    if ( File::exists( $journal->journal_featured_image ) ) {
                        File::delete( $journal->journal_featured_image );
                    }
                    // random string generator
                    $randomString = Str::random( 20 );

                    // Image store in local
                    $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'journal', $request->feature_image . '_' . $randomString );

                    $journal->journal_featured_image = $featuredImage;
                }
                $journal->tag = $request->tag;
                $journal->save();

                return redirect()->route( 'admin.journal.index' )->with( 't-success', "Journal Updated Successfull" );

            } catch ( \Exception $e ) {
                return redirect()->back( 'admin.journal.index' )->with( 't-error', 'Something Went Wrong' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete journal' ) ) {
            if ( $request->ajax() ) {
                $data = Journal::findOrFail( $id );
                if ( $data ) {
                    // Remove old image
                    if ( File::exists( $data->journal_featured_image ) ) {
                        File::delete( $data->journal_featured_image );
                    }
                    $data->delete();
                }
                return response()->json( [
                    'success' => true,
                    'message' => 'Journal Deleted Successfully.',
                ] );
            }
        }
        return redirect()->back();

    }

}
