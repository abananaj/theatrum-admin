# theatrum-admin — Admin & Editor Customization

> First draft. Component deep-dive; project-level story lives in the [root case study](../../../CASE_STUDY.md).

The smallest plugin by commit count, and the one the client touches most —
it shapes what the editing experience actually feels like.

---

## Goal

- Make the block editor usable for people who edit theater content, not people who build websites.
- Add the controls WordPress doesn't ship (per-block custom CSS, position controls, semantic heading groups, screen-reader-only blocks).
- Cut the admin surface down to what staff need — fewer menus, fewer ways to break something.

---

## Timeline

40 commits, 2026-05-11 → 2026-08-31.

- **May–Jun** — Init; theme admin pages customized; source structure and build config reorganized; the `.sr-only` feature (iframe CSS warning + ES module fix).
- **Jul** — Pattern query fix and pattern-view enhancements; Media Library Assistant customizations; positioning controls.
- **Aug** — Script refactor; per-block custom CSS; copy-caption; icon fixes; the standards pass (text domain, docblocks, ABSPATH guards, escaping, `.sr-only` unified with the theme's rule).

---

## Structure

`inc/` — PHP, one concern per file

- `design-system.php` — the shared admin design language
- `submenus.php` — admin menu restructuring
- `patterns-admin.php` — pattern browsing and management
- `media-library-assistant.php` — MLA integration
- `block-custom-css.php` · `block-row-customization.php` · `position-controls.php`
- `sr-only-blocks.php` — mark any block screen-reader-only
- `copy-caption.php` · `disable-links-editor.php` · `manual.php`

`src/` — TypeScript/React editor extensions

- `copy-caption.tsx` · `custom-formats.tsx` · `hgroup-control.tsx` · `position-controls.tsx` · `sr-only-blocks.tsx` · `list-view-css-indicator.ts`

Seven separate Vite configs — each editor extension builds and loads independently rather than
shipping as one bundle.

---

## Highlights

**Per-block custom CSS**

- Editors can style a single block without a developer, without touching a stylesheet, and without a plugin that dumps CSS into the page.

**Accessibility as an editor control**

- `.sr-only` on any block, from the inspector. Unified with the theme's rule during the audit so there's exactly one definition sitewide.
- `hgroup-control` gives editors semantic heading groups instead of a visually-styled fake.

**List-view CSS indicator**

- Small thing, real payoff: the block list view shows which blocks carry custom CSS, so "why does this look different" is answerable at a glance.

**Media Library Assistant integration**

- Thirteen years of media needs real taxonomy and search. MLA provides it; this plugin makes it fit the rest of the admin.

---

## Results

> **TODO:**
> - Which customizations the client uses daily vs. never
> - Before/after screenshots of the admin menu and editor sidebar
> - Any training/onboarding notes worth citing
