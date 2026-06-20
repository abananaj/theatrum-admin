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
require_once THEATRUM_ADMIN_DIR . 'patterns-admin.php';
require_once THEATRUM_ADMIN_DIR . 'design-system.php';
require_once THEATRUM_ADMIN_DIR . 'sr-only-blocks.php';

/**
 * Enqueue SR-Only block editor script (outer editor UI — block filters)
 */
function chance_enqueue_sr_only_editor_script()
{
  $script_dist_path = plugin_dir_path(__FILE__) . 'dist/sr-only-blocks.js';

  if (file_exists($script_dist_path)) {
    wp_enqueue_script(
      'chance-sr-only-blocks',
      plugin_dir_url(__FILE__) . 'dist/sr-only-blocks.js',
      ['wp-blocks', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-hooks'],
      filemtime($script_dist_path),
      true
    );
  }
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_sr_only_editor_script');

/**
 * Enqueue SR-Only styles into the block editor iFrame and on the frontend
 */
function chance_enqueue_sr_only_styles()
{
  $style_dist_path = plugin_dir_path(__FILE__) . 'dist/sr-only-blocks.css';

  if (file_exists($style_dist_path)) {
    wp_enqueue_style(
      'chance-sr-only-styles',
      plugin_dir_url(__FILE__) . 'dist/sr-only-blocks.css',
      [],
      filemtime($style_dist_path)
    );
  }
}
add_action('enqueue_block_assets', 'chance_enqueue_sr_only_styles');
add_action('wp_enqueue_scripts', 'chance_enqueue_sr_only_styles');
