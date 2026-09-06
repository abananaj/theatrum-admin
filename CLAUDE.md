# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

**[← Back to wp_root](../../../CLAUDE.md)** | [AGENTS.md](AGENTS.md) | [README.md](README.md)

## Markdown Formatting

Write prose as one line per paragraph — never hard-wrap sentences across multiple lines. Tables, code blocks, and lists are unaffected.

## Project Overview

Theatrum Admin is a site-specific WordPress plugin (git submodule, must-use in spirit but
loaded as a regular plugin) that reshapes wp-admin for Chance Theater: menu reorganization,
pattern/template management screens, a cross-post-type tagged-posts view, a Screen-Reader-Only
block toggle, position controls for two theatrum-blocks blocks, and a few editor RichText
formats. Mostly server-side PHP with a small Vite/TypeScript editor layer.

For the full architecture, feature-by-feature breakdown, and current known issues, see
**[README.md](README.md)** — it's kept in much more detail than this file duplicates.
**[jul5-code-review.md](jul5-code-review.md)** has line-numbered findings from the last
full review; treat it as more current than README's own "Next Steps" list where they overlap.

## Build & Development Commands

```bash
npm install
npm run build        # runs all 6 Vite configs (index, sr-only editor, position, formats, hgroup, list-view-css)
npm run build:watch  # ⚠️ watch mode only rebuilds the DEFAULT config and empties dist/ each run —
                      # do not rely on this alone; it silently strips the other 5 built files
npm run deploy        # identical to build
```

`dist/` is gitignored — every environment must run `npm run build` itself. There is currently
no remote build step in the deploy pipeline (see README Next Steps #4 for why this matters).

## Architecture

A thin loader (`theatrum-admin.php`) `require_once`s each feature module in `inc/`, then
registers every editor script/style enqueue in the same file. Everything is hook-driven; no
classes.

```
theatrum-admin/
├── theatrum-admin.php                # loader + all editor-script/style enqueues
├── inc/
│   ├── submenus.php                  # admin menu reorder, Tags view, tagged-posts page
│   ├── media-library-assistant.php   # media library admin customizations
│   ├── patterns-admin.php            # wp_block tag support, usage count, list columns
│   ├── design-system.php             # Templates / Patterns / Parts admin pages
│   ├── sr-only-blocks.php            # srOnly attribute + render_block class injection
│   └── position-controls.php         # position attrs + render_block style injection
├── src/
│   ├── index.ts                      # bundles SCSS
│   ├── sr-only-blocks.tsx            # editor toggle + outline badge
│   ├── position-controls.tsx         # Position panel (theatrum/cover-card, theatrum/chance-card)
│   ├── custom-formats.tsx            # RichText formats: Inline Quote, Small Text, Span
│   ├── hgroup-control.tsx            # Group block <hgroup> toggle
│   ├── list-view-css-indicator.ts    # List View "CSS" badge for blocks with Additional CSS set
│   └── scss/                         # sr-only.scss, svg-media-library.scss
├── dist/                             # build output (gitignored)
└── vite.config*.js                   # one config per feature — see README's directory map
```

## Known Issues Worth Knowing Before You Touch This Plugin

- **"Themes → Settings" menu move doesn't work.** Implemented twice (`submenus.php` and
  `design-system.php`), both use the wrong menu-parent key. Don't build on top of either
  implementation without fixing the key first — see README Next Steps #3.
- **PHP 8.0 is a hard requirement**, not documented in the plugin header. `str_ends_with()`
  in `design-system.php` fatals on 7.4.
- **Build ↔ enqueue mismatch**: `dist/sr-only-blocks.css` is enqueued but never emitted by
  any Vite config (SCSS is self-injected into JS instead), and `dist/index.js` is built but
  never enqueued by any PHP. Don't assume an enqueue call means the asset exists — check the
  actual Vite config it's supposed to come from.
- **Deploy path for `dist/` is unresolved.** This plugin's `.gitignore` excludes `dist/`, but
  the deploy flow (git push → SSH pull) has no remote build step, so built assets never reach
  the server as root `CLAUDE.md`'s deploy checklist assumes. Confirm which side is being fixed
  before treating either doc as authoritative.

## Related Documentation

- **wp_root docs:** `../../../CLAUDE.md` and `AGENTS.md`
- **Theme (defines the CPTs this plugin reshapes):** `../../themes/chance-ollie/CLAUDE.md`
- **Deployment:** `../../../.deploy/DEV_DEPLOY.md`
- **SR-Only feature detail:** [SR-ONLY-FEATURE.md](SR-ONLY-FEATURE.md)
