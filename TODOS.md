# TODOS

## Website Config (school-sass + demo-school)

### Existing-data migration tooling

**What:** A script/command to import demo-school's live content (notices, gallery, menu, etc.) into the new `web_*` tables for any school already live on demo-school today, so cutover doesn't lose their existing public-site content.

**Why:** Without it, a currently-live school loses all its public-site content the moment it's cut over to the new school-sass-backed Website Config panel.

**Context:** Only matters for schools already live on demo-school pre-migration — new schools onboarding fresh have nothing to import. Depends on schema recovery (see design doc's "The Assignment") being done first, since the source tables' exact structure isn't known yet. Design doc: `~/.gstack/projects/demo-school/u-unknown-design-20260706-110046.md`.

**Effort:** M
**Priority:** P2
**Depends on:** Schema recovery (SHOW CREATE TABLE on the 8 underlying demo-school tables)

### Automated new-school provisioning

**What:** A command/script that spins up a new demo-school instance (domain, `.env`, `website_api` user + Sanctum token) automatically when a school signs up in school-sass, instead of a manual deploy each time.

**Why:** The chosen deployment topology (one demo-school instance per school) means every new school onboarding is currently a manual ops step. Flagged by an outside-voice review pass as the real ongoing operational cost of that architecture choice.

**Context:** Not needed for the first school or two, but will matter once onboarding volume grows — the manual step doesn't scale with school count. Design doc: `~/.gstack/projects/demo-school/u-unknown-design-20260706-110046.md`, Engineering Decision #1.

**Effort:** L
**Priority:** P3
**Depends on:** Deployment topology decision (already locked — Engineering Decision #1)

### Wire up AdminPermission/AdminRole for fine-grained Website Config permissions

**What:** Finish the currently-unwired role/permission scaffold in school-sass (`AdminPermission`/`AdminRole` models exist; `RoleController` only persists the role name today, doesn't enforce anything) so sub-admins can be restricted to specific Website Config modules (e.g. only Notice, not Menu).

**Why:** v1 ships with coarse `admin`-guard gating — any admin user can touch any of the 7 modules. Fine for a small school's single admin, limiting once a school has multiple staff with different responsibilities.

**Context:** The scaffold already exists in school-sass (`app/Models/AdminPermission.php`, `app/Models/AdminRole.php`) but sidebar rendering and role CRUD don't consult it at all today — this is a from-scratch wiring job, not a small tweak. Independent of the 7-module build; can be picked up anytime. Design doc: `~/.gstack/projects/demo-school/u-unknown-design-20260706-110046.md`.

**Effort:** L
**Priority:** P3
**Depends on:** None

## Bugs (found incidentally, not caused by Website Config work)

### `php artisan route:list` crashes on undefined `HolidayController` reference

**What:** Running `php artisan route:list` in school-sass throws `ReflectionException: Class "HolidayController" does not exist` — some existing route references `HolidayController` without its full namespace (or the class was never created/imported).

**Why:** Breaks `route:list` entirely (can't inspect routes at all until fixed), which will keep blocking route debugging for any future work, not just Website Config.

**Context:** Found while verifying the new Website Config API routes registered correctly (2026-07-06) — pre-existing, unrelated to this work. Needs someone to grep `routes/*.php` for `HolidayController` and either add the missing `use` import or fix/remove the dangling route.

**Effort:** S
**Priority:** P2
**Depends on:** None
