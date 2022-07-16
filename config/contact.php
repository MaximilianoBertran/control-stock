<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact Mail Address
    |--------------------------------------------------------------------------
    |
    | Here, you may specify an address for all contact requests to be sent to.
    |
    */

    'address' => env('CONTACT_ADDRESS', 'hello@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Send Mail
    |--------------------------------------------------------------------------
    |
    | If for some reason contact mails may not be sent, set this to false.
    |
    */
    'send' => env('CONTACT_SEND', true),


    /*
    |--------------------------------------------------------------------------
    | Send Mail
    |--------------------------------------------------------------------------
    |
    | If the contact request may not be stored in the database, set this to false.
    |
    */
    'store' => env('CONTACT_STORE', true)
];
