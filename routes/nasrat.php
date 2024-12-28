<?php

// use App\Http\Controllers\API\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\QuizController;
use App\Http\Controllers\Web\Backend\InvoiceController;
use App\Http\Controllers\Web\Backend\InvoicesController;
use App\Http\Controllers\Web\Backend\PurchageController;
use App\Http\Controllers\Web\Backend\QuestionController;
use App\Http\Controllers\Web\Backend\QuestioncategoryController;
use App\Http\Controllers\Web\Backend\CourseController;


Route::prefix('question/category')->controller( QuestioncategoryController::class )->group( function () {
    Route::get( '/', 'index' )->name( 'question.category.index' );
    Route::get( '/create', 'create' )->name( 'question.category.create' );
    Route::post( '/create', 'store' )->name( 'question.category.store' );
    Route::get( '/edit/{id}', 'edit' )->name( 'question.category.edit' );
    Route::patch( '/update/{id}', 'update' )->name( 'question.category.update' );
    Route::post( '/delete/{id}', 'destroy' )->name( 'question.category.destroy' );
});



Route::prefix('questions')->controller( QuestionController::class )->group( function () {
    Route::get( '/', 'index' )->name( 'questions.index' );
    Route::get( '/create', 'create' )->name( 'questions.create' );
    Route::post( '/create', 'store' )->name( 'questions.store' );
    Route::get( '/edit/{id}', 'edit' )->name( 'questions.edit' );
    Route::post( '/update/{id}', 'update' )->name( 'questions.update' );
    Route::post( '/delete/{id}', 'destroy' )->name( 'questions.destroy' );
});



Route::prefix('quizzes')->controller( QuizController::class )->group( function () {
    Route::get( '/', 'index' )->name( 'quizzes.index' );
    Route::get( '/view', 'view' )->name( 'quizzes.view' );
    Route::get( '/create', 'create' )->name( 'quizzes.create' );
    Route::post( '/create', 'store' )->name( 'quizzes.store' );
    Route::get( '/edit/{id}', 'edit' )->name( 'quizzes.edit' );
    Route::post( '/update/{id}', 'update' )->name( 'quizzes.update' );
    Route::delete( '/delete/{id}', 'destroy' )->name( 'quizzes.destroy' );
});



Route::prefix('purchases')->controller( PurchageController::class )->group( function () {
    Route::get( '/', 'index' )->name( 'purchases.index' );
    // Route::get( '/view', 'view' )->name( 'quizzes.view' );
    // Route::get( '/create', 'create' )->name( 'quizzes.create' );
    // Route::post( '/create', 'store' )->name( 'quizzes.store' );
    // Route::get( '/edit/{id}', 'edit' )->name( 'quizzes.edit' );
    // Route::post( '/update/{id}', 'update' )->name( 'quizzes.update' );
    // Route::delete( '/delete/{id}', 'destroy' )->name( 'quizzes.destroy' );
});



Route::get('delete/file/{id}',[CourseController::class,'fileDelete'])->name('delete.file');

Route::get('download-invoice/{purchaseId}', [InvoicesController::class, 'downloadInvoice'])->name('invoice.download');

