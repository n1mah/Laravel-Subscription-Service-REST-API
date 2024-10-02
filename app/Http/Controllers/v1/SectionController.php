<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class SectionController extends BaseController
{
    public function index():AnonymousResourceCollection
    {
        $subscription=Auth::user()->subscriptions->first();
        $sections = Section::where('access_level', '<=', $subscription->plan->level)->get();
        return SectionResource::collection($sections);
    }
}
