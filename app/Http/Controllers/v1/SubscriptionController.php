<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends BaseController
{

    public function index(): JsonResponse
    {
        return $this->sendResponse(SubscriptionResource::collection(Auth::user()->subscriptions),'Show All My Purchases');
    }
    public function success(): JsonResponse
    {
        return $this->sendResponse(SubscriptionResource::collection(Auth::user()->subscriptions->where('status','active')),'Show All My Purchases');
    }

    public function store(StoreSubscriptionRequest $request): JsonResponse
    {
        if (Auth::id()!=$request->user_id)
            return $this->sendError('Error Subscription', 'The user ID does not belong to you.',422);

            $active_subscription = Auth::user()->subscriptions()->where('status','active')->count();
        if ($active_subscription>0)
            return $this->sendError('You currently have an active subscription','You are not allowed to purchase another subscription',420);

        $subscription=Subscription::create([
            ...$request->validated(),
            "start_date" =>Carbon::now() ,
            "end_date" =>Carbon::now()->addDays(30),
            "status" =>"pending",
        ]);
        return $this->sendResponse('Subscription created successfully.', $subscription);
    }
}
