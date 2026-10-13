<?php

/**
 * Rich Excerpt — keeps a manual excerpt's formatting when core/post-excerpt renders it (core strips all tags).
 */

if ( ! defined('ABSPATH')) {
  exit;
}

// Tags that sit inside a word run; any other tag (p, li, br, h3…) separates words when counting.
const CHANCE_RICH_EXCERPT_INLINE_TAGS = ['a', 'abbr', 'b', 'cite', 'code', 'del', 'em', 'i', 'mark', 'q', 's', 'small', 'span', 'strong', 'sub', 'sup', 'u'];

const CHANCE_RICH_EXCERPT_VOID_TAGS = ['br', 'hr', 'img', 'wbr'];

/**
 * Trim HTML to a word count without breaking tags, closing any left open.
 */
function chance_trim_html_words($html, $num_words) {
  $tokens  = preg_split('/(<[^>]*>)/', $html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
  $output  = '';
  $open    = [];
  $count   = 0;
  $in_word = false;

  foreach ($tokens as $token) {
    if ('<' === $token[0]) {
      if (preg_match('#^<(/?)([a-z][a-z0-9]*)#i', $token, $match)) {
        $tag = strtolower($match[2]);

        if ( ! in_array($tag, CHANCE_RICH_EXCERPT_INLINE_TAGS, true)) {
          $in_word = false;
        }

        if (in_array($tag, CHANCE_RICH_EXCERPT_VOID_TAGS, true)) {
          // Void tags never close, so they don't go on the stack.
        } elseif ('/' === $match[1]) {
          array_pop($open);
        } else {
          $open[] = [$tag, strlen($output)];
        }
      }
      $output .= $token;
      continue;
    }

    foreach (preg_split('/([\n\r\t ]+)/', $token, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY) as $chunk) {
      if (preg_match('/^[\n\r\t ]/', $chunk)) {
        $in_word = false;
        $output .= $chunk;
        continue;
      }

      if ( ! $in_word && ++$count > $num_words) {
        // Drop tags opened since the last word so the ellipsis isn't wrapped in an empty link or paragraph.
        while ($open && '' === trim(wp_strip_all_tags(substr($output, end($open)[1])))) {
          $output = substr($output, 0, array_pop($open)[1]);
        }
        $closing = array_map(fn($item) => "</{$item[0]}>", array_reverse($open));
        // Ellipsis goes before any just-closed tags so it stays on the last line of text, not its own line.
        $output = preg_replace('#((?:</[a-z0-9]+>\s*)*)$#i', '&hellip;$1', rtrim($output), 1);
        return $output . implode('', $closing);
      }

      $in_word = true;
      $output .= $chunk;
    }
  }

  return $html;
}

/**
 * Core strips all tags via wp_trim_words(); swap its plain text for the formatted, word-trimmed excerpt.
 */
function chance_render_rich_excerpt($block_content, $block, $instance) {
  $post_id = $instance->context['postId'] ?? 0;

  // Core shows a "protected post" notice here, which would otherwise match and be swapped for the real excerpt.
  if ( ! $post_id || post_password_required($post_id)) {
    return $block_content;
  }

  $raw = get_post_field('post_excerpt', $post_id);

  if ( ! $raw || false === strpos($raw, '<')) {
    return $block_content;
  }

  $length   = (int) ($instance->attributes['excerptLength'] ?? 55);
  $open_tag = '<p class="wp-block-post-excerpt__excerpt">';
  $plain    = $open_tag . wp_trim_words(get_the_excerpt($post_id), $length);
  $rich     = chance_trim_html_words(force_balance_tags(wp_kses_post($raw)), $length);
  $pos      = strpos($block_content, $plain);

  // No match (e.g. another plugin filtered the excerpt) means core's output is left as-is.
  if (false === $pos) {
    return $block_content;
  }

  // The pop-up editor saves one-paragraph text as a lone <p>; unwrap it so it renders like an inline excerpt.
  if (preg_match('#^<p>(.*)</p>$#s', trim($rich), $match) && false === stripos($match[1], '<p')) {
    $rich = $match[1];
  }

  if ( ! preg_match('#<(p|div|ul|ol|blockquote|h[1-6]|hr|pre|table)\b#i', $rich)) {
    return substr_replace($block_content, $open_tag . $rich, $pos, strlen($plain));
  }

  // Block-level content can't sit inside a <p>, so the wrapper becomes a <div>; an inline "more" link keeps its place after the text.
  $rest_start = $pos + strlen($plain);
  $end        = strpos($block_content, '</p>', $rest_start);

  if (false === $end) {
    return $block_content;
  }

  $rest = substr($block_content, $rest_start, $end - $rest_start);

  return substr_replace($block_content, '<div class="wp-block-post-excerpt__excerpt">' . $rich . $rest . '</div>', $pos, $end + 4 - $pos);
}
add_filter('render_block_core/post-excerpt', 'chance_render_rich_excerpt', 10, 3);
