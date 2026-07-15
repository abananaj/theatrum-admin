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

require_once THEATRUM_ADMIN_DIR . 'submenus.php';
require_once THEATRUM_ADMIN_DIR . 'media-library-assistant.php';
// block-custom-css.php: per-block custom CSS field, parked pending a product
// decision on whether to expose it to editors. Implementation is complete and
// its CSS sanitization is safe to use — see the file header for details.
// require_once THEATRUM_ADMIN_DIR . 'block-custom-css.php';
require_once THEATRUM_ADMIN_DIR . 'block-row-customization.php';
require_once THEATRUM_ADMIN_DIR . 'patterns-admin.php';
require_once THEATRUM_ADMIN_DIR . 'design-system.php';
require_once THEATRUM_ADMIN_DIR . 'sr-only-blocks.php';
require_once THEATRUM_ADMIN_DIR . 'position-controls.php';

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
 * Enqueue Position block editor script (outer editor UI — block filters)
 */
function chance_enqueue_position_editor_script()
{
  $script_dist_path = plugin_dir_path(__FILE__) . 'dist/position-controls.js';

  if (file_exists($script_dist_path)) {
    wp_enqueue_script(
      'chance-position-controls',
      plugin_dir_url(__FILE__) . 'dist/position-controls.js',
      ['wp-blocks', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-hooks'],
      filemtime($script_dist_path),
      true
    );
  }
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_position_editor_script');

/**
 * Enqueue custom RichText format editor script (Inline Quote, Small Text, Span)
 */
function chance_enqueue_custom_formats_editor_script()
{
  $script_dist_path = plugin_dir_path(__FILE__) . 'dist/custom-formats.js';

  if (file_exists($script_dist_path)) {
    wp_enqueue_script(
      'chance-custom-formats',
      plugin_dir_url(__FILE__) . 'dist/custom-formats.js',
      ['wp-block-editor', 'wp-rich-text', 'wp-element', 'wp-components', 'wp-icons'],
      filemtime($script_dist_path),
      true
    );
  }
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_custom_formats_editor_script');

/**
 * Enqueue the Group block <hgroup> toggle editor script
 */
function chance_enqueue_hgroup_control_editor_script()
{
  $script_dist_path = plugin_dir_path(__FILE__) . 'dist/hgroup-control.js';

  if (file_exists($script_dist_path)) {
    wp_enqueue_script(
      'chance-hgroup-control',
      plugin_dir_url(__FILE__) . 'dist/hgroup-control.js',
      ['wp-block-editor', 'wp-components', 'wp-element', 'wp-hooks'],
      filemtime($script_dist_path),
      true
    );
  }
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_hgroup_control_editor_script');

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
