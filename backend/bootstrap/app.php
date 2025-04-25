<?php

use App\Http\Middleware\TokenToAuth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'setAuth' => TokenToAuth::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e) {
            if (!request()->headers->has('Authorization')) {
                return response([
                    'message' => 'Missing token'
                ], 400);
            }
            return response([
                'message' => 'Unathorized user'
            ], 401);
        });
        $exceptions->render((function (ValidationException $e) {
            return response([
                'message' => 'Invalid field',
                'errors' => $e->errors()
            ], 401);
        }));
    })->create();
