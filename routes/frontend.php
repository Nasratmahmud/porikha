<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\FrontEnd\BookController;
use App\Http\Controllers\Web\FrontEnd\BundleController;
use App\Http\Controllers\Web\FrontEnd\CourseController;
use App\Http\Controllers\Web\FrontEnd\ForumContrtoller;
use App\Http\Controllers\Web\FrontEnd\InsightController;
use App\Http\Controllers\Web\FrontEnd\JournalController;
use App\Http\Controllers\Web\FrontEnd\GuidanceController;
use App\Http\Controllers\Web\FrontEnd\JobBoardController;
use App\Http\Controllers\Web\FrontEnd\LikeFuramController;
use App\Http\Controllers\Web\FrontEnd\UserProfileController;
use App\Http\Controllers\Web\FrontEnd\UserDashboardController;
use App\Http\Controllers\Web\FrontEnd\CoursePurchaseController;

/*

|--------------------------------------------------------------------------
| FontEnd Auth User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Web" middleware group. Now create something great!
|
 */

Route::get( '/user-dashboard', [UserDashboardController::class, 'index'] )->name( 'user.dashboard' );

//Books Route

Route::get( '/books/library', [BookController::class, 'index'] )->name( 'book.collection' );
Route::get( '/books/filter-by/{category}', [BookController::class, 'filterByCategory'] )->name( 'book.filter' );
Route::get( '/books/{id}', [BookController::class, 'bookSinglePage'] )->name( 'book.singlePage' );
Route::post( '/book/favorite', [BookController::class, 'booksFavorite'] )->name( 'books.favorite' );

//Course Route
Route::get( '/course-collection', [CourseController::class, 'index'] )->name( 'course.collection' );
Route::get( '/courses/{courseId}', [CourseController::class, 'courseDetailsView'] )->name( 'course.enrollment' );
Route::get( '/course-quiz/{courseId}/{moduleId}', [CourseController::class, 'courseQuiz'] )->name( 'course.quiz' );
Route::post( '/course-quiz/{quiz_id}/{course_id}/{course_module_id}', [CourseController::class, 'courseQuizSubmit'] )->name( 'course.quiz.submit' );
Route::get( '/course-quiz/retake/{quizId}/{courseId}/{moduleId}', [CourseController::class, 'courseQuizRetake'] )->name( 'course.quiz.retake' );
Route::post( '/course-quiz/retake/{quiz_id}/{course_id}/{course_module_id}', [CourseController::class, 'courseQuizRetakeSubmit'] )->name( 'course.quiz.retakeSubmit' );
Route::post( '/course-module/complete', [CourseController::class, 'courseComplete'] )->name( 'course.complete' );
// Course Purchase
Route::post( '/course/purchase', [CoursePurchaseController::class, 'index'] )->name( 'course.purchasing' );

//Guidance Route
Route::get( '/guides', [GuidanceController::class, 'index'] )->name( 'guidances' );
Route::get( '/guides/{tag}', [GuidanceController::class, 'guidesByTag'] )->name( 'guides.filter' );
Route::get( '/guidances/{slug}', [GuidanceController::class, 'singleGuidance'] )->name( 'guidances.single' );

Route::get( '/journal', [JournalController::class, 'index'] )->name( 'journal.index' );
Route::get( '/journal/{slug}', [JournalController::class, 'singleJournal'] )->name( 'single.journal' );
Route::get( '/journal/edit/{id}', [JournalController::class, 'edit'] )->name( 'journal.edit' );
Route::post( '/journal/update', [JournalController::class, 'update'] )->name( 'journal.update' );
Route::get( '/my-journal', [JournalController::class, 'myIndex'] )->name( 'my.journal.index' );
Route::get( '/journal-create', [JournalController::class, 'create'] )->name( 'journal.create' );
Route::post( '/journal-store', [JournalController::class, 'store'] )->name( 'journal.store' );
Route::delete( 'journal/{id}', [JournalController::class, 'destroy'] )->name( 'journal.destroy' );

Route::get( '/forum-post', [ForumContrtoller::class, 'index'] )->name( 'forum_post' );
Route::get( '/forum-post/category/{category_id}', [ForumContrtoller::class, 'categoryPost'] )->name( 'forum_post.category.post' );
Route::get( '/forum-post/create', [ForumContrtoller::class, 'create'] )->name( 'forum_post.create' );
Route::post( '/forum-post/store', [ForumContrtoller::class, 'store'] )->name( 'forum_post.store' );
Route::get( '/forum-post/detail/{slug}', [ForumContrtoller::class, 'postDetail'] )->name( 'forum_post.detail' );

// like forum
Route::get( 'like/furam/{id}', [LikeFuramController::class, 'likeFuram'] )->name( 'like.furam' );
Route::get( '/insights', [InsightController::class, 'index'] )->name( 'insight.index' );

Route::get( '/user/profile', [UserProfileController::class, 'userProfilePage'] )->name( 'userProfile' );
Route::post( '/user/profile', [UserProfileController::class, 'userInfoUpdate'] )->name( 'userProfile.update' );
Route::post( '/user/password-update', [UserProfileController::class, 'userPasswordUpdate'] )->name( 'userPassword.update' );
Route::post( '/user/cover-update', [UserProfileController::class, 'userCoverPictureUpdate'] )->name( 'userCover.update' );

Route::get( '/bundles', [BundleController::class, 'index'] )->name( 'bundle.page' );
Route::get( '/bundles/{id}', [BundleController::class, 'singleBundle'] )->name( 'single.bundle' );
Route::get( '/bundles/content/{id}', [BundleController::class, 'singleBundleContent'] )->name( 'single.bundle.content' );
Route::post( '/bundles/favorite', [BundleController::class, 'bundleFavorite'] )->name( 'bundle.favorite' );



// Job Board
Route::get('/jobs', [JobBoardController::class, 'index'])->name('jobs');
Route::get('/job/details/{slug}', [JobBoardController::class, 'details'])->name('job.details');
Route::get( 'favorite/job/{id}', [JobBoardController::class, 'favorate'] )->name( 'favorite.job' );

// Apply
Route::post( '/job/apply', [JobBoardController::class, 'application'] )->name( 'job.application' );
Route::get('/my/application', [JobBoardController::class, 'myApplication'])->name('my.application');
