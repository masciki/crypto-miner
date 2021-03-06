<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        Route::middleware('web')
            ->prefix('auth')
            ->namespace($this->namespace.'\Auth')
            ->group(base_path('routes/web-auth.php'));

        Route::middleware('panel')
            ->prefix('panel')
            ->namespace($this->namespace.'\Panel')
            ->group(base_path('routes/web-panel.php'));

        Route::middleware('panel')
            ->prefix('panel/wallet')
            ->namespace($this->namespace.'\Panel\Wallet')
            ->group(base_path('routes/web-panel-wallet.php'));

        Route::middleware('panel.admin')
            ->prefix('panel/admin')
            ->namespace($this->namespace.'\Panel\Admin')
            ->group(base_path('routes/web-panel-admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('panel/admin/api')
             ->middleware('panel.admin.api')
             ->namespace($this->namespace.'\Panel\Admin\Api')
             ->group(base_path('routes/api-panel-admin.php'));
    }
}
