# Task List: BlatUI Starter Boundaries, CI/CD, and Functional Auth Pages

> Generated from [`SPEC.md`](../SPEC.md) and [`tasks/plan.md`](./plan.md).

---

## Task 1: Add Standard Laravel GitHub Actions CI Workflow

**Description:** Create `.github/workflows/ci.yml` following standard Laravel 13 conventions (`ADR-002`) to run on pushes and pull requests to `main`/`master`. The workflow sets up PHP 8.4/8.5 and Node.js, installs Composer and NPM dependencies, runs `composer run lint:check` (Laravel Pint), compiles frontend assets via `npm run build`, prepares SQLite, and executes `php artisan test --compact`.

**Acceptance criteria:**
- [x] `.github/workflows/ci.yml` exists with valid GitHub Actions YAML syntax.
- [x] Workflow enforces three gates: `composer run lint:check` (Pint), `npm run build` (Vite), and `php artisan test` (Pest 5).
- [x] Local execution of `composer run test` and `npm run build` passes without errors.

**Verification:**
- [x] Tests pass: `composer run test`
- [x] Build succeeds: `npm run build`
- [x] Manual check: Inspect `.github/workflows/ci.yml` steps against `composer.json` scripts.

**Dependencies:** None

**Files likely touched:**
- `.github/workflows/ci.yml`

**Estimated scope:** Small (1 file)

---

## Checkpoint 1: After Task 1 (CI & Baseline Verification)
- [x] `composer run lint:check` passes with zero formatting issues
- [x] `npm run build` succeeds without errors
- [x] `php artisan test --compact` passes all existing feature and unit tests

---

## Task 2: Create Functional Login Page Variants `login-01` to `login-03` from BlatUI Registry

**Description:** Fetch the official `login-01`, `login-02`, and `login-03` blocks from the BlatUI registry (`BlatUI\Mcp\RegistryClient`), save them as `resources/views/pages/auth/login-01.blade.php`, `login-02.blade.php`, and `login-03.blade.php`, and wire each template with full Laravel authentication functionality (`method="POST"`, `action="{{ route('login') }}"`, `@csrf`, `session('status')` alert, `name="email"` with `:value="old('email')"`, `name="password"`, `name="remember"`, `<x-ui.field-error>`, and named route links for `password.request`, `register`, and `home`).

**Acceptance criteria:**
- [x] `resources/views/pages/auth/login-01.blade.php`, `login-02.blade.php`, and `login-03.blade.php` exist and preserve their official BlatUI block layout and component composition.
- [x] Every form posts to `{{ route('login') }}` with `@csrf`, required `email` and `password` inputs, `remember` checkbox support, validation error rendering (`<x-ui.field-error>`), and `session('status')` banner.
- [x] All links use Laravel named routes (`route('password.request')`, `route('register')`, `route('home')`) instead of `#` placeholders.

**Verification:**
- [x] Tests pass: `php artisan test --compact tests/Feature/Auth/AuthenticationTest.php`
- [x] Build succeeds: `npm run build`
- [x] Manual check: Render `view('pages.auth.login-01')`, `login-02`, and `login-03` via Pest agent to confirm zero Blade/component errors.

**Dependencies:** Task 1

**Files likely touched:**
- `resources/views/pages/auth/login-01.blade.php`
- `resources/views/pages/auth/login-02.blade.php`
- `resources/views/pages/auth/login-03.blade.php`

**Estimated scope:** Medium (3 files)

---

## Task 3: Create Functional Login Page Variants `login-04` to `login-05`, Wire `AuthenticatedSessionController`, and Add Variant Tests

**Description:** Fetch the official `login-04` and `login-05` blocks from the BlatUI registry into `resources/views/pages/auth/login-04.blade.php` and `login-05.blade.php` with full Laravel authentication wiring. Update `AuthenticatedSessionController::create()` (and `resources/views/auth/login.blade.php` as a fallback/alias if needed) to render `view('pages.auth.login-01')` by default, and update `tests/Feature/Auth/AuthenticationTest.php` to verify rendering and form structure across all 5 login variants (`login-01`..`login-05`).

**Acceptance criteria:**
- [x] `resources/views/pages/auth/login-04.blade.php` and `login-05.blade.php` exist with complete Laravel auth form wiring (`POST {{ route('login') }}`, `@csrf`, `email`, `password`, `remember`, validation errors, named routes).
- [x] `AuthenticatedSessionController::create()` returns `view('pages.auth.login-01')` with a clear PHPDoc note showing how to switch between `login-01`..`login-05`.
- [x] `tests/Feature/Auth/AuthenticationTest.php` passes and includes assertions that all 5 views (`pages.auth.login-01`..`05`) render without errors and contain the login form action.

**Verification:**
- [x] Tests pass: `php artisan test --compact tests/Feature/Auth/AuthenticationTest.php`
- [x] Build succeeds: `npm run build`
- [x] Lint passes: `vendor/bin/pint --dirty --format agent`

**Dependencies:** Task 2

**Files likely touched:**
- `resources/views/pages/auth/login-04.blade.php`
- `resources/views/pages/auth/login-05.blade.php`
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `resources/views/auth/login.blade.php`
- `tests/Feature/Auth/AuthenticationTest.php`

**Estimated scope:** Medium (5 files)

---

## Task 4: Create Functional Signup Page Variants `signup-01` to `signup-03` from BlatUI Registry

**Description:** Fetch the official `signup-01`, `signup-02`, and `signup-03` blocks from the BlatUI registry into `resources/views/pages/auth/signup-01.blade.php`, `signup-02.blade.php`, and `signup-03.blade.php`. Wire each form to `POST {{ route('register') }}` with `@csrf`, `name="name"` (`:value="old('name')"`), `name="email"` (`:value="old('email')"`), `name="password"`, `name="password_confirmation"`, `<x-ui.field-error>` for each field, and named route links (`route('login')`, `route('home')`).

**Acceptance criteria:**
- [x] `resources/views/pages/auth/signup-01.blade.php`, `signup-02.blade.php`, and `signup-03.blade.php` exist and preserve their official BlatUI block layout.
- [x] Every form posts to `{{ route('register') }}` with `@csrf` and inputs matching `RegisteredUserController::store()` (`name`, `email`, `password`, `password_confirmation`) plus `<x-ui.field-error>` messages.
- [x] All sign-in/brand links point to `{{ route('login') }}` and `{{ route('home') }}`.

**Verification:**
- [x] Tests pass: `php artisan test --compact tests/Feature/Auth/RegistrationTest.php`
- [x] Build succeeds: `npm run build`
- [x] Manual check: Render `view('pages.auth.signup-01')`, `signup-02`, and `signup-03` via Pest agent to confirm zero Blade/component errors.

**Dependencies:** Task 3

**Files likely touched:**
- `resources/views/pages/auth/signup-01.blade.php`
- `resources/views/pages/auth/signup-02.blade.php`
- `resources/views/pages/auth/signup-03.blade.php`

**Estimated scope:** Medium (3 files)

---

## Task 5: Create Functional Signup Page Variants `signup-04` to `signup-05`, Wire `RegisteredUserController`, and Add Variant Tests

**Description:** Fetch the official `signup-04` and `signup-05` blocks from the BlatUI registry into `resources/views/pages/auth/signup-04.blade.php` and `signup-05.blade.php` with full Laravel registration wiring. Update `RegisteredUserController::create()` to render `view('pages.auth.signup-01')` by default, and update `tests/Feature/Auth/RegistrationTest.php` to verify rendering and form contract across all 5 signup variants (`signup-01`..`signup-05`).

**Acceptance criteria:**
- [x] `resources/views/pages/auth/signup-04.blade.php` and `signup-05.blade.php` exist with complete Laravel registration wiring (`POST {{ route('register') }}`, `@csrf`, `name`, `email`, `password`, `password_confirmation`, validation errors, named routes).
- [x] `RegisteredUserController::create()` returns `view('pages.auth.signup-01')` with a clear PHPDoc note showing how to switch between `signup-01`..`signup-05`.
- [x] `tests/Feature/Auth/RegistrationTest.php` passes and verifies that all 5 signup views (`pages.auth.signup-01`..`05`) render cleanly and expose the required registration fields.

**Verification:**
- [x] Tests pass: `php artisan test --compact tests/Feature/Auth/RegistrationTest.php`
- [x] Build succeeds: `npm run build`
- [x] Lint passes: `vendor/bin/pint --dirty --format agent`

**Dependencies:** Task 4

**Files likely touched:**
- `resources/views/pages/auth/signup-04.blade.php`
- `resources/views/pages/auth/signup-05.blade.php`
- `app/Http/Controllers/Auth/RegisteredUserController.php`
- `resources/views/auth/register.blade.php`
- `tests/Feature/Auth/RegistrationTest.php`

**Estimated scope:** Medium (5 files)

---

## Task 6: Align Remaining Auth Views (`forgot-password`, `reset-password`, `verify-email`, `confirm-password`) under `resources/views/pages/auth/`

**Description:** Move/mirror the remaining existing authentication pages (`forgot-password`, `reset-password`, `verify-email`, `confirm-password`) into `resources/views/pages/auth/` with cohesive BlatUI card/field styling and wire their controllers (`PasswordResetLinkController`, `NewPasswordController`, `EmailVerificationPromptController`, `ConfirmablePasswordController`) so all auth views live consistently under `resources/views/pages/auth/` (keeping thin `@include` aliases in `resources/views/auth/*` for backwards compatibility).

**Acceptance criteria:**
- [x] `resources/views/pages/auth/{forgot-password,reset-password,verify-email,confirm-password}.blade.php` exist and use consistent BlatUI `<x-ui.card>`, `<x-ui.field>`, `<x-ui.input>`, `<x-ui.button>`, and `<x-ui.alert>` components.
- [x] All auth controllers render `pages.auth.*` views consistently, and `resources/views/auth/*` delegate to `pages.auth.*` so no external references break.
- [x] Full `tests/Feature/Auth/` suite passes (`AuthenticationTest`, `RegistrationTest`, `PasswordResetTest`, `EmailVerificationTest`, `PasswordConfirmationTest`, `PasswordUpdateTest`).

**Verification:**
- [x] Tests pass: `php artisan test --compact tests/Feature/Auth`
- [x] Build succeeds: `npm run build`
- [x] Lint passes: `vendor/bin/pint --dirty --format agent`

**Dependencies:** Task 5

**Files likely touched:**
- `resources/views/pages/auth/forgot-password.blade.php`
- `resources/views/pages/auth/reset-password.blade.php`
- `resources/views/pages/auth/verify-email.blade.php`
- `resources/views/pages/auth/confirm-password.blade.php`
- `app/Http/Controllers/Auth/*` (view path updates)

**Estimated scope:** Medium (5 files)

---

## Checkpoint 2: After Tasks 2–6 (Auth UI Complete)
- [x] All 10 official BlatUI auth variants (`login-01`..`05`, `signup-01`..`05`) and 4 secondary auth pages live under `resources/views/pages/auth/`
- [x] `php artisan test --compact tests/Feature/Auth` passes 100%
- [x] `npm run build` and `vendor/bin/pint --dirty --format agent` pass cleanly

---

## Task 7: Codify Project Workflow & BlatUI MCP Rules in `AGENTS.md` and Overhaul `README.md`

**Description:** Update `AGENTS.md` to embed the project's standard agent workflow:
1. Check `SPEC.md`, `docs/decisions/` (ADRs), and `tasks/plan.md` + `tasks/todo.md` before making structural changes.
2. Autonomously query BlatUI's MCP server / `BlatUI\Mcp\RegistryClient` for official components, blocks (`login-01`..`05`, `signup-01`..`05`, `dashboard-01`..`04`, etc.), and charts instead of reinventing markup or asking the user where to find them.
3. Place page-level templates in `resources/views/pages/` and ensure all forms/actions are functionally wired to Laravel routes and tested with Pest + Pint.
Also overhaul `README.md` to document the 5 login & 5 signup variants in `resources/views/pages/auth/`, how to switch them via `view('pages.auth.login-01')`, the CI/CD quality gates, and links to `SPEC.md` and `docs/decisions/`.

**Acceptance criteria:**
- [x] `AGENTS.md` includes a dedicated Project Workflow & Boundaries section referencing `SPEC.md`, `docs/decisions/`, `tasks/plan.md`, `resources/views/pages/`, and autonomous BlatUI MCP block/component discovery.
- [x] `README.md` documents the `resources/views/pages/auth/` multi-variant auth system (`login-01`..`05`, `signup-01`..`05`), how to switch variants, CI/CD commands (`composer run test`, `composer run lint`), and links to `SPEC.md` and `docs/decisions/`.
- [x] Full test and lint suite (`composer run test` and `npm run build`) passes.

**Verification:**
- [x] Tests pass: `composer run test`
- [x] Build succeeds: `npm run build`
- [x] Manual check: Review `AGENTS.md` and `README.md` links and command accuracy.

**Dependencies:** Task 6

**Files likely touched:**
- `AGENTS.md`
- `README.md`

**Estimated scope:** Small (2 files)

---

## Checkpoint 3: Complete
- [x] All tasks in `tasks/todo.md` checked off
- [x] `composer run test` and `npm run build` pass with zero warnings/errors
- [x] Ready for human review
