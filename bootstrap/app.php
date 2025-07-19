<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckPermission;
use Illuminate\Session\Middleware\StartSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // เพิ่มระบบ permission
        $middleware->alias([
            'check.permission' => CheckPermission::class,
        ]);

        // เพิ่ม session
        $middleware->appendToGroup('web', StartSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
