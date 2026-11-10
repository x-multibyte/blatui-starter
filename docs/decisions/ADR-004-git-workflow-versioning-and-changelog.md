# ADR-004: Git Workflow, Semantic Versioning Tags, and Curated Changelog

## Status
Accepted

## Date
2026-11-10

## Context
As `x-multibyte/blatui-starter` is consumed by developers creating new projects via `laravel new --using=x-multibyte/blatui-starter` or `composer create-project`, consumers and maintainers need a predictable release history, clean atomic commits, and a human-readable record of what changed between versions (`v0.0.1`, `v0.0.2`, `v0.0.3`, etc.).

## Decision
Following `git-workflow-and-versioning`, `code-review-and-quality`, and `documentation-and-adrs`:
1. **Atomic Conventional Commits:** Group changes by single logical concern (`feat:`, `fix:`, `ci:`, `docs:`, `test:`, `refactor:`, `chore:`). Never mix unrelated refactors, CI config, and feature work into a single monolithic commit.
2. **Short-Lived Feature Branches & CI-Gated PRs:** Keep `main` always deployable. Develop non-trivial changes on short-lived branches (`feat/<slug>`, `fix/<slug>`, `ci/<slug>`) and verify against `.github/workflows/ci.yml` (Pint + Vite + Pest) before merging.
3. **Semantic Versioning via Git Tags:** Tag every release with an annotated Git tag (`git tag -a vX.Y.Z -m "Release vX.Y.Z"`) as the single source of truth for Packagist and downstream consumers.
4. **Curated `CHANGELOG.md`:** Maintain `CHANGELOG.md` at the repository root grouped by user-visible impact (`Added`, `Changed`, `Fixed`, `Deprecated`, `Removed`, `Security`), updating `[Unreleased]` in the same change set that introduces a feature or fix.

## Alternatives Considered

### Relying Only on Raw `git log`
- **Pros:** Zero manual changelog maintenance.
- **Cons:** Commit logs are written for maintainers at commit granularity, not for downstream users evaluating what changed between starter kit releases.
- **Rejected:** A curated `CHANGELOG.md` gives immediate clarity on each tagged version.

### Monolithic "Update" Commits Directly on `main`
- **Pros:** Faster in the moment.
- **Cons:** Makes `git bisect` and reverting a specific change (e.g., reverting a view change without reverting CI) difficult.
- **Rejected:** Atomic commits by concern keep history clean and reversible.

## Consequences
- Every notable change updates `CHANGELOG.md` before release tagging.
- Commits are atomic and pass `composer run lint:check`, `npm run build`, and `php artisan test --compact` before push.
