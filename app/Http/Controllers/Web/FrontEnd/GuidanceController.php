<?php

namespace App\Http\Controllers\Web\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuidanceController extends Controller {
    /*
     * Get All Active Guidance from store
     */

    public function index( Request $request ) {

        $guides = Guide::where( 'status', '1' )->latest()->paginate( 8 );
        if ( $request->ajax() ) {
            return $guides;
        } else {
            $categories = Category::has( 'guides' )->get();
            return view( 'frontend.layout.guidance.guidances-list', compact( 'categories', 'guides' ) );
        }
    }

    /*
     * Get All Active Guidance from store
     */

    public function guidesByTag( $category ) {
        if ( $category == 'all' ) {
            $guides = Guide::where( 'status', '1' )->latest()->paginate( 8 );
        } else {
            $guides = Guide::where( 'status', '1' )->whereHas( 'category', function ( $query ) use ( $category ) {
                $query->where( 'category_name', $category );
            } )->latest()->paginate( 8 );
        }
        return $guides;
    }

    /*

     * Get All Active Single nGuidance from store

     */

    public function singleGuidance( $slug ) {

        $guidance = Guide::where( ['guide_slug' => $slug, 'status' => '1'] )->with( 'category' )->first();

        if ( $guidance == false ) {

            return redirect()->back();

        }

        $relatedes = Guide::where( 'status', '1' )->where( 'category_id', $guidance->category_id )->where( 'guide_slug', '!=', $slug )->with( 'category' )->take( 10 )->paginate( 5 );
        $latests = Guide::where( 'guide_slug', '!=', $slug )->where( 'status', '1' )->with( 'category' )->latest()->take( 10 )->paginate( 5 );

        return view( 'frontend.layout.guidance.guidance-single', compact( 'guidance', 'relatedes', 'latests' ) );

    }

}
