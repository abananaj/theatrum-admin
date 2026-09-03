<?php

/**
 * Site Manual topic: shared patterns and their blast radius.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>
      <?php
      $chance_manual_counts = chance_manual_pattern_counts();

    echo esc_html(
        sprintf(
          /* translators: 1: number of shared patterns, 2: total patterns. */
            __('%1$s of the %2$s patterns on this site are shared.', 'theatrum-admin'),
            number_format_i18n($chance_manual_counts['shared']),
            number_format_i18n($chance_manual_counts['total'])
        )
    );
      ?>
    </strong>
    <?php esc_html_e('Editing a shared pattern changes every page that uses it, immediately, with no warning and no undo across those pages.', 'theatrum-admin'); ?>
  </p>
</div>

<h2>What a pattern is</h2>

<p>
  A pattern is a saved chunk of layout — a page header, a card, a call-to-action block — that
  can be dropped into any page. Almost every page on this site is assembled from them, which
  is why pages look consistent and why building a new one is quick.
</p>

<h2>Shared and independent patterns</h2>

<p>
  There are two kinds, and telling them apart is the whole point of this page.
</p>

<ul>
  <li>
    <strong>Shared (synced).</strong> One master copy, used in many places. Change it once and
    every page using it changes. Almost all of this site's patterns are this kind.
  </li>
  <li>
    <strong>Independent (unsynced).</strong> Inserting one drops a copy into the page. Editing
    that copy affects only that page.
  </li>
</ul>

<p>
  In the editor, a shared pattern appears as a single locked-looking unit with a purple
  outline. If you can click straight into the individual words and change them without any
  warning, you are almost certainly editing a shared pattern for the entire site.
</p>

<h2>Before you edit one: check who else uses it</h2>

<p>
  The patterns list has a <strong>Used In</strong> column showing how many places each pattern
  appears, and clicking the number lists them. Check it first, every time.
</p>

<?php chance_manual_go('edit.php?post_type=wp_block', 'Open the patterns list'); ?>

<ul>
  <li><strong>Used in 1 place</strong> — editing is usually safe.</li>
  <li><strong>Used in several places</strong> — your change lands on all of them. Make sure that is what you want.</li>
  <li><strong>Used in many places</strong> — treat it as a site-wide design change and check with whoever looks after the site first.</li>
</ul>

<h2>When you only want to change one page</h2>

<p>
  This is the common case: a page header is nearly right but this one show needs different
  wording. Do <em>not</em> edit the shared pattern. Instead, in the page you are editing,
  select the pattern and choose <strong>Detach</strong> from its options menu (the three
  dots). That replaces the shared pattern with an ordinary copy of its blocks on that page
  only. Edit freely afterwards — nothing else is affected.
</p>

<p>
  The trade-off is that a detached copy no longer receives future updates to the original.
  That is usually the right price for a one-off change.
</p>

<h2>If you have already edited one by mistake</h2>

<p>
  Do not start undoing things across the site. Open the pattern itself from the patterns list
  and use its revision history to restore the previous version — that repairs every page at
  once. If the revision list does not go back far enough, ask before making further changes,
  because each additional save makes the original harder to recover.
</p>

<h2>Naming and categories</h2>

<p>
  Patterns are grouped into categories — page headers, sections, cards, banners and so on —
  and you can filter the list by category. If you create a pattern, give it a name that says
  where it is meant to be used, and put it in a category. An uncategorised pattern called
  “Group” is one nobody will ever find again.
</p>
