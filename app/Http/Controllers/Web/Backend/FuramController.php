<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ForumPost;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class FuramController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'forum menu' ) ) {
            if ( $request->ajax() ) {

                $data = ForumPost::with( 'user', 'category' )->latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'feature_image', function ( $data ) {
                        $feature_image = url( $data->feature_image );
                        return '<div class="avatar avatar-lg"><img class="avatar-img img-fluid" style="border-radius: 10px;" src="' . $feature_image . '" alt="' . $data->post_title . '"></div>';
                    } )
                    ->addColumn( 'categories', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1'>" . $data->category['category_name'] . "</span>";

                    } )
                    ->addColumn( 'views', function ( $data ) {
                        return "<span class='bg-info rounded py-1 px-3 text-light'><i class='bi bi-eye'></i> $data->views</span>";

                    } )
                    ->addColumn( 'votes', function ( $data ) {
                        return "<span class='bg-success rounded py-1 px-3 text-light'><i class='bi bi-hand-thumbs-up'></i> $data->votes</span>";

                    } )
                    ->addColumn( 'username', function ( $data ) {
                        if ( $data->user->name ) {
                            return "<span class='text-capitalize'>{$data->user->name}</span>";
                        } else {
                            return "<span class='text-capitalize'>{$data->user->username}</span>";
                        }

                    } )
                    ->addColumn( 'action', function ( $data ) {
                        $user = User::find( auth()->user()->id );
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        if ( $user->hasPermissionTo( 'delete forum' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')"
                                        class="btn btn-danger btn-sm text-white" title="Delete">
                                        <i class="bx bxs-trash"></i>
                                    </a>';
                        } else {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        $html .= '</div>';
                        return $html;
                    } )

                    ->rawColumns( ['feature_image', 'categories', 'views', 'username', 'votes', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.furam.index' );
        }
        return redirect()->back();

    }

    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create() {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create forum' ) ) {
            $categorys = Category::where( 'status', '1' )->orderBy( 'category_name' )->get();

            // Get All Post
            $forumPosts = ForumPost::with( 'user' )->latest()->paginate( 2 );

            // Get Most popular post
            $popularForums = ForumPost::with( 'user' )->latest()->paginate( 2 );

            $popularCategorys = DB::table( 'forum_posts' )
                ->select( 'category_id', DB::raw( 'COUNT(*) as category_count' ) )
                ->groupBy( 'category_id' )
                ->orderByDesc( 'category_count' )
                ->limit( 2 )
                ->get();

            $selectedCategory = null;

            return view( 'backend.layout.furam.create', compact( 'categorys', 'forumPosts', 'popularForums', 'popularCategorys', 'selectedCategory' ) );
        }
        return redirect()->back();
        // Get All Category

    }

    /**
     * Store data in database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create forum' ) ) {
            $request->validate( [
                'post_title'    => 'required|string',
                'post_content'  => 'required|string',
                'category_id'   => 'required|exists:categories,id',
                'feature_image' => 'required|file|mimes:jpeg,png,gif|max:5120',
            ] );

            try {
                $users = User::all();
                // Create new post slug
                $slug = Str::slug( $request->post_title );

                // Check if the initial slug already exists in the database
                if ( ForumPost::where( 'post_slug', $slug )->exists() ) {
                    // If it exists, add a suffix to make it unique
                    $counter = 1;

                    do {
                        $newSlug = $slug . '-' . $counter;
                        $counter++;
                    } while ( ForumPost::where( 'post_slug', $newSlug )->exists() );

                    // Assign the unique slug to the data object
                    $post_slug = $newSlug;
                } else {
                    // If the initial slug doesn't exist, use it as is
                    $post_slug = $slug;
                }

                // random string generator
                $randomString = Str::random( 20 );
                // Image store in local
                $featuredImage = Helper::fileUpload( $request->file( 'feature_image' ), 'forum_post', $request->feature_image . '_' . $randomString );

                // Store the Forum
                $data = new ForumPost();
                $data->post_title = $request->post_title;
                $data->post_slug = $post_slug;
                $data->post_content = $request->post_content;
                $data->category_id = $request->category_id;
                $data->feature_image = $featuredImage;
                $data->views = 1;
                $data->votes = 0;
                $data->user_id = Auth::user()->id;
                $data->save();
                foreach ( $users as $user ) {
                    if ( $user->id != Auth::user()->id && 2 == $user->user_type ) {
                        $user->notify( new UserNotification( "Admin: Write a Forum", " $data->post_title", route( 'forum_post.detail', $data->post_slug ) ) );
                    }
                }

                return redirect()->route( 'admin.furam.index' )->with( 't-success', 'Your post added successfully.' );
            } catch ( \Exception $e ) {
                return redirect()->back()->with( 't-error', 'Something Went Wrong' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete forum' ) ) {
            if ( $request->ajax() ) {
                $data = ForumPost::findOrFail( $id );
                if ( $data ) {
                    // Remove old image
                    if ( File::exists( $data->feature_image ) ) {
                        File::delete( $data->feature_image );
                    }
                    $data->delete();
                }
                return response()->json( [
                    'success' => true,
                    'message' => 'Forum Deleted Successfully.',
                ] );
            }
        }
        return redirect()->back();

    }

}
