<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $authNamespace = 'App\\Http\\Controllers\\Auth';
    protected $adminApiNamespace = 'App\\Http\\Controllers\\Api\\Admin';
    protected $userApiNamespace = 'App\\Http\\Controllers\\Api\\User';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
    }

    public function map()
    {
        $this->mapAuthRoutes();
        $this->mapUserApiRoutes();
        $this->mapAdminApiRoutes();
    }

    protected function mapAuthRoutes()
    {
        Route::middleware(['api'])
            ->namespace($this->authNamespace)
            ->group(base_path('/routes/api/auth.php'));
    }

    protected function mapUserApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware(['api', 'auth'])
            ->namespace($this->userApiNamespace)
            ->group(base_path('routes/api/user.php'));
    }

    protected function mapAdminApiRoutes()
    {
        Route::prefix('api/v1/admin')
            ->middleware(['api', 'auth'])
            ->namespace($this->adminApiNamespace)
            ->name('admin.')
            ->group(base_path('/routes/api/admin.php'));
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
