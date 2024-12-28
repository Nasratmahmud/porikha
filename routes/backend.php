<?php

use App\Http\Controllers\Web\Backend\BookController;
use App\Http\Controllers\Web\Backend\BundleController;
use App\Http\Controllers\Web\Backend\CategoryController;
use App\Http\Controllers\Web\Backend\CourseController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\FuramController;
use App\Http\Controllers\Web\Backend\GuideController;
use App\Http\Controllers\Web\Backend\JobPostController;
use App\Http\Controllers\Web\Backend\JobPostFacilitiesController;
use App\Http\Controllers\Web\Backend\JournalController;
use App\Http\Controllers\Web\Backend\PermissionAssignController;
use App\Http\Controllers\Web\Backend\PromoCodeController;
use App\Http\Controllers\Web\Backend\SettingController;
use App\Http\Controllers\Web\Backend\SocialMediaController;
use App\Http\Controllers\Web\Backend\UserUpdateController;
use Illuminate\Support\Facades\Route;

/*

|--------------------------------------------------------------------------

| Backend Routes

|--------------------------------------------------------------------------

|

| Here is where you can register Backend routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "Web" middleware group. Now create something great!

|

 */

Route::get( 'dashboard-main', [DashboardController::class, 'index'] )->name( 'home' );
// Setting
Route::get( 'setting', [SettingController::class, 'index'] )->name( 'setting' );
Route::post( 'setting-update', [SettingController::class, 'update'] )->name( 'setting.update' );
// User Update
Route::get( 'user-profile', [UserUpdateController::class, 'userProfile'] )->name( 'user.profile' );
Route::post( 'user-update', [UserUpdateController::class, 'update'] )->name( 'user.update' );

// User Password Change
Route::get( 'user-password', [UserUpdateController::class, 'userPassword'] )->name( 'user.password' );
Route::post( 'user-password/update', [UserUpdateController::class, 'userPasswordUpdate'] )->name( 'user.password-update' );
// Category Route
Route::controller( CategoryController::class )->group( function () {
    Route::get( 'category', 'index' )->name( 'category.index' );
    Route::get( 'category/edit/{id}', 'edit' )->name( 'category.edit' );
    Route::post( 'category', 'addAndUpdate' )->name( 'category.addUpdate' );
    Route::delete( 'category/{id}', 'destroy' )->name( 'category.destroy' );
    Route::get( 'category/status/{id}', 'status' )->name( 'category.status' );
} );

// Book Route
Route::controller( BookController::class )->group( function () {
    Route::get( 'book', 'index' )->name( 'book.index' );
    Route::get( 'book/create', 'create' )->name( 'book.create' );
    Route::post( 'book', 'store' )->name( 'book.store' );
    Route::get( '/book/edit/{id}', 'edit' )->name( 'book.edit' );
    Route::post( 'book/update', 'update' )->name( 'book.update' );
    Route::delete( 'book/{id}', 'destroy' )->name( 'book.destroy' );
    Route::get( 'book/status/{id}', 'status' )->name( 'book.status' );
} );

// Guide Route
Route::controller( GuideController::class )->group( function () {
    Route::get( 'guide', 'index' )->name( 'guide.index' );
    Route::get( 'guide/create', 'create' )->name( 'guide.create' );
    Route::post( 'guide', 'store' )->name( 'guide.store' );
    Route::get( '/guide/edit/{id}', 'edit' )->name( 'guide.edit' );
    Route::post( 'guide/update', 'update' )->name( 'guide.update' );
    Route::delete( 'guide/{id}', 'destroy' )->name( 'guide.destroy' );
    Route::get( 'guide/status/{id}', 'status' )->name( 'guide.status' );
} );

// Promo Code Route
Route::controller( PromoCodeController::class )->group( function () {
    Route::get( 'promo/code', 'index' )->name( 'promoCode.index' );
    Route::get( 'promo/code/create', 'create' )->name( 'promoCode.create' );
    Route::post( 'promo/code', 'store' )->name( 'promoCode.store' );
    Route::get( 'promo/code/edit/{id}', 'edit' )->name( 'promoCode.edit' );
    Route::post( 'promo/code/update', 'update' )->name( 'promoCode.update' );
    Route::delete( 'promo/code/{id}', 'destroy' )->name( 'promoCode.destroy' );
    Route::get( 'promo/code/status/{id}', 'status' )->name( 'promoCode.status' );
} );

// Course Route
Route::controller( CourseController::class )->group( function () {
    Route::get( 'course', 'index' )->name( 'course.index' );
    Route::get( 'course/create', 'create' )->name( 'course.create' );
    Route::post( 'course', 'store' )->name( 'course.store' );
    Route::get( 'course/edit/{id}', 'edit' )->name( 'course.edit' );
    Route::put( 'course/update/{id}', 'update' )->name( 'course.update' );
    Route::delete( 'course/{id}', 'destroy' )->name( 'course.destroy' );
    Route::get( 'course/status/{id}', 'status' )->name( 'course.status' );
    Route::delete( 'course/module/{course_id}/{module_id}', 'moduleDestroy' )->name( 'module.destroy' );
    Route::delete( 'course/content/{course_id}/{id}', 'contentDestroy' )->name( 'content.destroy' );
    Route::get( 'content/status/{id}', 'contentStatus' )->name( 'content.status' );
} );

// Journal
Route::get( 'admin-journal/', [JournalController::class, 'index'] )->name( 'admin.journal.index' );
Route::get( 'admin-journal/create', [JournalController::class, 'create'] )->name( 'admin.journal.create' );
Route::post( 'admin-journal/create', [JournalController::class, 'store'] )->name( 'admin.journal.store' );
Route::get( 'admin-journal/edit/{id}', [JournalController::class, 'edit'] )->name( 'admin.journal.edit' );
Route::post( 'admin-journal/update', [JournalController::class, 'update'] )->name( 'admin.journal.update' );
Route::delete( 'admin-journal/{id}', [JournalController::class, 'destroy'] )->name( 'admin.journal.destroy' );

// Furam
Route::get( 'admin-furam/', [FuramController::class, 'index'] )->name( 'admin.furam.index' );
Route::get( 'admin-furam/create', [FuramController::class, 'create'] )->name( 'admin.furam.create' );
Route::post( 'admin-furam/create', [FuramController::class, 'store'] )->name( 'admin.furam.store' );
Route::delete( 'admin/delete/furam/{id}', [FuramController::class, 'destroy'] )->name( 'admin.forum.destroy' );

// Bundle

Route::controller( BundleController::class )->group( function () {
    Route::get( 'bundle', 'index' )->name( 'bundle.index' );
    Route::get( 'bundle/create', 'create' )->name( 'bundle.create' );
    Route::get( 'bundle/select/item/{type}', 'findItemByType' )->name( 'bundle.select.item' );
    Route::post( 'bundle', 'store' )->name( 'bundle.store' );
    Route::get( 'bundle/edit/{id}', 'edit' )->name( 'bundle.edit' );
    Route::post( 'bundle/update', 'update' )->name( 'bundle.update' );
    Route::delete( 'bundle/{id}', 'destroy' )->name( 'bundle.destroy' );
    Route::delete( 'bundle/item/{id}', 'bundleItemDestroy' )->name( 'bundle.item.destroy' );
    Route::get( 'bundle/status/{id}', 'status' )->name( 'bundle.status' );
} );

// Dynamic Page
Route::get( '/dynamic-page/create', [SettingController::class, 'dynamicPageCreate'] )->name( 'dynamic_page.create' );
Route::post( '/dynamic-page/create', [SettingController::class, 'dynamicPageStore'] )->name( 'dynamic_page.store' );
Route::get( '/dynamic-page/update/{id}', [SettingController::class, 'dynamicPageEdit'] )->name( 'dynamic_page.edit' );
Route::post( '/dynamic-page/update/{id}', [SettingController::class, 'dynamicPageUpdate'] )->name( 'dynamic_page.update' );
Route::get( '/dynamic-page/delete/{id}', [SettingController::class, 'dynamicPageDelete'] )->name( 'dynamic_page.delete' );

//Stripe Setting Controller
Route::get( 'stripe/setting', [SettingController::class, 'stripeSetting'] )->name( 'stripe.setting' );
Route::post( 'stripe/setting', [SettingController::class, 'stripeSettingUpdate'] )->name( 'stripe.setting.update' );
//Pusher Setting Controller
Route::get( 'pusher/setting', [SettingController::class, 'pusherSetting'] )->name( 'pusher.setting' );
Route::post( 'pusher/setting', [SettingController::class, 'pusherSettingUpdate'] )->name( 'pusher.setting.update' );

//Mail Setting Controller
Route::get( 'mail/setting', [SettingController::class, 'mailSetting'] )->name( 'mail.setting' );
Route::post( 'mail/setting', [SettingController::class, 'mailSettingUpdate'] )->name( 'mail.setting.update' );
//Social media route
Route::controller( SocialMediaController::class )->group( function () {
    Route::get( 'social/media', 'index' )->name( 'social.media' );
    Route::get( 'social/media/edit/{id}', 'edit' )->name( 'social.media.edit');
    Route::post( 'social/media', 'addAndUpdate' )->name( 'social.media.addUpdate');
    Route::delete( 'social/media/{id}', 'destroy' )->name( 'social.media.destroy');
    Route::get( 'social/media/status/{id}', 'status' )->name( 'social.media.status');
} );
//User Assign Permission routes
Route::controller( PermissionAssignController::class )->group( function () {
    Route::get( 'all/users/permissions/list', 'index' )->name( 'user.permission.index');
    Route::get( 'all/users/permissions/edit/{id}', 'edit' )->name( 'user.permission.edit');
    Route::post( 'all/users/permissions/update/{id}', 'update' )->name( 'user.permission.update');
    Route::post( 'add/admin/dashboard/user', 'addUser' )->name( 'admin.dashboard.user');
    Route::delete( 'destroy/admin/dashboard/user/{id}', 'destroy' )->name( 'destroy.dashboard.user');
} );

//Job Post route
Route::controller( JobPostController::class )->group( function () {
    Route::get( 'job/post', 'index' )->name( 'job.post' );
    Route::get( 'job/post/user', 'userindex' )->name( 'job.post.user' );
    Route::post( 'job/post/status/{id}', 'status' )->name( 'job.post.status' );
    Route::post( '/reject/resonse', 'rejectReson' )->name( 'reject.reson' );

    // Create
    Route::get( 'job/post/create', 'create' )->name( 'job.post.create' );
    Route::post( 'job/post/create', 'store' )->name( 'job.post.store' );

    // Edit
    Route::get( 'job/post/edit/{id}', 'edit' )->name( 'job.post.edit' );
    Route::post( 'job/post/update', 'update' )->name( 'job.post.update' );

    // Show
    Route::get( 'job/post/show/{id}', 'show' )->name( 'job.post.show' );

    // Delete
    Route::delete( 'job/post/destroy/{id}', 'destroy' )->name( 'job.post.destroy' );

    // Job Application
    Route::get( 'job/application/{id}', 'Applications' )->name( 'job.applications' );
} );

//Job Post Facilities route
Route::controller( JobPostFacilitiesController::class )->group( function () {
    Route::get( 'job/post/facilities/{id}', 'index' )->name( 'job.post.facitilies' );

    // Create
    Route::get( 'facilities/create/{id}', 'create' )->name( 'job.postfacilities.create' );
    Route::post( 'facilities/store', 'store' )->name( 'job.post.facilities.store' );

    Route::delete( 'facilities/destroy/{id}', 'destroy' )->name( 'facilities.destroy' );
} );
