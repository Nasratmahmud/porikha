<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Book;
use App\Models\Quiz;
use App\Models\Guide;
use App\Models\Course;
use App\Models\JobPost;
use App\Models\Journal;
use App\Models\Question;
use App\Models\ForumPost;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        $course = Course::get()->count();
        // $furam = ForumPost::get()->count();
        // $journal = Journal::get()->count();
        // $guide = Guide::get()->count();
        // $books = Book::get()->count();
        $guiz = Quiz::get()->count();
        $question = Question::get()->count();
        // $myJobPost = JobPost::where( 'user_id', auth()->user()->id )->get()->count();


        return view( 'backend.layout.dashboard.dashboard', compact( 'course', 'guiz','question' ) );
    }
}
