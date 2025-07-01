<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
        Response::macro('rspOk', fn($data = null, $message = 'Operation successful') => Response::make(['success' => true, 'message' => $message, 'data' => $data], 200));

        Response::macro('rsp404', fn($message = 'Not Found') => Response::make(['success' => false, 'message' => $message], 404));

        Response::macro('rsp500', fn($message = 'Internal Server Error') => Response::make(['success' => false, 'message' => $message], 500));
    }
}
