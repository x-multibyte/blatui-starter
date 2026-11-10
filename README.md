<div align="center">

# BlatUI Starter

### A production-ready Laravel 13 starter kit pre-wired with [BlatUI](https://blatui.remix-it.com) — shadcn/ui for the BLAT stack (Blade · Laravel · Alpine · Tailwind v4) and Livewire 4 + Blaze.

[![CI](https://github.com/x-multibyte/blatui-starter/actions/workflows/ci.yml/badge.svg)](https://github.com/x-multibyte/blatui-starter/actions/workflows/ci.yml)
[![PHP Version](https://img.shields.io/badge/PHP-8.4%20%7C%208.5-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-13.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

</div>

---

## Overview

**`x-multibyte/blatui-starter`** is an opinionated, zero-friction Laravel 13 starter kit combining [BlatUI](https://blatui.remix-it.com) (180+ copy-paste Blade components inspired by shadcn/ui) with [Livewire 4](https://livewire.laravel.com) and [Livewire Blaze](https://github.com/livewire/blaze).

### The Zero-Friction Value Proposition

In standard Laravel projects, incorporating modern UI component libraries requires substantial boilerplate: resolving peer Composer packages (`gehrisandro/tailwind-merge-laravel`, `mallardduck/blade-lucide-icons`, `livewire/blaze`), npm runtime dependencies (`@alpinejs/anchor`, `@alpinejs/collapse`, `@alpinejs/focus`, `@floating-ui/dom`, `apexcharts`), configuring Tailwind CSS v4 CSS variables (`blatui.css`), setting up Livewire bridges, and scaffolding authentication.

**BlatUI Starter eliminates this entire friction cycle.** Run a single command, and you receive an application where:
- All **180+ BlatUI component families** (`<x-ui.*>`) and **8 layout blocks** (`<x-block.*>`) are pre-installed in your repository — you own every line of code.
- **5 functional login variants** (`login-01`..`05`) and **5 functional signup variants** (`signup-01`..`05`) are ready in `resources/views/pages/auth/`, pre-wired with Laravel authentication, CSRF protection, and validation feedback.
- Livewire 4 and Blaze are optimized out of the box with memoized Tailwind merge caching.
- CI/CD quality gates (Laravel Pint, Vite compilation, and Pest 5) ensure your code stays clean and deployable.

---

## Quick Start

### 1. Create a New Project

Use the Laravel installer's `--using` flag:

```bash
laravel new my-app --using=x-multibyte/blatui-starter
cd my-app
```

Or initialize via Composer directly:

```bash
composer create-project x-multibyte/blatui-starter my-app
cd my-app
npm install && npm run build
```

### 2. Start the Development Environment

```bash
composer run dev
```

This starts the Laravel HTTP server, queue worker, Laravel Pail log stream, and Vite dev server concurrently.

Open **<http://localhost:8000>** to explore the landing page, analytics dashboard, profile management, and authentication flows.

---

## What's Inside

| Layer | Technology | Details |
|---|---|---|
| **Backend Framework** | Laravel 13 (`laravel/framework` ^13.36) | PHP 8.4+ / PHP 8.5 compatible with strict types and modern Laravel conventions |
| **Reactive UI** | Livewire 4 (`livewire/livewire` ^4.4) + Blaze (`livewire/blaze` ^1.0) | Seamless two-way `wire:model` binding across inputs, date-pickers, tables, and selects; pre-optimized in `AppServiceProvider` via `Blaze::optimize()` and memoized `tailwind-merge` cache |
| **Component System** | BlatUI (`anousss007/blatui` ^1.4) | 180+ component families (377+ Blade files) in `resources/views/components/ui/` (`<x-ui.*>`) and 8 layout blocks in `resources/views/components/block/` (`<x-block.*>`) |
| **Styling** | Tailwind CSS v4 (`@tailwindcss/vite` ^4.0.0) | CSS variable design tokens on `:root` and `.dark` in `resources/css/blatui.css`, fully customizable visually via [BlatUI Themes](https://blatui.remix-it.com/themes) |
| **Interactivity** | Alpine.js 3 (`alpinejs` ^3.15.12) | Bundled with official plugins (`@alpinejs/anchor`, `@alpinejs/collapse`, `@alpinejs/focus`), `@floating-ui/dom`, and `apexcharts` |
| **Asset Bundling** | Vite 8 (`vite` ^8.0.0) | Blazing-fast HMR and production asset compilation |
| **Testing** | Pest 5 (`pestphp/pest` ^5.3) | Feature tests with `RefreshDatabase`, browser testing support, and one-shot Pest agent verification |
| **Code Style** | Laravel Pint (`laravel/pint` ^1.32) + Prettier | Parallel linting and formatting for PHP, Blade, and Tailwind classes |

### Pre-Installed Layout Shells

- `<x-layouts.app>`: Base HTML shell featuring flash-free theme initialization script (`dark` mode toggle support).
- `<x-layouts.auth>`: Centered layout card shell for authentication views.
- `<x-layouts.dashboard>`: Comprehensive dashboard shell with collapsible inset sidebar (`<x-block.sidebar-*>`), command search, breadcrumbs, and user dropdown.

### Pre-Installed Application Blocks (`<x-block.*>`)

- `nav-user`: User profile dropdown menu with avatar and logout action
- `nav-main`: Primary collapsible navigation links
- `nav-projects`: Project list navigation group
- `nav-secondary`: Secondary system links (settings, help, feedback)
- `team-switcher`: Workspace/team switcher dropdown
- `version-switcher`: Branch or software version selector
- `search-form`: Quick search modal trigger input
- `file-tree`: Interactive hierarchical file and folder explorer

---

## Multi-Variant Functional Auth Pages

Unlike upstream BlatUI blocks which provide static HTML mockups, BlatUI Starter pre-wires **10 official BlatUI auth blocks** under `resources/views/pages/auth/` as **100% functionally integrated Laravel Blade templates**:

```text
resources/views/pages/auth/
├── login-01.blade.php      # Variant 1: Clean centered card
├── login-02.blade.php      # Variant 2: Split screen with hero visual panel
├── login-03.blade.php      # Variant 3: Minimalist floating card with subtle focus accents
├── login-04.blade.php      # Variant 4: Side-by-side with brand testimonial quote
├── login-05.blade.php      # Variant 5: Full-bleed background card overlay
├── signup-01.blade.php     # Variant 1: Clean centered card
├── signup-02.blade.php     # Variant 2: Split screen with feature showcase panel
├── signup-03.blade.php     # Variant 3: Floating minimalist registration card
├── signup-04.blade.php     # Variant 4: Side-by-side with brand quote testimonial
├── signup-05.blade.php     # Variant 5: Full-bleed card overlay
├── forgot-password.blade.php
├── reset-password.blade.php
├── verify-email.blade.php
└── confirm-password.blade.php
```

### Every Variant Is Fully Wired Out of the Box

Each auth variant includes:
- Secure `POST` forms posting directly to Laravel named routes (`{{ route('login') }}` and `{{ route('register') }}`).
- `@csrf` token directive.
- Proper input `name` attributes (`email`, `password`, `remember`, `name`, `password_confirmation`).
- Form value restoration on validation failures using `:value="old('email')"` and `:value="old('name')"`.
- Validation errors rendered using `<x-ui.field-error :messages="$errors->get('field')" />`.
- Session status alerts (`session('status')`) for password resets and verification prompts.
- Real named route links for password recovery (`route('password.request')`), registration (`route('register')`), login (`route('login')`), and brand home (`route('home')`) — no broken `#` placeholders.

### Switching Auth Variants via `config/blatui.php`

To switch authentication layout styles, update `config/blatui.php` (or set the corresponding `.env` variables):

```php
// config/blatui.php
'pages' => [
    'auth' => [
        // Available: 'pages.auth.login-01' through 'pages.auth.login-05'
        'login' => env('BLATUI_AUTH_LOGIN_VIEW', 'pages.auth.login-01'),

        // Available: 'pages.auth.signup-01' through 'pages.auth.signup-05'
        'register' => env('BLATUI_AUTH_REGISTER_VIEW', 'pages.auth.signup-01'),

        'forgot_password' => env('BLATUI_AUTH_FORGOT_PASSWORD_VIEW', 'pages.auth.forgot-password'),
        'reset_password' => env('BLATUI_AUTH_RESET_PASSWORD_VIEW', 'pages.auth.reset-password'),
        'verify_email' => env('BLATUI_AUTH_VERIFY_EMAIL_VIEW', 'pages.auth.verify-email'),
        'confirm_password' => env('BLATUI_AUTH_CONFIRM_PASSWORD_VIEW', 'pages.auth.confirm-password'),
    ],
],
```

*(Auth controllers and the backwards-compatible wrappers in `resources/views/auth/*` automatically resolve their Blade views from `config('blatui.pages.auth.*')`).*

---

## Commands

| Command | Description |
|---|---|
| `composer run setup` | Full initial project setup (`composer install`, `.env`, `key:generate`, `migrate`, `npm install`, `build`) |
| `composer run dev` | Run local development stack concurrently (HTTP server, queue worker, pail, Vite dev) |
| `npm run build` | Compile and minify production frontend assets using Vite and Tailwind v4 |
| `composer run lint` | Auto-format PHP code with Laravel Pint in parallel (`pint --parallel`) |
| `composer run lint:check` | Check PHP formatting without modifying files (`pint --parallel --test` — used in CI) |
| `composer run test` | Clear config cache, verify Pint formatting, and run the Pest 5 test suite |
| `php artisan test --compact` | Run Pest feature and unit tests with concise output |
| `php artisan blatui:list` | Browse all official BlatUI components, blocks, and charts |
| `php artisan blatui:add <name>` | Copy a BlatUI component or block into your application |
| `php artisan blatui:mcp` | Start local BlatUI MCP server for autonomous AI agent inspection |

---

## Architecture, Specification & ADRs

Architectural decisions, quality standards, and technical specifications are committed in the repository to provide durable long-term memory for human contributors and AI agents alike:

- **[`SPEC.md`](SPEC.md)**: Master specification covering capability maps, tech stack constraints, command references, and module delivery plans.
- **[`AGENTS.md`](AGENTS.md)**: Autonomous agent guidelines, coding conventions, BlatUI MCP discovery instructions, and quality gates.
- **Architecture Decision Records ([`docs/decisions/`](docs/decisions/))**:
  - **[`ADR-001: Pre-bundle All BlatUI Components with Locked Dependencies and Manual Upstream Review`](docs/decisions/ADR-001-prebundle-and-lock-blatui-components.md)**: Why all 180+ components and peer packages are bundled upfront and locked against automated drift.
  - **[`ADR-002: Standard Laravel GitHub Actions CI with Pint and Pest`](docs/decisions/ADR-002-ci-cd-and-quality-gates.md)**: Establishing continuous integration quality gates enforcing Pint formatting, Vite build, and Pest test suite.
  - **[`ADR-003: Multi-Variant Functional Auth Pages from BlatUI Registry Blocks`](docs/decisions/ADR-003-multi-variant-auth-pages-via-blatui-blocks.md)**: Pre-wiring official BlatUI `login-01`..`05` and `signup-01`..`05` blocks under `resources/views/pages/auth/`.

### Continuous Integration (CI/CD)

The GitHub Actions workflow at [`.github/workflows/ci.yml`](.github/workflows/ci.yml) executes on every push and pull request to `main`/`master`, enforcing three mandatory quality gates:
1. **Code Style Gate:** `composer run lint:check` (Laravel Pint)
2. **Frontend Asset Gate:** `npm ci && npm run build` (Vite 8 + Tailwind v4)
3. **Test Suite Gate:** `php artisan test --compact` (Pest 5 on SQLite)

---

## BlatUI MCP Server & AI Agent Pairing

If you develop using AI coding agents (such as Antigravity, Claude Code, or Cursor), this project supports autonomous BlatUI component and block discovery:

- **Local MCP Server:** Run `php artisan blatui:mcp` to expose tools (`search_registry`, `get_component`, `get_example`, `install_command`) and URI resources (`blatui://component|block|chart/{name}`).
- **Autonomous Discovery:** Agents inspect upstream blocks (`dashboard-01`..`04`, `sidebar-01`..`16`, `calendar-01`..`32`, `marketing-01`, `pricing-01`) directly via the BlatUI registry rather than generating custom HTML from scratch.

---

## License

BlatUI Starter is open-source software licensed under the [MIT license](LICENSE).
