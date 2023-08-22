<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'key' => env('pk_test_51NhNXhIkNFXyIz1gC9SitV3REAB8R8ndLHzgeCyOjSw62iOPl2BcWYujsU6z0Dv55neNQ5F6HJk5DY0BHsxcrpUg00eV2CcS2x'),
        'secret' => env('sk_test_51NhNXhIkNFXyIz1guxy9yUm9rMnRKePNfarzxJ7zExbcB1c1vq4GJOv6Uc89wnyhyFc9uuiswURPCZBOkn6hpzqx00zXMX4O7T'),
    ]

];
