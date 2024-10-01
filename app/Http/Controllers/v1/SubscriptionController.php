<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(SubscriptionResource::collection(Auth::user()->subscriptions),'Show All My Purchases');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $subscription=Subscription::create([
            ...$request->validated(),
            "start_date" =>Carbon::now() ,
            "end_date" =>Carbon::now()->addDays(30),
            "status" =>"pending",
        ]);
        return $this->sendResponse('Subscription created successfully.', $subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
