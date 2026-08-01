# 🎭 Theatrum Admin

WordPress **admin-customization plugin** for Chance Theater. Reshapes the wp-admin sidebar, adds pattern/template management screens, a cross-post-type tag view, and a Screen-Reader-Only block toggle. Mostly server-side PHP, with a small Vite/TypeScript editor layer.

> 📸 **Snapshot:** This README documents the plugin as of **2026-06-30**, captured prior to a round of large changes. It reflects current code, not historical intent.

**Quick facts**

| | |
|---|---|
| Type | Site-specific must-have plugin (git submodule) |
| Stack | PHP · Vite 8 · TypeScript · SCSS · `@wordpress/*` editor packages |
| Loads | `submenus` · `patterns-admin` · `design-system` · `sr-only-blocks` · `position-controls` |
| Version | `1.0.0` (plugin header + `package.json` agree ✅) |
| Text Domain | `chance-theater` (declared; no `/languages` loaded) |

🔗 [Parent project CLAUDE.md](../../../CLAUDE.md) · [Theme README](../../themes/chance-ollie/README.md) · [SR-Only feature doc](SR-ONLY-FEATURE.md)

---

## Architecture

A thin loader (`theatrum-admin.php`) defines `THEATRUM_ADMIN_DIR` and `require_once`s the active modules in `inc/`, then enqueues the SR-Only editor bundle. Everything is hook-driven; no classes.

### Directory map

```
theatrum-admin/
├── theatrum-admin.php          # loader + SR-Only asset enqueues
├── inc/
│   ├── submenus.php            # ✅ admin menu reorder, Tags view, tagged-posts page
│   ├── patterns-admin.php      # ✅ wp_block tag support, usage count, list columns
│   ├── design-system.php       # ✅ Templates / Patterns / Parts admin pages
│   ├── sr-only-blocks.php      # ✅ srOnly attribute + render_block class injection
│   └── position-controls.php   # ✅ positionType/Top/Right/Bottom/Left attrs + render_block style injection
├── src/
│   ├── index.ts                # bundles SCSS
│   ├── sr-only-blocks.tsx      # editor toggle + outline badge (editor build)
│   ├── position-controls.tsx   # Position panel (Static/Relative/Absolute/Fixed/Sticky + UnitControl offsets)
│   └── scss/                   # sr-only.scss, svg-media-library.scss
├── dist/                       # build output (gitignored) — currently only index.js
├── vite.config.js              # builds src/index.ts → dist/index.js (IIFE, self-injects CSS)
├── vite.config.editor.js       # builds src/sr-only-blocks.tsx → dist/sr-only-blocks.js
└── vite.config.position.js     # builds src/position-controls.tsx → dist/position-controls.js
```

> ⚠️ The build/enqueue wiring is **out of sync** — see [Next Steps #1](#-high). The dependable, working surface of this plugin is the PHP in `submenus.php`, `patterns-admin.php`, and `design-system.php`.

---

## What it does

### 🗂️ Admin menu reshaping — `submenus.php`
- Renames **Posts → Blog**; reorders top-level menu to **Media · Pages · Blog**.
- Promotes **Comments**, **Tags**, and **Themes** (moved out of Appearance into Settings) to deliberate positions.
- Inserts visual **separators** into Blog and CPT submenus.
- **Productions:** renames "All Productions" → **Chance Productions**, orders Series before Season, adds a **Visiting Companies** submenu, and filters the main list to *exclude* the `visiting-companies` series.
- Hides the **Tags** submenu on CPTs and adds a global **Tagged Posts** screen that lists every public post type sharing a tag (the tag-count column links to it).

### 🧩 Pattern management — `patterns-admin.php` + `design-system.php`
- Registers **`post_tag`** on `wp_block` so synced patterns can be tagged.
- `ct_count_pattern_usage()` — accurate **"Used In"** count via a prepared `LIKE` on the `"ref":ID` block comment, with a hidden detail page listing every location.
- Adds **Category / Tags / Used In** columns to the native `wp_block` list and makes it filterable by `?wp_pattern_category=`.
- Appearance pages for **Templates**, **Parts**, and a read-only **Grouped Pattern Overview** (synced/unsynced → category), each merging theme files with DB records.

### ♿ Screen-Reader-Only blocks — `sr-only-blocks.php` + `sr-only-blocks.tsx`
- Adds a **"Screen Reader Only"** toggle (Accessibility panel) to `core/heading` and `core/paragraph`, plus an **SR-ONLY** badge on the block outline.
- Registers the `srOnly` attribute via `register_block_type_args` and injects the `.sr-only` class at `render_block`. Full notes: [SR-ONLY-FEATURE.md](SR-ONLY-FEATURE.md).

### 📐 Position controls — `position-controls.php` + `position-controls.tsx`
- Adds a **"Position"** panel to `chance/cover-card` and `chance/chance-card` with a **Static / Relative / Absolute / Fixed / Sticky** select, plus four `UnitControl` offset inputs (**Top, Right, Bottom, Left**) laid out in a 2×2 grid once a non-static type is chosen.
- Replaces core's native `supports.position` (which only offered Sticky/Fixed and a single Top offset — removed from both blocks' `block.json`). Registers `positionType`/`positionTop`/`positionRight`/`positionBottom`/`positionLeft` attributes via `register_block_type_args`, previews live in the editor canvas via an `editor.BlockListBlock` wrapper-style filter, and injects the computed `position`/offset CSS into the wrapper's `style` attribute at `render_block` (offset values are validated against a CSS-length pattern before being written out).

CPTs this plugin touches (defined in the [theme](../../themes/chance-ollie/README.md)): 🎬 `production` · 🎟️ `event` · 👤 `artist` · 🎓 `class` · 🏛️ `venue` · 💛 `supporter` · 📄 `page`.

---

## Build & Development

```bash
npm install
npm run build        # vite build (index.js) + vite.config.editor.js (sr-only-blocks.js) + vite.config.position.js (position-controls.js)
npm run build:watch  # watch index build only
npm run deploy       # same as build
```

`dist/` is **gitignored** — assets must be rebuilt in each environment. `npm run build` runs **all three** configs; a partial build (only the first) leaves the SR-Only and/or Position features without their scripts. See Next Steps #1.

---

## Code Review — Current State

Reviewed broadly for correctness, WP standards, security, performance, and architecture. **The PHP layer is in good shape:**

✅ Pattern usage count is `$wpdb->prepare`'d with `esc_like`, and matches `"ref":ID}` / `"ref":ID,` to avoid false positives (5 vs 50) · ✅ consistent output escaping (`esc_url` / `esc_html` / `(int)`) across all admin tables · ✅ `$_GET` inputs sanitized (`sanitize_text_field`, `(int)`) · ✅ `ABSPATH` guards · ✅ admin screens capability-gated via `add_submenu_page` · ✅ native `wp_block` list reused (keeps Quick/Bulk Edit) instead of a custom table.

The remaining issues are concentrated in the **JS/build layer**, which has drifted from the PHP that loads it.

---

## Next Steps — by severity

> Most of these are intended to be fixed before archiving.

### 🔴 High
1. **`dist/` currently holds only `index.js`** — the editor build (`sr-only-blocks.js`) is absent, so the SR-Only **editor toggle + badge don't render** and the `srOnly` attribute can't be authored. Run the **full** `npm run build` (both configs) in every environment before relying on it. *(Note: srOnly content that's already set still hides correctly on the frontend — the theme defines `.sr-only` in `dist/main.css`, so this is not an accessibility regression, only an authoring breakage.)*
2. **Build output ↔ enqueue mismatch across the JS/CSS layer.** Two loose wires:
   - `theatrum-admin.php` enqueues `dist/sr-only-blocks.css`, but **no build step emits it** — the SCSS is self-injected by `index.js` instead. Only impact today is the editor-only SR-ONLY **badge** cosmetics (the frontend `.sr-only` rule comes from the theme).
   - `dist/index.js` **is built but never enqueued** by any PHP.
   → Decide one strategy: emit named files per feature, *or* enqueue `index.js` + its CSS. Then make the PHP paths match the build outputs.

### 🟠 Medium
3. **Fragile hardcoded menu positions.** `submenus.php` swaps menu slots by literal index (`5/10/20/30/31/32/58`). Another plugin adding menu items can collide. → Look items up by slug instead of assuming positions.

### 🟡 Low
4. **`date()` instead of `wp_date()`/`gmdate()`** for the "Created" column in `design-system.php` — timezone-naive. → Use `wp_date()`.
5. **i18n incomplete.** Text Domain `chance-theater` is declared and strings use `__()`, but there's no `load_plugin_textdomain()` and no `/languages`. → Wire it up or drop the domain noise.
6. **Anonymous closures** on `admin_menu` / `pre_get_posts` / `admin_head` can't be unhooked or unit-tested. → Prefer named functions if this grows.
7. **Inline `<style>` echoed in `admin_head`** (submenu separator). → Minor; could move to an enqueued stylesheet.

---

## Technical Debt

- 🔌 **Two pattern surfaces coexist by design.** `design-system.php`'s grouped overview is intentionally archived to a hidden page (`admin.php?page=chance-patterns`) in favor of the native list; the file name `design-system.php` actually renders Templates/Patterns/Parts, which is misleading. → Consider renaming to `appearance-pages.php`.
- 🧱 **`index.js` self-injects CSS via JS** rather than shipping a stylesheet, and isn't enqueued anyway — so the **SVG media-library icon** style (`svg-media-library.scss`) never loads. (Frontend `.sr-only` is unaffected; it ships from the theme's `main.css`.)
- 🧪 **No tests or linting** in the build.
- 🗒️ **Docs were scratch notes.** This README replaces the previous "Functions to add" list (now captured under Backlog) and sits alongside `SR-ONLY-FEATURE.md`.

---

## Backlog

Per-block custom CSS UX (reset button, list-view indicators, popup editor with syntax highlighting) was previously planned here but depended on the `block-custom-css` feature, which was removed — WordPress 7 now provides this natively.

---

## Dependencies

- **WordPress** 6.x · **PHP** 7.4+ (`str_ends_with` → 8.0+ recommended)
- Editor packages: `@wordpress/block-editor`, `components`, `data`, `element`, `hooks`
- Build: **Vite 8**, **sass**, **TypeScript 5**
- Companion: [`chance-ollie` theme](../../themes/chance-ollie/README.md) (defines the CPTs/taxonomies this plugin reshapes)

## Resources

- [Block Filters (`editor.BlockEdit`, `BlockListBlock`)](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/)
- [`register_block_type_args`](https://developer.wordpress.org/reference/hooks/register_block_type_args/)
- [Admin Menu reference](https://developer.wordpress.org/reference/functions/add_submenu_page/)
- [Synced Patterns (`wp_block`)](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/)
