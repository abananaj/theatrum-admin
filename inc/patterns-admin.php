<?php

/**
 * Patterns admin: tag support, category management, and accurate usage count.
 *
 * Provides:
 * - post_tag taxonomy registered for wp_block
 * - ct_count_pattern_usage() for querying actual post_content references
 * - "Categories" submenu link + hidden usage detail page
 * - Extra columns (Category, Tags, Used In) on the native wp_block list table
 * - pre_get_posts filter so the native list respects ?wp_pattern_category=slug
 */

// ── Tag support ───────────────────────────────────────────────────────────────

add_action('init', function () {
  register_taxonomy_for_object_type('post_tag', 'wp_block');
}, 11);

// ── Submenus ──────────────────────────────────────────────────────────────────

add_action('admin_menu', function () {
  global $submenu;

  // "Categories" link alongside the existing Appearance > Patterns submenu
  $submenu['themes.php'][] = [
    'Pattern Categories',
    'manage_categories',
    'edit-tags.php?taxonomy=wp_pattern_category&post_type=wp_block',
    'Pattern Categories',
  ];

  // Hidden page: pattern usage detail (accessible via admin.php?page=ct-pattern-usage&id=ID)
  add_submenu_page(
    null,
    'Pattern Usage',
    'Pattern Usage',
    'edit_posts',
    'ct-pattern-usage',
    'ct_render_pattern_usage_page'
  );
}, 999);

// ── Link from the native list back to the archived grouped overview ───────────

add_filter('views_edit-wp_block', function ($views) {
  if (!current_user_can('manage_options')) return $views;
  $url = admin_url('admin.php?page=chance-patterns');
  $views['ct_grouped_overview'] =
    '<a href="' . esc_url($url) . '">' . esc_html__('Grouped Overview', 'chance-theater') . '</a>';
  return $views;
});

// ── Filter native wp_block list by wp_pattern_category query param ────────────

add_action('pre_get_posts', function ($query) {
  global $pagenow;
  if (!is_admin() || !$query->is_main_query()) return;
  if ($pagenow !== 'edit.php') return;
  if ($query->get('post_type') !== 'wp_block') return;

  $cat_slug = isset($_GET['wp_pattern_category']) ? sanitize_text_field($_GET['wp_pattern_category']) : '';
  if (!$cat_slug) return;

  $tax_query   = $query->get('tax_query') ?: [];
  $tax_query[] = [
    'taxonomy' => 'wp_pattern_category',
    'field'    => 'slug',
    'terms'    => $cat_slug,
  ];
  $query->set('tax_query', $tax_query);
});

// ── Columns on the native wp_block admin list ─────────────────────────────────

add_filter('manage_wp_block_posts_columns', function ($columns) {
  $new = [];
  foreach ($columns as $key => $label) {
    $new[$key] = $label;
    if ($key === 'title') {
      $new['pattern_category'] = __('Category', 'chance-theater');
      $new['pattern_tags']     = __('Tags', 'chance-theater');
      $new['pattern_usage']    = __('Used In', 'chance-theater');
    }
  }
  return $new;
});

add_action('manage_wp_block_posts_custom_column', function ($column, $post_id) {
  switch ($column) {
    case 'pattern_category':
      $terms = get_the_terms($post_id, 'wp_pattern_category');
      if ($terms && !is_wp_error($terms)) {
        $links = [];
        foreach ($terms as $term) {
          $url     = add_query_arg(
            ['post_type' => 'wp_block', 'wp_pattern_category' => $term->slug],
            admin_url('edit.php')
          );
          $links[] = '<a href="' . esc_url($url) . '">' . esc_html($term->name) . '</a>';
        }
        echo implode(', ', $links);
      } else {
        echo '—';
      }
      break;

    case 'pattern_tags':
      $terms = get_the_terms($post_id, 'post_tag');
      if ($terms && !is_wp_error($terms)) {
        $links = [];
        foreach ($terms as $term) {
          $url     = add_query_arg(
            ['post_type' => 'wp_block', 'tag' => $term->slug],
            admin_url('edit.php')
          );
          $links[] = '<a href="' . esc_url($url) . '">' . esc_html($term->name) . '</a>';
        }
        echo implode(', ', $links);
      } else {
        echo '—';
      }
      break;

    case 'pattern_usage':
      $count = ct_count_pattern_usage((int) $post_id);
      if ($count === 0) {
        echo '—';
      } else {
        $url = admin_url('admin.php?page=ct-pattern-usage&id=' . (int) $post_id);
        echo '<a href="' . esc_url($url) . '">' . $count . '</a>';
      }
      break;
  }
}, 10, 2);

// ── Usage count ───────────────────────────────────────────────────────────────

/**
 * Count how many published/drafted posts embed a synced pattern by ref ID.
 *
 * Searches post_content for the block comment attribute "ref":ID which is
 * written by Gutenberg as {"ref":123} or {"ref":123,"syncBehavior":"..."}.
 */
function ct_count_pattern_usage(int $pattern_id): int
{
  global $wpdb;
  // Match ref followed by } or , to avoid false positives (e.g. ID 5 matching 50)
  $like_close = '%' . $wpdb->esc_like('"ref":' . $pattern_id . '}') . '%';
  $like_comma = '%' . $wpdb->esc_like('"ref":' . $pattern_id . ',') . '%';

  return (int) $wpdb->get_var(
    $wpdb->prepare(
      "SELECT COUNT(*) FROM {$wpdb->posts}
       WHERE post_status NOT IN ('auto-draft', 'trash', 'inherit')
       AND post_type NOT IN ('wp_block', 'revision')
       AND (post_content LIKE %s OR post_content LIKE %s)",
      $like_close,
      $like_comma
    )
  );
}

// ── Usage detail page ─────────────────────────────────────────────────────────

function ct_render_pattern_usage_page(): void
{
  $pattern_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

  echo '<div class="wrap">';

  if (!$pattern_id) {
    echo '<h1>Pattern Usage</h1><p>No pattern specified.</p></div>';
    return;
  }

  $pattern = get_post($pattern_id);
  if (!$pattern || $pattern->post_type !== 'wp_block') {
    echo '<h1>Pattern Usage</h1><p>Pattern not found.</p></div>';
    return;
  }

  $back_url = admin_url('admin.php?page=chance-patterns');
  echo '<h1>Used: ' . esc_html($pattern->post_title ?: '(untitled)') . '</h1>';
  echo '<p><a href="' . esc_url($back_url) . '">&larr; Back to Patterns</a></p>';

  global $wpdb;
  $like_close = '%' . $wpdb->esc_like('"ref":' . $pattern_id . '}') . '%';
  $like_comma = '%' . $wpdb->esc_like('"ref":' . $pattern_id . ',') . '%';

  $posts = $wpdb->get_results(
    $wpdb->prepare(
      "SELECT ID, post_title, post_type, post_status FROM {$wpdb->posts}
       WHERE post_status NOT IN ('auto-draft', 'trash', 'inherit')
       AND post_type NOT IN ('wp_block', 'revision')
       AND (post_content LIKE %s OR post_content LIKE %s)
       ORDER BY post_type ASC, post_title ASC",
      $like_close,
      $like_comma
    )
  );

  if (empty($posts)) {
    echo '<p>This pattern is not used in any posts or pages.</p></div>';
    return;
  }

  $n = count($posts);
  echo '<p><strong>' . $n . '</strong> ' . ($n === 1 ? 'location' : 'locations') . '</p>';
  echo '<table class="wp-list-table widefat fixed striped">';
  echo '<thead><tr><th>Title</th><th>Type</th><th>Status</th></tr></thead><tbody>';

  foreach ($posts as $post) {
    $type_obj = get_post_type_object($post->post_type);
    $label    = $type_obj ? $type_obj->labels->singular_name : $post->post_type;
    echo '<tr>';
    $edit_link = get_edit_post_link($post->ID);
    if ($edit_link) {
      echo '<td><a href="' . esc_url($edit_link) . '">' . esc_html($post->post_title ?: '(no title)') . '</a></td>';
    } else {
      echo '<td>' . esc_html($post->post_title ?: '(no title)') . '</td>';
    }
    echo '<td>' . esc_html($label) . '</td>';
    echo '<td>' . esc_html($post->post_status) . '</td>';
    echo '</tr>';
  }

  echo '</tbody></table></div>';
}
