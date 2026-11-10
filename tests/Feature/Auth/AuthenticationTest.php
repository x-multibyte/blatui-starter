<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('all login page variants render with functional authentication form', function (string $variant) {
    $view = $this->withViewErrors([])->view("pages.auth.{$variant}");

    $view->assertSee('action="'.route('login').'"', false);
    $view->assertSee('name="email"', false);
    $view->assertSee('name="password"', false);
    $view->assertSee('remember', false);
})->with([
    'login-01',
    'login-02',
    'login-03',
    'login-04',
    'login-05',
]);
