<?php

/**
 * Site Manual topic: Site Options.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  <strong>Site Options</strong> is one screen of settings that apply to the whole site rather
  than to any one page: the staff and board listings, and the fallback images that stand in when
  a post has no picture of its own.
</p>

<?php chance_manual_go('admin.php?page=site-options', 'Open Site Options'); ?>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>There is no revision history on this screen.</strong> Pages and posts can be rolled
    back; these settings cannot. Note down what a field said before you change it.
  </p>
</div>

<h2>Looking for Current Season?</h2>

<p>
  It has moved. <strong>Current Season</strong>, <strong>Next Season</strong> and
  <strong>Hide Next Season?</strong> now live under <strong>Seasons → Season Settings</strong>,
  which only administrators can open. If you are an Editor and the season needs changing, ask an
  administrator. <?php chance_manual_see('seasons-and-series', 'Seasons and series'); ?> explains
  what the setting does.
</p>

<h2>Featured images — the fallbacks</h2>

<p>
  One image per content type: productions, events, classes, artists, supporters, blog posts,
  plus a <strong>Default Featured Image</strong> behind all of them. These are used whenever a
  post has no featured image of its own, so they are what stops a card appearing blank.
</p>

<p>
  You will rarely need to change these. When you do, pick something neutral that will look
  reasonable behind any title — they appear in lists next to real photography.
</p>

<h2>Staff and Board</h2>

<p>
  Two lists of roles — Executive Artistic Director, General Manager, Production Manager and so
  on for staff; President, Vice President, Treasurer, Secretary, Immediate Past Board
  President, Board Members, Emeritus and Legacy for the board. Staff slots point at
  <strong>Artist</strong> records; board slots point at <strong>Supporter</strong> records.
</p>

<p>
  The same two lists can also be opened on their own, from <strong>Artists → Chance Staff</strong>
  and <strong>Supporters → Board Positions</strong>. They are the same fields, not copies:
  a change made in either place shows in both.
</p>

<ul>
  <li>
    <strong>The person must exist first</strong> — as an Artist for a staff role, as a Supporter
    for a board role. These fields search those lists; they cannot create someone. See
    <?php chance_manual_see('adding-an-artist'); ?> and <?php chance_manual_see('classes-venues-supporters'); ?>.
  </li>
  <li>
    <strong>Changing who holds a role is done here</strong>, not on the person's own record. Editing the
    record changes their name and bio everywhere; it does not move them into or out of a role.
  </li>
</ul>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Deleting an artist or supporter does not clear them out of these lists.</strong> The slot keeps
    pointing at a record that no longer exists, and the listing on the site quietly loses that
    person with no warning on either screen. When someone leaves, empty the slot here first.
  </p>
</div>

<h2>Saving</h2>

<p>
  Changes take effect as soon as you save, everywhere, with no preview and no draft. If
  something looks wrong immediately afterwards, the cause is usually caching rather than the
  setting — see <?php chance_manual_see('why-isnt-my-change-showing', 'Why isn\'t my change showing?'); ?>
</p>
