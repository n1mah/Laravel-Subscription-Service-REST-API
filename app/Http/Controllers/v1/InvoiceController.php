<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices=Invoice::with('subscription')->get();
        return InvoiceResource::collection($invoices->where('subscription.user_id',Auth::id()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,string $subscription)
    {
        $subscription=Subscription::find($subscription);
        if (!$subscription)
            return $this->sendError('Validation Error', 'The invoice does not Exist.',422);

        if ($subscription->user->id!=Auth::id())
            return $this->sendError('Error Invoice', 'The invoice does not belong to you.',422);

        $invoice=Invoice::firstOrCreate([
            'subscription_id'=>$subscription->id,
        ],[
            'link'=>'http://localhost:8000/api/v1/invoice/'.$subscription->id.'/download',
        ]);
        return new InvoiceResource($invoice);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
