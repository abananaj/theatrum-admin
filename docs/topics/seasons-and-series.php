<?php

/**
 * Site Manual topic: seasons and series.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  <strong>Season</strong> is when a show happened — 2024, 2025, 2026. <strong>Series</strong> is
  what kind of show it is — Main, OTR Reading, TYA Family, Holiday, Visiting Companies, Online.
  Every production should have one of each, and between them they drive most of the lists on
  the site.
</p>

<?php chance_manual_go('edit-tags.php?taxonomy=season&post_type=production', 'Open the Seasons list'); ?>

<h2>They are not pages</h2>

<p>
  A season is a label, not a page. But visitors expect <em>/2026-season</em> to show them
  something, so each season term can point at a real page — and when it does, anyone landing on
  the season's own address is sent straight there.
</p>

<p>
  That link is the <strong>Related Page</strong> column on the Seasons list. Use
  <strong>Quick Edit</strong> on the row to set or change it. The same mechanism exists on
  Series, Sessions, Programs, Event Types and Support Levels, though only Season actually
  redirects.
</p>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>If more than one page is picked, the first one wins.</strong> Some of the older
    seasons have two pages stored against them for historical reasons. It is harmless, but if a
    season sends people somewhere unexpected, that is the first place to look.
  </p>
</div>

<h2>Building a season page</h2>

<p>
  A season page is an ordinary Page. What makes it a season page is the blocks on it: a query
  that pulls in every production filed under that season, rather than a hand-written list.
</p>

<p>
  Which means <strong>you do not add shows to a season page.</strong> You file the show under
  the season on the production itself, and the page picks it up. If a show is missing from a
  season page, the season on that production is the thing to check.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Do not choose “Season Page” from the Template dropdown.</strong> It appears in the
    list but the template behind it was never finished, and selecting it will leave the page
    blank. Build a season page as a normal page. See
    <?php chance_manual_see('things-not-to-touch'); ?>.
  </p>
</div>

<h2>What a season term itself holds</h2>

<p>
  Open a season for editing and there are a few fields on the term:
</p>

<ul>
  <li><strong>Hide Season?</strong> — takes the season out of the lists without deleting anything.</li>
  <li><strong>Season Press Release</strong> — a file attached to the season.</li>
  <li><strong>Resident Playwright</strong>, <strong>Season Producers</strong>, <strong>Associate Season Producers</strong>, <strong>OTR Sponsors</strong> — each points at Artist or Supporter records, so those must exist first.</li>
</ul>

<h2>Moving the site on to a new season</h2>

<p>
  This is the job people are usually looking for, and it is smaller than it sounds.
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>1. Make sure the new season exists</strong> as a term, and that every production in
    it is filed under it with correct opening and closing dates.
  </li>
  <li>
    <strong>2. Build or update the season's page</strong>, and point the season term at it with
    Quick Edit → Related Page.
  </li>
  <li>
    <strong>3. Change Current Season in Site Options.</strong> This is the switch. Everything
    that computes “what's on now” reads that one field — see
    <?php chance_manual_see('site-options'); ?>.
  </li>
  <li>
    <strong>4. Set Next Season</strong> to the one after it, if there is one.
  </li>
</ul>

<p>
  Nothing needs deleting. Old seasons stay exactly where they are, and their pages keep working.
</p>

<h2>Series</h2>

<p>
  Series is the smaller of the two and rarely changes — the six that exist cover everything.
  The one worth knowing is <strong>Visiting Companies</strong>, which has its own entry in the
  Productions menu: that menu item is simply the production list filtered to that series.
</p>

<p>
  A production can sit in a series and a season at once, and normally does. If a show is
  appearing in the wrong list on the site, it is almost always the series rather than the
  season that is wrong.
</p>
