<?php
/**
 * ACF edit-screen styling: tinted accordion labels so sections read apart from fields (Anna, Oct 6).
 *
 * @package theatrum-admin
 */

if ( ! defined('ABSPATH')) {
  exit;
}

add_action(
    'acf/input/admin_head',
    function () {
    ?>
  <style id="theatrum-acf-admin">
    .acf-fields > .acf-field.acf-accordion > .acf-accordion-title {
      background: #f0f6fc;
      border-left: 3px solid #2271b1;
    }
    .acf-fields > .acf-field.acf-accordion > .acf-accordion-title:hover {
      background: #e5eff8;
    }
    .acf-fields > .acf-field.acf-accordion.-open > .acf-accordion-title {
      background: #dcebf7;
    }
  </style>
    <?php
    }
);
