<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapApiRoutes();

        //$this->mapFrontendRoutes();
        $this->mapBackendRoutes();
        $this->mapOAuthRoutes();
        $this->mapExternalRoutes();

        //
    }

    /**
     * Define the "backend" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapBackendRoutes() {
        Route::name('backend.')
                ->middleware('web')
                ->namespace($this->namespace. '\Backend')
                ->group(base_path('routes/web/backend.php'));
        
    }


    /**
     * Define the "frontend" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapFrontendRoutes() {
        Route::middleware('web')
                ->namespace($this->namespace . '\Frontend')
                ->group(base_path('routes/web/frontend.php'))
        ;
    }

    /**
     * Define the "external" routes for the application.
     *
     * @return void
     */
    protected function mapExternalRoutes() {
        Route::name('external.')->group(base_path('routes/external.php'));
    }

    /**
     * Define the "oauth" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapOAuthRoutes() {
        Route::prefix('oauth')
                ->name('passport.')
                ->namespace('\Laravel\Passport\Http\Controllers')
                ->group(base_path('routes/oauth.php'))
        ;
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::prefix('api')
                ->middleware('api')
                ->name('api.')
                ->namespace($this->namespace . '\API')
                ->group(base_path('routes/api.php'));
    }

}
