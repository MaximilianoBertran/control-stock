<?php

namespace App\Providers;

use App\Listeners\PruneOldTokens;
use App\Listeners\RevokeOldtokens;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Events\RefreshTokenCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AccessTokenCreated::class => [
//            RevokeOldtokens::class,
        ],
        RefreshTokenCreated::class => [
//            PruneOldTokens::class,
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UpdateUltimoLogin',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
