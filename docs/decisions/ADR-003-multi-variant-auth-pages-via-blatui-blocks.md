# ADR-003: Multi-Variant Functional Auth Pages from BlatUI Registry Blocks

## Status
Accepted

## Date
2026-11-10

## Context
The initial authentication views in `resources/views/auth/*` were basic scaffolded forms. Rather than inventing custom login and registration designs from scratch, the official BlatUI registry already ships five login blocks (`login-01` through `login-05`) and five signup blocks (`signup-01` through `signup-05`).

However, upstream BlatUI blocks are static UI templates (`<form>` with no `method`, `action`, `@csrf`, input `name` attributes, validation error bindings, or named route links). Downstream developers using `x-multibyte/blatui-starter` need ready-to-use, functional authentication pages where they can pick their preferred layout style immediately.

## Decision
1. **Store official auth page variants in `resources/views/pages/auth/`:**
   - `resources/views/pages/auth/login-01.blade.php` through `login-05.blade.php`
   - `resources/views/pages/auth/signup-01.blade.php` through `signup-05.blade.php`
2. **Make every variant 100% functional out of the box:**
   - Wire all 5 login views to `POST {{ route('login') }}` with `@csrf`, `name="email"`, `name="password"`, `name="remember"`, `:value="old('email')"`, `<x-ui.field-error>`, session status alert (`session('status')`), and named route links (`password.request`, `register`, `home`).
   - Wire all 5 signup views to `POST {{ route('register') }}` with `@csrf`, `name="name"`, `name="email"`, `name="password"`, `name="password_confirmation"`, `:value="old(...)"`, `<x-ui.field-error>`, and named route links (`login`, `home`).
3. **Switch variants directly via `view()` call (no extra config file):**
   - `AuthenticatedSessionController::create()` renders `view('pages.auth.login-01')` by default (and `RegisteredUserController::create()` renders `view('pages.auth.signup-01')`), allowing project creators to switch styles by changing a single `view(...)` argument.

## Alternatives Considered

### Custom-Designed Single Login & Register View
- **Pros:** Only one file per route to maintain.
- **Cons:** Forces a single layout opinion on every downstream project and ignores BlatUI's official `login-01`..`05` and `signup-01`..`05` blocks.
- **Rejected:** Providing all 5 official BlatUI variants pre-wired with Laravel auth gives starter-kit users much higher leverage.

### Dedicated Config File (`config/starter.php`) for Auth Theme Switching
- **Pros:** Allows switching via `.env`.
- **Cons:** Adds unnecessary configuration surface area for a decision a developer makes once when starting a project.
- **Rejected:** Changing `view('pages.auth.login-01')` in the controller is simpler, explicit, and idiomatic Laravel.

## Consequences
- All 10 official BlatUI login/signup variants are pre-installed and functionally wired in `resources/views/pages/auth/`.
- Feature tests verify both the default auth routes and each variant's view rendering and form contract.
