<?php

namespace App\Providers;

use App\Interfaces\iPines;
use App\Services\PinesService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Contracts\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        Passport::ignoreMigrations();

        $this->app->singleton(iPines::class, function ($app){
            return new PinesService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url) {
        $this->registerBladeDirectives();
        $this->registerValidationRules();
        if(\App::environment('production')) {
            $url->forceScheme('https');
        }
    }

    protected function registerBladeDirectives() {
        Blade::directive('embed', function($image) {
            if (config('mail.embed_images')) {
                return "<?php echo \$message->embed({$image}); ?>";
            } else {
                return "<?php echo {$image}; ?>";
            }
        });
    }

    protected function registerValidationRules() {
        Validator::extend('strong', function ($attribute, $value, $parameters, $validator) {
            return $validator->validateRegex($attribute, $value, ['/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/']);
        });
    }
}
