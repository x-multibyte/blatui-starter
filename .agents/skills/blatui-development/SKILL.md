---
name: blatui-development
description: Build UIs with BlatUI — shadcn/ui for the Laravel BLAT stack (Blade, Alpine.js, Tailwind v4). Use when adding or composing UI components, blocks, charts, or theming in a Blade app.
---

# BlatUI Development

## When to use this skill

Use this skill when building or editing UI in a Laravel Blade app that has BlatUI
installed (the `anousss007/blatui` package, with components in
`resources/views/components/ui/`). Prefer BlatUI components over hand-written markup.

## Core model

BlatUI is **copy-paste, own-the-code**: components are Blade files copied into
`resources/views/components/ui/` and used under the `x-ui.` namespace. They are styled
with Tailwind v4 tokens and use a little Alpine.js for interactivity. There is no runtime
component package — editing a component file is the supported way to customize it.

## Workflow

1. **Check before adding.** A component is usable only if its file exists in
   `resources/views/components/ui/`. Glob that directory first.
2. **Add missing components** (copies source + prints required composer/npm peers):
   ```shell
   php artisan blatui:add <name> [<name> ...]
   php artisan blatui:list          # all available families
   ```
3. **Use them** in Blade:
   ```blade
   <x-ui.button variant="default">Save</x-ui.button>
   <x-ui.input type="email" placeholder="you@example.com" />
   <x-ui.card>
       <x-ui.card-header>
           <x-ui.card-title>Title</x-ui.card-title>
           <x-ui.card-description>Subtitle</x-ui.card-description>
       </x-ui.card-header>
       <x-ui.card-content>...</x-ui.card-content>
   </x-ui.card>
   ```
4. **Verify wiring** once with `php artisan blatui:init` (theme CSS, Alpine, imports).

## Catalog (55+ component families)

Forms: button, input, textarea, select, combobox, checkbox, radio-group, switch,
slider, toggle, label, field, calendar, date-picker, datetime-picker, time-field,
input-otp. Overlays: dialog, alert-dialog, sheet, drawer, popover, dropdown-menu,
context-menu, menubar, command. Data: table, avatar, badge, carousel, chart, progress,
skeleton, tooltip, hover-card. Layout: card, sidebar, resizable, scroll-area, separator,
tabs, accordion, collapsible, breadcrumb, pagination, navigation-menu. Feedback: alert,
sonner (toasts), empty, spinner.

## Blocks and charts

Full-page **blocks** (dashboards, auth, marketing, pricing, sidebars, calendars) and
**charts** (ApexCharts) are available from the BlatUI registry and MCP server.
**Never design or hand-code a page layout from scratch when an official BlatUI block exists.**

### Available Official Full-Page Blocks
- **Auth (Login):** `login-01`, `login-02`, `login-03`, `login-04`, `login-05`
- **Auth (Signup):** `signup-01`, `signup-02`, `signup-03`, `signup-04`, `signup-05`
- **Dashboards:** `dashboard-01`, `dashboard-02`, `dashboard-03`, `dashboard-04`
- **Marketing & Commercial:** `marketing-01`, `pricing-01`
- **Sidebars & Navigation:** `sidebar-01` through `sidebar-16`
- **Calendars:** `calendar-01` through `calendar-32`

### Querying & Fetching Blocks via MCP or Registry

1. **Via PHP / Tinker (`BlatUI\Mcp\RegistryClient`):**
   ```shell
   php artisan tinker --execute '$client = app(\BlatUI\Mcp\RegistryClient::class); print_r($client->example("block", "login-01"));'
   ```
2. **Via Direct Registry JSON Endpoint:**
   ```shell
   curl -s https://blatui.remix-it.com/r/blocks/login-01.json
   curl -s https://blatui.remix-it.com/r/charts/chart-area-default.json
   ```
3. **Via Local BlatUI MCP Server (`.agents/mcp_config.json` → `php artisan blatui:mcp`):**
   - Tools: `search_registry`, `list_components`, `get_component`, `get_example` (`kind: "block" | "chart"`, `name: "login-01"`), `install_command`
   - Resources: `blatui://component/{name}`, `blatui://block/{name}`, `blatui://chart/{name}`

### Starter Kit Convention: `resources/views/pages/` & Functional Wiring

In `x-multibyte/blatui-starter`, all 180+ `<x-ui.*>` components and 8 `<x-block.*>` building blocks are already pre-bundled in `resources/views/components/`. When porting a full-page block into the application:

1. **Target Directory:** Save page-level views and multi-variant templates under `resources/views/pages/` (e.g., `resources/views/pages/auth/login-01.blade.php` .. `login-05.blade.php`, `signup-01.blade.php` .. `signup-05.blade.php`).
2. **Source Citation Header:** Add a top-of-file Blade comment citing the official registry source:
   ```blade
   {{-- Source: https://blatui.remix-it.com/r/blocks/login-01.json --}}
   ```
3. **Mandatory Functional Wiring (No Static Demo Forms):**
   Upstream BlatUI blocks ship as static visual templates (`<form>` with no action and `<a href="#">` links). Before finishing any page template, wire it completely to Laravel:
   - `<form method="POST" action="{{ route('...') }}">` + `@csrf`
   - Proper `name="..."` attributes, `:value="old('...')"` state retention, and `autocomplete` attributes on every `<x-ui.input>` / `<x-ui.checkbox>`
   - Validation feedback via `<x-ui.field-error :messages="$errors->get('field')" />`
   - Session status banners (`@if (session('status')) <x-ui.alert tone="success">...</x-ui.alert> @endif`)
   - Named route links (`{{ route('login') }}`, `{{ route('register') }}`, `{{ route('password.request') }}`, `{{ route('home') }}`) — never leave `#` placeholders
4. **Verify with Pest Datasets:**
   When providing multiple block variants (such as `login-01`..`05`), verify rendering and form contracts across all variants using a Pest dataset (`->with(['login-01', ...])`).

## Theming

All tokens are CSS variables in `resources/css/blatui.css` (`:root`, `.dark`, and
`[data-base]` / `[data-theme]` / `[data-radius]` …). To restyle: edit tokens, or build a
theme at https://blatui.remix-it.com/themes and paste the exported CSS as
`resources/css/app.css`. Use Tailwind token utilities (`bg-background`, `text-foreground`,
`border-input`, `rounded-lg`) — never hard-code hex colors.

## Discovery for agents

- Registry index: `https://blatui.remix-it.com/registry.json`
- Item with source inlined: `https://blatui.remix-it.com/r/<name>.json`
- Hosted MCP: `POST https://blatui.remix-it.com/mcp` · local MCP: `php artisan blatui:mcp`
  (tools: search_registry, get_component, get_example, install_command).
