<?php

/**
 * Group/Columns Block Z-Index — adds a "Z-index" field to the Group (incl. its Row/Stack/Grid variations) and Columns blocks' Advanced panel that renders `z-index` on the wrapper.
 * z-index is ignored on statically positioned boxes (unless they're flex/grid items), so the wrapper also gets `position: relative` — unless the block already uses core's Position support (sticky/fixed), which must win.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

const CHANCE_Z_INDEX_BLOCKS = ['core/group', 'core/columns'];

/**
 * Register the zIndex attribute server-side so render_block sees it with its default.
 * Stored as a string so "unset" ('') is distinct from 0.
 */
function chance_register_z_index_attribute($settings, $name) {
  if ( ! in_array($name, CHANCE_Z_INDEX_BLOCKS, true)) {
    return $settings;
  }

  if ( ! isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['zIndex'] = [
    'type'    => 'string',
    'default' => '',
  ];

  return $settings;
}
add_filter('register_block_type_args', 'chance_register_z_index_attribute', 10, 2);

/**
 * Mirror chance_register_z_index_attribute() on the client, attached to 'wp-blocks' so it runs before core/group and core/columns register — same ordering reason as chance_inline_overflow_attribute_filter().
 */
function chance_inline_z_index_attribute_filter() {
  $blocks = wp_json_encode(CHANCE_Z_INDEX_BLOCKS);

  $js = <<<JS
wp.hooks.addFilter('blocks.registerBlockType', 'chance/add-z-index-attribute', function (settings, name) {
  if ({$blocks}.indexOf(name) === -1) {
    return settings;
  }
  settings.attributes = Object.assign({}, settings.attributes, {
    zIndex: { type: 'string', default: '' }
  });
  return settings;
});
JS;

  wp_add_inline_script('wp-blocks', $js, 'after');
}
add_action('enqueue_block_editor_assets', 'chance_inline_z_index_attribute_filter', 5);

/**
 * Apply z-index to the block wrapper on render. Done here rather than in save() so the saved markup is untouched — changing the value (or deactivating the plugin) never invalidates existing blocks.
 */
function chance_apply_z_index_style($block_content, $block) {
  if ( ! in_array($block['blockName'] ?? '', CHANCE_Z_INDEX_BLOCKS, true)) {
    return $block_content;
  }

  $z_index = $block['attrs']['zIndex'] ?? '';
  if ('' === $z_index || ! preg_match('/^-?\d+$/', $z_index)) {
    return $block_content;
  }

  $css = 'z-index: ' . (int) $z_index . ';';

  // Skip when core's Position support or position-controls.php already positions the box — a later inline `position: relative` would override its absolute/fixed/sticky.
  $has_position = ! empty($block['attrs']['style']['position']['type'])
    || in_array($block['attrs']['positionType'] ?? 'static', ['relative', 'absolute', 'fixed', 'sticky'], true);
  if ( ! $has_position) {
    $css = 'position: relative; ' . $css;
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
add_filter('render_block', 'chance_apply_z_index_style', 10, 2);
