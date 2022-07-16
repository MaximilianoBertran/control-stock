<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'private_key' => env('PASSPORT_PRIVATE_KEY'),

    'public_key' => env('PASSPORT_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Client UUIDs
    |--------------------------------------------------------------------------
    |
    | By default, Passport uses auto-incrementing primary keys when assigning
    | IDs to clients. However, if Passport is installed using the provided
    | --uuids switch, this will be set to "true" and UUIDs will be used.
    |
    */

    'client_uuids' => false,

    /*
    |--------------------------------------------------------------------------
    | Personal Access Client
    |--------------------------------------------------------------------------
    |
    | If you enable client hashing, you should set the personal access client
    | ID and unhashed secret within your environment file. The values will
    | get used while issuing fresh personal access tokens to your users.
    |
    */

    'personal_access_client' => [
        'id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Passport Storage Driver
    |--------------------------------------------------------------------------
    |
    | This configuration value allows you to customize the storage options
    | for Passport, such as the database connection that should be used
    | by Passport's internal database models which store tokens, etc.
    |
    */

    'storage' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'pgsql'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Skip User Authorization
    |--------------------------------------------------------------------------
    |
    | This configuration value allows you to skip the authorization prompt that
    | would allow a user to approve or deny the authorization request. If set to
    | false, the user will be redirected back to the client's redirect_uri.
    |
    */
    'skip_authorization' => env('PASSPORT_SKIP_AUTHORIZATION', true),

    /*
    |--------------------------------------------------------------------------
    | Token Time to Live
    |--------------------------------------------------------------------------
    |
    | This configuration values allow you to make access and refresh tokens
    | last as long as you wish. Note that a refresh token should always last
    | longer than an access token.
    |
    */
    'access_token_ttl' => env('PASSPORT_ACCESS_TOKEN_TTL', 3600),
    'refresh_token_ttl' => env('PASSPORT_REFRESH_TOKEN_TTL', 604800),
];
