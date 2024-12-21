<?php

namespace App\Http\Controllers\Web\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CoinBalance;
use App\Models\Course;
use App\Models\CoursePurchase;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\Charge;
use Stripe\Stripe;

class CoursePurchaseController extends Controller {

    public function index( Request $request ) {

        $validator = Validator::make( $request->all(), [

            'course_id'  => 'required|string|exists:courses,id',
            'useBalance' => 'nullable|numeric',

        ] );

        if ( $validator->fails() ) {

            $errorMessages = $validator->errors()->first();

            return redirect()->route( 'course.collection' )->with( 't-error', $errorMessages );

        }

        // getting all Data

        $course = Course::where( 'id', $request->course_id )->first();

        $price = $course->course_price;
        if ( $price == null || $price == 0 ) {
            $coursePurchase = new CoursePurchase();
            $coursePurchase->user_id = Auth::user()->id;
            $coursePurchase->course_id = $request->course_id;
            $coursePurchase->save();
            return redirect()->back()->with( "t-success", "Course Purchase successfully" );
        }

        $users = User::all();
        // Use Balance

        if ( $request->has( 'useBalance' ) ) {

            // Get Transaction

            $bal = new CoinBalance();

            $myBal = $bal->GetLastTransaction()->total;

            if ( $myBal >= $price ) {

                $price = 0;

                $currentBal = $myBal - $course->course_price;

            } else {

                $price -= $myBal;

            }

        }
        $isPayment = '';
        // return $price;
        if ( $price === 1 ) {
            // Insert Course Purchase Table
            $coursePurchase = new CoursePurchase();
            $coursePurchase->user_id = Auth::user()->id;
            $coursePurchase->course_id = $request->course_id;
            $coursePurchase->save();
            foreach ( $users as $user ) {
                if ( $user->id != Auth::user()->id && 1 == $user->user_type ) {
                    $user->notify( new UserNotification( Auth::user()->name ?? Auth::user()->username, "Purchasing Course: $course->course_title" ) );
                }
            }
            // Insert Transaction;
            $coin = new CoinBalance();
            $coin->user_id = Auth::user()->id;
            $coin->amount = $course->course_price;
            $coin->transaction_type = 1;
            $coin->total = $currentBal;
            $coin->save();
            return redirect()->route( 'course.collection' )->with( "t-success", "Course Purchase successfully" );
        } else {
            // For Production
            Stripe::setApiKey( env( 'STRIPE_SECRET' ) );
            $isPayment = Charge::create( [
                "amount"      => $price * 100,
                "currency"    => "usd",
                "source"      => $request->stripeToken,
                "description" => "Purchasing Course: $course->course_title",
            ] );
            // Stripe Done
            if ( $isPayment !== null && $isPayment->status === "succeeded" ) {
                // Insert Course Purchase Table
                $coursePurchase = new CoursePurchase();
                $coursePurchase->user_id = Auth::user()->id;
                $coursePurchase->course_id = $request->course_id;
                $coursePurchase->save();
                foreach ( $users as $user ) {
                    if ( $user->id != Auth::user()->id && 1 == $user->user_type ) {
                        $user->notify( new UserNotification( Auth::user()->name ?? Auth::user()->username, "Purchasing Course: $course->course_title" ) );
                    }
                }
                // Insert Transaction;
                if ( $request->has( 'useBalance' ) ) {
                    $coin = new CoinBalance();
                    $lastTransaction = $coin->GetLastTransaction();
                    $coin->user_id = Auth::user()->id;
                    $coin->amount = $lastTransaction->total;
                    $coin->transaction_type = 2;
                    $coin->total = 00.00;
                    $coin->save();
                }
                return redirect()->back()->with( "t-success", "Course Purchase successfull" );
            }

        }
    }

}
