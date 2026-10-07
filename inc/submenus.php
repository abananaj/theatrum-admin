<?php

/**
 * Customize admin sidebar submenus for custom post types.
 */

// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited -- $menu/$submenu ARE the admin menu API; reordering and extending it means writing to them.

if ( ! defined('ABSPATH')) {
  exit;
}

add_action(
    'admin_menu',
    function () {

    global $menu, $submenu;

    // Helper: remove a submenu item matching a substring of its URL
    $remove_submenu = function ($key, $url_fragment) use (&$submenu) {
    if ( ! isset($submenu[$key])) { return;
    }
    foreach ($submenu[$key] as $index => $item) {
      if (isset($item[2]) && strpos($item[2], $url_fragment) !== false) {
        unset($submenu[$key][$index]);
        break;
      }
    }
    };

    // ── Rename "Posts" to "Blog" ────────────────────────────────────────────────
    foreach ($menu as $pos => $item) {
      if (isset($item[2]) && $item[2] === 'edit.php') {
        $menu[$pos][0] = 'Blog';
        $menu[$pos][3] = 'Blog';
        break;
      }
    }

    // ── Move Media (pos 10) before Blog/Posts (pos 5) ───────────────────────────
    if (isset($menu[5]) && isset($menu[10])) {
      $temp     = $menu[5];
      $menu[5]  = $menu[10];
      $menu[10] = $temp;
    }

    // ── Swap Blog (pos 10) and Pages (pos 20) to get Media, Pages, Blog ──────────
    if (isset($menu[10]) && isset($menu[20])) {
      $temp     = $menu[10];
      $menu[10] = $menu[20];
      $menu[20] = $temp;
    }

    // ── Move Comments under Venues ──────────────────────────────────────────────
    foreach ($menu as $pos => $item) {
      if (isset($item[2]) && $item[2] === 'edit-comments.php') {
        unset($menu[$pos]);
        break;
      }
    }

    // Separator between Venues (30) and Comments (32)
    $menu[31] = ['', 'read', 'separator-venues-comments', '', 'wp-menu-separator'];

    // Place Comments as top-level item right after Venues (pos 30)
    $menu[32] = [
    'Comments',
    'moderate_comments',
    'edit-comments.php',
    'Comments',
    'menu-top menu-icon-comments',
    'menu-comments',
    'dashicons-admin-comments',
    ];

    // ── Separator in Blog submenu after "Add Post" ──────────────────────────────
    if ( ! empty($submenu['edit.php'])) {
      $rebuilt = [];
      foreach (array_values($submenu['edit.php']) as $item) {
        $rebuilt[] = $item;
        if (isset($item[2]) && $item[2] === 'post-new.php') {
          $rebuilt[] = ['<span class="ct-sub-sep"></span>', 'read', '#ct-blog-sep', '', 'ct-submenu-separator'];
        }
      }
      $submenu['edit.php'] = $rebuilt;
    }

    // ── Separator after 2nd subitem for other post types, plus any "Add …" (post-new.php) links directly following it ──
    $insert_sep = function ($key) use (&$submenu) {
    if (empty($submenu[$key])) { return;
    }
    $items = array_values($submenu[$key]);
    $last  = 1;
    while (isset($items[$last + 1][2]) && strpos($items[$last + 1][2], 'post-new.php') === 0) {
      $last++;
    }
    $rebuilt = [];
    foreach ($items as $i => $item) {
      $rebuilt[] = $item;
      if ($i === $last) {
        $rebuilt[] = ['<span class="ct-sub-sep"></span>', 'read', '#sep-' . sanitize_key($key), '', 'ct-submenu-separator'];
      }
    }
    $submenu[$key] = $rebuilt;
    };

    $insert_sep('edit.php?post_type=page');
    $insert_sep('edit.php?post_type=artist');
    $insert_sep('edit.php?post_type=event');
    $insert_sep('edit.php?post_type=production');
    $insert_sep('edit.php?post_type=supporter');
    $insert_sep('edit.php?post_type=class');
  // phpcs:ignore Squiz.PHP.CommentedOutCode.Found -- Kept deliberately.
    // $insert_sep('edit.php?post_type=venue');

    // ── Hide Tags ───────────────────────────────────────────────────────────────
    $remove_submenu('edit.php?post_type=page',        'taxonomy=post_tag');
    $remove_submenu('edit.php?post_type=venue',    'taxonomy=post_tag');
    $remove_submenu('edit.php?post_type=event',    'taxonomy=post_tag');
    $remove_submenu('edit.php?post_type=artist',   'taxonomy=post_tag');
    $remove_submenu('edit.php?post_type=production', 'taxonomy=post_tag');

    // ── Productions: All / Add links, divider, then the three series views (Anna, Oct 6). Series, Seasons and Credits move out (Credits stays reachable by URL). ──
    $key = 'edit.php?post_type=production';

    if (isset($submenu[$key])) {
      $add_links = [];
      foreach ($submenu[$key] as $item) {
        if (isset($item[2]) && strpos($item[2], 'post-new.php?post_type=production') === 0) {
          $add_links[] = $item;
        }
      }
      $submenu[$key] = array_merge(
          [['All Productions', 'edit_posts', 'edit.php?post_type=production', 'All Productions']],
          $add_links,
          [
          ['<span class="ct-sub-sep"></span>', 'read', '#sep-' . sanitize_key($key), '', 'ct-submenu-separator'],
          ['Chance Productions', 'edit_posts', 'edit.php?post_type=production&ct_chance=1', 'Chance Productions'],
          ['OTR Readings', 'edit_posts', 'edit.php?post_type=production&series=otr-series', 'OTR Readings'],
          ['Visiting Companies', 'edit_posts', 'edit.php?post_type=production&series=visiting-companies', 'Visiting Companies'],
          ]
      );
    }

    // ── Season / series / page taxonomies now live under the Seasons menu, so drop their per-post-type copies ──
    $drop = function ($parent, $fragments) use (&$submenu) {
    if (empty($submenu[$parent])) { return;
    }
    foreach ($submenu[$parent] as $index => $item) {
      foreach ($fragments as $fragment) {
        if (isset($item[2]) && strpos($item[2], $fragment) !== false) {
          unset($submenu[$parent][$index]);
          break;
        }
      }
    }
    };
    $drop('edit.php', ['taxonomy=season', 'taxonomy=series']);
    $drop('edit.php?post_type=event', ['taxonomy=season', 'taxonomy=series']);
    $drop('edit.php?post_type=page', ['taxonomy=season', 'taxonomy=series', 'taxonomy=category', 'taxonomy=event-type', 'taxonomy=program', 'ct_layout=season', 'post_type=archived-page']);

    // ── Pages: "Archived Pages" lists pages with the archive status (the old link pointed at an empty archived-page post type) ──
    if (isset($submenu['edit.php?post_type=page'])) {
      $submenu['edit.php?post_type=page'][] = ['Archived Pages', 'edit_pages', 'edit.php?post_status=archive&post_type=page', 'Archived Pages'];
    }

    // ── Move Themes from Appearance to Settings submenu ────────────────────────
    // Remove Themes from Appearance
    if (isset($submenu['themes.php'])) {
      foreach ($submenu['themes.php'] as $index => $item) {
        if (isset($item[2]) && $item[2] === 'themes.php') {
          unset($submenu['themes.php'][$index]);
          break;
        }
      }
    }

    // Add Themes to Settings
    if ( ! isset($submenu['options-general.php'])) {
      $submenu['options-general.php'] = [];
    }
    $submenu['options-general.php'][] = [
    'Themes',
    'switch_themes',
    'themes.php',
    'Themes',
    ];

    // Hidden page for the all-types tagged-posts view
    add_submenu_page('', 'Tagged Posts', 'Tagged Posts', 'edit_posts', 'ct-tagged-posts', 'ct_render_tagged_posts_page');
    },
    999
);

// ── Filter productions to exclude visiting-companies from "Chance Productions" ──

add_action(
    'pre_get_posts',
    function ($query) {
    if ( ! is_admin() || ! $query->is_main_query()) {
      return;
    }

    if ($query->get('post_type') !== 'production') {
      return;
    }

    // Only filter the "Chance Productions" view; All Productions shows everything.
    if (empty($_GET['ct_chance'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.
      return;
    }

    // Exclude visiting-companies, and otr-series unless also main-series, from the main list
    $tax_query = $query->get('tax_query');
    if ( ! is_array($tax_query)) {
      $tax_query = [];
    }

    $tax_query[] = [
    'relation' => 'AND',
    [
      'taxonomy' => 'series',
      'field'    => 'slug',
      'terms'    => 'visiting-companies',
      'operator' => 'NOT IN',
    ],
    [
      'relation' => 'OR',
      [
        'taxonomy' => 'series',
        'field'    => 'slug',
        'terms'    => 'otr-series',
        'operator' => 'NOT IN',
      ],
      [
        'taxonomy' => 'series',
        'field'    => 'slug',
        'terms'    => 'main-series',
        'operator' => 'IN',
      ],
    ],
    ];

    $query->set('tax_query', $tax_query);
    }
);

// ── Seasons top-level menu: seasons, new season page, series, then Global Categories, Tags and the season Settings page (Anna, Oct 6) ──

define('THEATRUM_ADMIN_SEASONS_MENU', 'edit-tags.php?taxonomy=season');

// Registered early (before ACF's priority-99 options pages) so the Settings sub-page resolves its hook against this parent.
add_action(
    'admin_menu',
    function () {
    add_menu_page(__('Seasons', 'theatrum-admin'), __('Seasons', 'theatrum-admin'), 'manage_categories', THEATRUM_ADMIN_SEASONS_MENU, '', 'dashicons-calendar-alt', 51);
    },
    9
);

add_action(
    'admin_menu',
    function () {
    global $menu, $submenu;
    $parent = THEATRUM_ADMIN_SEASONS_MENU;

    // Global Categories and the old top-level Tags fold in here.
    remove_menu_page('edit-tags.php?taxonomy=nomenclature');
    foreach ($menu as $pos => $item) {
      if (isset($item[2]) && 'edit-tags.php?taxonomy=post_tag' === $item[2]) {
        unset($menu[$pos]);
      }
    }

    // Settings is the ACF options page (chance-ollie season.php); kept last, its link is fixed up in the PHP_INT_MAX pass below.
    $settings = array();
    foreach ($submenu[$parent] ?? array() as $item) {
      if (isset($item[2]) && 'season-settings' === $item[2]) {
        $settings[] = $item;
      }
    }

    $submenu[$parent] = array_merge(
        array(
        array(__('All Seasons', 'theatrum-admin'), 'manage_categories', $parent, __('All Seasons', 'theatrum-admin')),
        array(__('New Season', 'theatrum-admin'), 'edit_pages', 'post-new.php?post_type=page&ct_layout=season', __('New Season', 'theatrum-admin')),
        array(__('Series', 'theatrum-admin'), 'manage_categories', 'edit-tags.php?taxonomy=series', __('Series', 'theatrum-admin')),
        array('<span class="ct-sub-sep"></span>', 'read', '#sep-seasons', '', 'ct-submenu-separator'),
        array(__('Global Categories', 'theatrum-admin'), 'manage_categories', 'edit-tags.php?taxonomy=nomenclature', __('Global Categories', 'theatrum-admin')),
        array(__('Tags', 'theatrum-admin'), 'manage_categories', 'edit-tags.php?taxonomy=post_tag', __('Tags', 'theatrum-admin')),
        ),
        $settings
    );
    },
    1000
);

// Last pass: point the Settings row through admin.php (core would build edit-tags.php?…&page=, which errors).
add_action(
    'admin_menu',
    function () {
    global $submenu;
    foreach ($submenu[THEATRUM_ADMIN_SEASONS_MENU] ?? array() as $index => $item) {
      if (isset($item[2]) && 'season-settings' === $item[2]) {
        $submenu[THEATRUM_ADMIN_SEASONS_MENU][$index][2] = 'admin.php?page=season-settings';
      }
    }
    },
    PHP_INT_MAX
);

// Keep Seasons open and the right row highlighted on its term screens and the New Season editor.
add_filter(
    'parent_file',
    function ($parent_file) {
    global $pagenow;
    $screen = get_current_screen();
    if ($screen && in_array($screen->taxonomy, array('season', 'series', 'nomenclature'), true)) {
      return THEATRUM_ADMIN_SEASONS_MENU;
    }
    if ($screen && 'post_tag' === $screen->taxonomy && empty($_GET['post_type'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return THEATRUM_ADMIN_SEASONS_MENU;
    }
    if ('post-new.php' === $pagenow && isset($_GET['ct_layout']) && 'season' === $_GET['ct_layout']) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return THEATRUM_ADMIN_SEASONS_MENU;
    }
    return $parent_file;
    },
    20
);

add_filter(
    'submenu_file',
    function ($submenu_file) {
    global $pagenow;
    $screen = get_current_screen();
    if ($screen && in_array($pagenow, array('edit-tags.php', 'term.php'), true)) {
      if ($screen && in_array($screen->taxonomy, array('season', 'series', 'nomenclature'), true)) {
        return 'edit-tags.php?taxonomy=' . $screen->taxonomy;
      }
      if ($screen && 'post_tag' === $screen->taxonomy && empty($_GET['post_type'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
        return 'edit-tags.php?taxonomy=post_tag';
      }
    }
    if ('post-new.php' === $pagenow && isset($_GET['ct_layout']) && 'season' === $_GET['ct_layout']) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return 'post-new.php?post_type=page&ct_layout=season';
    }
    if (isset($_GET['page']) && 'season-settings' === $_GET['page']) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return 'admin.php?page=season-settings';
    }
    return $submenu_file;
    },
    20
);

// ── Highlight the Visiting Companies / OTR Readings submenu item on their filtered lists ──

add_filter(
    'submenu_file',
    function ($submenu_file) {
    global $pagenow;
    if ($pagenow === 'edit.php' && ! empty($_GET['ct_chance'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return 'edit.php?post_type=production&ct_chance=1';
    }
    if ($pagenow === 'edit.php' && isset($_GET['post_status'], $_GET['post_type']) && 'archive' === $_GET['post_status'] && 'page' === $_GET['post_type']) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return 'edit.php?post_status=archive&post_type=page';
    }
    if ($pagenow !== 'edit.php' || ! isset($_GET['post_type'], $_GET['series']) || $_GET['post_type'] !== 'production') { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
      return $submenu_file;
    }
    $series = sanitize_key(wp_unslash($_GET['series'])); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin menu highlight; no state change.
    if (in_array($series, ['visiting-companies', 'otr-series'], true)) {
      return 'edit.php?post_type=production&series=' . $series;
    }
    return $submenu_file;
    }
);

// ── Style the Blog submenu separator ────────────────────────────────────────

add_action(
    'admin_head',
    function () {
    echo '<style>
    #adminmenu .ct-submenu-separator > a {
      display: block !important;
      height: 1px !important;
      background: #3c434a !important;
      margin: 4px 8px !important;
      padding: 0 !important;
      pointer-events: none !important;
      cursor: default !important;
    }
  </style>';
    // The separator rows are still <a> elements in the menu DOM — take them out of the tab order and the accessibility tree.
    echo '<script>document.querySelectorAll("#adminmenu .ct-submenu-separator > a").forEach(function (a) { a.setAttribute("tabindex", "-1"); a.setAttribute("aria-hidden", "true"); });</script>';
    }
);

// ── Override count column in the global tag list to link to the all-types view ─

add_filter(
    'manage_edit-post_tag_columns',
    function ($columns) {
    // Only on the generic tags list — not when scoped to a specific post type
    if ( ! empty($_GET['post_type'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.
      return $columns;
    }
    unset($columns['posts']);
    $columns['ct_all_posts'] = __('Posts', 'theatrum-admin');
    return $columns;
    }
);

add_filter(
    'manage_post_tag_custom_column',
    function ($string, $column_name, $term_id) {
    if ($column_name !== 'ct_all_posts') {
      return $string;
    }
    $term = get_term($term_id, 'post_tag');
    if ( ! $term || is_wp_error($term)) {
      return '0';
    }
    $url = admin_url('admin.php?page=ct-tagged-posts&tag=' . urlencode($term->slug));
    return '<a href="' . esc_url($url) . '">' . (int) $term->count . '</a>';
    },
    10,
    3
);

// ── Render: all posts of all types with the given tag ───────────────────────

function ct_render_tagged_posts_page() {
  $tag_slug = isset($_GET['tag']) ? sanitize_text_field(wp_unslash($_GET['tag'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.

  echo '<div class="wrap">';

  if ( ! $tag_slug) {
    echo '<h1>Tagged Posts</h1><p>No tag specified.</p></div>';
    return;
  }

  $term = get_term_by('slug', $tag_slug, 'post_tag');
  if ( ! $term) {
    echo '<h1>Tagged Posts</h1><p>Tag not found.</p></div>';
    return;
  }

  echo '<h1>Posts tagged &ldquo;' . esc_html($term->name) . '&rdquo;</h1>';
  echo '<p><a href="' . esc_url(admin_url('edit-tags.php?taxonomy=post_tag')) . '">&larr; Back to Tags</a></p>';

  // All post types that use post_tag
$tagged_post_types = array_values(
    array_filter(
        get_post_types(['public' => true], 'names'),
        function ($pt) {
          return in_array('post_tag', get_object_taxonomies($pt), true);
        }
    )
);

$posts = get_posts(
    [
    'post_type'      => $tagged_post_types,
    'posts_per_page' => -1,
    'post_status'    => ['publish', 'draft', 'pending', 'private'],
    // phpcs:ignore WordPress.DB.SlowDBQuery -- admin-only, builds one admin submenu.
    'tax_query'      => [[
      'taxonomy' => 'post_tag',
      'field'    => 'slug',
      'terms'    => $tag_slug,
    ]],
    'orderby'        => 'post_type',
    'order'          => 'ASC',
    ]
);

  // Drop posts the user can't see — get_posts() above has no capability gate, so a Contributor (edit_posts is enough to reach this page) could otherwise see other authors' private/draft posts.
$posts = array_values(
    array_filter(
        $posts,
        function ($post) {
          return current_user_can('read_post', $post->ID);
        }
    )
);

  if (empty($posts)) {
    echo '<p>No posts found with this tag.</p></div>';
    return;
  }

  echo '<table class="wp-list-table widefat fixed striped">';
  echo '<thead><tr><th scope="col">Title</th><th scope="col">Type</th><th scope="col">Status</th></tr></thead><tbody>';

  foreach ($posts as $post) {
    $type_obj  = get_post_type_object($post->post_type);
    $label     = $type_obj ? $type_obj->labels->singular_name : $post->post_type;
    $edit_link = get_edit_post_link($post->ID);
    $title     = esc_html($post->post_title ?: '(no title)');
    echo '<tr>';
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $title is esc_html()'d above; $edit_link is esc_url()'d inline.
    echo '<td>' . ($edit_link ? '<a href="' . esc_url($edit_link) . '">' . $title . '</a>' : $title) . '</td>';
    echo '<td>' . esc_html($label) . '</td>';
    echo '<td>' . esc_html($post->post_status) . '</td>';
    echo '</tr>';
  }

  echo '</tbody></table></div>';
}
