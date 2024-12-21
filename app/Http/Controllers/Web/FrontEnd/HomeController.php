<?php

namespace App\Http\Controllers\Web\FrontEnd;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View

     */

    public function index() {

        // return App\Models\DynamicPage::where( 'status', 1 )->get();

        // return view( 'frontend.layout.root_page' );
        //dd("Hello World");
        return view( 'auth.login' );

    }

    public function membershipPackage() {

        return view( 'frontend.layout.pricing' );

    }

    public function accessDenied() {

        return view( 'auth.access_denied' );

    }

}
