<?php

/**
 * Media Library Assistant customizations:
 * - Hide the "Icon" attachment category everywhere an attachment query
 *   happens by default: the Media > Assistant view, the native Media >
 *   Library grid/list, the "Add Media" modal (post insertion, featured
 *   image, ACF fields), and REST attachment queries.
 * - Add a dedicated "Icons" submenu under Media that links straight into
 *   that category (using MLA's own mla-tax/mla-term query args, same as
 *   clicking a term in an MLA taxonomy column) — the way back in for the
 *   Library/Assistant screens. The "Add Media" modal already has its own way
 *   back in: MLA's built-in category filter dropdown, which the exclusion
 *   below defers to whenever it's in use.
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

/**
 * Append a "NOT IN [Icon term]" clause to a tax_query array, unless it
 * already carries a clause targeting CT_MLA_ICON_TAXONOMY (an explicit
 * filter already in play, which we don't want to fight).
 *
 * @param array $tax_query
 * @return array
 */
function ct_mla_exclude_icon_tax_query($tax_query)
{
  $term = ct_mla_get_icon_term();
  if (!$term) {
    return $tax_query;
  }

  if (!empty($tax_query)) {
    foreach ($tax_query as $clause) {
      if (is_array($clause) && isset($clause['taxonomy']) && CT_MLA_ICON_TAXONOMY === $clause['taxonomy']) {
        return $tax_query;
      }
    }
  }

  $exclude_clause = [
    'taxonomy' => CT_MLA_ICON_TAXONOMY,
    'field'    => 'term_id',
    'terms'    => [$term->term_id],
    'operator' => 'NOT IN',
  ];

  if (empty($tax_query)) {
    return [$exclude_clause];
  }

  $tax_query[] = $exclude_clause;
  if (empty($tax_query['relation'])) {
    $tax_query['relation'] = 'AND';
  }

  return $tax_query;
}

// ── Exclude "Icon" from the default Media > Assistant list ───────────────────
// Runs after MLA has already merged any user-chosen taxonomy filter into
// $request['tax_query'], so if the admin is explicitly filtering
// attachment_category themselves (including via the Icons submenu below),
// we leave their query alone.

add_filter('mla_list_table_query_final_terms', function ($request) {
  $request['tax_query'] = ct_mla_exclude_icon_tax_query($request['tax_query'] ?? []);
  return $request;
});

// ── Exclude "Icon" from the "Add Media" modal (insertion, featured image,
// ACF fields) ─────────────────────────────────────────────────────────────
// Fires for both plain core's wp_ajax_query_attachments() and MLA's own
// modal-enhanced query path (class-mla-media-modal-ajax.php), which applies
// this same core filter on its way to building the query. When the admin has
// already picked a category from MLA's modal filter dropdown
// (query['mla_filter_term'], a term ID — "-1" means "All"), leave it alone;
// that dropdown is the way back in to see Icons from inside the modal.

add_filter('ajax_query_attachments_args', function ($query) {
  if (isset($query['mla_filter_term']) && '-1' !== (string) $query['mla_filter_term']) {
    return $query;
  }

  $query['tax_query'] = ct_mla_exclude_icon_tax_query($query['tax_query'] ?? []);
  return $query;
});

// ── Exclude "Icon" from the native Media > Library grid/list ─────────────────
// Guard: skip if the query is already explicitly filtering by
// attachment_category (a tax_query clause, or the query var directly — e.g.
// upload.php?attachment_category=icon), so an explicit request isn't
// double-excluded.

add_action('pre_get_posts', function ($query) {
  if (!is_admin() || 'attachment' !== $query->get('post_type')) {
    return;
  }

  if ($query->get(CT_MLA_ICON_TAXONOMY)) {
    return;
  }

  $query->set('tax_query', ct_mla_exclude_icon_tax_query($query->get('tax_query') ?: []));
});

// ── Exclude "Icon" from REST attachment queries (wp/v2/media) ────────────────

add_filter('rest_attachment_query', function ($args, $request) {
  if ($request->get_param(CT_MLA_ICON_TAXONOMY)) {
    return $args;
  }

  $args['tax_query'] = ct_mla_exclude_icon_tax_query($args['tax_query'] ?? []);
  return $args;
}, 10, 2);

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
