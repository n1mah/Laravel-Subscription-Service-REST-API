<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends BaseController
{
    public function payment_webhook(Request $request):JsonResponse
    {
        $payload = $request->all();

        if ($payload['status'] && $payload['status'] == 'success') {
            $subscription = Subscription::where('id', $payload['subscription_id'])->orderBy('id', 'desc')->first();
            if (!$subscription)
                return $this->sendError('Validation Error', 'The invoice does not Exist.',422);

//            if ($subscription->user->id!=Auth::id())
//                return $this->sendError('Error Invoice', 'The invoice does not belong to you.',422);

            if ($subscription->status=='pending')
                $subscription->update([
                    'status' => 'active',
                ]);
            else
                return $this->sendError('Subscription not found','Subscription Status is active',404);
            $payment = Payment::create([
                'subscription_id' => $subscription->id,
                'transaction_id' => Str::random(20),
                'reference'=>Str::random(10),
                'price'=>$subscription->plan->price,
                'gateway'=>'paypal',
                'status'=>'completed',
                'payload'=> json_encode($payload),
            ]);

        }

        return response()->json([
            'message' => 'Webhook received and processed',
            'transaction_id' => $payment->transaction_id,
            'subscription_id' => $payment->subscription_id,
            'gateway' => $payment->gateway,
            'price'=>$payment->price,
        ], 200);

    }
}
