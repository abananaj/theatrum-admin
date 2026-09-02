<?php

/**
 * Caption Copy-On-Click Block Support — toggle adds has-caption-copy class to rendered figcaptions; click behavior lives in assets/copy-caption.js.
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register allowCaptionCopy attribute on the target blocks
 */
function chance_register_copy_caption_attribute($settings, $name)
{
  $target_blocks = [
    'core/image',
    'theatrum/meta-image',
    'theatrum/meta-gallery',
  ];

  if (!in_array($name, $target_blocks, true)) {
    return $settings;
  }

  if (!isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['allowCaptionCopy'] = [
    'type' => 'boolean',
    'default' => false,
  ];

  return $settings;
}
add_filter('register_block_type_args', 'chance_register_copy_caption_attribute', 10, 2);

/**
 * Apply has-caption-copy class to every figcaption rendered by the block when allowCaptionCopy is true.
 * No replacement-count limit (unlike sr-only's single-tag match) — a meta-gallery block can render several figcaptions per render_block call, and all should pick up the class.
 */
function chance_apply_copy_caption_class($block_content, $block)
{
  if (empty($block['attrs']['allowCaptionCopy'])) {
    return $block_content;
  }

  // Attributes matched as repeated name/name=value pairs, not [^>]* up to the first `>` — a quoted value containing `>` would otherwise truncate the match and corrupt the tag.
  $block_content = preg_replace_callback(
    '/<figcaption((?:\s+[^\s"\'>]+(?:=(?:"[^"]*"|\'[^\']*\'|[^\s>]+))?)*)\s*>/',
    function ($matches) {
      $attributes = $matches[1] ?? '';

      if (preg_match('/class=(["\'])([^"\']*)\1/', $attributes, $class_match)) {
        $quote           = $class_match[1];
        $existing_classes = $class_match[2];
        $new_classes      = $existing_classes . ' has-caption-copy';
        $attributes = str_replace(
          'class=' . $quote . $existing_classes . $quote,
          'class=' . $quote . $new_classes . $quote,
          $attributes
        );
      } else {
        $attributes = $attributes . ' class="has-caption-copy"';
      }

      return '<figcaption' . $attributes . '>';
    },
    $block_content
  );

  return $block_content;
}
add_filter('render_block', 'chance_apply_copy_caption_class', 10, 2);
