<?php

/**
 * Site Manual workflow: putting a whole season up.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  This is the big one, and the reason the order matters: each step depends on the one before it.
  Done in this sequence it is a long afternoon. Done in a different order it turns into an
  afternoon of going back and fixing things.
</p>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>Before you start, know which artists are new.</strong> The credits panel in step 4
    cannot create an artist for you — it is the one place in this whole job with no “add new”
    button. If you can list the new names up front and add them first, the rest runs without
    interruption.
  </p>
</div>

<h2>1. Create the season</h2>

<?php chance_manual_go('edit-tags.php?taxonomy=season&post_type=production', 'Open the Seasons list'); ?>

<p>
  Click <strong>Add New Season</strong> at the top of that page. The form holds everything a season
  needs, so this is a single pass rather than a create-then-come-back:
</p>

<ul>
  <li><strong>Name</strong> — the year. Slug and Description can be left to look after themselves.</li>
  <li><strong>Hide Season?</strong> — leave unticked for a season you are announcing.</li>
  <li><strong>Season Press Release</strong> — see <?php chance_manual_see('workflow-press-release-season'); ?> if you have one.</li>
  <li>
    <strong>Resident Playwright</strong>, <strong>Season Producers</strong>,
    <strong>Associate Season Producers</strong> and <strong>OTR Sponsors</strong> — Artist and
    Supporter records.
  </li>
  <li><strong>Related Page</strong> — the season's page on the site. Step 2 explains what it does.</li>
</ul>

<p>
  Every one of those pickers has an <strong>Add New</strong> button beside it, so a playwright,
  sponsor or page that does not exist yet can be made from here without abandoning the form.
</p>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>Add New opens a full editor in a window on top of the form.</strong> It is the real
    thing — publish or save a draft in there, close it, and what you made drops into the field
    behind it. If you change your mind, close the window without saving and nothing is kept.
  </p>
</div>

<h2>2. Give the season a page</h2>

<p>
  A season is a label, not a page. But visitors expect <em>/2026-season</em> to show them something,
  so <strong>Related Page</strong> points the season at a real page, and anyone landing on the
  season's own address is sent straight there.
</p>

<p>
  Either pick an existing page, or use <strong>Add New</strong> to build it now. Whichever you do,
  remember what a season page is: an ordinary Page carrying a query that pulls in every production
  filed under that season. <strong>You do not list the shows on it by hand</strong> — step 3 files
  them, and the page finds them.
  <?php chance_manual_see('seasons-and-series', 'How season pages are assembled'); ?>.
</p>

<p>
  To change the link later you do not have to reopen the season: the Seasons list has a
  <strong>Related Page</strong> column, and <strong>Quick Edit</strong> on the row sets it.
</p>

<h2>3. Add the productions</h2>

<?php chance_manual_go('post-new.php?post_type=production', 'Add a new production'); ?>

<p>
  One at a time, and for each one: save a draft first, then set <strong>Season</strong> and
  <strong>Series</strong> in the sidebar before anything else. A show with no season will not appear
  on the season page, and that is the single most common thing to have to come back and fix.
</p>

<p>
  Then work down the <strong>Details</strong> tabs — dates, run time, venue, bylines, artwork — and
  set a featured image. <?php chance_manual_see('adding-a-production', 'The full production walkthrough'); ?>.
</p>

<h2>4. Add the cast and creative team</h2>

<p>
  Save the production first. The <strong>Production Credits</strong> panel needs the show to exist
  before it will let you add anything to it.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>The credits panel only finds artists who already exist.</strong> Unlike the season form
    in step 1, there is no “add new” button here. If someone is not in the system, open
    <strong>Artists</strong> in a second browser tab, create and save them there, then come back and
    search again. The same is true of the Producers tab, which searches Supporters rather than
    Artists.
  </p>
</div>

<p>
  <?php chance_manual_see('production-credits', 'How the Credits Manager works'); ?>.
</p>

<h2>5. Add the events</h2>

<p>
  Openings, talkbacks, galas, auditions — each is an Event, and each is created from the
  <strong>Events</strong> menu, not from the production.
</p>

<p>
  On the event, set <strong>Related Production</strong>. That one field is what lists the event on
  the show's page. <?php chance_manual_see('adding-events', 'Adding events'); ?>.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Do it from the event, not from the production.</strong> The production has an
    <strong>Events</strong> field on its Calendar tab, and it fills itself in as you link events to
    the show. Typing into it directly does <em>not</em> link the other way, and leaves you with a
    half-made connection that looks finished.
  </p>
</div>

<h2>6. Turn the season on</h2>

<p>
  Last step, and the one that actually moves the site: set <strong>Current Season</strong> in Site
  Options, and <strong>Next Season</strong> to the one after it. Everything that works out “what is
  on now” reads those two fields.
  <?php chance_manual_see('site-options', 'Site Options'); ?>.
</p>

<h2>Before you call it done</h2>

<ul class="ct-manual__rules">
  <li>Every production has a <strong>season</strong>, a <strong>series</strong> and a <strong>featured image</strong>.</li>
  <li>Every production has <strong>opening and closing dates</strong>, and they are the right way round.</li>
  <li>The season's page opens when you visit the season's own address.</li>
  <li>Nothing is still sitting in <strong>Draft</strong>.</li>
</ul>

<p>
  If something is missing after all that,
  <?php chance_manual_see('why-isnt-my-change-showing', 'work through the checklist'); ?>.
</p>
