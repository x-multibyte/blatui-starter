# Spec: BlatUI Starter (`x-multibyte/blatui-starter`)

## Capability Map

This initiative spans three independently verifiable modules:

| Module id | Responsibility | Depends on |
|---|---|---|
| `foundation-docs` | Project-level `SPEC.md`, ADR repository (`docs/decisions/`), `AGENTS.md` workflow alignment, and `README.md` overhaul | — |
| `ci-cd` | Standard Laravel GitHub Actions workflows enforcing Laravel Pint formatting, Vite asset compilation, and Pest 5 test suite | `foundation-docs` |
| `auth-ui` | Integrating official BlatUI auth blocks (`login-01`..`login-05`, `signup-01`..`signup-05`) under `resources/views/pages/auth/` mapped via `config/blatui.php` | `foundation-docs` |
| `home-ui` | Placing the home page under `resources/views/pages/home.blade.php` (based on the official BlatUI SaaS template `https://blatui.remix-it.com/templates/saas`), extracting reusable `<x-layouts.header>` and `<x-layouts.footer>` layout components driven by `config/blatui.php` (`navigation` and `footer`), and mapping `pages.home` in `config/blatui.php` | `foundation-docs`, `auth-ui` |

Build order: `foundation-docs` → `ci-cd`, `auth-ui` → `home-ui`

---

## Objective

`x-multibyte/blatui-starter` (currently `v0.0.2`) is a community Laravel 13 starter kit pre-wired with **BlatUI** (shadcn/ui for Blade, Alpine.js 3, and Tailwind CSS v4) and **Livewire 4 + Blaze**.

Its core value proposition is **zero-friction project initialization**: a developer runs a single command (`laravel new my-app --using=x-multibyte/blatui-starter` or `composer create-project x-multibyte/blatui-starter my-app`) and gets a ready-to-use application where all 180+ BlatUI component families (`<x-ui.*>`), 8 layout blocks (`<x-block.*>`), required Composer/NPM peer dependencies, theme tokens, and authentication/profile scaffolds work out of the box without dependency troubleshooting.

### Current Initiative Scope
1. **Lock Project Boundaries & Long-Term Memory (`foundation-docs`):** Establish `SPEC.md` and `docs/decisions/` (ADRs) alongside updated `README.md` and `AGENTS.md` guidelines so both human maintainers and Antigravity agents retain full architectural context across months.
2. **Standard Laravel CI/CD (`ci-cd`):** Add GitHub Actions workflows for automated code style checks (Laravel Pint), frontend asset build verification (`npm run build`), and test execution (Pest 5).
3. **Official BlatUI Auth Page Variants (`auth-ui`):** Pull the official BlatUI registry blocks (`login-01` to `login-05`, `signup-01` to `signup-05`) into `resources/views/pages/auth/`, wire them with Laravel's auth routes/CSRF/validation attributes, and allow project creators to easily select or switch between variants via `config/blatui.php`.
4. **Configurable Home Page & Reusable Frontend Layout Components (`home-ui`):** Place the home page view at `resources/views/pages/home.blade.php` (using the official BlatUI SaaS template `https://blatui.remix-it.com/templates/saas`), extract reusable `<x-layouts.header>` (`resources/views/components/layouts/header.blade.php`) and `<x-layouts.footer>` (`resources/views/components/layouts/footer.blade.php`) components driven by `config('blatui.navigation')` and `config('blatui.footer')`, include dark/light theme toggling and `@auth` avatar dropdown / `@guest` sign-in buttons in `<x-layouts.header>`, map `pages.home` in `config/blatui.php` (`env('BLATUI_HOME_VIEW', 'pages.home')`), and resolve `route('home')` (`/`) dynamically from `config('blatui.pages.home')`.

---

## Tech Stack

| Layer | Package / Tool | Version Constraint |
|---|---|---|
| Runtime | PHP | `^8.4` (running on PHP 8.5 in local dev) |
| Framework | `laravel/framework` | `^13.36` |
| Reactive UI | `livewire/livewire` + `livewire/blaze` | `^4.4` + `^1.0` |
| UI Component System | `anousss007/blatui` + `gehrisandro/tailwind-merge-laravel` + `mallardduck/blade-lucide-icons` | `^1.4` + `^1.4` + `^2.0` |
| Frontend Styling & Interactivity | Tailwind CSS v4 (`@tailwindcss/vite`), Alpine.js (`anchor`, `collapse`, `focus`), `@floating-ui/dom`, `apexcharts` | Tailwind `^4.0.0`, Alpine `^3.15.12`, Vite `^8.0.0` |
| Code Style & Formatting | `laravel/pint`, `prettier` (`prettier-plugin-blade`, `prettier-plugin-tailwindcss`) | Pint `^1.32`, Prettier `^3.9.10` |
| Testing | `pestphp/pest` + `pest-plugin-laravel` + `pest-plugin-browser` + `pest-plugin-agent` | Pest `^5.3` |

---

## Commands

```bash
# Full initial setup
composer run setup

# Start local development environment (server, queue, pail, vite)
composer run dev

# Build production frontend assets
npm run build

# Format PHP code (Pint)
composer run lint
vendor/bin/pint --dirty --format agent

# Check PHP code formatting without modifying files (CI mode)
composer run lint:check

# Run full test suite (clears config, runs Pint check, runs Pest)
composer run test

# Run targeted Pest tests
php artisan test --compact tests/Feature/Auth/AuthenticationTest.php

# Seed the local development database with the demo account
php artisan db:seed
php artisan migrate:fresh --seed

# Install Playwright browser binaries (one-time, for browser tests)
npx playwright install
```

---

## Project Structure

```text
app/
  Http/Controllers/        → Auth & Profile controllers
  Models/                  → Eloquent models (User)
  Providers/               → AppServiceProvider (TailwindMerge memo cache + Blaze optimization)
  View/Components/         → Class-based Blade layout components
config/                    → Standard Laravel configuration files
database/
  factories/               → Model factories (UserFactory)
  migrations/              → Core database migrations (users, cache, jobs)
  seeders/                 → DatabaseSeeder
docs/
  decisions/               → Architecture Decision Records (ADR-001, ADR-002, ...)
  intent/                  → Confirmed user intent records (optional)
resources/
  css/
    app.css                → Tailwind v4 entry point importing blatui.css
    blatui.css             → BlatUI CSS variable design tokens (:root / .dark)
  js/
    app.js                 → Boots Alpine, charts.js, and blatui.js
    blatui.js              → BlatUI client runtime & Livewire bridge
    charts.js              → ApexCharts helpers
  views/
    pages/                 → Page-level Blade views & official BlatUI page variants (e.g. auth login-01..05, signup-01..05)
    auth/                  → Active authentication route views (or delegated to resources/views/pages/auth/*)
    profile/               → Profile management views and partials
    components/
      block/               → 8 BlatUI application blocks (<x-block.*>)
      layouts/             → Shell layouts (app, auth, dashboard)
      ui/                  → 180+ pre-installed BlatUI components (<x-ui.*>)
routes/
  web.php                  → Landing, dashboard, and profile routes
  auth.php                 → Authentication routes
tests/
  Feature/                 → Pest feature tests (Auth, Profile, Example)
  Unit/                    → Pest unit tests
```

---

## Code Style

### PHP (Laravel 13 + PHP 8.4+ Strict Conventions)

Always use explicit parameter/return type hints, constructor property promotion, and curly braces on all control structures:

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
```

### Blade & BlatUI Components

Compose UI exclusively from `<x-ui.*>` and `<x-block.*>` components and semantic theme tokens (`bg-background`, `text-foreground`, `text-muted-foreground`, `border-border`) rather than hardcoded palette colors:

```blade
<x-ui.field>
    <x-ui.field-label for="email">Email address</x-ui.field-label>
    <x-ui.input
        id="email"
        type="email"
        name="email"
        :value="old('email')"
        placeholder="name@example.com"
        required
        autofocus
        autocomplete="username"
    />
    <x-ui.field-error :messages="$errors->get('email')" />
</x-ui.field>
```

---

## Testing Strategy

Following `laravel-best-practices` and `testing-best-practices`:

- **Framework:** Pest 5 (`tests/Feature` and `tests/Unit`) with `RefreshDatabase` enabled for all Feature tests (`tests/Pest.php`).
- **Observable Behavior & Datasets:**
  - Test HTTP endpoints, authentication state (`assertAuthenticated`, `assertGuest`), redirects (`assertRedirect`), validation errors (`assertSessionHasErrors`), and view rendering (`assertOk`, `assertSee`).
  - Use **Pest datasets** (`->with(['login-01', 'login-02', 'login-03', 'login-04', 'login-05'])` and `->with(['signup-01', 'signup-02', 'signup-03', 'signup-04', 'signup-05'])`) to verify that all 5 login and 5 signup variants render cleanly with working `POST` form actions, `@csrf`, required input `name` attributes (`email`, `password`, `name`, `password_confirmation`), and validation error displays.
  - Keep all existing tests in `tests/Feature/Auth/*` intact; never delete existing tests.
- **Scope Rule:**
  - **Test core flows & dependencies:** Authentication (`tests/Feature/Auth/*`), Profile management (`tests/Feature/ProfileTest.php`), Landing & Dashboard route rendering, and Livewire/Blaze boot integrity.
  - **Do NOT exhaustively test every BlatUI component:** The 180+ `<x-ui.*>` components are pre-bundled upstream primitives; we verify their shared runtime dependencies (`tailwind-merge`, `livewire/blaze`, Vite build, Alpine boot) rather than maintaining 180+ isolated component unit tests.
- **One-Shot & Browser Verification:** Use `vendor/bin/pest --agent='...'` for rapid verification and visual/browser checks when modifying Auth or layout views. Install the Playwright browser binaries once with `npx playwright install`; screenshots land in the gitignored `tests/Browser/Screenshots/`.
- **Environment Determinism & Asset Fidelity:** `phpunit.xml` forces `APP_ENV=testing` on both `<env>` and `<server>` so host-level `APP_ENV` exports cannot re-enable CSRF middleware; `tests/TestCase.php` stubs Vite only when `public/build/manifest.json` is absent, so browser screenshots use compiled CSS/JS when built while fresh clones still render without a build.
- **Source-Driven & Subagent Orchestration:**
  - Follow `source-driven-development`: fetch official BlatUI block sources (`https://blatui.remix-it.com/r/blocks/<name>.json`) rather than inventing custom components, and cite source URLs in Blade/PHP comments.
  - Delegate implementation tasks in batches to Gemini Flash 3.8 (`Model: "flash"`) subagents while the lead agent orchestrates and runs verification gates (`composer run test`, `vendor/bin/pint --dirty --format agent`, `npm run build`) after each batch.

---

## Boundaries

### Always Do
- Run `vendor/bin/pint --dirty --format agent` after modifying any PHP file.
- Run affected Pest tests (`php artisan test --compact <path>`) and `npm run build` after changing views, routes, or controllers.
- Compose UIs using existing `<x-ui.*>` and `<x-block.*>` components and semantic CSS variable tokens in `resources/css/blatui.css`.
- Record significant architectural or boundary changes as a new or superseding ADR in `docs/decisions/`.
- Update `CHANGELOG.md` under `[Unreleased]` (or the target release version) for every user-facing feature, fix, or structural change, and use atomic Conventional Commits (`ADR-004`).
- Keep the starter kit lean so `laravel new --using=x-multibyte/blatui-starter` requires zero cleanup of domain-specific bloat.

### Ask First
- Changing or upgrading locked dependency versions in `composer.json` or `package.json`.
- Pulling or applying upstream `anousss007/blatui` updates to `resources/views/components/ui/` or `resources/js/blatui.js` (must be manually reviewed).
- Modifying database migrations (`database/migrations/*`).
- Adding new top-level directories or new CI workflow triggers.
- Deleting any existing test file or pre-bundled `<x-ui.*>` / `<x-block.*>` component.

### Never Do
- Never add automated bots/scripts that overwrite `resources/views/components/ui/` from upstream without human review.
- Never add domain-specific business modules (e.g., billing, multi-tenant RBAC, CRM) that downstream users would have to strip out.
- Never edit `vendor/` or `node_modules/` directly.
- Never commit `.env` secrets or bypass authentication/validation middleware.
- Never delete or skip failing tests to make CI pass.

---

## Success Criteria

1. **Specification & ADRs (`foundation-docs`):**
   - `SPEC.md` is committed at the repository root.
   - `docs/decisions/ADR-001-prebundle-and-lock-blatui-components.md` and `docs/decisions/ADR-002-ci-cd-and-quality-gates.md` are created and linked from `README.md` and `AGENTS.md`.
   - `README.md` accurately documents quick start, architecture, commands, ADRs, and Agent workflow conventions.
2. **CI/CD Pipeline (`ci-cd`):**
   - `.github/workflows/` contains standard Laravel GitHub Actions workflows for running `composer run lint:check` (Laravel Pint), `npm ci && npm run build`, and `php artisan test`.
   - Local execution of `composer run test` and `npm run build` passes with zero errors.
3. **Authentication UI (`auth-ui`):**
   - Official BlatUI auth blocks (`login-01`..`login-05` and `signup-01`..`signup-05`) are placed under `resources/views/pages/auth/` and wired with complete, working Laravel authentication (`method="POST"`, `action="{{ route('login') }}"` / `action="{{ route('register') }}"`, `@csrf`, `name` attributes, `old()` values, `<x-ui.field-error>`, session status alerts, and route links).
   - `config/blatui.php` defines `pages.auth.*` view mappings (`login`, `register`, `forgot_password`, `reset_password`, `verify_email`, `confirm_password`), allowing developers to switch between the 5 login and 5 signup styles via `config/blatui.php` or `.env` (`BLATUI_AUTH_LOGIN_VIEW`, `BLATUI_AUTH_REGISTER_VIEW`).
   - All existing auth feature tests in `tests/Feature/Auth/` pass (`php artisan test --compact tests/Feature/Auth`), and each variant is verified for functional form submission.
4. **Home Page & Shared Frontend Layouts (`home-ui`):**
   - `resources/views/pages/home.blade.php` exists and renders the official BlatUI SaaS template (`https://blatui.remix-it.com/templates/saas`) composed with `<x-layouts.app>`, `<x-layouts.header />`, the middle SaaS sections, and `<x-layouts.footer />`.
   - `resources/views/components/layouts/header.blade.php` (`<x-layouts.header>`) renders the brand link (`route('home')`), navigation links from `config('blatui.navigation')`, theme toggle (`$store.theme.toggle()`), and `@auth` user avatar dropdown (`route('dashboard')`, `route('profile.edit')`, `route('logout')`) or `@guest` `Sign in` / `Get started` buttons.
   - `resources/views/components/layouts/footer.blade.php` (`<x-layouts.footer>`) renders the footer columns from `config('blatui.footer')`.
   - `config/blatui.php` defines `'home' => env('BLATUI_HOME_VIEW', 'pages.home')` under `pages`, along with `navigation` and `footer` arrays.
   - `routes/web.php` resolves the `/` (`home`) route view dynamically from `config('blatui.pages.home', 'pages.home')`.
   - Feature tests in `tests/Feature/ExampleTest.php` verify that `GET /` returns HTTP 200, renders `config('blatui.pages.home')`, renders guest and authenticated header states, and supports dynamic `config('blatui.navigation')` items.

---

## Resolved Decisions

1. **Directory & Route Structure under `resources/views/pages/` (See `ADR-003`):**
   - Store page-level views (`pages/home.blade.php`) and multi-variant auth templates (`pages/auth/login-01..05.blade.php`, `pages/auth/signup-01..05.blade.php`) under `resources/views/pages/`.
   - Share `<x-layouts.header>` and `<x-layouts.footer>` across frontend pages so each page only defines its middle content while navigation and footer columns are managed in `config/blatui.php`.
   - Developers switch page templates centrally via `config/blatui.php` (`pages.home`, `pages.auth.*`) or `.env` variables (`BLATUI_HOME_VIEW`, `BLATUI_AUTH_LOGIN_VIEW`, `BLATUI_AUTH_REGISTER_VIEW`).
2. **Agent Workflow Codification (`AGENTS.md`):**
   - Codify the standard project workflow (Spec → ADR → Plan/Tasks → BlatUI MCP discovery & functional wiring → Pint + Pest verification) directly in `AGENTS.md` so future agent sessions autonomously discover BlatUI components/blocks via MCP without manual re-briefing.

---

## Open Questions

- None currently.
