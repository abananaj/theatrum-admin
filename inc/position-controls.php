<?php

/**
 * Custom Block Position Support — for any block declaring `supports.position.sticky`, replaces core's sticky-only Position panel with Relative/Absolute/Fixed/Sticky plus independent Top/Right/Bottom/Left offsets.
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register position attributes on any block that supports position sticky, and disable core's native position support so its panel doesn't also render.
 */
function chance_register_position_attributes($settings, $name)
{
  if (empty($settings['supports']['position']['sticky'])) {
    return $settings;
  }

  if (!isset($settings['attributes'])) {
    $settings['attributes'] = [];
  }

  $settings['attributes']['positionType'] = [
    'type' => 'string',
    'default' => 'static',
  ];

  foreach (['positionTop', 'positionRight', 'positionBottom', 'positionLeft'] as $side_attr) {
    $settings['attributes'][$side_attr] = [
      'type' => 'string',
      'default' => '',
    ];
  }

  // Suppress core's native Position panel/render support — ours replaces it.
  $settings['supports']['position'] = false;

  return $settings;
}
add_filter('register_block_type_args', 'chance_register_position_attributes', 10, 2);

/**
 * Mirror chance_register_position_attributes() on the client, as inline JS attached to the 'wp-blocks' handle rather than a normally enqueued script.
 * A regular wp_enqueue_script() has no dependency edge forcing it to run before a block's own registerBlockType() — if our filter registers late, the Position panel silently never appears for that block. Every block script depends on 'wp-blocks', so code attached here always runs first.
 */
function chance_inline_position_attribute_filter()
{
  $js = <<<'JS'
wp.hooks.addFilter('blocks.registerBlockType', 'chance/add-position-attributes', function (settings) {
  if (!settings || !settings.supports || !settings.supports.position || !settings.supports.position.sticky) {
    return settings;
  }
  settings.attributes = Object.assign({}, settings.attributes, {
    positionType: { type: 'string', default: 'static' },
    positionTop: { type: 'string', default: '' },
    positionRight: { type: 'string', default: '' },
    positionBottom: { type: 'string', default: '' },
    positionLeft: { type: 'string', default: '' }
  });
  settings.supports = Object.assign({}, settings.supports, { position: false });
  return settings;
});
JS;

  wp_add_inline_script('wp-blocks', $js, 'after');
}
add_action('enqueue_block_editor_assets', 'chance_inline_position_attribute_filter', 5);

/**
 * Only allow well-formed CSS length values (e.g. "10px", "-1.5rem", "50%")
 * through to the rendered style attribute.
 */
function chance_is_valid_css_length($value)
{
  return (bool) preg_match('/^-?\d*\.?\d+(px|em|rem|%|vh|vw|vmin|vmax|ch|ex|cm|mm|in|pt|pc|fr)?$/', $value);
}

/**
 * Apply the position styles to the block wrapper on render. Gated on the `positionType` attribute alone (not a block name list) — only opted-in blocks ever have it set.
 */
function chance_apply_position_style($block_content, $block)
{
  $type = $block['attrs']['positionType'] ?? 'static';
  $allowed_types = ['relative', 'absolute', 'fixed', 'sticky'];

  if (!in_array($type, $allowed_types, true)) {
    return $block_content;
  }

  $css = 'position: ' . $type . ';';

  $sides = [
    'top' => $block['attrs']['positionTop'] ?? '',
    'right' => $block['attrs']['positionRight'] ?? '',
    'bottom' => $block['attrs']['positionBottom'] ?? '',
    'left' => $block['attrs']['positionLeft'] ?? '',
  ];

  foreach ($sides as $side => $value) {
    if ('' !== $value && chance_is_valid_css_length($value)) {
      $css .= ' ' . $side . ': ' . $value . ';';
    }
  }

  // `is-position-{type}` mirrors the class core's native position support would add — themes (see .is-position-sticky in header.scss) hook offset overrides off it; without it a sticky block sticks at the literal positionTop (usually 0px), ending up underneath the fixed header instead of below it.
  $position_class = 'is-position-' . $type;

  // Merge the position CSS/class into the wrapper's existing style/class attributes (or add them). Attributes matched as repeated name/name=value pairs, not [^>]* up to the first `>` — a quoted value containing `>` would otherwise truncate the match and corrupt the tag.
  $block_content = preg_replace_callback(
    '/(<[a-zA-Z][a-zA-Z0-9-]*)((?:\s+[^\s"\'>]+(?:=(?:"[^"]*"|\'[^\']*\'|[^\s>]+))?)*)\s*(>)/',
    function ($matches) use ($css, $position_class) {
      $tag = $matches[1];
      $attributes = $matches[2] ?? '';
      $close = $matches[3];

      if (preg_match('/style=(["\'])(.*?)\1/s', $attributes, $style_match)) {
        $quote = $style_match[1];
        $existing_style = rtrim(trim($style_match[2]), ';');
        $new_style = ('' !== $existing_style ? $existing_style . '; ' : '') . esc_attr($css);
        $attributes = str_replace(
          'style=' . $quote . $style_match[2] . $quote,
          'style=' . $quote . $new_style . $quote,
          $attributes
        );
      } else {
        $attributes .= ' style="' . esc_attr($css) . '"';
      }

      if (preg_match('/class=(["\'])(.*?)\1/s', $attributes, $class_match)) {
        $quote = $class_match[1];
        $existing_class = trim($class_match[2]);
        $new_class = ('' !== $existing_class ? $existing_class . ' ' : '') . esc_attr($position_class);
        $attributes = str_replace(
          'class=' . $quote . $class_match[2] . $quote,
          'class=' . $quote . $new_class . $quote,
          $attributes
        );
      } else {
        $attributes .= ' class="' . esc_attr($position_class) . '"';
      }

      return $tag . $attributes . $close;
    },
    $block_content,
    1
  );

  return $block_content;
}
add_filter('render_block', 'chance_apply_position_style', 10, 2);
