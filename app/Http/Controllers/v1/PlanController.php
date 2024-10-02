<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Database\Seeders\PlanSeeder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request):AnonymousResourceCollection
    {
        return PlanResource::collection(Plan::all());
    }
}
