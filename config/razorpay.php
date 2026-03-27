<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Razorpay API Credentials
    |--------------------------------------------------------------------------
    |
    | You must set your Razorpay key and secret in your .env file.
    | These credentials are used to authenticate with Razorpay API.
    |
    */

    'key'    => env('RAZORPAY_KEY', ''),
    'secret' => env('RAZORPAY_SECRET', ''),
];
