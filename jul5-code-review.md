# 🔍 theatrum-admin — Code Review (2026-07-05)

**Scope:** All plugin source (PHP, TS/TSX, SCSS, build configs) **and** documentation (`README.md`, `SR-ONLY-FEATURE.md`, root `CLAUDE.md` deploy sections), cross-checked against:

- The four WordPress developer references linked in the README **Resources** section (Block Filters, `register_block_type_args`, Admin Menu / `add_submenu_page`, Synced Patterns) — fetched and read; the `add_submenu_page` page served only metadata, so its behaviors were verified against the code and core `$submenu` conventions instead.
- The **CT Documentation** Notion page (read in full — all 74.5 KB), which carries the *July 6 goals* ("WP Admin ready for review") and the 2026-07-04 "ai code review / pre-deploy" to-dos this review serves.
- **Empirical verification:** `npm run build` was executed during this review; findings marked ✅ *verified* were observed, not inferred.

**Overall:** The PHP admin layer is solid — the README's own security self-review checks out (prepared `LIKE` queries with `esc_like`, consistent `esc_url`/`esc_html`/`(int)` output escaping, sanitized `$_GET`, capability-gated pages, `ABSPATH` guards). The problems cluster in three places: **the Themes-menu move is dead code (twice)**, **a stray `return` couples unrelated menu features to the production CPT**, and the already-documented **build ↔ enqueue drift**, which is worse than the README states because of editor-iframe style isolation.

---

## 🔴 High

### 1. "Move Themes from Appearance to Settings" is broken — implemented twice, both dead
- `inc/submenus.php:171-191` manipulates `$submenu['themes']` and `$submenu['options-general']`. Core keys are the parent **file names**: `themes.php` and `options-general.php` (compare `inc/patterns-admin.php:26`, which correctly uses `themes.php`). Neither the removal from Appearance nor the insertion into Settings ever matches — Themes stays under Appearance and never appears under Settings. The removal loop also compares `$item[2] === 'themes'`; the core item slug is `themes.php`.
- `inc/design-system.php:66-88` (`chance_add_themes_to_settings`) is a second, competing implementation using parent slug `'options'`, which is not a registered menu parent — the entry lands in `$submenu['options']` and never renders.
- **Impact:** README's "What it does" claims this feature works ("Themes (moved out of Appearance into Settings)"). It doesn't.
- **Fix:** Delete one implementation. In the survivor use `remove_submenu_page('themes.php', 'themes.php')` and `add_submenu_page('options-general.php', …)`, then verify in wp-admin.

### 2. Early `return` aborts half the menu customizations if the production submenu is missing
`inc/submenus.php:111` — `if (!isset($submenu[$key])) return;` exits the **entire** `admin_menu` closure. Everything after it — the top-level **Tags** menu (`:161`), the Themes move (`:171`), and crucially the hidden **Tagged Posts** page registration (`:194`) — silently depends on the `production` CPT's submenu existing. If the theme (which registers the CPT) is inactive or the user lacks the CPT capability, the tag-count links rendered by `manage_post_tag_custom_column` (`:257-267`) point to an unregistered page → *"Sorry, you are not allowed to access this page."*
**Fix:** Wrap only the production-specific blocks in the `isset` check; never `return` from the shared closure.

### 3. Build ↔ enqueue drift — confirmed, and one layer worse than the README says ✅ *verified*
Ran the full `npm run build`; output is exactly `dist/index.js` (1.0 kB) + `dist/sr-only-blocks.js` (2.2 kB). Confirmed:
- **`dist/sr-only-blocks.css` is never emitted by any build.** Vite 8 self-injects the compiled SCSS into each JS bundle via `document.createElement('style')` (observed in both files). The `chance_enqueue_sr_only_styles()` enqueue in `theatrum-admin.php:52-66` is permanently dead code.
- **New finding — editor iframe isolation:** the editor script loads in the *outer* admin frame (`enqueue_block_editor_assets`), so its self-injected styles land in the outer document. The `.wp-block-sr-only-badge` element renders *inside the editor canvas iframe*, which those styles cannot reach. **Even with a complete build, the SR-ONLY badge renders unstyled** (plain text, no blue chip). The dead CSS enqueue on `enqueue_block_assets` was the right idea — it targets the iframe — but the file it points at doesn't exist. Fix: make the editor build emit a real `.css` asset (disable CSS injection / extract CSS) and keep the `enqueue_block_assets` hook, or inject styles into the iframe document from JS.
- `dist/index.js` is built but never enqueued → the SVG media-library icon style (`svg-media-library.scss`) never loads anywhere (README Technical Debt, confirmed).
- `block-row-customization.php:12` enqueues `dist/block-row-customization.js`, which no config emits; `file_exists()` fails silently forever (README #2, confirmed).
- Note: running the build during this review restored `dist/sr-only-blocks.js` locally, so the SR-Only toggle authoring (README High #1) now works **on this machine** — the underlying "partial build leaves it broken" hazard remains for other environments.

### 4. `npm run build:watch` destroys the editor bundle ✅ *config-verified*
`package.json` `build:watch` runs only the default config, and `vite.config.js` sets `emptyOutDir: true`. Every watch rebuild **empties `dist/` and never rebuilds `sr-only-blocks.js`** — dev sessions in watch mode silently strip the SR-Only editor feature until the next full build (very likely how `dist/` ended up holding only `index.js`, the state the README flags as High #1).
**Fix:** `emptyOutDir: false` in watch, or a combined watch script for both configs.

---

## 🟠 Medium

### 5. N+1 unindexed `LIKE` scans on the pattern screens
`ct_count_pattern_usage()` (`inc/patterns-admin.php:145-162`) issues one full-table `LIKE '%…%'` scan of `wp_posts.post_content` **per row** of the native `wp_block` list (`:126`) and again per DB pattern on the grouped overview (`inc/design-system.php:287`). With dozens of patterns that's dozens of unindexable scans per page view. Root `CLAUDE.md` explicitly prescribes `wp_cache_*` for expensive queries; none is used.
**Fix:** cache per pattern (`wp_cache_set`/transient, invalidated on `save_post`), or compute all counts in one query per page load.

### 6. PHP 8.0 is *required*, not "recommended" — and undeclared
`str_ends_with()` (`inc/design-system.php:103,223,551`) fatals on PHP 7.4. The plugin header declares neither `Requires PHP:` nor `Requires at least:`, and the README states "PHP 7.4+ (`str_ends_with` → 8.0+ recommended)", which is wrong — 7.4 white-screens the three Appearance pages.
**Fix:** add `Requires PHP: 8.0` (and `Requires at least: 6.x`) to the plugin header; correct the README.

### 7. `add_submenu_page(null, …)` — deprecated hidden-page pattern
Three call sites: `inc/submenus.php:194`, `inc/patterns-admin.php:34`, `inc/design-system.php:41`. Passing `null` as `$parent_slug` triggers PHP 8.1+ deprecation notices inside core (null fed to string functions) and is discouraged in the developer reference; the supported value for menu-less pages is `''` (empty string).

### 8. Deployment docs contradict the `.gitignore`
Root `CLAUDE.md` says: *"Commit: Stage `dist/` and `build/` changes alongside code"* and the checklist requires *"`dist/` and `build/` folders staged and committed"*. This plugin's `.gitignore` ignores `dist/` entirely, and the README says assets "must be rebuilt in each environment" — but the documented deploy flow is git push → SSH pull with **no remote build step**, so the remote server never receives `dist/`. One of the three documents is lying to the next person who deploys.
**Fix:** either stop gitignoring `dist/` (matching CLAUDE.md), or add an `npm run build` step to `.deploy` remote scripts and fix CLAUDE.md.

### 9. Grouped overview inverts "synced" semantics for theme patterns
`inc/design-system.php:204-233`: theme-file patterns found in `WP_Block_Patterns_Registry` are marked `'synced' => true` and listed under **"Synced Patterns"**. Registered theme patterns are by definition *not* synced — synced patterns are `wp_block` posts (per the Synced Patterns reference). DB-side detection (`wp_pattern_sync_status` empty ⇒ synced, `:253-254`) is correct; the theme-file branch mislabels, inflating the "Synced" count and confusing the page's whole premise. (Page is archived/hidden, so severity is capped — but it's linked from the native list's "Grouped Overview" view.)

### 10. `block-custom-css` can't work as designed (beyond the known `wp_kses_post` issue)
The module is unloaded (require commented out), and the README already flags `wp_kses_post()` as the wrong sanitizer for CSS. Additional design flaw worth recording before the Backlog items build on it: `chance_collect_custom_css_from_blocks()` (`inc/block-custom-css.php:107-147`) generates selectors like `.wp-block-core-paragraph-3` from an in-memory counter — **no such class ever exists in the rendered markup**, so the emitted CSS matches nothing. The `$prefix` parameter is computed but never used, the counter resets per nesting level, and `esc_attr()` is the wrong escaper inside a CSS selector context. `chance_handle_site_editor_custom_css()` (`:154-158`) is an empty function hooked to nothing. The feature needs a `render_block`-injected unique class (or block `id`) to target — redesign before implementing Backlog items 1–4.

### 11. Badge implementation fights the Block Filters guidance
Per the Block Filters reference (README Resources): `editor.BlockListBlock` customizations should merge `wrapperProps` / add a className rather than wrap the block in a new element. `src/sr-only-blocks.tsx:82` wraps `BlockListBlock` in an extra `<div class="wp-block-sr-only-wrapper">`, which inserts a foreign element into the editor's block flow — breaks parent flex/grid/spacing layouts in the canvas and can confuse block-toolbar positioning. Both filters also skip `createHigherOrderComponent` (losing the debug `displayName`). Suggest: `props.wrapperProps.className += ' has-sr-only'` + a CSS `::after` badge.

### 12. Hardcoded menu indices (README #6 — confirmed, plus a collision detail)
`inc/submenus.php` swaps literal slots `5/10/20/30/31/32` and writes `$menu[58]`. Beyond fragility, direct assignment `$menu[31] = …` / `$menu[32] = …` **overwrites** whatever another plugin already placed at those indices. Look items up by slug and insert at computed free positions (e.g., `"32.1"`-style string keys, the standard collision-avoidance trick).

---

## 🟡 Low

13. **`date()` → `wp_date()`** — `inc/design-system.php:108,556` (README #7 confirmed): timezone-naive "Created" column.
14. **i18n inconsistent** (README #8 confirmed, extended): a handful of strings use `__( …, 'chance-theater' )` but most UI text is hardcoded English — all of `submenus.php`'s menu labels and the Tagged Posts page, every table header in `design-system.php`, and all strings in `sr-only-blocks.tsx` (no `@wordpress/i18n`). No `load_plugin_textdomain()`, no `/languages`. Commit to i18n or drop the ceremony.
15. **Null edit-link handling inconsistent:** `inc/patterns-admin.php:217-222` guards against `get_edit_post_link()` returning `null`; `inc/submenus.php:324` does not — users who can't edit a given post get an empty-`href` link on the Tagged Posts page. Also `posts_per_page => -1` is unbounded there.
16. **Loose capabilities:** the Visiting Companies submenu item and the fake separator items use `read` (`inc/submenus.php:54,73,87,144`) — `edit_posts` matches the surrounding items. Comments uses `moderate_comments` (`:59`) where core uses `edit_posts`; fine if intentional (hides it from Authors), worth a comment.
17. **Inline `<style>` in `admin_head` on every admin page** (README #10 confirmed) plus inline `style=""` attributes across the design-system tables — consolidate into one small enqueued admin stylesheet.
18. **Anonymous closures on `admin_menu`/`pre_get_posts`/`admin_head`** (README #9 confirmed) — can't be unhooked or tested.
19. **`inc/disable-links-editor.php` is empty** (README #5) — note the CT Documentation Notion page still lists *"cover card, disable links in block editor"* as an open WP Admin to-do, so this is a planned feature, not pure cruft: either stub it with a TODO header comment or delete until implementation starts.
20. **Pattern-usage back link goes to the archived page:** `inc/patterns-admin.php:183` sends "← Back to Patterns" to `admin.php?page=chance-patterns` (the hidden grouped overview) though the README establishes the native list as the primary surface — and users arrive from the native list. Point it at `edit.php?post_type=wp_block`.
21. **`usort(...strcmp)`** sorts case-sensitively (lowercase titles sink below `Z`) — `strcasecmp` or `natcasesort` reads better in admin tables.
22. **New `position` CPT not covered:** the theme now registers `position` (`inc/post-type/position.php`) — Notion: *"Positions - NEW"* — but `submenus.php` gives it no separator/tag treatment. Decide and update README's CPT list either way.
23. **Plugin header typo:** `Plugin URI: https://chancetheatre.com` (`theatrum-admin.php:5`) — the site is chancetheat**er**.com (per the Notion sitemap link). Header also lacks a `License:` field (package.json says ISC).
24. **package.json:** `deploy` is byte-identical to `build` (README notes); `typescript` is a devDependency but there's **no `tsconfig.json`** and no typecheck script — Vite strips types without checking them, so the `.tsx` annotations are decorative. Add `tsc --noEmit` or drop the pretense.
25. **Redundant double hook:** `theatrum-admin.php:65-66` enqueues the (nonexistent) style on both `enqueue_block_assets` *and* `wp_enqueue_scripts`; `enqueue_block_assets` already fires on the frontend.
26. **Hardcoded theme slug** `chance-ollie` in site-editor URLs (`inc/design-system.php:169,431,494,614`) while the same functions already compute `$theme_slug` — use it.

---

## 📚 Documentation review

### README.md — accurate and unusually honest; three corrections
The README's self-review section held up well under verification: the security claims are all true, dist really did contain only `index.js`, versions really do agree at 1.0.0, and Next Steps #1–#10 are all real. Corrections:
1. **"Themes (moved out of Appearance into Settings)"** listed under working features — broken (High #1). Move to Next Steps 🔴.
2. **"PHP 7.4+ (8.0+ recommended)"** → 8.0 is a hard requirement (Medium #6).
3. Next Steps #1's parenthetical is right that frontend `.sr-only` ships from the theme (✅ verified: `.sr-only` present in `chance-ollie/dist/main.css`) — but add the iframe caveat from High #3: even a full build won't style the editor badge until a real CSS file is emitted.
4. Worth adding: the `build:watch` foot-gun (High #4) is very plausibly the *cause* of the dist state the README describes.

### SR-ONLY-FEATURE.md — stale in four places
- "Files Modified" lists `src/sr-only-blocks.ts` (actual: `.tsx`), `src/sr-only.scss` (actual: `src/scss/sr-only.scss`), and credits `vite.config.js` (actual: `vite.config.editor.js` builds this feature).
- "This generates: … `dist/sr-only-blocks.css`" — **false, verified**: no build config ever emits CSS; it's self-injected into the JS.
- The doc predates the iframe problem; its "Styling" section describes the intended (working) architecture, not the current one.

### Root CLAUDE.md — one contradiction affecting this plugin
"Stage `dist/` and `build/`" vs. this plugin's `.gitignore` (Medium #8). Also its WP-CLI examples (`wp post list --post_type=production`) use the correct unprefixed slugs — the Notion page is the outlier (below).

### Notion — CT Documentation page (read 100%)
- The **July 6 goals** include *"WP Admin ready for review"* and the 2026-07-04 list has *"ai code review"* / *"pre-deploy"* — the High findings above (especially #1, #2, and the deploy-docs contradiction #8) are the blockers to calling WP Admin review-ready.
- **Stale slugs in Notion:** the Taxonomies/Post-types sections link with `post_type=ct-production`, `ct-event`, `ct-artist`, `ct-class`, `ct-venue`, `ct-supporter`, but the theme registers **unprefixed** slugs (`production`, `event`, … — verified in `chance-ollie/inc/post-type/*.php`). Those wp-admin links on the Notion page will 404 against the current site; worth a find/replace pass in Notion.
- Open Notion items that map onto this plugin's backlog: *custom css indicator* (README Backlog #2–3), *disable links in block editor* (`disable-links-editor.php`), *customize sidebar submenu items* (`submenus.php`), *icon sets management* (relates to the never-loaded `svg-media-library.scss`), *dev-mode block-name display via `css[attr]`* (future theatrum-admin module).

### Web resources (README Resources section)
- **Block Filters** reference → grounds findings #11 (wrapperProps, `createHigherOrderComponent`, conditional rendering).
- **`register_block_type_args`** reference → the server-side attribute registration in `sr-only-blocks.php` is a valid use; persistence works because wp-admin bootstraps server block definitions into the client registry, so no client-side `blocks.registerBlockType` filter is strictly required for `srOnly`.
- **`add_submenu_page`** reference → hidden-page and `$parent_slug` conventions ground findings #1 and #7 (the live page served only metadata; conventions verified against core `$submenu` keys and observed code).
- **Synced Patterns** reference → grounds finding #9 (synced = `wp_block` posts; registered theme patterns are not synced).

---

## ✅ What's good (verified, not just re-asserted)

- `ct_count_pattern_usage()` is correctly prepared: `$wpdb->prepare` + `esc_like`, and the `"ref":ID}` / `"ref":ID,` two-pattern match genuinely prevents ID-5-matches-50 false positives.
- Output escaping is consistent across every echo'd admin table (`esc_url`, `esc_html`, `(int)`), and `$_GET` input is sanitized at every read.
- Reusing the native `wp_block` list (keeping Quick/Bulk Edit) instead of a custom table was the right architectural call, and the archived-overview migration is cleanly documented in code comments.
- `patterns-admin.php` is the model file: correct `$submenu['themes.php']` key, null-edit-link guard, `$pagenow` check in `pre_get_posts` — the fixes for #1, #2, #15 can mostly be copied from it.

## Suggested fix order

1. Themes-move repair + de-duplicate (High #1) and un-couple the `return` (High #2) — small, user-visible, pre-deploy.
2. Pick the build strategy (README Next Steps #2) *including* CSS extraction for the iframe (High #3) and fix `build:watch` (High #4).
3. Deploy-docs decision (#8) before the next `git_deploy.sh` run.
4. Cache the usage counts (#5), declare PHP 8.0 (#6), swap `null` parents for `''` (#7).
5. Sweep the Lows alongside the README/SR-ONLY-FEATURE/Notion doc corrections.

---
*Generated 2026-07-05 by Claude Code review session (branch `fable-exp`). Build verification performed locally; `dist/` regenerated as a side effect (gitignored).*
