<?php

/**
 * Group/Columns Block Overflow Clip — adds a "Clip overflow" toggle to the Group and Columns blocks' Advanced panel that renders `overflow: clip` (plus an optional `overflow-clip-margin`) on the wrapper.
 * `clip` rather than `hidden` on purpose: `hidden` makes the Group a scroll container, which traps every `position: sticky` descendant (the 2026-08-08 sitewide sticky bug); `clip` clips identically without creating one.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

const CHANCE_OVERFLOW_CLIP_BLOCKS = ['core/group', 'core/columns'];

/**
 * Register the overflow attributes server-side so render_block sees them with their defaults.
 */
function chance_register_overflow_attributes($settings, $name) {
  if ( ! in_array($name, CHANCE_OVERFLOW_CLIP_BLOCKS, true)) {
    return $settings;
  }

  if ( ! isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['overflowClip'] = [
    'type'    => 'boolean',
    'default' => false,
  ];

  $settings['attributes']['overflowClipMargin'] = [
    'type'    => 'string',
    'default' => '',
  ];

  return $settings;
}
add_filter('register_block_type_args', 'chance_register_overflow_attributes', 10, 2);

/**
 * Mirror chance_register_overflow_attributes() on the client, attached to 'wp-blocks' so it runs before core/group and core/columns register — same ordering reason as chance_inline_position_attribute_filter(). Without it the attributes aren't declared client-side and never get serialized into the block comment.
 */
function chance_inline_overflow_attribute_filter() {
  $blocks = wp_json_encode(CHANCE_OVERFLOW_CLIP_BLOCKS);

  $js = <<<JS
wp.hooks.addFilter('blocks.registerBlockType', 'chance/add-overflow-attributes', function (settings, name) {
  if ({$blocks}.indexOf(name) === -1) {
    return settings;
  }
  settings.attributes = Object.assign({}, settings.attributes, {
    overflowClip: { type: 'boolean', default: false },
    overflowClipMargin: { type: 'string', default: '' }
  });
  return settings;
});
JS;

  wp_add_inline_script('wp-blocks', $js, 'after');
}
add_action('enqueue_block_editor_assets', 'chance_inline_overflow_attribute_filter', 5);

/**
 * Apply the overflow styles to the block wrapper on render. Done here rather than in save() so the saved markup is untouched — toggling the option (or deactivating the plugin) never invalidates existing Group/Columns blocks.
 */
function chance_apply_overflow_style($block_content, $block) {
  if (empty($block['attrs']['overflowClip']) || ! in_array($block['blockName'] ?? '', CHANCE_OVERFLOW_CLIP_BLOCKS, true)) {
    return $block_content;
  }

  $css = 'overflow: clip;';

  // overflow-clip-margin takes a non-negative length only (no %); empty means the CSS default of 0.
  $margin = $block['attrs']['overflowClipMargin'] ?? '';
  if ('' !== $margin && preg_match('/^\d*\.?\d+(px|em|rem|vh|vw|vmin|vmax|ch|ex|cm|mm|in|pt|pc)?$/', $margin)) {
    $css .= ' overflow-clip-margin: ' . $margin . ';';
  }

  $processor = new WP_HTML_Tag_Processor($block_content);

  if ($processor->next_tag()) {
    $existing_style = $processor->get_attribute('style');
    $existing_style = is_string($existing_style) ? rtrim(trim($existing_style), ';') : '';

    // set_attribute() escapes the value itself, so no esc_attr() here.
    $processor->set_attribute('style', ('' !== $existing_style ? $existing_style . '; ' : '') . $css);
  }

  return $processor->get_updated_html();
}
add_filter('render_block', 'chance_apply_overflow_style', 10, 2);
