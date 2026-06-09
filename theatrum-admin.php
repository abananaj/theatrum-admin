<?php

/**
 * Plugin Name: Theatrum Admin
 * Plugin URI:  https://chancetheatre.com
 * Description: WP admin interface customizations for Chance Theater — custom columns, submenus, block CSS, and design system pages.
 * Version:     1.0.0
 * Author:      Chance Theater
 * Text Domain: chance-theater
 */

if (! defined('ABSPATH')) {
  exit;
}

define('THEATRUM_ADMIN_DIR', plugin_dir_path(__FILE__) . 'inc/');

// require_once THEATRUM_ADMIN_DIR . 'artist-all.php';
// require_once THEATRUM_ADMIN_DIR . 'class-all.php';
// require_once THEATRUM_ADMIN_DIR . 'event-all.php';
// require_once THEATRUM_ADMIN_DIR . 'production-all.php';
// require_once THEATRUM_ADMIN_DIR . 'supporter-all.php';
require_once THEATRUM_ADMIN_DIR . 'submenus.php';
// require_once THEATRUM_ADMIN_DIR . 'block-custom-css.php';
require_once THEATRUM_ADMIN_DIR . 'block-row-customization.php';
require_once THEATRUM_ADMIN_DIR . 'design-system.php';
require_once THEATRUM_ADMIN_DIR . 'sr-only-blocks.php';

/**
 * Enqueue SR-Only blocks editor script and styles
 */
function chance_enqueue_sr_only_assets()
{
  $script_dist_path = plugin_dir_path(__FILE__) . 'dist/sr-only-blocks.js';
  $style_dist_path = plugin_dir_path(__FILE__) . 'dist/sr-only-blocks.css';

  // Only enqueue in editor context
  if (!is_admin()) {
    return;
  }

  // Enqueue JS for block editor
  if (file_exists($script_dist_path)) {
    wp_register_script(
      'chance-sr-only-blocks',
      plugin_dir_url(__FILE__) . 'dist/sr-only-blocks.js',
      [
        'wp-blocks',
        'wp-block-editor',
        'wp-components',
        'wp-data',
        'wp-hooks',
      ],
      filemtime($script_dist_path),
      true
    );

    wp_enqueue_script('chance-sr-only-blocks');
  }

  // Enqueue CSS for editor and frontend
  if (file_exists($style_dist_path)) {
    wp_register_style(
      'chance-sr-only-styles',
      plugin_dir_url(__FILE__) . 'dist/sr-only-blocks.css',
      [],
      filemtime($style_dist_path)
    );

    wp_enqueue_style('chance-sr-only-styles');
  }
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_sr_only_assets');
