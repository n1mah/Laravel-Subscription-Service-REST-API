<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PDFController extends BaseController
{
    public function download(string $subscription){
        $subscription=Subscription::find($subscription);
        if (!$subscription)
            return $this->sendError('Validation Error', 'The invoice does not Exist.',422);

        if ($subscription->user->id!=Auth::id())
            return $this->sendError('Error Invoice', 'The invoice does not belong to you.',422);

        $data = [
            'id' => '1',
            'title' => 'Invoice',
            'plan'=>$subscription->plan->name,
            'subscription_id'=>$subscription->id,
            'price'=>$subscription->plan->price,
            'start'=>$subscription->start_date,
            'end'=>$subscription->end_date,
        ];
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('document.pdf');
    }
}
