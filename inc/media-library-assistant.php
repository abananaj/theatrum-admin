<?php

/**
 * Media Library Assistant customizations: hides the "Icon" attachment category from every default attachment query (Assistant view, Library grid/list, Add Media modal, REST), and adds an "Icons" submenu under Media as the way back in.
 * The Add Media modal has its own way back in (MLA's category filter dropdown), which the exclusion below defers to whenever it's in use.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

const CT_MLA_ICON_TAXONOMY  = 'attachment_category';
const CT_MLA_ICON_TERM_NAME = 'Icon';

function ct_mla_get_icon_term() {
  static $term = null;

  if (null === $term) {
    $found = get_term_by('name', CT_MLA_ICON_TERM_NAME, CT_MLA_ICON_TAXONOMY);
    $term  = $found instanceof WP_Term ? $found : false;
  }

  return $term;
}

/**
 * Append a "NOT IN [Icon term]" clause to a tax_query array, unless one targeting CT_MLA_ICON_TAXONOMY is already there (an explicit filter we don't want to fight).
 *
 * @param array $tax_query
 * @return array
 */
function ct_mla_exclude_icon_tax_query($tax_query) {
  $term = ct_mla_get_icon_term();
  if ( ! $term) {
    return $tax_query;
  }

  if ( ! empty($tax_query)) {
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
// Runs after MLA has merged any user-chosen taxonomy filter into $request['tax_query'], so an explicit attachment_category filter (incl. via the Icons submenu) is left alone.

add_filter(
    'mla_list_table_query_final_terms',
    function ($request) {
    $request['tax_query'] = ct_mla_exclude_icon_tax_query($request['tax_query'] ?? []);
    return $request;
    }
);

// ── Exclude "Icon" from the "Add Media" modal (insertion, featured image, ACF fields) ────
// Fires for both core's wp_ajax_query_attachments() and MLA's modal query path (class-mla-media-modal-ajax.php), which applies this same filter. Leave alone when the admin already picked a category via MLA's modal dropdown (query['mla_filter_term'], "-1" = "All") — that's the way back in to Icons from the modal.

add_filter(
    'ajax_query_attachments_args',
    function ($query) {
    if (isset($query['mla_filter_term']) && '-1' !== (string) $query['mla_filter_term']) {
      return $query;
    }

    $query['tax_query'] = ct_mla_exclude_icon_tax_query($query['tax_query'] ?? []);
    return $query;
    }
);

// ── Exclude "Icon" from the native Media > Library grid/list ─────────────────
// Guard: skip if already explicitly filtering by attachment_category (tax_query clause or query var, e.g. upload.php?attachment_category=icon), so it isn't double-excluded.

add_action(
    'pre_get_posts',
    function ($query) {
    if ( ! is_admin() || 'attachment' !== $query->get('post_type')) {
      return;
    }

    if ($query->get(CT_MLA_ICON_TAXONOMY)) {
      return;
    }

    $query->set('tax_query', ct_mla_exclude_icon_tax_query($query->get('tax_query') ?: []));
    }
);

// ── Exclude "Icon" from REST attachment queries (wp/v2/media) ────────────────

add_filter(
    'rest_attachment_query',
    function ($args, $request) {
    if ($request->get_param(CT_MLA_ICON_TAXONOMY)) {
      return $args;
    }

    $args['tax_query'] = ct_mla_exclude_icon_tax_query($args['tax_query'] ?? []);
    return $args;
    },
    10,
    2
);

// ── "Icons" submenu under Media ───────────────────────────────────────────────

add_action(
    'admin_menu',
    function () {
    add_submenu_page(
        'upload.php',
        __('Icons', 'theatrum-admin'),
        __('Icons', 'theatrum-admin'),
        'upload_files',
        'ct-media-icons',
        'ct_mla_render_icons_redirect'
    );
    },
    20
);

function ct_mla_render_icons_redirect() {
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
