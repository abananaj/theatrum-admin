<?php

/**
 * Site Manual topic: seasons and series.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  <strong>Season</strong> is when a show happened — 2024, 2025, 2026. <strong>Series</strong> is
  what kind of show it is — Main, OTR Reading, TYA Family, Holiday, Visiting Companies, Online.
  Every production should have one of each, and between them they drive most of the lists on
  the site. Both live under the <strong>Seasons</strong> menu.
</p>

<?php chance_manual_go('edit-tags.php?taxonomy=season', 'Open the Seasons list'); ?>

<h2>They are not pages</h2>

<p>
  A season is a label, not a page. But visitors expect <em>/2026-season</em> to show them
  something, so each season term can point at a real page — and when it does, anyone landing on
  the season's own address is sent straight there.
</p>

<p>
  That link is the <strong>Related Page</strong> field, and there are three places to set it: on the
  <strong>Add New Season</strong> form when you first create the season, on the season's own edit
  screen afterwards, and — quickest for an existing season — via <strong>Quick Edit</strong> on its
  row in the Seasons list, where a <strong>Related Page</strong> column also shows what is currently
  linked.
</p>

<p>
  The picker has an <strong>Add New</strong> button, so the page can be created from there rather
  than made first. It opens a full editor in a window on top; save or publish, close it, and the new
  page drops into the field.
</p>

<p>
  The same Related Page mechanism exists on Series, Sessions, Programs, Event Types and Support
  Levels, though only Season actually redirects.
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
  Start it from <strong>Seasons → New Season</strong>. That opens a new Page, already filed under
  <strong>Onstage</strong> and already laid out: the season header, a lead sentence to fill in, the
  Season Producers' message, and one row of shows for each series — Main, OTR, TYA and Holiday.
</p>

<?php chance_manual_go('post-new.php?post_type=page&ct_layout=season', 'Start a new season page'); ?>

<p>
  <strong>Give the page its Season</strong> in the editor's sidebar before anything else — a notice at
  the top of the editor reminds you. Everything on the page reads from that one setting: the series
  rows show the productions filed under that season, and the producers' names come from the season
  itself. A season page with no Season set shows empty rows.
</p>

<p>
  Which means <strong>you do not add shows to a season page.</strong> You file the show under
  the season on the production itself, and the page picks it up. If a show is missing from a
  season page, the season on that production is the thing to check — and if a whole row is wrong,
  check the series.
</p>

<h2>What a season term itself holds</h2>

<p>
  Open a season for editing and there are a few fields on the term:
</p>

<ul>
  <li><strong>Hide Season?</strong> — takes the season out of the lists without deleting anything.</li>
  <li><strong>General Press Releases</strong> and <strong>OTR Press Releases</strong> — files attached to the season, which the Press Room lists. See <?php chance_manual_see('workflow-press-release-season'); ?>.</li>
  <li><strong>Resident Playwright</strong>, <strong>Season Producers</strong>, <strong>Associate Season Producers</strong>, <strong>OTR Sponsors</strong> — each points at Artist or Supporter records. Each has an <strong>Add New</strong> button, so a name that is not in the system yet can be created without leaving the season.</li>
  <li><strong>Related Page</strong> — the season's page, as above.</li>
</ul>

<h2>Current Season — Season Settings</h2>

<p>
  <strong>Seasons → Season Settings</strong> holds <strong>Current Season</strong>,
  <strong>Next Season</strong> and <strong>Hide Next Season?</strong>. Only administrators can open
  it; if you are an Editor, ask one.
</p>

<?php chance_manual_go('admin.php?page=season-settings', 'Open Season Settings'); ?>

<p>
  What Current Season does is narrower than its name suggests. <strong>Past Productions</strong> and
  the <strong>Press Room</strong> each show one season at a time with a <strong>Season</strong>
  dropdown for the others, and Current Season is the one they open on. It does not decide what the
  home page shows as on stage now — that is worked out from the opening and closing dates on each
  production, which is why a show with missing or mistyped dates can vanish from the home page.
</p>

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
    <strong>2. Build the season's page</strong> with <strong>Seasons → New Season</strong>, give it
    its Season, and point the season term at it with Quick Edit → Related Page.
  </li>
  <li>
    <strong>3. Change Current Season in Seasons → Season Settings</strong> (administrators), so
    Past Productions and the Press Room open on the new season. Set <strong>Next Season</strong>
    to the one after it, if there is one.
  </li>
  <li>
    <strong>4. Check the home page.</strong> What is on stage now follows the production dates by
    itself, but the home page's season section is set on the home page's own blocks, so it may
    still be showing the old season. Ask whoever looks after the home page if it needs moving on.
  </li>
</ul>

<p>
  Nothing needs deleting. Old seasons stay exactly where they are, and their pages keep working.
</p>

<h2>Series</h2>

<p>
  Series is the smaller of the two and rarely changes — the six that exist cover everything. It
  matters more than it looks: when you add a production, the <strong>Choose a Series</strong> box
  that opens first decides which fields the show gets and which page design it uses. OTR Readings
  and Visiting Companies each have their own row in the <strong>Productions</strong> menu, which
  is simply the production list filtered to that series.
</p>

<p>
  A production can sit in a series and a season at once, and normally does. If a show is
  appearing in the wrong list on the site, it is almost always the series rather than the
  season that is wrong.
</p>
