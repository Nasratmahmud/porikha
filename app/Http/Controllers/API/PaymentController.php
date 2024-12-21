<?php

namespace App\Http\Controllers\API;

use Stripe\Stripe;
use App\Models\Course;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $courseId = $request->input('course_id');
        // Retrieve or calculate the amount dynamically
        $course = Course::find($courseId); // Assuming you have a Course model
        if (!$course) {
            return response()->json(['error' => 'Invalid course selected.'], 404);
        }
        $amount = $course->course_price*100; // Amount in cents ($50)

        // Create a Payment Intent
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'metadata' => [
                'course_id' => $courseId,
                'user_id' => auth()->id(), // Ensure the user is authenticated
            ],
        ]);

        return response()->json([
            'client_secret' => $paymentIntent->client_secret,
        ]);
    }
}
