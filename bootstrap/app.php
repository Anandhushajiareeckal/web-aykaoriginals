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
        $middleware->redirectTo(function($request) {
            if ($request->is('admin*')) return route('admin.login');
            if ($request->is('talent-portal*')) return route('talent.portal.login');
            return route('model.login');
        });
        $middleware->alias([
            'admin.auth'   => \App\Http\Middleware\AdminAuth::class,
            'track.views'  => \App\Http\Middleware\TrackPageView::class,
            'model.auth'   => \App\Http\Middleware\ModelAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
