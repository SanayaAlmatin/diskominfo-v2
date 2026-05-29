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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
            'admin.role' => \App\Http\Middleware\AdminRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e, \Illuminate\Http\Request $request) {
            // Jika aplikasi dalam mode debug dan error bukan 404/403, biarkan Laravel menampilkan stack trace
            if (config('app.debug') && !in_array($e->getStatusCode(), [403, 404])) {
                return null;
            }

            if ($request->is('api/*') || $request->wantsJson()) {
                return response()->json([
                    'message' => $e->getMessage() ?: 'An error occurred.',
                ], $e->getStatusCode());
            }

            $code = $e->getStatusCode();
            $title = match($code) {
                401 => 'Belum Login',
                403 => 'Akses Ditolak',
                404 => 'Halaman Tidak Ditemukan',
                419 => 'Sesi Kedaluwarsa',
                429 => 'Terlalu Banyak Permintaan',
                500 => 'Kesalahan Server',
                503 => 'Layanan Tidak Tersedia',
                default => 'Terjadi Kesalahan'
            };

            $message = $e->getMessage() ?: \Symfony\Component\HttpFoundation\Response::$statusTexts[$code] ?? 'Terjadi kesalahan sistem.';
            if ($message === 'This action is unauthorized.') {
                $message = 'Anda tidak memiliki hak akses yang cukup untuk melakukan tindakan ini.';
            }

            return response()->view('errors.dynamic', [
                'code' => $code,
                'title' => $title,
                'message' => $message,
            ], $code);
        });
    })->create();
