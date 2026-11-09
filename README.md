<div align="center">

# BlatUI Starter

### A Laravel 13 starter kit pre-wired with [BlatUI](https://blatui.remix-it.com) — shadcn/ui for the BLAT stack (Blade · Laravel · Alpine · Tailwind v4).

</div>

---

This is a community Laravel starter kit combining **BlatUI** (shadcn/ui components for Blade + Alpine.js + Tailwind CSS v4) with working authentication and profile management out of the box.

## Get started

Create a new project using the Laravel installer's `--using` flag:

```bash
laravel new my-app --using=x-multibyte/blatui-starter
cd my-app
```

Or with Composer directly:

```bash
composer create-project x-multibyte/blatui-starter my-app
cd my-app
npm install && npm run build
```

Then start the development server:

```bash
composer run dev
```

Open <http://localhost:8000> — the landing page. `/login`, `/register`, `/dashboard`, and `/profile` are ready to use.

## What's inside

- **Laravel 13** · **Livewire 4** · **Tailwind CSS v4** · **Alpine.js 3** · **Vite 8** · **Pest 5**.
- **Livewire-ready & Blaze-optimized out of the box** (`livewire/livewire` v4 + `livewire/blaze` v1 installed and pre-configured):
  - Every BlatUI value-bearing component (`input`, `select`, `combobox`, `checkbox`, `switch`, `slider`, `date-picker`, `file-upload`, `data-table`, `server-table`, etc.) supports two-way `wire:model` binding via BlatUI's built-in Livewire bridge.
  - Full-page Livewire components default to the `layouts::app` layout (`resources/views/components/layouts/app.blade.php`).
  - `Blaze::optimize()->in(resource_path('views/components/ui'))` and `Cache::memo()` for `tailwind-merge` are pre-wired in `AppServiceProvider` for maximum rendering performance.
- **Full authentication & account management** built entirely with BlatUI components:
  - Login, registration, password reset, email verification, and password confirmation (`resources/views/auth/*`).
  - Profile information update, password update, and account deletion confirmation dialog (`resources/views/profile/*`).
- The full **BlatUI component set** copied into `resources/views/components/` — you own every line:
  - `ui/` — 180+ component families (377 files), rendered as `<x-ui.*>`.
  - `block/` — 8 dashboard/sidebar building blocks (`nav-user`, `nav-main`, `nav-projects`,
    `nav-secondary`, `team-switcher`, `version-switcher`, `search-form`, `file-tree`), rendered as
    `<x-block.*>`.
  - `layouts/app.blade.php` — base HTML layout (`<x-layouts.app>`) with a no-flash theme script.
  - `layouts/auth.blade.php` — centered card shell (`<x-layouts.auth>`) for authentication screens.
  - `layouts/dashboard.blade.php` — authenticated application shell (`<x-layouts.dashboard>`) with collapsible inset sidebar and user menu.
- Foundations wired: `resources/css/app.css` → `@import './blatui.css'` (Tailwind v4 + theme tokens),
  `resources/js/app.js` → `import './charts.js'` + `import './blatui.js'` (boots Alpine + the BlatUI engine and ApexCharts helpers).
- Pre-built pages:
  - `/` — marketing landing (`resources/views/landing.blade.php`)
  - `/dashboard` — analytics dashboard (`resources/views/dashboard.blade.php`)
  - `/profile` — account settings (`resources/views/profile/edit.blade.php`)
  - `/login`, `/register`, `/forgot-password`, `/reset-password`, `/verify-email`, `/confirm-password` — auth flows
- Theme tokens are CSS variables — recolor everything from the BlatUI
  [theme editor](https://blatui.remix-it.com/themes) and paste into `resources/css/blatui.css`.

## Add or update components

Everything is already included, and the BlatUI CLI is installed for pulling updates or browsing components:

```bash
php artisan blatui:add <component>     # e.g. command, date-picker, sonner
php artisan blatui:list                # browse everything available
php artisan blatui:init                # verify theme tokens, Alpine, imports
```

## Testing & formatting

```bash
composer test              # Clear config, check code style with Pint, and run Pest suite
vendor/bin/pest            # Run Pest tests directly
vendor/bin/pint            # Auto-format PHP files
```
