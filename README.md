# 🎭 Theatrum Admin

WordPress **admin-customization plugin** for Chance Theater. Reshapes the wp-admin sidebar, adds pattern/template management screens, a cross-post-type tag view, and a Screen-Reader-Only block toggle. Mostly server-side PHP, with a small Vite/TypeScript editor layer.

> 📸 **Snapshot:** This README documents the plugin as of **2026-06-30**, captured prior to a round of large changes. It reflects current code, not historical intent.

**Quick facts**

| | |
|---|---|
| Type | Site-specific must-have plugin (git submodule) |
| Stack | PHP · Vite 8 · TypeScript · SCSS · `@wordpress/*` editor packages |
| Loads | `submenus` · `block-row-customization` · `patterns-admin` · `design-system` · `sr-only-blocks` |
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
│   ├── block-row-customization.php  # ⚠️ enqueues a file the build never emits (dead)
│   ├── block-custom-css.php    # ⚠️ NOT loaded (require commented out); incomplete
│   └── disable-links-editor.php # ⚠️ empty file, not loaded
├── src/
│   ├── index.ts                # bundles row-customization + custom-css + SCSS
│   ├── sr-only-blocks.tsx      # editor toggle + outline badge (editor build)
│   ├── ts/                     # block-row-customization.ts (no-op), block-custom-css.ts (stub)
│   └── scss/                   # sr-only.scss, svg-media-library.scss
├── dist/                       # build output (gitignored) — currently only index.js
├── vite.config.js              # builds src/index.ts → dist/index.js (IIFE, self-injects CSS)
└── vite.config.editor.js       # builds src/sr-only-blocks.tsx → dist/sr-only-blocks.js
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

CPTs this plugin touches (defined in the [theme](../../themes/chance-ollie/README.md)): 🎬 `production` · 🎟️ `event` · 👤 `artist` · 🎓 `class` · 🏛️ `venue` · 💛 `supporter` · 📄 `page`.

---

## Build & Development

```bash
npm install
npm run build        # vite build (index.js) + vite build --config vite.config.editor.js (sr-only-blocks.js)
npm run build:watch  # watch index build only
npm run deploy       # same as build
```

`dist/` is **gitignored** — assets must be rebuilt in each environment. `npm run build` runs **both** configs; a partial build (only the first) leaves the SR-Only feature without its script. See Next Steps #1.

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
2. **Build output ↔ enqueue mismatch across the JS/CSS layer.** Three loose wires:
   - `theatrum-admin.php` enqueues `dist/sr-only-blocks.css`, but **no build step emits it** — the SCSS is self-injected by `index.js` instead. Only impact today is the editor-only SR-ONLY **badge** cosmetics (the frontend `.sr-only` rule comes from the theme).
   - `block-row-customization.php` enqueues `dist/block-row-customization.js`, which **is never built** (it's bundled into `index.js`). `file_exists()` fails silently → feature never loads.
   - `dist/index.js` **is built but never enqueued** by any PHP.
   → Decide one strategy: emit named files per feature, *or* enqueue `index.js` + its CSS. Then make the PHP paths match the build outputs.

### 🟠 Medium
3. **`block-row-customization` is a complete no-op.** The JS filter body is empty (comments only) and the PHP enqueues a missing file. → Implement the `p` tagName option properly, or remove the module and its `require`.
4. **`block-custom-css.php` is unfinished and unloaded.** Its `require` is commented out, the TS (`block-custom-css.ts`) is a `console.log` stub, and the PHP would sanitize CSS with `wp_kses_post()` (an HTML sanitizer, wrong for CSS). → Finish it (see Backlog) or delete it to stop the confusion.
5. **Dead files.** `inc/disable-links-editor.php` is empty and never required. → Delete.
6. **Fragile hardcoded menu positions.** `submenus.php` swaps menu slots by literal index (`5/10/20/30/31/32/58`). Another plugin adding menu items can collide. → Look items up by slug instead of assuming positions.

### 🟡 Low
7. **`date()` instead of `wp_date()`/`gmdate()`** for the "Created" column in `design-system.php` — timezone-naive. → Use `wp_date()`.
8. **i18n incomplete.** Text Domain `chance-theater` is declared and strings use `__()`, but there's no `load_plugin_textdomain()` and no `/languages`. → Wire it up or drop the domain noise.
9. **Anonymous closures** on `admin_menu` / `pre_get_posts` / `admin_head` can't be unhooked or unit-tested. → Prefer named functions if this grows.
10. **Inline `<style>` echoed in `admin_head`** (submenu separator). → Minor; could move to an enqueued stylesheet.

---

## Technical Debt

- 🔌 **Two pattern surfaces coexist by design.** `design-system.php`'s grouped overview is intentionally archived to a hidden page (`admin.php?page=chance-patterns`) in favor of the native list; the file name `design-system.php` actually renders Templates/Patterns/Parts, which is misleading. → Consider renaming to `appearance-pages.php`.
- 🧱 **`index.js` self-injects CSS via JS** rather than shipping a stylesheet, and isn't enqueued anyway — so the **SVG media-library icon** style (`svg-media-library.scss`) never loads. (Frontend `.sr-only` is unaffected; it ships from the theme's `main.css`.)
- 🧪 **No tests or linting** in the build.
- 🗒️ **Docs were scratch notes.** This README replaces the previous "Functions to add" list (now captured under Backlog) and sits alongside `SR-ONLY-FEATURE.md`.

---

## Backlog — planned editor features

Carried over from the prior README notes (Custom-CSS-per-block UX):

1. **Reset all custom styles** button in the block inspector — clears inline custom CSS for the block instance without removing user-added utility classes.
2. **List-view tooltip** showing a block's custom CSS classes on hover.
3. **List-view indicator** marking blocks that have custom CSS.
4. **Custom CSS popup editor** with syntax highlighting (replacing the plain textarea).

> These depend on first resolving the `block-custom-css` feature (Next Steps #4).

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
