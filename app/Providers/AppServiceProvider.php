<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Response::macro('success', function($message, $data) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ]);
        });

        Response::macro('error', function($errors, $data = null, $code = 400) {
            return response()->json([
                'status' => 'error',
                'errors' => $errors,
                'data' => $data,
            ], $code);
        });
    }
}
