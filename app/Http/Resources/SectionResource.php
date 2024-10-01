<?php

namespace App\Http\Resources;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $planes=Plan::all();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'min_subscription_plan' => $planes->where('level',$this->access_level)->first()->name,
            'created_at'=>Carbon::make($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
