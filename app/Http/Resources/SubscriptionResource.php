<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
//            'user' => UserResource::make($this->user),
            'start_date' => Carbon::make($this->start_date)->format('Y-m-d'),
            'end_date' => Carbon::make($this->end_date)->format('Y-m-d'),
            'status' => $this->status,
            'plan' => PlanResource::make($this->plan),
        ];
    }
}
