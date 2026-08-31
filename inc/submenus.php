<?php

/**
 * Customize admin sidebar submenus for custom post types.
 */

add_action('admin_menu', function () {

  global $menu, $submenu;

  // Helper: remove a submenu item matching a substring of its URL
  $remove_submenu = function ($key, $url_fragment) use (&$submenu) {
    if (!isset($submenu[$key])) return;
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
  if (!empty($submenu['edit.php'])) {
    $rebuilt = [];
    foreach (array_values($submenu['edit.php']) as $item) {
      $rebuilt[] = $item;
      if (isset($item[2]) && $item[2] === 'post-new.php') {
        $rebuilt[] = ['<span class="ct-sub-sep"></span>', 'read', '#ct-blog-sep', '', 'ct-submenu-separator'];
      }
    }
    $submenu['edit.php'] = $rebuilt;
  }

  // ── Separator after 2nd subitem for other post types ────────────────────────
  $insert_sep = function ($key) use (&$submenu) {
    if (empty($submenu[$key])) return;
    $items   = array_values($submenu[$key]);
    $rebuilt = [];
    foreach ($items as $i => $item) {
      $rebuilt[] = $item;
      if ($i === 1) {
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
  // $insert_sep('edit.php?post_type=venue');

  // ── Hide Tags ───────────────────────────────────────────────────────────────
  $remove_submenu('edit.php?post_type=page',        'taxonomy=post_tag');
  $remove_submenu('edit.php?post_type=venue',    'taxonomy=post_tag');
  $remove_submenu('edit.php?post_type=event',    'taxonomy=post_tag');
  $remove_submenu('edit.php?post_type=artist',   'taxonomy=post_tag');
  $remove_submenu('edit.php?post_type=production', 'taxonomy=post_tag');

  // ── production: put Series before Season ─────────────────────────────────
  $key = 'edit.php?post_type=production';

  if (!isset($submenu[$key])) return;

  // ── Rename "All Productions" to "Chance Productions" ─────────────────────────
  foreach ($submenu[$key] as $index => $item) {
    if (isset($item[2]) && $item[2] === 'edit.php?post_type=production') {
      $submenu[$key][$index][0] = 'Chance Productions';
      $submenu[$key][$index][3] = 'Chance Productions';
      break;
    }
  }

  $series_item = $season_item = null;
  $series_index = $season_index = null;

  foreach ($submenu[$key] as $index => $item) {
    if (isset($item[2]) && strpos($item[2], 'taxonomy=series') !== false) {
      $series_item  = $item;
      $series_index = $index;
    }
    if (isset($item[2]) && strpos($item[2], 'taxonomy=season') !== false) {
      $season_item  = $item;
      $season_index = $index;
    }
  }

  if ($series_item && $season_item && $season_index < $series_index) {
    $submenu[$key][$season_index] = $series_item;
    $submenu[$key][$series_index] = $season_item;
  }

  // ── Add "Visiting Companies" custom submenu item after "All Productions" ─────
  $visiting_companies_item = [
    'Visiting Companies',
    'read',
    'edit.php?post_type=production&series=visiting-companies',
    'Visiting Companies',
  ];
  
  // Insert after first item (All Productions)
  $items = array_values($submenu[$key]);
  $submenu[$key] = [];
  foreach ($items as $i => $item) {
    $submenu[$key][] = $item;
    if ($i === 0) {
      $submenu[$key][] = $visiting_companies_item;
    }
  }

  // ── Top-level Tags menu (before the separator before Appearance) ────────────
  global $menu;
  $menu[58] = [
    'Tags',
    'edit_posts',
    'edit-tags.php?taxonomy=post_tag',
    'Tags',
    'menu-top menu-icon-post_tag',
    'menu-posts-post_tag',
    'dashicons-tag',
  ];

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
  if (!isset($submenu['options-general.php'])) {
    $submenu['options-general.php'] = [];
  }
  $submenu['options-general.php'][] = [
    'Themes',
    'switch_themes',
    'themes.php',
    'Themes',
  ];

  // Hidden page for the all-types tagged-posts view
  add_submenu_page(null, 'Tagged Posts', 'Tagged Posts', 'edit_posts', 'ct-tagged-posts', 'ct_render_tagged_posts_page');
}, 999);

// ── Filter productions to exclude visiting-companies from "Chance Productions" ──

add_action('pre_get_posts', function ($query) {
  if (!is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->get('post_type') !== 'production') {
    return;
  }

  // Only filter when viewing the main Chance Productions list (no series filter)
  if (isset($_GET['series'])) {
    return;
  }

  // Exclude visiting-companies term from the main list
  $tax_query = $query->get('tax_query');
  if (!is_array($tax_query)) {
    $tax_query = [];
  }

  $tax_query[] = [
    'taxonomy' => 'series',
    'field'    => 'slug',
    'terms'    => 'visiting-companies',
    'operator' => 'NOT IN',
  ];

  $query->set('tax_query', $tax_query);
});

// ── Style the Blog submenu separator ────────────────────────────────────────

add_action('admin_head', function () {
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
});

// ── Override count column in the global tag list to link to the all-types view ─

add_filter('manage_edit-post_tag_columns', function ($columns) {
  // Only on the generic tags list — not when scoped to a specific post type
  if (!empty($_GET['post_type'])) {
    return $columns;
  }
  unset($columns['posts']);
  $columns['ct_all_posts'] = __('Posts', 'theatrum-admin');
  return $columns;
});

add_filter('manage_post_tag_custom_column', function ($string, $column_name, $term_id) {
  if ($column_name !== 'ct_all_posts') {
    return $string;
  }
  $term = get_term($term_id, 'post_tag');
  if (!$term || is_wp_error($term)) {
    return '0';
  }
  $url = admin_url('admin.php?page=ct-tagged-posts&tag=' . urlencode($term->slug));
  return '<a href="' . esc_url($url) . '">' . (int) $term->count . '</a>';
}, 10, 3);

// ── Render: all posts of all types with the given tag ───────────────────────

function ct_render_tagged_posts_page()
{
  $tag_slug = isset($_GET['tag']) ? sanitize_text_field($_GET['tag']) : '';

  echo '<div class="wrap">';

  if (!$tag_slug) {
    echo '<h1>Tagged Posts</h1><p>No tag specified.</p></div>';
    return;
  }

  $term = get_term_by('slug', $tag_slug, 'post_tag');
  if (!$term) {
    echo '<h1>Tagged Posts</h1><p>Tag not found.</p></div>';
    return;
  }

  echo '<h1>Posts tagged &ldquo;' . esc_html($term->name) . '&rdquo;</h1>';
  echo '<p><a href="' . esc_url(admin_url('edit-tags.php?taxonomy=post_tag')) . '">&larr; Back to Tags</a></p>';

  // All post types that use post_tag
  $tagged_post_types = array_values(array_filter(
    get_post_types(['public' => true], 'names'),
    function ($pt) {
      return in_array('post_tag', get_object_taxonomies($pt), true);
    }
  ));

  $posts = get_posts([
    'post_type'      => $tagged_post_types,
    'posts_per_page' => -1,
    'post_status'    => ['publish', 'draft', 'pending', 'private'],
    'tax_query'      => [[
      'taxonomy' => 'post_tag',
      'field'    => 'slug',
      'terms'    => $tag_slug,
    ]],
    'orderby'        => 'post_type',
    'order'          => 'ASC',
  ]);

  // Drop posts the current user isn't allowed to see — get_posts() above has
  // no capability gate, so without this a Contributor (who only needs
  // edit_posts to reach this page) could see other authors' private/draft
  // post titles and statuses.
  $posts = array_values(array_filter($posts, function ($post) {
    return current_user_can('read_post', $post->ID);
  }));

  if (empty($posts)) {
    echo '<p>No posts found with this tag.</p></div>';
    return;
  }

  echo '<table class="wp-list-table widefat fixed striped">';
  echo '<thead><tr><th>Title</th><th>Type</th><th>Status</th></tr></thead><tbody>';

  foreach ($posts as $post) {
    $type_obj  = get_post_type_object($post->post_type);
    $label     = $type_obj ? $type_obj->labels->singular_name : $post->post_type;
    $edit_link = get_edit_post_link($post->ID);
    $title     = esc_html($post->post_title ?: '(no title)');
    echo '<tr>';
    echo '<td>' . ($edit_link ? '<a href="' . esc_url($edit_link) . '">' . $title . '</a>' : $title) . '</td>';
    echo '<td>' . esc_html($label) . '</td>';
    echo '<td>' . esc_html($post->post_status) . '</td>';
    echo '</tr>';
  }

  echo '</tbody></table></div>';
}
