<?php

namespace App\Http\Controllers\v1;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class InvoiceController extends BaseController
{

    public function index():AnonymousResourceCollection
    {
        $invoices=Invoice::with('subscription')->get();
        return InvoiceResource::collection($invoices->where('subscription.user_id',Auth::id()));
    }

    public function store(Request $request,string $subscription): JsonResponse|InvoiceResource
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
}
