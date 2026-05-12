<?php

//  add submenu page for Templates
function chance_add_templates_submenu_page()
{
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

//  add submenu page for Patterns, grouped by synced and unsynced patterns
function chance_add_patterns_submenu_page()
{
  add_submenu_page(
    'themes.php', // parent slug (Appearance menu)
    'Patterns', // page title
    'Patterns', // menu title
    'manage_options', // capability
    'chance-patterns', // menu slug
    'chance_render_patterns_page' // callback function
  );
}
add_action('admin_menu', 'chance_add_patterns_submenu_page');

//  add submenu page for Template Parts
function chance_add_template_parts_submenu_page()
{
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

// Add Themes submenu to Settings
function chance_add_themes_to_settings()
{
  add_submenu_page(
    'options', // parent slug (Settings menu)
    'Themes', // page title
    'Themes', // menu title
    'switch_themes', // capability
    'chance-themes', // menu slug (unique)
    '__return_null' // no callback needed since we use a direct link below
  );

  // Override the menu link to point directly to themes.php
  global $submenu;
  if (isset($submenu['options'])) {
    foreach ($submenu['options'] as $key => $item) {
      if ($item[2] === 'chance-themes') {
        $submenu['options'][$key][2] = 'themes.php';
        break;
      }
    }
  }
}
add_action('admin_menu', 'chance_add_themes_to_settings');

// render templates page
function chance_render_templates_page()
{
  // Get template files from the theme
  $theme = wp_get_theme();
  $theme_root = $theme->get_theme_root();
  $theme_slug = $theme->get_stylesheet();
  $templates_dir = $theme_root . '/' . $theme_slug . '/templates';

  $template_files = [];
  if (is_dir($templates_dir)) {
    $files = scandir($templates_dir);
    foreach ($files as $file) {
      if (strpos($file, '.html') !== false) {
        $template_files[] = [
          'title' => ucfirst(str_replace(['-', '.html'], [' ', ''], $file)),
          'slug' => str_replace('.html', '', $file),
          'source' => 'theme',
          'date' => date('Y-m-d H:i:s', filemtime($templates_dir . '/' . $file)),
        ];
      }
    }
  }

  // Get templates from database
  $db_templates = get_posts([
    'post_type' => 'wp_template',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  ]);

  // Merge templates, database takes precedence
  $templates = [];
  $processed_slugs = [];

  // Add database templates first
  foreach ($db_templates as $template) {
    $templates[] = [
      'title' => $template->post_title,
      'slug' => $template->post_name,
      'source' => 'database',
      'date' => $template->post_date,
      'id' => $template->ID,
    ];
    $processed_slugs[] = $template->post_name;
  }

  // Add theme templates (skip if already in database)
  foreach ($template_files as $file) {
    if (!in_array($file['slug'], $processed_slugs)) {
      $templates[] = $file;
    }
  }

  // Sort by title
  usort($templates, function ($a, $b) {
    return strcmp($a['title'], $b['title']);
  });
?>
  <div class="wrap">
    <h1>Templates</h1>
    <?php if (empty($templates)) : ?>
      <p><em>No templates found.</em></p>
    <?php endif; ?>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th>Created</th>
          <th>Source</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($templates)) : ?>
          <?php foreach ($templates as $template) : ?>
            <tr>
              <td>
                <strong><a href="<?php echo esc_url(admin_url('site-editor.php?p=' . urlencode('/wp_template/chance-ollie//' . $template['slug']) . '&canvas=edit')); ?>" target="_blank"><?php echo esc_html($template['title']); ?></a></strong>
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
function chance_render_patterns_page()
{
  // Synced patterns: those WITHOUT wp_pattern_sync_status meta
  $synced_pattern_ids = get_posts([
    'post_type' => 'wp_block',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'meta_query' => [
      [
        'key' => 'wp_pattern_sync_status',
        'compare' => 'NOT EXISTS',
      ],
    ],
  ]);

  $synced_patterns = get_posts([
    'post_type' => 'wp_block',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'post__in' => ! empty($synced_pattern_ids) ? $synced_pattern_ids : [0],
  ]);

  // Unsynced patterns: those WITH wp_pattern_sync_status meta
  $unsynced_pattern_ids = get_posts([
    'post_type' => 'wp_block',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'meta_query' => [
      [
        'key' => 'wp_pattern_sync_status',
        'compare' => 'EXISTS',
      ],
    ],
  ]);

  $unsynced_patterns = get_posts([
    'post_type' => 'wp_block',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'post__in' => ! empty($unsynced_pattern_ids) ? $unsynced_pattern_ids : [0],
  ]);
?>
  <div class="wrap">
    <h1>Patterns</h1>

    <h2>Synced Patterns (<?php echo count($synced_patterns); ?>)</h2>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th>Created</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($synced_patterns)) : ?>
          <?php foreach ($synced_patterns as $pattern) : ?>
            <tr>
              <td>
                <strong><a href="<?php echo esc_url(admin_url('post.php?post=' . $pattern->ID . '&action=edit')); ?>" target="_blank"><?php echo esc_html($pattern->post_title); ?></a></strong>
              </td>
              <td><?php echo esc_html($pattern->post_name); ?></td>
              <td><?php echo esc_html($pattern->post_date); ?></td>
              <td><?php echo esc_html(ucfirst($pattern->post_status)); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="4">No synced patterns found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <h2>Unsynced Patterns (<?php echo count($unsynced_patterns); ?>)</h2>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th>Created</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($unsynced_patterns)) : ?>
          <?php foreach ($unsynced_patterns as $pattern) : ?>
            <tr>
              <td>
                <strong><a href="<?php echo esc_url(admin_url('post.php?post=' . $pattern->ID . '&action=edit')); ?>" target="_blank"><?php echo esc_html($pattern->post_title); ?></a></strong>
              </td>
              <td><?php echo esc_html($pattern->post_name); ?></td>
              <td><?php echo esc_html($pattern->post_date); ?></td>
              <td><?php echo esc_html(ucfirst($pattern->post_status)); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="4">No unsynced patterns found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<?php
}

// render template parts page
function chance_render_template_parts_page()
{
  $template_parts = get_posts([
    'post_type' => 'wp_template_part',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  ]);
?>
  <div class="wrap">
    <h1>Parts</h1>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th>Created</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($template_parts)) : ?>
          <?php foreach ($template_parts as $part) :
            $part_path = urlencode('/wp_template_part/chance-ollie//' . $part->post_name);
          ?>
            <tr>
              <td>
                <strong><a href="<?php echo esc_url(admin_url('site-editor.php?p=' . $part_path . '&canvas=edit')); ?>" target="_blank"><?php echo esc_html($part->post_title); ?></a></strong>
              </td>
              <td><?php echo esc_html($part->post_name); ?></td>
              <td><?php echo esc_html($part->post_date); ?></td>
              <td><?php echo esc_html(ucfirst($part->post_status)); ?></td>
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
