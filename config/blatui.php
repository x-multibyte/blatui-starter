<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Page View Mappings
    |--------------------------------------------------------------------------
    |
    | Configure which Blade view templates are rendered for each page.
    | Available official BlatUI authentication variants:
    |   - Login:    'pages.auth.login-01' through 'pages.auth.login-05'
    |   - Register: 'pages.auth.signup-01' through 'pages.auth.signup-05'
    |
    */

    'pages' => [
        'auth' => [
            'login' => env('BLATUI_AUTH_LOGIN_VIEW', 'pages.auth.login-01'),
            'register' => env('BLATUI_AUTH_REGISTER_VIEW', 'pages.auth.signup-01'),
            'forgot_password' => env('BLATUI_AUTH_FORGOT_PASSWORD_VIEW', 'pages.auth.forgot-password'),
            'reset_password' => env('BLATUI_AUTH_RESET_PASSWORD_VIEW', 'pages.auth.reset-password'),
            'verify_email' => env('BLATUI_AUTH_VERIFY_EMAIL_VIEW', 'pages.auth.verify-email'),
            'confirm_password' => env('BLATUI_AUTH_CONFIRM_PASSWORD_VIEW', 'pages.auth.confirm-password'),
        ],
    ],

];
