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
    $view = $this->withViewErrors([])->view("pages.auth.{$variant}");

    $view->assertSee('action="'.route('register').'"', false);
    $view->assertSee('name="name"', false);
    $view->assertSee('name="email"', false);
    $view->assertSee('name="password"', false);
    $view->assertSee('name="password_confirmation"', false);
})->with([
    'signup-01',
    'signup-02',
    'signup-03',
    'signup-04',
    'signup-05',
]);
