<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Auth::user();
        $subscriptions=$user->subscriptions->first();
        if ($subscriptions && $subscriptions->status=='active') {
            return $next($request);
        }
        return response()->json(['message'=>'You are not allowed to access this page.'], Response::HTTP_FORBIDDEN);
    }
}
