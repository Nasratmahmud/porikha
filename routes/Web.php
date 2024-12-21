<?php

use App\Http\Controllers\Web\Backend\NotificationController;
use App\Http\Controllers\Web\FrontEnd\DynamicPageController;
use App\Http\Controllers\Web\FrontEnd\HomeController;
use App\Http\Controllers\Web\FrontEnd\PromoCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register Web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "Web" middleware group. Now create something great!

|

 */

Route::middleware( 'redirectIfAuthenticated' )->group( function () {

    // The 'auth' middleware checks if the user is authenticated.

    Route::get( '/', [HomeController::class, 'index'] )->name( 'root.page' );

    // The 'HomeController@index' will be executed only if the user is authenticated.

    Route::get( 'page/{page_slug}', [DynamicPageController::class, 'index'] )->name( 'custom.page' );

    Route::post( '/Promo-code', [PromoCodeController::class, 'index'] )->name( 'promo.code.discount' );

    // The 'PromoCodeController@index' will be executed only if the user is authenticated.

    Route::get( '/price', [HomeController::class, 'membershipPackage'] )->name( 'membership.package' );

    // The 'HomeController@membershipPackage' will be executed only if the user is authenticated.

} );

Route::get( '/access-denied', [HomeController::class, 'accessDenied'] )->name( 'access.denied' );

//Notification Route
Route::get( '/mark-as-read/{notification}', [NotificationController::class, 'markAsRead'] )->name( 'markAsRead' );

// Auth Routes

Auth::routes();