<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkSubscription' => \App\Http\Middleware\CheckSubscription::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->stopIgnoring(AuthenticationException::class);

        $exceptions->render(function (AuthenticationException $exception, Request $request) {
            //Unauthorized
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        });
    })->create();
