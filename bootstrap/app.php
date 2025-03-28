<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Illuminate\Http\Exceptions\ThrottleRequestsException $e, \Illuminate\Http\Request $request) {
            // Return a custom response for rate limit exceeded
            return response()->view('error.429', status: 429);
        });
        // 404 error
        $exceptions->render(function (\Illuminate\Http\Exceptions\HttpResponseException $e, \Illuminate\Http\Request $request) {
            return response()->view('error.404', status: 404);
        });
//        $exceptions->render(function (InvalidOrderException $e, Request $request) {
//            return response()->view('errors.invalid-order', status: 500);
//        });
    })->create();
