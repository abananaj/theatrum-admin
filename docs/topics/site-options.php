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
  than to any one page. It is small, and it has more reach than anything else you can edit —
  a single field here changes what the home page leads with.
</p>

<?php chance_manual_go('admin.php?page=site-options', 'Open Site Options'); ?>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>There is no revision history on this screen.</strong> Pages and posts can be rolled
    back; these settings cannot. Note down what a field said before you change it.
  </p>
</div>

<h2>Seasons — the most consequential field on the site</h2>

<p>
  <strong>Current Season</strong> is a single choice, and a great deal follows from it. The site
  works out what is on stage now by taking every production filed under that season and
  comparing their opening and closing dates to today: whichever show is currently running is
  “on stage”, and if none is running, the next one to open is. <strong>Next Up</strong> is then
  the one after that.
</p>

<p>
  So the home page's headline modules are not set by hand. They follow from this field plus the
  dates on each production — which means:
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>Rolling the site on to a new season is this one field.</strong> Change Current
    Season, and everything downstream re-reads itself.
  </li>
  <li>
    <strong>If the wrong show is on the home page, look at the dates first.</strong> A
    production with a missing or mistyped opening date cannot be found by this logic, and the
    site quietly moves on to the next one that has good dates.
  </li>
  <li>
    <strong>A production with no season is invisible here</strong>, however well filled in it is.
  </li>
</ul>

<p>
  <strong>Next Season</strong> is the season after the current one, used where the site needs to
  advertise what is coming. See <?php chance_manual_see('seasons-and-series'); ?>.
</p>

<h2>Featured modules — the manual override</h2>

<p>
  <strong>Current</strong> and <strong>Next up</strong> let you pin a specific production into
  those two slots instead of letting the dates decide. <strong>Featured 1</strong> to
  <strong>Featured 4</strong> do the same for the promoted items further down.
</p>

<p>
  <strong>Empty is the normal state for these.</strong> Left blank, each slot works itself out —
  the note under each field tells you what it falls back to, which for Featured 1 to 3 is the
  next upcoming readings and for Featured 4 the next upcoming event. Fill one in and it is
  pinned: it escapes the date and category rules entirely and stays exactly as you set it,
  including after the show has closed, until someone empties it again.
</p>

<p>
  Use them for a deliberate exception, and make a note to clear them afterwards. A forgotten
  override is one of the more common reasons the home page shows something stale.
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
  on for staff; President, Vice President, Treasurer, Secretary, Board Members, Emeritus and
  Legacy for the board. Each slot points at an <strong>Artist</strong> record.
</p>

<ul>
  <li>
    <strong>The person must exist as an Artist first.</strong> These fields search the Artists
    list; they cannot create someone. See <?php chance_manual_see('adding-an-artist'); ?>.
  </li>
  <li>
    <strong>Changing who holds a role is done here</strong>, not on the artist. Editing the
    artist changes their name and bio everywhere; it does not move them into or out of a role.
  </li>
</ul>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Deleting an artist does not clear them out of these lists.</strong> The slot keeps
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
