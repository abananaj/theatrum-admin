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
    <strong>Before you start, know which artists are new.</strong> Nothing in the production editor
    can create an artist for you — see step 4. If you can list the new names up front and add them
    first, the rest of this runs without interruption.
  </p>
</div>

<h2>1. Create the season</h2>

<?php chance_manual_go('edit-tags.php?taxonomy=season&post_type=production', 'Open the Seasons list'); ?>

<p>
  Add the season on the left-hand form. The fields on a season — <strong>Hide Season?</strong>,
  <strong>Season Press Release</strong>, <strong>Resident Playwright</strong>,
  <strong>Season Producers</strong>, <strong>Associate Season Producers</strong> and
  <strong>OTR Sponsors</strong> — sit on the term itself, so you can fill them in now or come back.
  The producer and sponsor fields point at existing Artist and Supporter records, so those need to
  exist first.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>The Related Page field is not on this form.</strong> It only appears in
    <strong>Quick Edit</strong> on the Seasons list, which is step 2. Do not go looking for it while
    creating the season — it is not there.
  </p>
</div>

<h2>2. Give the season a page</h2>

<p>
  Build the season's page as an ordinary Page, then go back to the Seasons list, hover the season's
  row, and click <strong>Quick Edit</strong>. Set <strong>Related Page</strong> to the page you just
  made. That is what sends anyone visiting the season's own address to a real page.
</p>

<p>
  You do not add shows to that page by hand — it finds them itself once the shows are filed under
  the season. <?php chance_manual_see('seasons-and-series', 'How season pages are assembled'); ?>.
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
    <strong>The credits panel only finds artists who already exist.</strong> There is no “add new”
    button in it. If someone is not in the system, open <strong>Artists</strong> in a second browser
    tab, create and save them there, then come back and search again. The same is true of the
    Producers tab, which searches Supporters rather than Artists.
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
