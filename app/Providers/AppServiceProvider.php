<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, string $message = "") {
            return Response::make([
                'success' => true,
                'data' => $data,
                'message' => $message
            ]);
        });
        Response::macro('failed', function ($data, string $message = "",$code="") {
            return Response::make([
                'success' => false,
                'data' => $data,
                'data' => $data,
                'message' => $message
            ]);
        });
    }
}
