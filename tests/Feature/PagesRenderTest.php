<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The starter's pre-built pages must render end-to-end — every <x-ui.*>, <x-block.*> and
 * <x-layouts.*> they compose has to resolve. This is the regression guard for the
 * "Unable to locate ... component [block.nav-user]" class of failure (GitHub issue #1):
 * a stale starter that dropped components would throw here.
 *
 * The base TestCase stubs the Vite manifest so the pages render without a frontend build.
 */
class PagesRenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_with_auth_links_for_guests(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee(route('login'), false)
            ->assertSee(route('register'), false);
    }

    public function test_landing_page_links_to_the_dashboard_for_authenticated_users(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/')
            ->assertOk()
            ->assertSee(route('dashboard'), false)
            ->assertDontSee(route('register'), false);
    }

    public function test_dashboard_renders_with_sidebar_and_the_signed_in_user(): void
    {
        $user = User::factory()->create(['name' => 'Ada Lovelace']);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('data-slot="sidebar"', false)
            ->assertSee($user->email)
            ->assertSee('AL')
            ->assertSee(route('logout'), false);
    }

    public function test_dashboard_redirects_guests_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
    }

    public function test_auth_pages_render(): void
    {
        $this->get('/login')->assertOk()->assertSee('Login to your account');
        $this->get('/register')->assertOk()->assertSee('Create an account');
        $this->get('/forgot-password')->assertOk()->assertSee('Forgot your password?');
    }

    public function test_no_unresolved_blade_component_tags_leak_into_output(): void
    {
        $pages = [
            '/' => null,
            '/login' => null,
            '/register' => null,
            '/forgot-password' => null,
            '/reset-password/token' => null,
            '/dashboard' => 'user',
            '/profile' => 'user',
            '/confirm-password' => 'user',
            '/verify-email' => 'unverified',
        ];

        foreach ($pages as $uri => $as) {
            $this->app['auth']->forgetGuards();

            if ($as !== null) {
                $this->actingAs($as === 'unverified' ? User::factory()->unverified()->create() : User::factory()->create());
            }

            $html = $this->get($uri)->assertOk()->getContent();

            $this->assertDoesNotMatchRegularExpression(
                '/<x-(ui|block|layouts)\./',
                $html,
                "Unresolved BlatUI component tag leaked into {$uri}"
            );
        }
    }
}
