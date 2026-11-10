# ADR-001: Pre-bundle All BlatUI Components with Locked Dependencies and Manual Upstream Review

## Status
Accepted

## Date
2026-11-10

## Context
BlatUI provides 180+ shadcn/ui-inspired Blade and Alpine.js components (`<x-ui.*>`) and layout blocks (`<x-block.*>`). In a standard Laravel project, installing BlatUI and adding components incrementally requires resolving peer Composer packages (`gehrisandro/tailwind-merge-laravel`, `mallardduck/blade-lucide-icons`, `livewire/blaze`), NPM packages (`@alpinejs/anchor`, `@alpinejs/collapse`, `@alpinejs/focus`, `@floating-ui/dom`, `apexcharts`), Tailwind CSS v4 tokens, and Livewire bridge scripts.

At the same time, because BlatUI components live directly inside the application repository (`resources/views/components/ui/`), unattended automated syncing with upstream `anousss007/blatui` risks introducing silent breaking changes to component props, styling tokens, or Livewire bindings.

## Decision
1. **Pre-bundle the complete BlatUI component and block set** in `resources/views/components/ui/` and `resources/views/components/block/` along with all required Composer and NPM peer dependencies pre-wired in `composer.json`, `package.json`, `resources/css/blatui.css`, and `resources/js/blatui.js`.
2. **Lock versions to known-good, human-verified releases** in `composer.lock` and `package-lock.json`.
3. **Require manual human review for any upstream BlatUI or core dependency updates.** We explicitly reject automated upstream component overwrite scripts or auto-merge bots.
4. **Verify shared runtime foundations rather than unit-testing every component.** Tests focus on core application flows (Auth, Profile, route rendering, Livewire/Blaze integration, and Vite asset compilation) rather than maintaining 180+ isolated component tests.

## Alternatives Considered

### Install Components On-Demand Only (Minimal Starter)
- **Pros:** Smaller initial file count in `resources/views/components/ui/`.
- **Cons:** Developers starting a new project still have to run `php artisan blatui:add ...` and install missing peer NPM/Composer dependencies as they build pages.
- **Rejected:** Defeats the core value proposition of `blatui-starter` ("one command to create a project where every BlatUI component is immediately ready to use").

### Automated Upstream Sync Bot (Scheduled `blatui:add --force` PRs)
- **Pros:** Tracks upstream BlatUI changes automatically.
- **Cons:** High risk of unintended visual regressions or broken Blade/Livewire contracts without human context.
- **Rejected:** Upstream changes must be inspected and curated manually by the maintainer before updating the locked baseline.

## Consequences
- New projects created via `laravel new --using=x-multibyte/blatui-starter` or `composer create-project` have immediate access to every `<x-ui.*>` and `<x-block.*>` component with zero dependency setup.
- Maintainers and AI agents treat `resources/views/components/ui/` and dependency lockfiles as stable, protected boundaries that only change through deliberate, human-reviewed updates.
