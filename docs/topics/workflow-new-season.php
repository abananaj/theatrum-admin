<?php

/**
 * Site Manual workflow: putting a whole season up.
 */

if ( ! defined('ABSPATH')) {
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

<?php chance_manual_go('edit-tags.php?taxonomy=season', 'Open Seasons → All Seasons'); ?>

<p>
  The <strong>Add New Season</strong> form is on the left of that page. It holds everything a
  season needs, so this is a single pass rather than a create-then-come-back:
</p>

<ul>
  <li><strong>Name</strong> — the year. Slug and Description can be left to look after themselves.</li>
  <li><strong>Hide Season?</strong> — leave unticked for a season you are announcing.</li>
  <li><strong>General Press Releases</strong> and <strong>OTR Press Releases</strong> — see <?php chance_manual_see('workflow-press-release-season'); ?> if you have them yet.</li>
  <li>
    <strong>Resident Playwright</strong>, <strong>Season Producers</strong>,
    <strong>Associate Season Producers</strong> and <strong>OTR Sponsors</strong> — Artist and
    Supporter records.
  </li>
  <li><strong>Related Page</strong> — the season's page on the site. You can leave it for now; step 2 comes back to it.</li>
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

<?php chance_manual_go('post-new.php?post_type=page&ct_layout=season', 'Seasons → New Season'); ?>

<p>
  <strong>Seasons → New Season</strong> opens a Page that is already laid out as a season page and
  already filed under Onstage. Before anything else, set its <strong>Season</strong> in the sidebar to
  the season you made in step 1 — the editor shows a reminder. The producers' message and every row
  of shows read from that setting, so without it the page stays empty.
</p>

<p>
  Fill in the lead sentence and the producers' letter, then save. <strong>You do not list the shows on
  it by hand</strong> — step 3 files them, and the page finds them.
  <?php chance_manual_see('seasons-and-series', 'How season pages are assembled'); ?>.
</p>

<p>
  Then point the season at the page. Go back to <strong>Seasons → All Seasons</strong> and use
  <strong>Quick Edit</strong> on the season's row to set <strong>Related Page</strong>. Visitors who
  land on the season's own address (<em>/2026-season</em>) are then sent to this page.
</p>

<h2>3. Add the productions</h2>

<?php chance_manual_go('post-new.php?post_type=production', 'Add a new production'); ?>

<p>
  One at a time. A new production opens with a <strong>Choose a Series</strong> box: pick the series,
  and the draft saves and reloads with the right fields and page design for that kind of show. Then
  set <strong>Season</strong> in the sidebar before anything else. A show with no season will not
  appear on the season page, and that is the single most common thing to have to come back and fix.
</p>

<p>
  Then work through the <strong>Details</strong> tabs — <strong>Basic</strong> for dates, run time and
  venue, then <strong>Content</strong>, <strong>Tickets</strong>, <strong>Media</strong>,
  <strong>Calendar</strong> and <strong>Buzz</strong> — and set a featured image.
  <?php chance_manual_see('adding-a-production', 'The full production walkthrough'); ?>.
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
  Openings, talkbacks, galas, auditions — each is an Event, created from the
  <strong>Events</strong> menu (<strong>Add Audition</strong> for auditions).
</p>

<p>
  On the event, set <strong>Related Production</strong>. That links it both ways: the event is listed
  on the show's page, and it appears in the production's own <strong>Events</strong> field on the
  Calendar tab. Linking from the production's side works too.
  <?php chance_manual_see('adding-events', 'Adding events'); ?>.
</p>

<h2>6. Turn the season on</h2>

<p>
  Last step: an administrator sets <strong>Current Season</strong> in
  <strong>Seasons → Season Settings</strong>, and <strong>Next Season</strong> to the one after it.
  Past Productions and the Press Room open on the Current Season. Editors cannot open Season Settings,
  so if you are an Editor, ask an administrator to do this one.
  <?php chance_manual_see('seasons-and-series', 'What Current Season does'); ?>.
</p>

<p>
  The home page works out what is on stage from the production dates by itself, but its season
  section is set on the home page's own blocks — check it still shows the right season.
</p>

<h2>Before you call it done</h2>

<ul class="ct-manual__rules">
  <li>Every production has a <strong>season</strong>, a <strong>series</strong> and a <strong>featured image</strong>.</li>
  <li>Every production has <strong>opening and closing dates</strong>, and they are the right way round.</li>
  <li>The season page has its <strong>Season</strong> set, and every row shows the right shows.</li>
  <li>The season's page opens when you visit the season's own address.</li>
  <li>Nothing is still sitting in <strong>Draft</strong>.</li>
</ul>

<p>
  If something is missing after all that,
  <?php chance_manual_see('why-isnt-my-change-showing', 'work through the checklist'); ?>.
</p>
