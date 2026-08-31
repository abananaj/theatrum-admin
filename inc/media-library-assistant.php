<?php

/**
 * Media Library Assistant customizations:
 * - Hide the "Icon" attachment category from the default Media > Assistant view.
 * - Add a dedicated "Icons" submenu under Media that links straight into that
 *   category (using MLA's own mla-tax/mla-term query args, same as clicking a
 *   term in an MLA taxonomy column).
 */

if (! defined('ABSPATH')) {
  exit;
}

const CT_MLA_ICON_TAXONOMY = 'attachment_category';
const CT_MLA_ICON_TERM_NAME = 'Icon';

function ct_mla_get_icon_term()
{
  static $term = null;

  if (null === $term) {
    $found = get_term_by('name', CT_MLA_ICON_TERM_NAME, CT_MLA_ICON_TAXONOMY);
    $term  = $found instanceof WP_Term ? $found : false;
  }

  return $term;
}

// ── Exclude "Icon" from the default Media > Assistant list ───────────────────
// Runs after MLA has already merged any user-chosen taxonomy filter into
// $request['tax_query'], so if the admin is explicitly filtering
// attachment_category themselves (including via the Icons submenu below),
// we leave their query alone.

add_filter('mla_list_table_query_final_terms', function ($request) {
  $term = ct_mla_get_icon_term();
  if (!$term) {
    return $request;
  }

  if (!empty($request['tax_query'])) {
    foreach ($request['tax_query'] as $clause) {
      if (is_array($clause) && isset($clause['taxonomy']) && CT_MLA_ICON_TAXONOMY === $clause['taxonomy']) {
        return $request;
      }
    }
  }

  $exclude_clause = [
    'taxonomy' => CT_MLA_ICON_TAXONOMY,
    'field'    => 'term_id',
    'terms'    => [$term->term_id],
    'operator' => 'NOT IN',
  ];

  if (empty($request['tax_query'])) {
    $request['tax_query'] = [$exclude_clause];
  } else {
    $request['tax_query'][] = $exclude_clause;
    if (empty($request['tax_query']['relation'])) {
      $request['tax_query']['relation'] = 'AND';
    }
  }

  return $request;
});

// ── "Icons" submenu under Media ───────────────────────────────────────────────

add_action('admin_menu', function () {
  add_submenu_page(
    'upload.php',
    __('Icons', 'theatrum-admin'),
    __('Icons', 'theatrum-admin'),
    'upload_files',
    'ct-media-icons',
    'ct_mla_render_icons_redirect'
  );
}, 20);

function ct_mla_render_icons_redirect()
{
  $term = ct_mla_get_icon_term();

  $url = $term
    ? add_query_arg(
      [
        'page'     => 'mla-menu',
        'mla-tax'  => CT_MLA_ICON_TAXONOMY,
        'mla-term' => $term->slug,
      ],
      admin_url('upload.php')
    )
    : admin_url('upload.php?page=mla-menu');

  wp_safe_redirect($url);
  exit;
}
