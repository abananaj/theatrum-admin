<?php

/**
 * Screen Reader Only Block Support — adds a toggle to heading/paragraph blocks that applies an sr-only class when enabled.
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register srOnly attribute on core heading and paragraph blocks
 */
function chance_register_sr_only_attribute($settings, $name)
{
  // Only apply to heading and paragraph blocks
  $target_blocks = [
    'core/heading',
    'core/paragraph',
  ];

  if (!in_array($name, $target_blocks, true)) {
    return $settings;
  }

  // Add srOnly to block attributes
  if (!isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['srOnly'] = [
    'type' => 'boolean',
    'default' => false,
  ];

  // Ensure block supports the attribute
  if (!isset($settings['supports'])) {
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
function chance_apply_sr_only_class($block_content, $block)
{
  // Only process heading and paragraph blocks
  $target_blocks = ['core/heading', 'core/paragraph'];

  if (!in_array($block['blockName'], $target_blocks, true)) {
    return $block_content;
  }

  // Check if srOnly attribute is set to true
  if (empty($block['attrs']['srOnly'])) {
    return $block_content;
  }

  // Attributes matched as repeated name/name=value pairs, not [^>]* up to the first `>` — a quoted value containing `>` (e.g. an aria-label) would otherwise truncate the match and corrupt the tag.
  $block_content = preg_replace_callback(
    '/<(h[1-6]|p)((?:\s+[^\s"\'>]+(?:=(?:"[^"]*"|\'[^\']*\'|[^\s>]+))?)*)\s*>/',
    function ($matches) {
      $tag = $matches[1];
      $attributes = $matches[2] ?? '';

      // Check if class attribute exists
      if (preg_match('/class=(["\'])([^"\']*)\1/', $attributes, $class_match)) {
        $quote           = $class_match[1];
        $existing_classes = $class_match[2];
        $new_classes      = $existing_classes . ' sr-only';
        $attributes = str_replace(
          'class=' . $quote . $existing_classes . $quote,
          'class=' . $quote . $new_classes . $quote,
          $attributes
        );
      } else {
        // Add class attribute
        $attributes = $attributes . ' class="sr-only"';
      }

      return '<' . $tag . $attributes . '>';
    },
    $block_content,
    1
  );

  return $block_content;
}
add_filter('render_block', 'chance_apply_sr_only_class', 10, 2);
