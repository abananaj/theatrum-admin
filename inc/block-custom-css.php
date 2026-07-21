<?php

/**
 * Custom CSS Support for All Blocks
 *
 * Adds a custom CSS field to the styles panel for all WordPress blocks
 * in the Site Editor and block editor. Allows per-block custom styling.
 *
 * Parked: not currently required (see the commented require_once in
 * theatrum-admin.php) pending a decision on whether to expose free-form CSS
 * input to editors. The implementation below is complete, but
 * chance_sanitize_block_custom_css() is a denylist over raw CSS text, not a
 * parser — it strips the known-dangerous constructs listed there and CSS
 * comments (to close comment-splitting bypasses like `exp/**\/ression(...)`),
 * but a denylist can't guarantee it covers every future CSS injection vector.
 * Re-review that function before enabling this for any role below
 * manage_options.
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
 * outputting it in a style tag. Result is cached (keyed on post ID + a hash
 * of post_content) so parse_blocks() doesn't re-run on every request — the
 * cache self-invalidates whenever the post content changes.
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

  $cache_key = $post->ID . '_' . md5($content);
  $custom_css = wp_cache_get($cache_key, 'chance_block_custom_css');

  if (false === $custom_css) {
    $blocks = parse_blocks($content);
    $custom_css = chance_collect_custom_css_from_blocks($blocks);
    wp_cache_set($cache_key, $custom_css, 'chance_block_custom_css', HOUR_IN_SECONDS);
  }

  if (!empty($custom_css)) {
    echo '<style id="chance-block-custom-css">';
    echo $custom_css; // Already sanitized in chance_sanitize_block_custom_css().
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

      $custom_css_content = $block['attrs']['customCSS'];
      $has_selector = preg_match('/^[\s\n]*[.#\[]/', $custom_css_content);

      $css .= $has_selector
        // Already has selectors — sanitize as a full ruleset.
        ? chance_sanitize_block_custom_css($custom_css_content)
        // Bare declarations — sanitize as a declaration list, then wrap with
        // the block's generated class as the selector.
        : sprintf('.%s { %s }', esc_attr($block_class), safecss_filter_attr($custom_css_content));

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

/**
 * Sanitize a full CSS ruleset (selectors + declarations) for safe output.
 *
 * wp_kses_post() is an HTML sanitizer and isn't appropriate here — it mangles
 * valid CSS syntax (child combinators, attribute selectors, bare `<`/`>` in
 * content values) while doing nothing to stop CSS-specific injection vectors
 * like `expression()` or `@import`. This strips literal HTML tags plus a
 * denylist of CSS constructs capable of executing script or loading remote
 * resources, and leaves ordinary CSS syntax untouched.
 */
function chance_sanitize_block_custom_css($css)
{
  $css = wp_strip_all_tags($css, true);

  // Strip CSS comments first so a denylisted construct can't be split across
  // a comment to dodge the checks below (e.g. `exp/**/ression(...)`).
  $css = preg_replace('#/\*.*?\*/#s', '', $css);

  // Denylist of CSS constructs that can execute script or exfiltrate data.
  $denylist = array(
    '/@import/i',
    '/expression\s*\(/i',
    '/javascript\s*:/i',
    '/vbscript\s*:/i',
    '/-moz-binding/i',
    '/behavior\s*:/i',
  );

  return preg_replace($denylist, '', $css);
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
