<?php

/**
 * Screen Reader Only Block Support — adds a toggle to heading/paragraph blocks that applies an sr-only class when enabled.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

/**
 * Register srOnly attribute on core heading and paragraph blocks
 */
function chance_register_sr_only_attribute($settings, $name) {
  // Only apply to heading and paragraph blocks
  $target_blocks = [
    'core/heading',
    'core/paragraph',
  ];

  if ( ! in_array($name, $target_blocks, true)) {
    return $settings;
  }

  // Add srOnly to block attributes
  if ( ! isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['srOnly'] = [
    'type'    => 'boolean',
    'default' => false,
  ];

  // Ensure block supports the attribute
  if ( ! isset($settings['supports'])) {
    $settings['supports'] = [];
  }

  // Mark that this block should support sr-only
  $settings['supports']['srOnly'] = true;

  return $settings;
}
add_filter('register_block_type_args', 'chance_register_sr_only_attribute', 10, 2);

/**
 * Apply sr-only class to block wrapper when srOnly attribute is true
 */
function chance_apply_sr_only_class($block_content, $block) {
  // Only process heading and paragraph blocks
  $target_blocks = ['core/heading', 'core/paragraph'];

  if ( ! in_array($block['blockName'], $target_blocks, true)) {
    return $block_content;
  }

  // Check if srOnly attribute is set to true
  if (empty($block['attrs']['srOnly'])) {
    return $block_content;
  }

  // WP_HTML_Tag_Processor is a real HTML parser, so it handles the cases the previous regex had to
  // guard by hand: quoted values containing `>`, single vs double quotes, and an existing class list.
  $processor = new WP_HTML_Tag_Processor($block_content);

  while ($processor->next_tag()) {
    if (in_array($processor->get_tag(), ['H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'P'], true)) {
      $processor->add_class('sr-only');
      break;
    }
  }

  return $processor->get_updated_html();
}
add_filter('render_block', 'chance_apply_sr_only_class', 10, 2);
