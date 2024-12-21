<?php

use App\Http\Controllers\Web\Backend\QuizController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Jobaed Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Web" middleware group. Now create something great!
|
 */

// Book Route
Route::controller( QuizController::class )->group( function () {
    Route::get( 'quiz', 'index' )->name( 'quiz.index' );
    Route::get( 'quiz/create', 'create' )->name( 'quiz.create' );
    Route::post( 'quiz', 'store' )->name( 'quiz.store' );
    Route::get( '/quiz/edit/{id}', 'edit' )->name( 'quiz.edit' );
    Route::post( 'quiz/update', 'update' )->name( 'quiz.update' );
    Route::delete( 'quiz/{id}', 'destroy' )->name( 'quiz.destroy' );
    Route::get( 'quiz/status/{id}', 'status' )->name( 'quiz.status' );

    // Get Module For selected Company
    Route::get( 'course/{id}', 'getModule' )->name( 'course.module' );

    // Quiz
    Route::post( 'question', 'questionStore' )->name( 'question.store' );
    Route::get( '{quiz_id}/question/create', 'questionCreate' )->name( 'question.create' );
    Route::delete( 'question/{id}', 'questionDestroy' )->name( 'question.destroy' );
    Route::post( 'question/update', 'updateQuestion' )->name( 'question.update' );
} );
