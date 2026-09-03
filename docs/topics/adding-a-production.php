<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  A production is a show. It is the biggest thing you will create on this site and it touches
  the most moving parts, so this walkthrough goes in the order that causes the fewest
  problems. Work top to bottom the first few times.
</p>

<?php chance_manual_go('post-new.php?post_type=production', 'Add a new production'); ?>

<h2>1. Create it and save a draft first</h2>

<p>
  Give it a title and click <strong>Save draft</strong> straight away, before filling anything
  in. The credits panel and several other fields only become usable once the production
  exists. This one habit prevents most of the confusion people hit on their first show.
</p>

<p>
  New productions open with a starter layout already in the content area. It is an ordinary
  starting point, not a locked template — edit it, or delete it and build your own.
</p>

<h2>2. Fill in the details panel</h2>

<p>
  Below the content area is the <strong>Details</strong> panel, split into eight tabs. Most shows
  need the first three; the rest are there when you need them and can be left empty.
</p>

<h3>Basic</h3>

<ul>
  <li><strong>Opening date</strong> and <strong>Closing date</strong> — these drive where the show appears across the site, including whether it counts as current. Get these right before anything else.</li>
  <li><strong>Run time</strong> — in minutes, digits only.</li>
  <li><strong>Intermissions</strong> — choose from the list.</li>
  <li><strong>Venue</strong> — start typing and pick an existing venue. If the venue does not exist yet, create it first under Venues, then come back.</li>
  <li><strong>Venue room</strong> — the specific space within that venue.</li>
</ul>

<h3>Featured</h3>

<p>
  <strong>Bylines</strong> is a repeating list rather than a single field. Each row has a lead
  word or phrase, the text itself, and optionally a linked artist — so a row reads like
  “Directed by · Jane Smith”. Click <em>Add row</em> for each credit line you want in the
  header, and drag rows to reorder them.
</p>

<p>
  <strong>Accolades</strong> works the same way and is for award and press blurbs. Leave it
  empty if there are none; empty rows display as gaps.
</p>

<h3>Artwork</h3>

<p>
  Poster and key art images, plus the <strong>video trailer URL</strong> if there is one —
  paste the ordinary YouTube or Vimeo address, not embed code.
</p>

<h3>Tickets 🎟️</h3>

<p>
  Three link fields — <strong>Choose Your Seats</strong>, <strong>SaverTIX</strong> and
  <strong>Pay What You Choose</strong>. Paste the full ticketing address into whichever apply; each
  one that has a link gets a button, and the ones you leave empty simply do not appear.
</p>

<h3>Calendar 📆</h3>

<p>
  <strong>Performances</strong> is the repeating list of dates and times for the run — a row per
  performance, each with a date, a time and an optional note for things like “opening night” or
  “ASL interpreted”.
</p>

<p>
  <strong>Events</strong> below it is a read-out, not something to fill in. It lists the galas,
  talkbacks and auditions that have been pointed at this show, and it fills itself in as those events
  are created. <?php chance_manual_see('adding-events', 'Events are made from the event side'); ?>.
</p>

<h3>Advisory ⚠️</h3>

<p>
  Content advisories, and a separate <strong>Spoilers</strong> box for anything that gives the show
  away. The spoilers section is hidden behind a click on the page, so it is safe to be specific in
  there.
</p>

<h3>Buzz 🗨️</h3>

<p>
  Reviews and press. <strong>Quotes 💬</strong> and <strong>Awards 🏆</strong> are repeating lists,
  and <strong>Press Release</strong> takes the PDF —
  <?php chance_manual_see('workflow-press-release-production', 'how to attach one'); ?>.
</p>

<h3>Photos 📸</h3>

<p>
  <strong>Production Photos</strong> and <strong>Rehearsal Photos</strong> are the two galleries that
  appear on the show's page, plus a <strong>Playbill</strong> file field. Photos have to be added
  here to be shown — uploading them is not enough on its own.
  <?php chance_manual_see('workflow-production-photos', 'Adding production photos'); ?>.
</p>

<h2>3. Set the featured image</h2>

<p>
  In the right-hand sidebar, set a <strong>featured image</strong>. This is what appears in
  listings, on season pages and in social previews. If you leave it blank the site falls back
  to a generic default image, which looks like a mistake. Always set one.
</p>

<h2>4. File it: series, season and categories</h2>

<p>
  Still in the sidebar:
</p>

<ul>
  <li><strong>Season</strong> — which season the show belongs to. This is what puts it on the right season page.</li>
  <li><strong>Series</strong> — used to group productions that are not part of the main season, including visiting companies.</li>
  <li><strong>Global categories</strong> and <strong>Tags</strong> — optional, used for cross-site grouping.</li>
</ul>

<p>
  A show with no season will not appear on any season page. If a finished production seems to
  be missing from a listing, this is the first thing to check.
</p>

<h2>5. Add the cast and creative team</h2>

<p>
  Scroll to the <strong>Production Credits</strong> panel. This has its own topic, because it
  behaves differently from everything else on the page —
  <?php chance_manual_see('production-credits', 'read it before you start'); ?>.
</p>

<h2>6. Choose the template, if it is not a standard show</h2>

<p>
  In the sidebar, under the page settings, there is a <strong>Template</strong> option. Most
  shows use the default. The alternatives are for on-the-road productions and visiting
  companies. If you are not sure which applies, leave it alone — the default is correct for a
  normal Chance production.
</p>

<h2>7. Preview, then publish</h2>

<p>
  Use <strong>Preview</strong> and read the page as a visitor would before publishing. Check
  the dates, that the poster appears, and that no credit lines are blank.
</p>

<?php chance_manual_go('edit.php?post_type=production', 'See all productions'); ?>

<h2>If something is missing afterwards</h2>

<p>
  The most common causes, in order: no season assigned, the opening or closing date is wrong,
  the production is still a draft, or the page is cached.
  <?php chance_manual_see('why-isnt-my-change-showing', 'Work through the checklist'); ?>.
</p>
