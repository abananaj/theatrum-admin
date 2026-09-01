<?php

/**
 * Site Manual — in-admin documentation for Chance Theater staff.
 *
 * Topics are HTML-mode PHP partials in docs/topics/, declared in
 * docs/manifest.php. Adding a topic is one manifest entry plus one file;
 * nothing in here changes. A declared topic with no file on disk renders a
 * "not written yet" notice, so the whole outline is browsable from day one.
 *
 * PHP and plain CSS only, on purpose: dist/ is gitignored and its deploy is
 * unreliable, so the manual must never depend on the build step. Partials are
 * written in HTML mode rather than parsed from markdown so they can emit real
 * admin_url() deep links into the screen being described.
 */

if (! defined('ABSPATH')) {
  exit;
}

define('CHANCE_MANUAL_SLUG', 'chance-manual');
define('CHANCE_MANUAL_ROOT', plugin_dir_path(__DIR__));
define('CHANCE_MANUAL_URL', plugin_dir_url(__DIR__));

/**
 * The topic registry — grouped and ordered. Read once per request.
 *
 * @return array
 */
function chance_manual_manifest()
{
  static $manifest = null;

  if (null === $manifest) {
    $file     = CHANCE_MANUAL_ROOT . 'docs/manifest.php';
    $manifest = file_exists($file) ? (array) require $file : [];
  }

  return $manifest;
}

/**
 * Look a topic up by slug.
 *
 * This is the only route from request input to a file path — the manifest is
 * the allowlist, so an undeclared slug can never reach an include().
 *
 * @param string $slug Topic slug.
 * @return array|null Topic data with slug/group added, or null if undeclared.
 */
function chance_manual_find_topic($slug)
{
  foreach (chance_manual_manifest() as $group_key => $group) {
    if (isset($group['topics'][$slug])) {
      return array_merge(
        $group['topics'][$slug],
        [
          'slug'        => $slug,
          'group'       => $group_key,
          'group_label' => $group['label'],
        ]
      );
    }
  }

  return null;
}

/**
 * Every topic slug in reading order — used for the previous/next pager.
 *
 * @return array
 */
function chance_manual_reading_order()
{
  $order = [];

  foreach (chance_manual_manifest() as $group) {
    foreach (array_keys($group['topics']) as $slug) {
      $order[] = $slug;
    }
  }

  return $order;
}

/**
 * URL for a topic, or the manual index when no slug is given.
 *
 * @param string $slug Topic slug.
 * @return string
 */
function chance_manual_url($slug = '')
{
  $args = ['page' => CHANCE_MANUAL_SLUG];

  if ($slug) {
    $args['topic'] = $slug;
  }

  return add_query_arg($args, admin_url('admin.php'));
}

/**
 * Does this topic have a written partial behind it?
 *
 * @param array $topic Topic data from chance_manual_find_topic().
 * @return bool
 */
function chance_manual_is_written($topic)
{
  if (! empty($topic['status']) && 'stub' === $topic['status']) {
    return false;
  }

  return file_exists(CHANCE_MANUAL_ROOT . 'docs/topics/' . $topic['slug'] . '.php');
}

/**
 * Register the top-level menu item.
 *
 * Position 3.5 sits between Dashboard (2) and the first separator (4), so the
 * manual is the first thing under Dashboard. The position is a float on
 * purpose: integer positions collide silently, and inc/submenus.php rewrites
 * integer keys 5/10/20/30/31/32 wholesale at priority 999. Registering at
 * priority 9 means this menu already exists when that code runs.
 */
function chance_manual_menu()
{
  add_menu_page(
    __('Site Manual', 'theatrum-admin'),
    __('Site Manual', 'theatrum-admin'),
    'edit_posts',
    CHANCE_MANUAL_SLUG,
    'chance_render_manual_page',
    'dashicons-book-alt',
    3.5
  );
}
add_action('admin_menu', 'chance_manual_menu', 9);

/**
 * Load the manual stylesheet, on the manual screen only.
 *
 * @param string $hook_suffix Current admin page hook.
 */
function chance_manual_enqueue($hook_suffix)
{
  if ('toplevel_page_' . CHANCE_MANUAL_SLUG !== $hook_suffix) {
    return;
  }

  $style_path = CHANCE_MANUAL_ROOT . 'assets/manual.css';

  if (file_exists($style_path)) {
    wp_enqueue_style(
      'chance-manual',
      CHANCE_MANUAL_URL . 'assets/manual.css',
      [],
      filemtime($style_path)
    );
  }
}
add_action('admin_enqueue_scripts', 'chance_manual_enqueue');

/**
 * Screenshot helper for topic partials.
 *
 * Keeps alt text mandatory and markup consistent. Images live in docs/images/.
 *
 * @param string $file    Filename inside docs/images/.
 * @param string $alt     Alt text describing the screenshot.
 * @param string $caption Optional caption.
 */
function chance_manual_img($file, $alt, $caption = '')
{
  $path = CHANCE_MANUAL_ROOT . 'docs/images/' . $file;

  if (! file_exists($path)) {
    return;
  }

  echo '<figure class="ct-manual__figure"><img src="' .
    esc_url(CHANCE_MANUAL_URL . 'docs/images/' . $file) . '" alt="' . esc_attr($alt) . '">';

  if ($caption) {
    echo '<figcaption>' . esc_html($caption) . '</figcaption>';
  }

  echo '</figure>';
}

/**
 * How many published patterns exist, and how many of those are shared.
 *
 * Used by the patterns topic so its warning cannot go stale as the library
 * grows. Cached for a day — this is a docs page, not a dashboard.
 *
 * @return array {
 *   @type int $total  Published patterns.
 *   @type int $shared Published patterns that are synced.
 * }
 */
function chance_manual_pattern_counts()
{
  $counts = get_transient('chance_manual_pattern_counts');

  if (is_array($counts)) {
    return $counts;
  }

  $args = [
    'post_type'              => 'wp_block',
    'post_status'            => 'publish',
    'posts_per_page'         => 1,
    'fields'                 => 'ids',
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
  ];

  $all = new WP_Query($args);

  // Unsynced patterns carry this meta; synced ones have none.
  // phpcs:ignore WordPress.DB.SlowDBQuery -- Runs at most once a day on one admin docs page.
  $unsynced = new WP_Query(array_merge($args, [
    'meta_key'   => 'wp_pattern_sync_status',
    'meta_value' => 'unsynced',
  ]));

  $counts = [
    'total'  => (int) $all->found_posts,
    'shared' => (int) $all->found_posts - (int) $unsynced->found_posts,
  ];

  set_transient('chance_manual_pattern_counts', $counts, DAY_IN_SECONDS);

  return $counts;
}

/**
 * A button linking into the admin screen a topic is describing.
 *
 * Always build these from admin_url() rather than hardcoding paths — the
 * Patterns screen has already moved once, from a custom page to the native
 * wp_block list.
 *
 * @param string $admin_path Path relative to wp-admin, e.g. 'edit.php?post_type=production'.
 * @param string $label      Button text.
 */
function chance_manual_go($admin_path, $label)
{
  echo '<p><a class="button button-secondary" href="' .
    esc_url(admin_url($admin_path)) . '">' . esc_html($label) . '</a></p>';
}

/**
 * Cross-link from one topic to another.
 *
 * @param string $slug  Target topic slug.
 * @param string $label Optional link text; defaults to the topic title.
 */
function chance_manual_see($slug, $label = '')
{
  $topic = chance_manual_find_topic($slug);

  if (! $topic) {
    return;
  }

  echo '<a href="' . esc_url(chance_manual_url($slug)) . '">' .
    esc_html($label ? $label : $topic['title']) . '</a>';
}

/**
 * The sidebar: every group and topic, with the open one marked.
 *
 * @param string $current Slug of the open topic, empty on the index.
 */
function chance_manual_render_nav($current)
{
  echo '<nav class="ct-manual__nav" aria-label="' .
    esc_attr__('Manual contents', 'theatrum-admin') . '">';

  echo '<a class="ct-manual__contents' . ('' === $current ? ' is-current' : '') . '" href="' .
    esc_url(chance_manual_url()) . '">' . esc_html__('Contents', 'theatrum-admin') . '</a>';

  foreach (chance_manual_manifest() as $group) {
    echo '<h2 class="ct-manual__group">' . esc_html($group['label']) . '</h2><ul>';

    foreach ($group['topics'] as $slug => $topic) {
      $topic['slug'] = $slug;
      $classes       = [];

      if ($slug === $current) {
        $classes[] = 'is-current';
      }

      if (! chance_manual_is_written($topic)) {
        $classes[] = 'is-stub';
      }

      echo '<li><a class="' . esc_attr(implode(' ', $classes)) . '" href="' .
        esc_url(chance_manual_url($slug)) . '">' . esc_html($topic['title']) . '</a></li>';
    }

    echo '</ul>';
  }

  echo '</nav>';
}

/**
 * The index view — the whole outline, with summaries.
 */
function chance_manual_render_index()
{
  echo '<p class="ct-manual__lead">' . esc_html__(
    'How to run the Chance Theater website. If you read only three things, read the ones marked "start here" — they cover the mistakes that are hard to undo.',
    'theatrum-admin'
  ) . '</p>';

  foreach (chance_manual_manifest() as $group) {
    echo '<h2>' . esc_html($group['label']) . '</h2><dl class="ct-manual__index">';

    foreach ($group['topics'] as $slug => $topic) {
      $topic['slug'] = $slug;

      echo '<dt><a href="' . esc_url(chance_manual_url($slug)) . '">' .
        esc_html($topic['title']) . '</a>';

      if (! empty($topic['key'])) {
        echo ' <span class="ct-manual__badge ct-manual__badge--key">' .
          esc_html__('start here', 'theatrum-admin') . '</span>';
      }

      if (! chance_manual_is_written($topic)) {
        echo ' <span class="ct-manual__badge">' .
          esc_html__('not written yet', 'theatrum-admin') . '</span>';
      }

      echo '</dt>';

      if (! empty($topic['summary'])) {
        echo '<dd>' . esc_html($topic['summary']) . '</dd>';
      }
    }

    echo '</dl>';
  }
}

/**
 * Previous / next links across the whole manual.
 *
 * @param string $current Slug of the open topic.
 */
function chance_manual_render_pager($current)
{
  $order = chance_manual_reading_order();
  $index = array_search($current, $order, true);

  if (false === $index) {
    return;
  }

  echo '<nav class="ct-manual__pager">';

  if ($index > 0) {
    $prev = chance_manual_find_topic($order[$index - 1]);
    echo '<a href="' . esc_url(chance_manual_url($prev['slug'])) . '">&larr; ' .
      esc_html($prev['title']) . '</a>';
  } else {
    echo '<span></span>';
  }

  if ($index < count($order) - 1) {
    $next = chance_manual_find_topic($order[$index + 1]);
    echo '<a href="' . esc_url(chance_manual_url($next['slug'])) . '">' .
      esc_html($next['title']) . ' &rarr;</a>';
  }

  echo '</nav>';
}

/**
 * Render one topic — its partial, or the stub notice.
 *
 * @param array $topic Topic data from chance_manual_find_topic().
 */
function chance_manual_render_topic($topic)
{
  if (! chance_manual_is_written($topic)) {
    echo '<div class="notice notice-info inline ct-manual__stub"><p><strong>' .
      esc_html__('This section has not been written yet.', 'theatrum-admin') . '</strong> ' .
      esc_html__('It is on the list. Until it lands, ask and the answer will end up here.', 'theatrum-admin') .
      '</p></div>';

    if (! empty($topic['summary'])) {
      echo '<p>' . esc_html__('It will cover:', 'theatrum-admin') . ' ' .
        esc_html($topic['summary']) . '</p>';
    }

    chance_manual_render_pager($topic['slug']);

    return;
  }

  $path = CHANCE_MANUAL_ROOT . 'docs/topics/' . $topic['slug'] . '.php';

  echo '<div class="ct-manual__prose">';
  include $path;
  echo '</div>';

  echo '<p class="ct-manual__updated">' . esc_html(
    sprintf(
      /* translators: %s: the date this topic was last edited. */
      __('Last updated %s', 'theatrum-admin'),
      date_i18n(get_option('date_format'), filemtime($path))
    )
  ) . '</p>';

  chance_manual_render_pager($topic['slug']);
}

/**
 * The Site Manual screen.
 */
function chance_render_manual_page()
{
  if (! current_user_can('edit_posts')) {
    wp_die(esc_html__('You do not have permission to view the site manual.', 'theatrum-admin'));
  }

  // Read-only navigation of first-party docs; this page changes no state.
  // phpcs:ignore WordPress.Security.NonceVerification.Recommended
  $requested = isset($_GET['topic']) ? sanitize_key(wp_unslash($_GET['topic'])) : '';

  $topic   = $requested ? chance_manual_find_topic($requested) : null;
  $current = $topic ? $topic['slug'] : '';

  echo '<div class="wrap">';

  if ($topic) {
    echo '<p class="ct-manual__crumb">' . esc_html($topic['group_label']) . '</p>';
    echo '<h1 class="wp-heading-inline">' . esc_html($topic['title']) . '</h1>';
  } else {
    echo '<h1 class="wp-heading-inline">' . esc_html__('Site Manual', 'theatrum-admin') . '</h1>';
  }

  // Core's common.js relocates admin notices to this marker. Without it, it
  // falls back to the first heading it finds — which would be a group heading
  // inside the sidebar, dropping unrelated plugin notices into the nav.
  echo '<hr class="wp-header-end">';

  echo '<div class="ct-manual">';
  chance_manual_render_nav($current);
  echo '<main class="ct-manual__main">';

  if ($topic) {
    chance_manual_render_topic($topic);
  } else {
    chance_manual_render_index();
  }

  echo '</main></div></div>';
}
