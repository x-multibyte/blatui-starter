<?php

use App\Models\User;

it('renders the configured home page with header navigation and footer', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertViewIs(config('blatui.pages.home'))
        ->assertSee('Features')
        ->assertSee('Solutions')
        ->assertSee('Pricing')
        ->assertSee('FAQ')
        ->assertSee(route('login'), false)
        ->assertSee(route('register'), false);
});

it('renders the authenticated user avatar menu in the header when logged in', function () {
    $user = User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
    ]);

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertOk()
        ->assertSee('JD')
        ->assertSee('Jane Doe')
        ->assertSee('jane@example.com')
        ->assertSee(route('dashboard'), false)
        ->assertSee(route('profile.edit'), false)
        ->assertSee(route('logout'), false);
});

it('dynamically renders custom navigation items from config', function () {
    config([
        'blatui.navigation' => [
            'Docs' => '#docs',
            'Changelog' => '#changelog',
        ],
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Docs')
        ->assertSee('#docs', false)
        ->assertSee('Changelog')
        ->assertSee('#changelog', false);
});
