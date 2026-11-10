# Changelog

All notable changes to `x-multibyte/blatui-starter` are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.0.5] - 2026-11-10

### Added
- **Configurable SaaS Home Page (`resources/views/pages/home.blade.php`):** Added the official BlatUI SaaS landing page (`https://blatui.remix-it.com/templates/saas`) under `resources/views/pages/home.blade.php`, mapped via `config('blatui.pages.home')` (`BLATUI_HOME_VIEW`) and wired to `route('home')` (`/`).
- **Reusable Frontend Header & Footer Layout Components (`<x-layouts.header>` & `<x-layouts.footer>`):** Extracted `resources/views/components/layouts/header.blade.php` and `resources/views/components/layouts/footer.blade.php` driven by `config('blatui.navigation')` and `config('blatui.footer')`, with built-in dark/light mode toggle (`$store.theme.toggle()`) and `@auth` user avatar dropdown / `@guest` sign-in & registration controls.

### Fixed
- **Theme Toggle Reactivity Fix:** Added `x-data` attribute to the root layout `<body>` (`resources/views/components/layouts/app.blade.php`) and hardened Alpine/BlatUI store lifecycle registration in `resources/js/app.js`, ensuring the dark/light mode toggle operates reliably across Blade and Livewire contexts.

## [0.0.4] - 2026-11-10

### Added
- **BlatUI Page Appearance Configuration (`config/blatui.php`):** Added `config/blatui.php` with `pages.auth.*` view mappings (`login`, `register`, `forgot_password`, `reset_password`, `verify_email`, `confirm_password`) and `.env` overrides (`BLATUI_AUTH_LOGIN_VIEW`, `BLATUI_AUTH_REGISTER_VIEW`, etc.), wired into all authentication controllers and `resources/views/auth/*` compatibility views.

## [0.0.3] - 2026-11-10

### Added
- **Multi-Variant Functional Auth Pages (`resources/views/pages/auth/`):** Added all 5 official BlatUI login blocks (`login-01` through `login-05`) and all 5 official signup blocks (`signup-01` through `signup-05`), fully wired to Laravel authentication routes (`POST /login`, `POST /register`), `@csrf`, `old()` state retention, `<x-ui.field-error>` validation feedback, session status alerts, and named route links (`ADR-003`).
- **Standard Laravel GitHub Actions CI (`.github/workflows/ci.yml`):** Added automated quality gates for Laravel Pint formatting (`composer run lint:check`), Vite frontend asset build (`npm ci && npm run build`), and Pest 5 feature/unit tests (`php artisan test --compact`) (`ADR-002`).
- **Pest Dataset Coverage for Auth Variants:** Added dataset-driven feature tests in `tests/Feature/Auth/AuthenticationTest.php` and `tests/Feature/Auth/RegistrationTest.php` verifying rendering and form contracts across all 10 login and signup variants.
- **Project Specification & Architecture Decision Records:** Added root `SPEC.md`, implementation plans (`tasks/plan.md`, `tasks/todo.md`), and `docs/decisions/ADR-001` through `ADR-004`.
- **Agent Skills & BlatUI MCP Workflow Codification:** Updated `AGENTS.md` and `.agents/skills/blatui-development/SKILL.md` with the `using-agent-skills` lifecycle, autonomous BlatUI MCP block discovery, and functional page wiring rules.

### Changed
- **Unified Auth View Directory:** Moved `forgot-password`, `reset-password`, `verify-email`, and `confirm-password` into `resources/views/pages/auth/` while preserving backward-compatible `@include` aliases in `resources/views/auth/*`.
- **One-Line Auth Variant Switching:** `AuthenticatedSessionController::create()` and `RegisteredUserController::create()` now render `view('pages.auth.login-01')` and `view('pages.auth.signup-01')` by default, allowing developers to switch styles by editing a single `view(...)` argument.

## [0.0.2] - 2026-11-10

### Added
- Integrated **Livewire 4** (`livewire/livewire` `^4.4`) and **Livewire Blaze** (`livewire/blaze` `^1.0`) with `Blaze::optimize()->in(resource_path('views/components/ui'))`.
- Configured memoized `tailwind-merge` cache (`Cache::memo()`) in `AppServiceProvider` for high-performance component class merging.
- Wired built-in Livewire two-way `wire:model` bridge across value-bearing BlatUI components.

## [0.0.1] - 2026-11-10

### Added
- Initial release of `x-multibyte/blatui-starter` built on **Laravel 13**, **Tailwind CSS v4**, **Alpine.js 3**, **Vite 8**, and **Pest 5**.
- Pre-bundled all 180+ BlatUI component families (`resources/views/components/ui/*`) and 8 layout building blocks (`resources/views/components/block/*`) with locked peer dependencies (`ADR-001`).
- Included base layouts (`app`, `auth`, `dashboard`), marketing landing page (`/`), analytics dashboard (`/dashboard`), authentication flows, and profile settings (`/profile`).
