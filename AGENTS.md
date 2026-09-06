# AGENTS.md

Claude Code agent workflows specific to the **theatrum-admin** plugin. For site-wide agent workflows, see [wp_root AGENTS.md](../../../AGENTS.md). For plugin architecture, see [CLAUDE.md](CLAUDE.md).

## Code Comments

One line, essential info only. No multi-line/wrapped comment blocks, no restating what the code does — if a comment needs more than one line, cut it down or drop it.

## Working in this plugin

This plugin has no automated `CHANGELOG.md` — the root `/changelog` skill derives its entries from `git log` here instead (see `.claude/skills/changelog/SKILL.md`). Write clear, categorized commit messages (Added/Changed/Fixed/etc.) so aggregation has something useful to pull from.

Before adding a new admin feature, check `jul5-code-review.md` first — several existing features (menu reshaping, pattern usage counts) have documented, unfixed issues that a new feature built on top of them would inherit.

## Common Tasks

### Adding a new admin-only editor feature (RichText format, block filter, etc.)

Follow the pattern used by `custom-formats.tsx`/`hgroup-control.tsx`:

1. Add `src/my-feature.tsx`
2. Add a matching `vite.config.myfeature.js` (one file in, one file out — this plugin does not use a single multi-entry build)
3. Add the entry to `package.json`'s `build` script
4. Add an `wp_enqueue_script()` call in `theatrum-admin.php`, gated on `file_exists()` like the existing enqueues
5. Run the **full** `npm run build` (not `build:watch` — see CLAUDE.md's known issues) and verify the new `dist/*.js` file actually exists before testing in wp-admin

### Adding a new wp-admin page or menu customization

Follow `patterns-admin.php`'s pattern, not `submenus.php`'s — the code review found `patterns-admin.php` uses the correct `$submenu['themes.php']`-style keys, a null-safe `get_edit_post_link()` guard, and a proper `$pagenow` check. `submenus.php` has the menu-parent-key bug described in CLAUDE.md; don't copy its Themes-move code.

### Reviewing changes

```bash
/code-review low          # Quick pass
/wp-standards              # WordPress coding standards check
```

Given the plugin's PHP layer is otherwise solid (consistent escaping, prepared queries, capability gates — see README's "Code Review — Current State"), a new PR that fails those same basic checks is a regression worth flagging explicitly.
