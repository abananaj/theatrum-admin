<?php

/**
 * Custom CSS Support for All Blocks
 * 
 * Adds a custom CSS field to the styles panel for all WordPress blocks
 * in the Site Editor and block editor. Allows per-block custom styling.
 */

// Enqueue custom CSS editor script and styles
function chance_enqueue_block_custom_css_assets()
{
  $script_dist_path = plugin_dir_path(dirname(__FILE__)) . 'dist/block-custom-css.js';

  // Only enqueue in editor context
  if (!is_admin() && !did_action('enqueue_block_editor_assets')) {
    return;
  }

  if (! file_exists($script_dist_path)) {
    return;
  }

  // Register and enqueue the block custom CSS editor script
  wp_register_script(
    'chance-block-custom-css',
    plugin_dir_url(dirname(__FILE__)) . 'dist/block-custom-css.js',
    ['wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-edit-site'],
    filemtime($script_dist_path),
    false
  );

  wp_enqueue_script('chance-block-custom-css');
}
add_action('enqueue_block_editor_assets', 'chance_enqueue_block_custom_css_assets');

/**
 * Register custom CSS attribute on all blocks
 * 
 * This hook modifies each block's settings to include a customCSS attribute
 */
function chance_register_custom_css_attribute($settings, $name)
{
  // Skip certain blocks that don't support custom CSS well
  $excluded_blocks = ['core/freeform', 'core/html'];

  if (in_array($name, $excluded_blocks, true)) {
    return $settings;
  }

  // Add customCSS to block attributes
  if (!isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['customCSS'] = [
    'type' => 'string',
    'default' => '',
  ];

  // Ensure block supports the attribute
  if (!isset($settings['supports'])) {
    $settings['supports'] = [];
  }

  // Mark that this block should support custom CSS
  $settings['supports']['customCSS'] = true;

  return $settings;
}
add_filter('register_block_type_args', 'chance_register_custom_css_attribute', 10, 2);

/**
 * Output custom CSS for blocks on the frontend
 * 
 * Loops through post content and extracts custom CSS from block attributes,
 * outputting it in a style tag
 */
function chance_output_block_custom_css()
{
  global $post;

  if (!is_singular() || !$post) {
    return;
  }

  $content = $post->post_content;

  if (empty($content)) {
    return;
  }

  // Parse blocks and collect custom CSS
  $blocks = parse_blocks($content);
  $custom_css = chance_collect_custom_css_from_blocks($blocks);

  if (!empty($custom_css)) {
    echo '<style id="chance-block-custom-css">';
    echo wp_kses_post($custom_css);
    echo '</style>';
  }
}

/**
 * Recursively collect custom CSS from blocks
 */
function chance_collect_custom_css_from_blocks($blocks, $prefix = '')
{
  $css = '';
  $block_counter = 0;

  foreach ($blocks as $block) {
    $block_counter++;

    if (isset($block['attrs']['customCSS']) && !empty($block['attrs']['customCSS'])) {
      // Generate a unique class for this block based on position
      $block_class = 'wp-block-' . sanitize_html_class(str_replace('/', '-', $block['blockName'] ?? 'unknown')) . '-' . $block_counter;

      // Create CSS with the block's unique class
      $custom_css_content = $block['attrs']['customCSS'];

      // If the CSS doesn't have a selector, wrap it with the block's class
      if (!preg_match('/^[\s\n]*[.#\[]/', $custom_css_content)) {
        $css .= sprintf(
          '.%s { %s }',
          esc_attr($block_class),
          wp_kses_post($custom_css_content)
        );
      } else {
        // If the CSS already has selectors, use it as-is
        $css .= wp_kses_post($custom_css_content);
      }

      $css .= "\n";
    }

    // Recursively process inner blocks
    if (!empty($block['innerBlocks'])) {
      $css .= chance_collect_custom_css_from_blocks(
        $block['innerBlocks'],
        $prefix . $block_counter . '-'
      );
    }
  }

  return $css;
}
add_action('wp_head', 'chance_output_block_custom_css', 15);

/**
 * Also handle Site Editor (Full Site Editing) custom CSS
 * Render custom CSS in Site Editor frontend context
 */
function chance_handle_site_editor_custom_css()
{
  // This will be handled by the frontend CSS collection hook above
  // when viewing the site with Site Editor styles applied
}
