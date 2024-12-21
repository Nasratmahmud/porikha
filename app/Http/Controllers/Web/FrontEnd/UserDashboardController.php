<?php

namespace App\Http\Controllers\Web\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use App\Models\CoursePurchase;

class UserDashboardController extends Controller {

    public function index() {

        $books = Book::where( 'status', '1' )->with( 'book_favourites' )->latest()->take( 5 )->get();
        $courses = Course::with( 'course_purchases' )->where( 'status', '1' )->latest()->limit( 5 )->get();
        $enrollment = CoursePurchase::where( 'user_id', auth()->user()->id )->pluck( 'course_id' )->toArray();

        return view( 'frontend.layout.user_dashboard', compact( 'books', 'courses', 'enrollment' ) );

    }

}
