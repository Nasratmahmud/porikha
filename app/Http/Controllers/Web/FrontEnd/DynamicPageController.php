<?php



namespace App\Http\Controllers\Web\FrontEnd;



use App\Http\Controllers\Controller;

use App\Models\DynamicPage;



class DynamicPageController extends Controller {

    public function index( $page_slug ){

        $pageData = DynamicPage::where( "page_slug", $page_slug )->first();

        return view( 'frontend.layout.dynamic_page', compact( 'pageData' ) );

    }

}