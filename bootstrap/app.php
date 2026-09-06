<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

// Ensure writable storage directory for Vercel Serverless Function (/tmp environment)
$storagePath = sys_get_temp_dir() . '/storage';
@mkdir($storagePath . '/framework/views', 0777, true);
@mkdir($storagePath . '/framework/sessions', 0777, true);
@mkdir($storagePath . '/framework/cache/data', 0777, true);
@mkdir($storagePath . '/logs', 0777, true);
@mkdir($storagePath . '/app/public', 0777, true);

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Force ALL exceptions to return JSON — this is an API-only backend.
        // Prevents Laravel from trying to render Blade error views (which don't
        // exist on Vercel's read-only filesystem).
        $exceptions->render(function (\Throwable $e, Request $request) {
            $statusCode = 500;
            if ($e instanceof HttpException) {
                $statusCode = $e->getStatusCode();
            } elseif (method_exists($e, 'getCode') && $e->getCode() >= 400 && $e->getCode() < 600) {
                $statusCode = $e->getCode();
            }

            return response()->json([
                'error'   => true,
                'message' => $e->getMessage() ?: 'Internal Server Error',
                'code'    => $statusCode,
            ], $statusCode);
        });
    })->create();

$app->useStoragePath($storagePath);
$app->instance('path.storage', $storagePath);

return $app;
