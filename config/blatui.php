<?php

return [

    /*
    |--------------------------------------------------------------------------
    | BlatUI Component Directory
    |--------------------------------------------------------------------------
    |
    | The directory where BlatUI looks for Blade component templates.
    |
    */
    'component_directory' => resource_path('views/components/ui'),

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
        'home' => 'pages.home',
        'forge' => 'pages.forge',
        'auth' => [
            'login' => env('BLATUI_AUTH_LOGIN_VIEW', 'pages.auth.login-01'),
            'register' => env('BLATUI_AUTH_REGISTER_VIEW', 'pages.auth.signup-01'),
            'forgot_password' => env('BLATUI_AUTH_FORGOT_PASSWORD_VIEW', 'pages.auth.forgot-password'),
            'reset_password' => env('BLATUI_AUTH_RESET_PASSWORD_VIEW', 'pages.auth.reset-password'),
            'verify_email' => env('BLATUI_AUTH_VERIFY_EMAIL_VIEW', 'pages.auth.verify-email'),
            'confirm_password' => env('BLATUI_AUTH_CONFIRM_PASSWORD_VIEW', 'pages.auth.confirm-password'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Header Navigation Links
    |--------------------------------------------------------------------------
    |
    | Links rendered in the shared <x-layouts.header> top navigation bar.
    |
    */

    'navigation' => [
        'Features' => '#features',
        'Solutions' => '#spotlight',
        'Pricing' => '#pricing',
        'FAQ' => '#faq',
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer Navigation Columns
    |--------------------------------------------------------------------------
    |
    | Link columns rendered in the shared <x-layouts.footer> component.
    |
    */

    'footer' => [
        'Product' => ['Features', 'Integrations', 'Pricing', 'Changelog', 'Roadmap'],
        'Company' => ['About', 'Careers', 'Blog', 'Customers', 'Contact'],
        'Resources' => ['Documentation', 'Guides', 'API reference', 'Status', 'Community'],
        'Legal' => ['Privacy', 'Terms', 'Security', 'DPA', 'Cookies'],
    ],

];
