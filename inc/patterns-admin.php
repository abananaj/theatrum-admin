<?php

/**
 * Patterns admin: tag support, category management, and accurate usage count.
 * Adds post_tag to wp_block, a Categories submenu + hidden usage detail page, Category/Tags/Used In list columns, and a pre_get_posts filter for ?wp_pattern_category=slug.
 */

if (! defined('ABSPATH')) {
  exit;
}

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
    '<a href="' . esc_url($url) . '">' . esc_html__('Grouped Overview', 'theatrum-admin') . '</a>';
  return $views;
});

// ── Filter native wp_block list by wp_pattern_category query param ────────────

add_action('pre_get_posts', function ($query) {
  global $pagenow;
  if (!is_admin() || !$query->is_main_query()) return;
  if ($pagenow !== 'edit.php') return;
  if ($query->get('post_type') !== 'wp_block') return;

  $cat_slug = isset($_GET['wp_pattern_category']) ? sanitize_text_field($_GET['wp_pattern_category']) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.
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
      $new['pattern_category'] = __('Category', 'theatrum-admin');
      $new['pattern_tags']     = __('Tags', 'theatrum-admin');
      $new['pattern_usage']    = __('Used In', 'theatrum-admin');
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
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $links entries built above from esc_url()/esc_html() output.
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
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $links entries built above from esc_url()/esc_html() output.
        echo implode(', ', $links);
      } else {
        echo '—';
      }
      break;

    case 'pattern_usage':
      $count = ct_get_all_pattern_usage_counts()[(int) $post_id] ?? 0;
      if ($count === 0) {
        echo '—';
      } else {
        $url = admin_url('admin.php?page=ct-pattern-usage&id=' . (int) $post_id);
        echo '<a href="' . esc_url($url) . '">' . esc_html($count) . '</a>';
      }
      break;
  }
}, 10, 2);

// ── Usage count ───────────────────────────────────────────────────────────────

/**
 * Count how many published/drafted posts embed a synced pattern by ref ID — searches post_content for "ref":ID as written by Gutenberg ({"ref":123} or {"ref":123,"syncBehavior":"..."}).
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

/**
 * Usage counts for every pattern in one pass, instead of one query per pattern — the list column and Grouped Overview page used to call ct_count_pattern_usage() once per row (150+ full unindexed LIKE scans per page load). This does one scan and tallies in PHP, cached in a transient since post content only changes on save.
 *
 * @return array<int,int> pattern_id => count of distinct posts referencing it
 */
function ct_get_all_pattern_usage_counts(): array
{
  static $counts = null;
  if ($counts !== null) {
    return $counts;
  }

  $cached = get_transient('ct_pattern_usage_counts');
  if (is_array($cached)) {
    $counts = $cached;
    return $counts;
  }

  global $wpdb;
  $rows = $wpdb->get_results(
    "SELECT post_content FROM {$wpdb->posts}
     WHERE post_status NOT IN ('auto-draft', 'trash', 'inherit')
     AND post_type NOT IN ('wp_block', 'revision')
     AND post_content LIKE '%\"ref\":%'"
  );

  $counts = [];
  foreach ($rows as $row) {
    if (!preg_match_all('/"ref":(\d+)/', $row->post_content, $matches)) {
      continue;
    }
    // Count each pattern once per post, matching the old per-post COUNT(*) semantics
    foreach (array_unique($matches[1]) as $ref_id) {
      $ref_id = (int) $ref_id;
      $counts[$ref_id] = ($counts[$ref_id] ?? 0) + 1;
    }
  }

  set_transient('ct_pattern_usage_counts', $counts, 12 * HOUR_IN_SECONDS);
  return $counts;
}

add_action('save_post', function ($post_id) {
  if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) return;
  delete_transient('ct_pattern_usage_counts');
});
add_action('before_delete_post', function () {
  delete_transient('ct_pattern_usage_counts');
});

// ── Usage detail page ─────────────────────────────────────────────────────────

function ct_render_pattern_usage_page(): void
{
  $pattern_id = isset($_GET['id']) ? (int) $_GET['id'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.

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

  // Drop posts the user can't see — the raw query above has no capability gate, so a Contributor (edit_posts is enough to reach this page) could otherwise see other authors' private/draft posts.
  $posts = array_values(array_filter($posts, function ($post) {
    return current_user_can('read_post', $post->ID);
  }));

  if (empty($posts)) {
    echo '<p>This pattern is not used in any posts or pages.</p></div>';
    return;
  }

  $n = count($posts);
  echo '<p><strong>' . esc_html($n) . '</strong> ' . ($n === 1 ? 'location' : 'locations') . '</p>';
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
