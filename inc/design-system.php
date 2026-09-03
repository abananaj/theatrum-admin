<?php

if ( ! defined('ABSPATH')) {
  exit;
}

// add submenu page for Templates
function chance_add_templates_submenu_page() {
add_submenu_page(
    'themes.php', // parent slug (Appearance menu)
    'Templates', // page title
    'Templates', // menu title
    'manage_options', // capability
    'chance-templates', // menu slug
    'chance_render_templates_page' // callback function
);
}
add_action('admin_menu', 'chance_add_templates_submenu_page');

// Patterns submenu: Appearance > Patterns now points at the native wp_block list table (Quick/Bulk Edit + Category/Tags/Used In columns from patterns-admin.php).
// The old grouped Synced/Unsynced overview is archived to a hidden page (admin.php?page=chance-patterns, back-links still work) — no menu entry since its echo'd table can't support inline/bulk editing.
function chance_add_patterns_submenu_page() {
  // Visible menu item -> native list table with full Quick Edit / Bulk Edit.
add_submenu_page(
    'themes.php',                 // parent slug (Appearance menu)
    'Patterns',                   // page title
    'Patterns',                   // menu title
    'edit_posts',                 // capability (matches the native wp_block list)
    'edit.php?post_type=wp_block' // link directly to the native list table
);

  // Archived grouped overview — hidden (parent null), still reachable by URL.
add_submenu_page(
    null,                          // hidden: no menu item rendered
    'Patterns (Grouped Overview)', // page title
    'Patterns (Grouped Overview)', // menu title
    'manage_options',              // capability
    'chance-patterns',             // menu slug (unchanged: existing links still work)
    'chance_render_patterns_page'  // callback function
);
}
add_action('admin_menu', 'chance_add_patterns_submenu_page');

// add submenu page for Template Parts
function chance_add_template_parts_submenu_page() {
add_submenu_page(
    'themes.php', // parent slug (Appearance menu)
    'Parts', // page title
    'Parts', // menu title
    'manage_options', // capability
    'chance-parts', // menu slug
    'chance_render_template_parts_page' // callback function
);
}
add_action('admin_menu', 'chance_add_template_parts_submenu_page');

// Moving Themes from Appearance to Settings is handled in inc/submenus.php (a second, independently-broken copy of this feature lived here — removed).

// render templates page
function chance_render_templates_page() {
  // Get template files from the theme
  $theme         = wp_get_theme();
  $theme_root    = $theme->get_theme_root();
  $theme_slug    = $theme->get_stylesheet();
  $templates_dir = $theme_root . '/' . $theme_slug . '/templates';

  $template_files = [];
  if (is_dir($templates_dir)) {
    $files = scandir($templates_dir);
    foreach ($files as $file) {
      if (str_ends_with($file, '.html')) {
        $template_files[] = [
          'title'  => ucfirst(str_replace(['-', '.html'], [' ', ''], $file)),
          'slug'   => str_replace('.html', '', $file),
          'source' => 'theme',
          'date'   => gmdate('Y-m-d H:i:s', filemtime($templates_dir . '/' . $file)),
        ];
      }
    }
  }

  // Get templates from database
$db_templates = get_posts(
    [
    'post_type'      => 'wp_template',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    ]
);

  // Merge templates, database takes precedence
  $templates       = [];
  $processed_slugs = [];

  // Add database templates first
  foreach ($db_templates as $template) {
    $templates[]       = [
      'title'  => $template->post_title,
      'slug'   => $template->post_name,
      'source' => 'database',
      'date'   => $template->post_date,
      'id'     => $template->ID,
    ];
    $processed_slugs[] = $template->post_name;
  }

  // Add theme templates (skip if already in database)
  foreach ($template_files as $file) {
    if ( ! in_array($file['slug'], $processed_slugs)) {
      $templates[] = $file;
    }
  }

  // Sort by title
usort(
    $templates,
    function ($a, $b) {
    return strcmp($a['title'], $b['title']);
    }
);
?>
  <div class="wrap">
    <h1>Templates</h1>
    <?php if (empty($templates)) : ?>
      <p><em>No templates found.</em></p>
    <?php endif; ?>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Slug</th>
          <th scope="col">Created</th>
          <th scope="col">Source</th>
        </tr>
      </thead>
      <tbody>
        <?php if ( ! empty($templates)) : ?>
          <?php foreach ($templates as $template) : ?>
            <tr>
              <td>
                <strong><a href="<?php echo esc_url(admin_url('site-editor.php?p=' . urlencode('/wp_template/chance-ollie//' . $template['slug']) . '&canvas=edit')); ?>" target="_blank" rel="noopener"><?php echo esc_html($template['title']); ?><span class="screen-reader-text"> (opens in a new tab)</span></a></strong>
              </td>
              <td><?php echo esc_html($template['slug']); ?></td>
              <td><?php echo esc_html($template['date']); ?></td>
              <td>
                <span style="font-size: 0.85em; background: <?php echo $template['source'] === 'database' ? '#d5e9ff' : '#e8f5e9'; ?>; padding: 2px 8px; border-radius: 3px;">
                  <?php echo esc_html(ucfirst($template['source'])); ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="4">No templates found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php
}

// render patterns page
function chance_render_patterns_page() {
  // Check for category / tag filters
  $filter_category = isset($_GET['pattern_category']) ? sanitize_text_field(wp_unslash($_GET['pattern_category'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.
  $filter_tag      = isset($_GET['pattern_tag']) ? sanitize_text_field(wp_unslash($_GET['pattern_tag'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only admin page render / list filter; no state change in this file.

  // Get registered patterns from WordPress registry
  $registry            = WP_Block_Patterns_Registry::get_instance();
  $registered_patterns = $registry->get_all_registered();

  // Build a map of registered patterns by slug
  $registered_map = [];
  foreach ($registered_patterns as $pattern) {
    $slug                  = str_replace('chance-ollie/', '', $pattern['name']);
    $categories            = isset($pattern['categories']) ? $pattern['categories'] : [];
    $registered_map[$slug] = [
      'categories' => $categories,
      'synced'     => true,
    ];
  }

  // Get pattern files from the theme
  $theme        = wp_get_theme();
  $theme_root   = $theme->get_theme_root();
  $theme_slug   = $theme->get_stylesheet();
  $patterns_dir = $theme_root . '/' . $theme_slug . '/patterns';

  $pattern_files = [];
  if (is_dir($patterns_dir)) {
    $files = scandir($patterns_dir);
    foreach ($files as $file) {
      if (str_ends_with($file, '.html')) {
        $file_slug       = str_replace('.html', '', $file);
        $categories      = isset($registered_map[$file_slug]) ? $registered_map[$file_slug]['categories'] : [];
        $pattern_files[] = [
          'title'      => ucfirst(str_replace(['-', '.html'], [' ', ''], $file)),
          'slug'       => $file_slug,
          'source'     => 'theme',
          'id'         => null,
          'categories' => $categories,
          'synced'     => isset($registered_map[$file_slug]) ? true : false,
        ];
      }
    }
  }

  // Get all patterns from database
$db_patterns = get_posts(
    [
    'post_type'      => 'wp_block',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    ]
);

  // Merge patterns, database takes precedence
  $patterns        = [];
  $processed_slugs = [];

  // Add database patterns first
  foreach ($db_patterns as $pattern) {
    // Check sync status
    $sync_status = get_post_meta($pattern->ID, 'wp_pattern_sync_status', true);
    $is_synced   = empty($sync_status);

    // Get categories from wp_pattern_category taxonomy (as objects)
    $categories    = wp_get_post_terms($pattern->ID, 'wp_pattern_category');
    $category_list = [];
    if (is_array($categories) && ! empty($categories)) {
      foreach ($categories as $cat) {
        $category_list[] = [
          'name' => $cat->name,
          'slug' => $cat->slug,
        ];
      }
    }

    // If no taxonomy categories, check registered pattern
    if (empty($category_list) && isset($registered_map[$pattern->post_name])) {
      foreach ($registered_map[$pattern->post_name]['categories'] as $cat_slug) {
        $category_list[] = [
          'name' => ucfirst(str_replace('-', ' ', $cat_slug)),
          'slug' => $cat_slug,
        ];
      }
    }

    // Get tags (post_tag taxonomy, registered for wp_block by patterns-admin.php)
    $raw_tags = wp_get_post_terms($pattern->ID, 'post_tag');
    $tag_list = [];
    if ( ! is_wp_error($raw_tags)) {
      foreach ($raw_tags as $tag) {
        $tag_list[] = ['name' => $tag->name, 'slug' => $tag->slug];
      }
    }

    $usage_count = function_exists('ct_get_all_pattern_usage_counts')
      ? (ct_get_all_pattern_usage_counts()[$pattern->ID] ?? 0)
      : 0;

    $patterns[]        = [
      'title'       => $pattern->post_title,
      'slug'        => $pattern->post_name,
      'source'      => 'database',
      'id'          => $pattern->ID,
      'synced'      => $is_synced,
      'categories'  => $category_list,
      'tags'        => $tag_list,
      'usage_count' => $usage_count,
    ];
    $processed_slugs[] = $pattern->post_name;
  }

  // Add theme patterns (skip if already in database)
  foreach ($pattern_files as $file) {
    if ( ! in_array($file['slug'], $processed_slugs)) {
      $category_list = [];
      foreach ($file['categories'] as $cat_slug) {
        $category_list[] = [
          'name' => ucfirst(str_replace('-', ' ', $cat_slug)),
          'slug' => $cat_slug,
        ];
      }
      $patterns[] = [
        'title'       => $file['title'],
        'slug'        => $file['slug'],
        'source'      => $file['source'],
        'id'          => $file['id'],
        'categories'  => $category_list,
        'synced'      => $file['synced'],
        'tags'        => [],
        'usage_count' => 0,
      ];
    }
  }

  // Sort by title
usort(
    $patterns,
    function ($a, $b) {
    return strcmp($a['title'], $b['title']);
    }
);

  // Filter by category if specified
  if ( ! empty($filter_category)) {
    $patterns = array_filter(
        $patterns,
        function ($p) use ($filter_category) {
        foreach ($p['categories'] as $cat) {
          if ($cat['slug'] === $filter_category) {
            return true;
          }
        }
        return false;
        }
    );
  }

  // Filter by tag if specified
  if ( ! empty($filter_tag)) {
    $patterns = array_filter(
        $patterns,
        function ($p) use ($filter_tag) {
        foreach ($p['tags'] as $tag) {
          if ($tag['slug'] === $filter_tag) {
            return true;
          }
        }
        return false;
        }
    );
  }

  // Separate synced and unsynced
$synced_patterns   = array_filter(
    $patterns,
    function ($p) {
    return $p['synced'] === true;
    }
);
$unsynced_patterns = array_filter(
    $patterns,
    function ($p) {
    return $p['synced'] === false;
    }
);

  // Group patterns by category
  $group_patterns_by_category = function ($patterns_list) {
    $grouped = [];
    foreach ($patterns_list as $pattern) {
      if (empty($pattern['categories'])) {
        // Add uncategorized patterns
        if ( ! isset($grouped['Uncategorized'])) {
          $grouped['Uncategorized'] = [];
        }
        $grouped['Uncategorized'][] = $pattern;
      } else {
        // Add pattern to each of its categories
        foreach ($pattern['categories'] as $cat) {
          if ( ! isset($grouped[$cat['name']])) {
            $grouped[$cat['name']] = [];
          }
          $grouped[$cat['name']][] = $pattern;
        }
      }
    }
    // Sort by category name
    ksort($grouped);
    return $grouped;
  };

  $synced_grouped   = $group_patterns_by_category($synced_patterns);
  $unsynced_grouped = $group_patterns_by_category($unsynced_patterns);
?>
  <div class="wrap">
    <h1>Patterns &mdash; Grouped Overview
      <a href="<?php echo esc_url(admin_url('edit.php?post_type=wp_block')); ?>" class="page-title-action">All Patterns (editable list)</a>
      <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=wp_pattern_category&post_type=wp_block')); ?>" class="page-title-action">Manage Categories</a>
    </h1>
    <p class="description">Read-only overview grouped by sync status and category. To edit categories or tags (including Quick Edit and Bulk Edit), use <a href="<?php echo esc_url(admin_url('edit.php?post_type=wp_block')); ?>">All Patterns</a>.</p>
    <?php if ( ! empty($filter_category)) : ?>
      <p>
        Filtering by category: <strong><?php echo esc_html(ucfirst(str_replace('-', ' ', $filter_category))); ?></strong>
        <a href="<?php echo esc_url(admin_url('admin.php?page=chance-patterns')); ?>">Clear filter</a>
      </p>
    <?php endif; ?>
    <?php if ( ! empty($filter_tag)) : ?>
      <p>
        Filtering by tag: <strong><?php echo esc_html($filter_tag); ?></strong>
        <a href="<?php echo esc_url(admin_url('admin.php?page=chance-patterns')); ?>">Clear filter</a>
      </p>
    <?php endif; ?>

    <h2>Synced Patterns (<?php echo count($synced_patterns); ?>)</h2>
    <?php foreach ($synced_grouped as $category_name => $category_patterns) : ?>
      <h3 style="margin-top: 20px; font-size: 14px; color: #555;"><?php echo esc_html($category_name); ?> (<?php echo count($category_patterns); ?>)</h3>
      <table class="wp-list-table widefat fixed striped">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Categories</th>
            <th scope="col">Tags</th>
            <th>Used In</th>
            <th scope="col">Source</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($category_patterns as $pattern) : ?>
            <tr>
              <td>
                <strong>
                  <?php if ($pattern['source'] === 'database') : ?>
                    <a href="<?php echo esc_url(admin_url('post.php?post=' . $pattern['id'] . '&action=edit')); ?>" target="_blank" rel="noopener"><?php echo esc_html($pattern['title']); ?><span class="screen-reader-text"> (opens in a new tab)</span></a>
                  <?php else : ?>
                    <a href="<?php echo esc_url(admin_url('site-editor.php?p=' . urlencode('/wp_block/chance-ollie//' . $pattern['slug']) . '&canvas=edit')); ?>" target="_blank" rel="noopener"><?php echo esc_html($pattern['title']); ?><span class="screen-reader-text"> (opens in a new tab)</span></a>
                  <?php endif; ?>
                </strong>
              </td>
              <td><?php echo esc_html($pattern['slug']); ?></td>
              <td>
                <?php if ( ! empty($pattern['categories'])) : ?>
                  <?php foreach ($pattern['categories'] as $index => $cat) : ?>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=chance-patterns&pattern_category=' . $cat['slug'])); ?>"><?php echo esc_html($cat['name']); ?></a><?php echo ($index < count($pattern['categories']) - 1) ? ', ' : ''; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if ( ! empty($pattern['tags'])) : ?>
                  <?php foreach ($pattern['tags'] as $index => $tag) : ?>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=chance-patterns&pattern_tag=' . $tag['slug'])); ?>"><?php echo esc_html($tag['name']); ?></a><?php echo ($index < count($pattern['tags']) - 1) ? ', ' : ''; ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <span style="color:#646970">—</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($pattern['source'] === 'database' && ! empty($pattern['usage_count'])) : ?>
                  <a href="<?php echo esc_url(admin_url('admin.php?page=ct-pattern-usage&id=' . $pattern['id'])); ?>"><?php echo (int) $pattern['usage_count']; ?></a>
                <?php elseif ($pattern['source'] === 'database') : ?>
                  <span style="color:#646970">0</span>
                <?php else : ?>
                  <span style="color:#646970">n/a</span>
                <?php endif; ?>
              </td>
              <td>
                <span style="font-size: 0.85em; background: <?php echo $pattern['source'] === 'database' ? '#d5e9ff' : '#e8f5e9'; ?>; padding: 2px 8px; border-radius: 3px;">
                  <?php echo esc_html(ucfirst($pattern['source'])); ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endforeach; ?>

    <h2>Unsynced Patterns (<?php echo count($unsynced_patterns); ?>)</h2>
    <?php foreach ($unsynced_grouped as $category_name => $category_patterns) : ?>
      <h3 style="margin-top: 20px; font-size: 14px; color: #555;"><?php echo esc_html($category_name); ?> (<?php echo count($category_patterns); ?>)</h3>
      <table class="wp-list-table widefat fixed striped">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Categories</th>
            <th scope="col">Tags</th>
            <th>Used In</th>
            <th scope="col">Source</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($category_patterns as $pattern) : ?>
            <tr>
              <td>
                <strong>
                  <?php if ($pattern['source'] === 'database') : ?>
                    <a href="<?php echo esc_url(admin_url('post.php?post=' . $pattern['id'] . '&action=edit')); ?>" target="_blank" rel="noopener"><?php echo esc_html($pattern['title']); ?><span class="screen-reader-text"> (opens in a new tab)</span></a>
                  <?php else : ?>
                    <a href="<?php echo esc_url(admin_url('site-editor.php?p=' . urlencode('/wp_block/chance-ollie//' . $pattern['slug']) . '&canvas=edit')); ?>" target="_blank" rel="noopener"><?php echo esc_html($pattern['title']); ?><span class="screen-reader-text"> (opens in a new tab)</span></a>
                  <?php endif; ?>
                </strong>
              </td>
              <td><?php echo esc_html($pattern['slug']); ?></td>
              <td>
                <?php if ( ! empty($pattern['categories'])) : ?>
                  <?php foreach ($pattern['categories'] as $index => $cat) : ?>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=chance-patterns&pattern_category=' . $cat['slug'])); ?>"><?php echo esc_html($cat['name']); ?></a><?php echo ($index < count($pattern['categories']) - 1) ? ', ' : ''; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if ( ! empty($pattern['tags'])) : ?>
                  <?php foreach ($pattern['tags'] as $index => $tag) : ?>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=chance-patterns&pattern_tag=' . $tag['slug'])); ?>"><?php echo esc_html($tag['name']); ?></a><?php echo ($index < count($pattern['tags']) - 1) ? ', ' : ''; ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <span style="color:#646970">—</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($pattern['source'] === 'database' && ! empty($pattern['usage_count'])) : ?>
                  <a href="<?php echo esc_url(admin_url('admin.php?page=ct-pattern-usage&id=' . $pattern['id'])); ?>"><?php echo (int) $pattern['usage_count']; ?></a>
                <?php elseif ($pattern['source'] === 'database') : ?>
                  <span style="color:#646970">0</span>
                <?php else : ?>
                  <span style="color:#646970">n/a</span>
                <?php endif; ?>
              </td>
              <td>
                <span style="font-size: 0.85em; background: <?php echo $pattern['source'] === 'database' ? '#d5e9ff' : '#e8f5e9'; ?>; padding: 2px 8px; border-radius: 3px;">
                  <?php echo esc_html(ucfirst($pattern['source'])); ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endforeach; ?>
  </div>
<?php
}

// render template parts page
function chance_render_template_parts_page() {
  // Get template part files from the theme
  $theme      = wp_get_theme();
  $theme_root = $theme->get_theme_root();
  $theme_slug = $theme->get_stylesheet();
  $parts_dir  = $theme_root . '/' . $theme_slug . '/parts';

  $part_files = [];
  if (is_dir($parts_dir)) {
    $files = scandir($parts_dir);
    foreach ($files as $file) {
      if (str_ends_with($file, '.html')) {
        $part_files[] = [
          'title'  => ucfirst(str_replace(['-', '.html'], [' ', ''], $file)),
          'slug'   => str_replace('.html', '', $file),
          'source' => 'theme',
          'date'   => gmdate('Y-m-d H:i:s', filemtime($parts_dir . '/' . $file)),
        ];
      }
    }
  }

  // Get template parts from database
$db_parts = get_posts(
    [
    'post_type'      => 'wp_template_part',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    ]
);

  // Merge template parts, database takes precedence
  $template_parts  = [];
  $processed_slugs = [];

  // Add database template parts first
  foreach ($db_parts as $part) {
    $template_parts[]  = [
      'title'  => $part->post_title,
      'slug'   => $part->post_name,
      'source' => 'database',
      'date'   => $part->post_date,
      'id'     => $part->ID,
    ];
    $processed_slugs[] = $part->post_name;
  }

  // Add theme template part files (skip if already in database)
  foreach ($part_files as $file) {
    if ( ! in_array($file['slug'], $processed_slugs)) {
      $template_parts[] = $file;
    }
  }

  // Sort by title
usort(
    $template_parts,
    function ($a, $b) {
    return strcmp($a['title'], $b['title']);
    }
);
?>
  <div class="wrap">
    <h1>Parts</h1>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Slug</th>
          <th scope="col">Created</th>
          <th scope="col">Source</th>
        </tr>
      </thead>
      <tbody>
        <?php if ( ! empty($template_parts)) : ?>
          <?php foreach ($template_parts as $part) : ?>
            <tr>
              <td>
                <strong><a href="<?php echo esc_url(admin_url('site-editor.php?p=' . urlencode('/wp_template_part/chance-ollie//' . $part['slug']) . '&canvas=edit')); ?>" target="_blank" rel="noopener"><?php echo esc_html($part['title']); ?><span class="screen-reader-text"> (opens in a new tab)</span></a></strong>
              </td>
              <td><?php echo esc_html($part['slug']); ?></td>
              <td><?php echo esc_html($part['date']); ?></td>
              <td>
                <span style="font-size: 0.85em; background: <?php echo $part['source'] === 'database' ? '#d5e9ff' : '#e8f5e9'; ?>; padding: 2px 8px; border-radius: 3px;">
                  <?php echo esc_html(ucfirst($part['source'])); ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="4">No template parts found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php
}
