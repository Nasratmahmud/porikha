<?php

namespace App\Http\Controllers\API;

use Stripe\Webhook;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\CourseUserPurchase;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class WebHookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Log::info('Webhook received', ['payload' => $request->all()]);

        $webhookSecret = env('STRIPE_WEBHOOK_SECRET');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
            Log::info('Stripe event constructed successfully', ['event_type' => $event->type]);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload received', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature verification', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        if ($event->type === 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object;

            $courseId = $paymentIntent->metadata->course_id ?? null;
            $userId = $paymentIntent->metadata->user_id ?? null;

            if (!$courseId || !$userId) {
                Log::warning('Metadata is missing in payment intent', ['metadata' => $paymentIntent->metadata]);
                return response()->json(['error' => 'Missing metadata'], 400);
            }

            // Retrieve transaction details
            $transactionId = $paymentIntent->id;
            $amount = $paymentIntent->amount;
            $currency = $paymentIntent->currency;
            $status = $paymentIntent->status;

            // Retrieve charge details
            $charges = $paymentIntent->charges->data ?? [];
            $receiptUrl = null;

            if (!empty($charges)) {
                $charge = $charges[0];
                $receiptUrl = $charge->receipt_url ?? null;
                Log::info('Charge details retrieved', ['receipt_url' => $receiptUrl]);
            }

            // Save the purchase in the database
            $purchase = Purchase::updateOrCreate(
                ['user_id' => $userId, 'course_id' => $courseId],
                [
                    'transaction_id' => $transactionId,
                    'amount' => $amount,
                    'currency' => $currency,
                    'status' => $status,
                    'receipt_url' => $receiptUrl,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            Log::info('Purchase saved successfully', ['purchase_id' => $purchase->id]);

            // Now, update the course purchase status to 1 (is_purchased) in the course_user_purchase table
                $purchaseRecord = CourseUserPurchase::updateOrCreate(
                    ['user_id' => $userId, 'course_id' => $courseId],
                    ['is_purchased' => 1] // Mark as purchased
                );
                Log::info('Purchase status updated to is_purchased = 1', ['purchase_record_id' => $purchaseRecord->id]);
        } else {
            // Handle other events
            switch ($event->type) {
                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    $failureMessage = $paymentIntent->last_payment_error->message ?? 'No failure message';
                    Log::warning('Payment intent failed', [
                        'payment_intent_id' => $paymentIntent->id,
                        'failure_message' => $failureMessage,
                    ]);
                    break;

                case 'customer.subscription.deleted':
                    $subscription = $event->data->object;
                    Log::info('Subscription canceled', ['subscription_id' => $subscription->id]);
                    break;

                case 'invoice.payment_succeeded':
                    $invoice = $event->data->object;
                    Log::info('Invoice payment succeeded', ['invoice_id' => $invoice->id]);
                    break;

                default:
                    Log::info('Unhandled event type', ['event_type' => $event->type]);
                    break;
            }
        }

        Log::info('Webhook processing completed');
        return response()->json(['status' => 'success']);
    }
}
