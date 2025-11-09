<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Giriş yapan kullanıcıların yönlendirileceği varsayılan yol.
     * Örneğin login sonrası dashboard sayfası.
     */
    public const HOME = '/dashboard';

    /**
     * Uygulama başlatıldığında çağrılır.
     */
    public function boot(): void
    {
        // Rota gruplarını yükle
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
