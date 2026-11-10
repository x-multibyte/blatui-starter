# ADR-002: Standard Laravel GitHub Actions CI with Pint and Pest

## Status
Accepted

## Date
2026-11-10

## Context
As `x-multibyte/blatui-starter` matures from `v0.0.2` into a reliable starter template, every change to views, controllers, dependencies, or documentation must keep the starter kit in a clean, immediately usable state. Previously, the repository had no `.github/workflows` CI configuration, meaning code style regressions or broken tests could only be caught manually.

## Decision
Adopt a standard Laravel GitHub Actions CI pipeline (`.github/workflows/`) that runs on pushes and pull requests to the main branch and enforces three mandatory gates:
1. **Code Style Gate (`Laravel Pint`):** Run `composer run lint:check` (`pint --parallel --test`) to guarantee consistent Laravel PHP formatting.
2. **Frontend Build Gate (`Vite`):** Run `npm ci && npm run build` to verify that Tailwind CSS v4 tokens (`blatui.css`) and Alpine/BlatUI JavaScript bundles (`app.js`, `blatui.js`, `charts.js`) compile cleanly.
3. **Test Suite Gate (`Pest 5`):** Run `php artisan test` against SQLite to verify authentication, profile management, and core page rendering.

## Alternatives Considered

### No CI / Local-Only Checks
- **Pros:** Zero CI maintenance.
- **Cons:** Easy for formatting drift or broken Vite/Pest builds to slip into the template repository.
- **Rejected:** A starter kit must always be green for downstream users cloning or initializing from it.

### Heavy Browser E2E Matrix on Every Commit
- **Pros:** Catches visual regressions across all browsers automatically.
- **Cons:** Slow CI feedback loop and high maintenance overhead for a starter kit template.
- **Rejected:** Keep CI fast and standard (Pint + Vite build + Pest feature tests); use Playwright/Pest browser checks locally on demand.

## Consequences
- Every commit and PR is automatically checked against Laravel Pint formatting and Pest feature tests.
- Contributors and AI agents can rely on `composer run test` locally to mirror the exact CI quality bar.
