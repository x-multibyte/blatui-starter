# Implementation Plan: BlatUI Starter Boundaries, CI/CD, and Functional Multi-Variant Auth UI

## Overview

We are hardening `x-multibyte/blatui-starter` (`v0.0.2`) across three capability modules defined in [`SPEC.md`](../SPEC.md):
1. **`ci-cd`**: Standard Laravel GitHub Actions CI workflows enforcing Laravel Pint formatting (`composer run lint:check`), Vite production build (`npm run build`), and the Pest 5 test suite (`php artisan test`).
2. **`auth-ui`**: Fetching the 5 official BlatUI login blocks (`login-01`..`login-05`) and 5 signup blocks (`signup-01`..`signup-05`) via BlatUI's registry (`RegistryClient`), saving them under `resources/views/pages/auth/`, converting them from static demo markup into fully functional Laravel authentication views (`POST` actions, `@csrf`, input `name` attributes, `old()` state, `<x-ui.field-error>`, session status alerts, named route links), wiring `AuthenticatedSessionController` and `RegisteredUserController` to switch styles via `view('pages.auth.login-01')` / `view('pages.auth.signup-01')`, and ensuring existing auth pages (`forgot-password`, `reset-password`, `verify-email`, `confirm-password`) match the same high-craft BlatUI conventions.
3. **`foundation-docs`**: Codifying the project's Spec/ADR/Plan + BlatUI MCP autonomous discovery workflow into `AGENTS.md` and updating `README.md` with complete documentation of the multi-variant auth pages, commands, architecture, and ADR links.

## Architecture Decisions

- **[ADR-001: Pre-bundle All BlatUI Components with Locked Dependencies and Manual Upstream Review](../docs/decisions/ADR-001-prebundle-and-lock-blatui-components.md)** — Keep all 180+ `<x-ui.*>` components and peer dependencies locked; never run unattended upstream overwrite scripts.
- **[ADR-002: Standard Laravel GitHub Actions CI with Pint and Pest](../docs/decisions/ADR-002-ci-cd-and-quality-gates.md)** — Enforce `composer run lint:check`, `npm ci && npm run build`, and `php artisan test` in GitHub Actions.
- **[ADR-003: Multi-Variant Functional Auth Pages from BlatUI Registry Blocks](../docs/decisions/ADR-003-multi-variant-auth-pages-via-blatui-blocks.md)** — Store functional `login-01`..`05` and `signup-01`..`05` views in `resources/views/pages/auth/` and switch variants centrally via `config/blatui.php` (`pages.auth.*`).

## Execution & Verification Model

- **Source-Driven Development (`source-driven-development`):**
  - Detected stack: PHP `^8.4` (8.5 runtime), `laravel/framework` `^13.36`, `anousss007/blatui` `^1.4`, `livewire/livewire` `^4.4`, `livewire/blaze` `^1.0`, `pestphp/pest` `^5.3`, `tailwindcss` `^4.0.0`, `alpinejs` `^3.15.12`.
  - Every auth page variant (`login-01`..`05`, `signup-01`..`05`) is pulled verbatim from the official BlatUI registry (`https://blatui.remix-it.com/r/blocks/<name>.json`) via `BlatUI\Mcp\RegistryClient`, preserving official `<x-ui.*>` composition and citing the upstream block URL in a Blade comment header.
- **Subagent Orchestration (Gemini Flash 3.8 — `Model: "flash"`):**
  - The main agent acts as orchestrator and verifier, dispatching tasks in focused batches to `self` subagents running on `Model: "flash"` (Gemini Flash 3.8) and verifying every batch with `php artisan test --compact`, `vendor/bin/pint --dirty --format agent`, and `npm run build` before advancing.
- **Testing Strategy (`laravel-best-practices` & `testing-best-practices`):**
  - Preserve all existing Feature tests in `tests/Feature/Auth/*`.
  - Test observable HTTP behavior (status, redirects, `assertAuthenticated`, `assertGuest`, `assertSessionHasErrors`) and use **Pest datasets** (`->with(['login-01', ...])` and `->with(['signup-01', ...])`) to verify that all 10 official variants in `resources/views/pages/auth/` render cleanly and expose the required Laravel form actions (`route('login')`, `route('register')`), input `name` attributes, and validation error rendering.
  - Run one-shot verification with `vendor/bin/pest --agent='...'` after each UI batch.

## Dependency Graph

```text
SPEC.md + docs/decisions/ADR-001..003 (Done)
    │
    ├── Task 1: Standard Laravel GitHub Actions CI (.github/workflows/ci.yml)
    │
    ├── Task 2: Functional Login Variants 01–03 (resources/views/pages/auth/login-01..03.blade.php)
    │       │
    │       └── Task 3: Functional Login Variants 04–05 + Controller & Feature Tests
    │
    ├── Task 4: Functional Signup Variants 01–03 (resources/views/pages/auth/signup-01..03.blade.php)
    │       │
    │       └── Task 5: Functional Signup Variants 04–05 + Controller & Feature Tests
    │
    └── Task 6: Align Remaining Auth Views (forgot/reset/verify/confirm)
            │
            └── Task 7: Codify Agent Workflow in AGENTS.md & Overhaul README.md
```

## Task List

Detailed task specifications and acceptance criteria are tracked in [`tasks/todo.md`](./todo.md):

### Phase 1: CI/CD & Quality Gates
- [x] Task 1: Add Standard Laravel GitHub Actions CI Workflow (`.github/workflows/ci.yml`)

### Checkpoint 1: CI & Baseline Verification
- [x] `composer run lint:check`, `npm run build`, and `php artisan test --compact` pass locally

### Phase 2: Functional BlatUI Login & Signup Page Variants (`resources/views/pages/auth/`)
- [x] Task 2: Create Functional Login Page Variants `login-01` to `login-03` from BlatUI Registry
- [x] Task 3: Create Functional Login Page Variants `login-04` to `login-05`, Wire `AuthenticatedSessionController`, and Add Variant Tests
- [x] Task 4: Create Functional Signup Page Variants `signup-01` to `signup-03` from BlatUI Registry
- [x] Task 5: Create Functional Signup Page Variants `signup-04` to `signup-05`, Wire `RegisteredUserController`, and Add Variant Tests
- [x] Task 6: Align Existing Secondary Auth Views (`forgot-password`, `reset-password`, `verify-email`, `confirm-password`) with `pages/auth/`

### Checkpoint 2: Auth UI & Feature Tests Complete
- [x] All 10 variants (`login-01`..`05`, `signup-01`..`05`) and secondary auth pages render cleanly and pass `php artisan test --compact tests/Feature/Auth`

### Phase 3: Agent Workflow Codification & Documentation (`foundation-docs`)
- [x] Task 7: Codify Project Workflow & BlatUI MCP Rules in `AGENTS.md` and Update `README.md`

### Checkpoint 3: Final Verification
- [x] All acceptance criteria in `SPEC.md` met, `composer run test` and `npm run build` pass cleanly

## Risks and Mitigations

| Risk | Impact | Mitigation |
|------|--------|------------|
| Upstream BlatUI `login-01`..`05` / `signup-01`..`05` blocks lack `name`, `@csrf`, `method="POST"`, or validation error bindings | High | Explicitly wire every form field (`email`, `password`, `password_confirmation`, `name`, `remember`), `@csrf`, `old()`, `<x-ui.field-error>`, and named route links (`route('login')`, `route('register')`, `route('password.request')`) and verify with Pest feature tests across all variants. |
| Signup blocks in BlatUI may use a single `name` field or different field labels compared to `RegisteredUserController` validation rules (`name`, `email`, `password`, `password_confirmation`) | Medium | Align every `signup-01`..`05` form's input `name` attributes with `RegisteredUserController::store()` expectations so switching `view('pages.auth.signup-XX')` works without controller changes. |
| Future agent sessions forget where ADRs, specs, or BlatUI blocks live | Medium | Document the exact directory conventions (`SPEC.md`, `docs/decisions/`, `tasks/plan.md`, `tasks/todo.md`, `resources/views/pages/auth/`) and `BlatUI\Mcp\RegistryClient` lookup workflow in `AGENTS.md`. |

## Open Questions

- None — all scope, directory structure (`resources/views/pages/auth/`), and variant-switching decisions (`config/blatui.php` `pages.auth.*`) have been confirmed.
