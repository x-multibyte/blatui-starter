<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.5. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== tests rules ===

# Test Enforcement

- Add or update tests for behavior and logic changes when a test provides meaningful regression coverage.
- Pure copy, styling, and layout-only changes do not require new or updated tests.
- When test coverage applies, run the affected tests and ensure they pass.
- Test the changed behavior and its important failure modes, but do not add tests beyond them.
- Read the `testing-best-practices` skill before writing tests.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== livewire/core rules ===

# Livewire

- Livewire allows you to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

# Pest

- This project uses Pest. Create tests with `php artisan make:test --pest {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.
- Do not delete tests or test files without approval. They are part of the application.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/pest` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

=== anousss007/blatui/core rules ===

## BlatUI

BlatUI is shadcn/ui for the Laravel BLAT stack (Blade, Alpine.js, Tailwind CSS v4).
Components are copy-paste Blade components the user **owns** — copied into
`resources/views/components/ui/`, not a runtime dependency. Works with or without Livewire.

### Using components

Components live under the `x-ui.` namespace. Use them directly in Blade and prefer
them over hand-rolled markup:

<code-snippet name="BlatUI components in Blade" lang="blade">
<x-ui.button variant="outline" size="sm">Save</x-ui.button>

<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button>Open</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content>
        <x-ui.dialog-header>
            <x-ui.dialog-title>Title</x-ui.dialog-title>
        </x-ui.dialog-header>
    </x-ui.dialog-content>
</x-ui.dialog>
</code-snippet>

Component APIs mirror shadcn/ui. `button` variants: `default`, `secondary`, `outline`,
`ghost`, `destructive`, `link`; sizes `sm`, `default`, `lg`, `icon`.

### Installing components

A component is only usable if its file exists in `resources/views/components/ui/`.
If it is missing, add it with the CLI — this copies the Blade source and prints the
required composer/npm peer packages. Never re-implement a component by hand if BlatUI
ships it.

<code-snippet name="Add BlatUI components" lang="shell">
php artisan blatui:add button card dialog   # copies files + their dependencies
php artisan blatui:list                      # browse everything available
php artisan blatui:init                      # verify theme tokens, Alpine, imports
</code-snippet>

### Theming

Every design token is a CSS variable on `:root` / `.dark` / `[data-*]` in
`resources/css/blatui.css`. Recolor by editing tokens, or design a theme visually at
https://blatui.remix-it.com/themes and paste the exported CSS into `resources/css/app.css`.

### Machine-readable registry

To read a component's exact source or discover what exists, use the registry
(shadcn-compatible, every file inlined):

- Index: `https://blatui.remix-it.com/registry.json`
- One item: `https://blatui.remix-it.com/r/<name>.json`
  (blocks: `/r/blocks/<name>.json`, charts: `/r/charts/<name>.json`)
- LLM index: `https://blatui.remix-it.com/llms.txt`

A hosted MCP server is available at `https://blatui.remix-it.com/mcp`, and a local one
via `php artisan blatui:mcp` (tools: search_registry, get_component, get_example,
install_command; resources `blatui://component|block|chart/{name}`).

=== pestphp/pest-plugin-agent/core rules ===

## Pest Agent Plugin

`vendor/bin/pest --agent="<code>"` runs a one-off Pest assertion without creating a test file — the fastest way to verify that a change actually works (a route response, a model relationship, a rendered page, a form submission, mail firing, a screenshot, JavaScript errors, and so on).

### ALWAYS load the skill first

Whenever the user asks you to check, verify, confirm, or "make sure" something **works** — and it can be exercised on a route, page, form, model, job, mail, notification, or screenshot — you **MUST** load the **`pest-plugin-agent` skill before doing anything else**. Do not reach for a shell command, a throwaway test file, or manual reasoning first. This includes prompts like "verify the login form works", "did my change break X", "screenshot the homepage", "check this route returns 200", "make sure the mail fires", "is the form working", or any behavioral check after a Blade, Livewire, CSS, or JS change. Load the skill, then follow it exactly.

### NEVER fight shell escaping — use SINGLE outer quotes

Inline the snippet, but wrap it in **single** quotes, not double. Single quotes tell the shell to interpret nothing, so `$variables`, `\App\Models\User`, backticks, and `!` all pass through to PHP literally — **there is nothing to escape.** Use double quotes for PHP string literals inside:

```bash
vendor/bin/pest --agent='$user = \App\Models\User::factory()->create(); visit("/login")->type("email", $user->email)->press("Log in")->assertPathIs("/dashboard");'
```

Double outer quotes are the trap the shell springs on you — `--agent="…$user…"` makes the shell interpolate `$user` to nothing. Never do that, and never hand-escape `\$`.

The one thing single quotes can't contain is a literal single quote (an apostrophe in the PHP). Only then, fall back to a file: **Write** the snippet to a `.php` file (plain body statements — no `<?php`, no `use`, fully qualified class names) and run `vendor/bin/pest --agent="$(cat /path/to/snippet.php)"`. `"$(cat …)"` passes the contents verbatim without re-parsing. The plugin resolves the test suite's `uses`/namespace itself, so the file's location does not matter (a scratch/temp path is fine — it need not live under `tests/`).

### Browser checks require the browser plugin — ask before installing

Whenever the request can only be answered in a real browser — "does login work", "is the page responsive", "screenshot the homepage", "check the mobile layout", "does the button click through", "are there JS/console errors", or any visual/interaction check — the `visit()` browser API is needed. It comes from a **separate** package, `pestphp/pest-plugin-browser`, which is powered by Playwright.

If `visit()` is undefined (or the package is not installed), **do not install it silently — ask the user for permission first**, since it pulls in Node/Playwright dependencies and downloads browser binaries. Explain that the browser check needs it and confirm before running these commands:

```bash
composer require pestphp/pest-plugin-browser --dev   # the browser plugin (needs Node.js)
npm install playwright@latest                         # Playwright driver
npx playwright install                                # download the browser binaries
```

Once the user approves and it's installed, add `tests/Browser/Screenshots` to `.gitignore` so captured screenshots aren't committed. Browser assertions then run through the same `vendor/bin/pest --agent='…'` flow:

```bash
vendor/bin/pest --agent='visit("/login")->type("email", "test@example.com")->type("password", "password")->press("Log in")->assertPathIs("/dashboard");'
vendor/bin/pest --agent='visit("/")->on()->mobile()->screenshot(fullPage: false, filename: "home-mobile");'
```

For full usage — backend examples, browser testing, screenshots, responsive checks, combining frontend and backend assertions, RefreshDatabase guidance, and pitfalls — load the **`pest-plugin-agent` skill**.

=== project workflow & boundaries ===

# Project Workflow & Architecture Boundaries

## Agent Skills Lifecycle (`using-agent-skills`)

Follow the structured `using-agent-skills` engineering sequence across sessions:
1. **Define (`interview-me` → `spec-driven-development`)**: Clarify intent, surface assumptions, and lock scope & boundaries in [`SPEC.md`](SPEC.md) before writing code.
2. **Plan (`planning-and-task-breakdown`)**: Decompose work into small, verifiable slices in [`tasks/plan.md`](tasks/plan.md) and [`tasks/todo.md`](tasks/todo.md).
3. **Build (`source-driven-development` + `blatui-development` + `laravel-best-practices`)**: Fetch official BlatUI components/blocks and cite sources; never invent custom UI layouts from scratch when BlatUI provides them.
4. **Verify (`testing-best-practices` + `pest-plugin-agent`)**: Verify with Pest datasets, `vendor/bin/pest --agent='...'`, `vendor/bin/pint --dirty --format agent`, and `npm run build`.
5. **Review & Ship (`code-review-and-quality` + `git-workflow-and-versioning` + `documentation-and-adrs`)**: Perform five-axis review, record architectural decisions in [`docs/decisions/`](docs/decisions/), update [`CHANGELOG.md`](CHANGELOG.md), and commit in clean atomic Conventional Commits (`ADR-004`).

## Spec & ADR First (`SPEC.md` & `docs/decisions/`)

- Before initiating architectural, structural, or scope modifications, always inspect [`SPEC.md`](SPEC.md), existing Architecture Decision Records in [`docs/decisions/`](docs/decisions/) (`ADR-001`, `ADR-002`, `ADR-003`), [`tasks/plan.md`](tasks/plan.md), and [`tasks/todo.md`](tasks/todo.md).
- When introducing a non-trivial architectural decision, interface pattern, or boundary constraint, record an Architecture Decision Record in `docs/decisions/` following sequential numbering (`docs/decisions/ADR-00X-<kebab-case-title>.md`). Follow the established format: Status, Date, Context, Decision, Alternatives Considered, Consequences.
- Maintain alignment between `SPEC.md`, ADRs, and implementation tasks; never make uncoordinated or undocumented scope expansions.

## Source-Driven BlatUI MCP Discovery

- **Never create custom UI components or page layouts from scratch** when BlatUI already supplies an official implementation.
- Autonomously query the BlatUI registry and MCP server before building:
  - Run `php artisan blatui:list` to browse locally available and downloadable components.
  - Run `php artisan blatui:mcp` or query the local MCP server (tools: `search_registry`, `get_component`, `get_example`, `install_command`; resources: `blatui://component|block|chart/{name}`).
  - Query in PHP using `app(\BlatUI\Mcp\RegistryClient::class)->itemsOfType('registry:block')`, `->component($name)`, or `->example('block', $name)`.
  - Directly inspect the upstream remote registry at `https://blatui.remix-it.com/r/blocks/<name>.json`, `https://blatui.remix-it.com/r/<name>.json`, or `https://blatui.remix-it.com/llms.txt`.
- Inspect official `<x-ui.*>` primitives, `<x-block.*>` layout building blocks, and full-page blocks:
  - Auth blocks: `login-01` through `login-05`, `signup-01` through `signup-05`
  - Dashboard blocks: `dashboard-01` through `dashboard-04`
  - Commercial & marketing blocks: `marketing-01`, `pricing-01`
  - Layout & navigation blocks: `sidebar-01` through `sidebar-16`
  - Specialized blocks: `calendar-01` through `calendar-32`
- When porting an upstream block into the application, cite the upstream source URL in a comment header at the top of the file (e.g., `{{-- Source: https://blatui.remix-it.com/r/blocks/login-01.json --}}`).

## Page Directory Convention (`resources/views/pages/`)

- Place all page-level Blade views and multi-variant page templates in `resources/views/pages/` (e.g., `resources/views/pages/auth/login-01.blade.php`..`05`, `signup-01.blade.php`..`05`).
- Ensure every page template is **100% functionally wired** to Laravel backend conventions:
  - Valid `method="POST"` actions pointing to named routes (`action="{{ route('login') }}"`, `action="{{ route('register') }}"`).
  - `@csrf` token directive present on every form.
  - Real input names and `:value="old('field')"` bindings.
  - Validation error feedback rendered using `<x-ui.field-error :messages="$errors->get('field')" />`.
  - Status messages rendered with session status alerts (`session('status')`).
  - Real named route links (`route('password.request')`, `route('login')`, `route('register')`, `route('home')`).
  - **Never leave static `#` demo links, dummy inputs without `name` attributes, or unhandled form submissions.**

## Locked Dependencies & Manual Upstream Review (`ADR-001`)

- The starter kit pre-bundles 180+ `<x-ui.*>` components and all necessary peer NPM/Composer dependencies locked in `composer.lock` and `package-lock.json` for zero-friction project setup.
- Never add automated scripts, scheduled bots, or auto-merge jobs that overwrite `resources/views/components/ui/` or upgrade locked dependencies without explicit human review.
- Upstream changes to `anousss007/blatui` or framework dependencies must be reviewed manually to avoid regressions.

## Subagent Orchestration & Quality Gates (`ADR-002`)

- For multi-file features or variant batches, delegate parallelizable slices to Gemini Flash 3.8 (`Model: "flash"`) subagents.
- Maintain strict file isolation across subagents to prevent concurrent write collisions.
- Verify every implementation slice against the three mandatory quality gates:
  1. Code formatting: `vendor/bin/pint --dirty --format agent` (or `composer run lint`)
  2. Asset build: `npm run build`
  3. Tests: `php artisan test --compact` (or `composer run test`)

</laravel-boost-guidelines>
