<?php

/**
 * Row Block HTML Element Customization — adds <p> as an HTML element option for the Row block in the block editor.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

function chance_enqueue_row_block_customization() {
  $script_dist_path = plugin_dir_path(dirname(__FILE__)) . 'dist/block-row-customization.js';

  // Only enqueue in editor context
  if ( ! is_admin() && ! did_action('enqueue_block_editor_assets')) {
    return;
  }

  // Check if the script exists
  if ( ! file_exists($script_dist_path)) {
    return;
  }

  // Register and enqueue the Row block customization script
wp_register_script(
    'chance-block-row-customization',
    plugin_dir_url(dirname(__FILE__)) . 'dist/block-row-customization.js',
    ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
    filemtime($script_dist_path),
    false
);

  wp_enqueue_script('chance-block-row-customization');
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_row_block_customization');
