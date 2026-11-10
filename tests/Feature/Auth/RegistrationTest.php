<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('signup variants render without errors and expose required registration fields', function (string $variant) {
    config(['blatui.pages.auth.register' => "pages.auth.{$variant}"]);

    $response = $this->get('/register');

    $response->assertOk();
    $response->assertViewIs("pages.auth.{$variant}");
    $response->assertSee('action="'.route('register').'"', false);
    $response->assertSee('name="name"', false);
    $response->assertSee('name="email"', false);
    $response->assertSee('name="password"', false);
    $response->assertSee('name="password_confirmation"', false);
})->with([
    'signup-01',
    'signup-02',
    'signup-03',
    'signup-04',
    'signup-05',
]);
