<?php

namespace App\Providers;

use App\Mail\EmailVerification;
use App\Mail\PasswordReset;
use App\Models\Passport\AuthCode;
use App\Models\Passport\Client;
use App\Models\Passport\PersonalAccessClient;
use App\Models\Passport\Token;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\SessionGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
            // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::before(function($user, $ability) {
            if (config('auth.gateless')) {
                return true;
            }

            return $user->permissions->pluck('name')->contains($ability);
        });

        $this->bootPassport();

        SessionGuard::macro('route', function ($route) {
            return config("auth.guards.$this->name.routes.$route");
        });

        VerifyEmail::toMailUsing(function($notifiable, $verificationUrl) {
            return (new EmailVerification($notifiable, $verificationUrl))->to($notifiable->getEmailForVerification());
        });

        ResetPassword::toMailUsing(function($notifiable, $token) {
            $tokenUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
            return (new PasswordReset($notifiable, $tokenUrl))->to($notifiable->getEmailForPasswordReset());
        });
    }

    protected function bootPassport() {
        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        Passport::tokensExpireIn(now()->addSeconds(config('passport.access_token_ttl')));
        Passport::refreshTokensExpireIn(now()->addSeconds(config('passport.refresh_token_ttl')));
    }
}
