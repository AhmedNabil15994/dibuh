<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	'google' => [
		'client_id' => '457594881488-vrdlnm9pf40u14paso3i8c2m3ff6mvfr.apps.googleusercontent.com',// Your Google Client ID
		'client_secret' => 'CsnrZoKTkgWZwhMsqxY1ZOiy', // Your Google Client Secret
		'redirect' => 'http://dibuh.com/auth/google/callback',
	],
    'twitter' => [
        'client_id' => 'MGy3yF6dmYg9bEkVmV9qlzeVj',// Your Twitter Client ID
        'client_secret' => 'hGNC9MtrRyagrHmNmyPFdgtxXKeOpn4ZHcgclEVfeGFFHJ9dM6', // Your Twitter Client Secret
        'redirect' => 'http://dibuh.com/auth/twitter/callback',
    ],
    'graph' => [
        'client_id' => 'f1daf37a-51b5-4fe1-971a-7455ad4721e9',// Your Microsoft Client ID
        'client_secret' => 'mdIGP4$_kzajoXQGO6339!-', // Your Microsoft Client Secret
        'redirect' => 'http://dibuh.com/oauth',
    ],

];
