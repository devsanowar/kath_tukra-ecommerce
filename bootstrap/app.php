<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
            ->group(base_path('routes/admin.php'));

            Route::middleware('web')
            ->group(base_path('routes/developer.php'));

            Route::middleware('web')
            ->group(base_path('routes/customer.php'));

            Route::middleware('web')
            ->group(base_path('routes/member.php'));

            Route::middleware('web')
            ->group(base_path('routes/dealer.php'));

        },
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\isAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->create();
