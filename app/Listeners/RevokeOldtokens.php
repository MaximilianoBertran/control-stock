<?php

namespace App\Listeners;

use Carbon\Carbon;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Passport;

class RevokeOldTokens {

    public function handle(AccessTokenCreated $event) {
        Passport::token()
            ->where('id', '<>', $event->tokenId)
            ->where('user_id', $event->userId)
            ->where('client_id', $event->clientId)
            ->update(['revoked' => true])
        ;

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
