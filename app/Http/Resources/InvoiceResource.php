<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subscription=$this->subscription;
        return [
            'id' => $this->id,
            'invoice_link' => $this->link,
            'plan' => $subscription->plan->name,
            'user' => UserResource::make($subscription->user),
            'subscription_id' => $subscription->id,
            'duration' => $subscription->plan->duration,
            'start_date' => Carbon::make($subscription->start_date)->format('Y-m-d'),
            'end_date' => Carbon::make($subscription->end_date)->format('Y-m-d'),
            'invoice_created_at'=>Carbon::make($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
