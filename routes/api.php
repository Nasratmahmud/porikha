<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\WebHookController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\QuizCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::controller(UserAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

    // Resend Otp
    Route::post('resend-otp', [UserAuthController::class, 'resendOtp']);

    // Forget Password
    Route::post('forget-password', 'forgetPassword');
    Route::post('verify-otp-password', 'varifyOtpWithOutAuth');
    Route::post('reset-password', 'resetPassword');

    // Google Login
    Route::post('google/login', 'googleLogin');
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::get('me', [UserAuthController::class, 'me']);
    Route::post('user-update', [UserController::class, 'updateUserInfo']);
    Route::get('course', [CourseController::class, 'index']);
    Route::get('/courses/{courseId}', [CourseController::class, 'courseModulesUnderCourseId']);
    Route::get('/course-modules/{moduleId}', [CourseController::class, 'courseContentsUnderModuleId']);
    Route::get('/courses/{courseId}/files', [CourseController::class, 'courseFilesUnderCourseId']);


    Route::get('/get-questions-category',[QuizCategoryController::class, 'index']);
    Route::get('/get-questions',[QuestionController::class, 'index']);
    Route::get('/get-quizzes/{courseId}',[QuizController::class, 'index']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    //Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    Route::post('/quizzes/calculate-result', [QuizController::class, 'calculateResult']);

    //Route::get('/quiz-result/{id}', [QuizController::class, 'showResult'])->name('quiz-result.show');

    //all answers and selected options after quiz completion
    //Route::get('/quiz-results/{quiz_id}', [QuizController::class, 'getResult']);
    Route::get('/quiz-result/{quizResultId}', [QuizController::class, 'getResultByResultId']);

    Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);

});

Route::post('/webhook', [WebHookController::class, 'handleWebhook']);


