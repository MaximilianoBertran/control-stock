<?php

namespace App\Listeners;

use Carbon\Carbon;
use Laravel\Passport\Events\RefreshTokenCreated;
use Laravel\Passport\Passport;

class PruneOldTokens {

    public function handle(RefreshTokenCreated $event) {
        Passport::refreshToken()
            ->where('expires_at', '<', Carbon::now())
            ->delete()
        ;

        Passport::token()
            ->doesntHave('refreshTokens')
            ->delete()
        ;
    }

}
