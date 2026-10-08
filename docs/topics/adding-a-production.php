<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  A production is a show. It is the biggest thing you will create on this site and it touches
  the most moving parts, so this walkthrough goes in the order that causes the fewest
  problems. Work top to bottom the first few times.
</p>

<?php chance_manual_go('post-new.php?post_type=production', 'Add a new production'); ?>

<h2>1. Choose the series</h2>

<p>
  A new production opens with a <strong>Choose a Series</strong> window. Pick the series the show
  belongs to — Main, Holiday, TYA Family, Online, OTR Reading or Visiting Companies. The draft then
  saves and reloads on its own, which takes a few seconds.
</p>

<p>
  The series matters more than it looks. It decides which starter layout the show gets, which
  template its page uses, and which <strong>Details</strong> fields you see. OTR Readings and Visiting
  Companies get a shorter set of fields and their own page design; every other series gets the full
  set described below.
</p>

<p>
  <strong>Skip, choose later</strong> closes the window without choosing. You can then set
  <strong>Series</strong> in the sidebar yourself — but save and reload the page afterwards, because the
  Details fields only switch over on reload. There is no separate “Add OTR Reading” link in the menu;
  this window is the way in.
</p>

<h2>2. Give it a title and save a draft</h2>

<p>
  Give it a title and click <strong>Save draft</strong> before filling much else in. The credits
  panel only becomes usable once the production exists.
</p>

<p>
  New productions arrive with a starter layout already in the content area. It is an ordinary
  starting point, not a locked template — edit it, or delete it and build your own.
</p>

<h2>3. Fill in the details panel</h2>

<p>
  Below the content area is the <strong>Details, production 🎭</strong> panel, split into six tabs.
  Most shows need the first four; the rest are there when you need them and can be left empty.
</p>

<h3>Basic ℹ️</h3>

<ul>
  <li><strong>Opening</strong> and <strong>Closing</strong> — the first and last performance. These drive where the show appears across the site, including whether it counts as current, and when its ticket buttons switch off. Get these right before anything else.</li>
  <li><strong>Run time</strong> — in minutes, digits only.</li>
  <li><strong>Intermissions</strong> — choose from the list.</li>
  <li><strong>Venue</strong> — start typing and pick an existing venue. If the venue does not exist yet, create it first under Venues, then come back.</li>
  <li><strong>Venue Room</strong> — the specific stage. It only appears when the venue is the Bette Aitken Theater Arts Center.</li>
</ul>

<h3>Content 📝</h3>

<p>
  <strong>Bylines</strong> is a repeating list rather than a single field. Each row has a
  <strong>Lead</strong>, the <strong>Text</strong> itself, and optionally a linked
  <strong>Artist</strong> — so a row reads like “Directed by · Jane Smith”. Click <em>Add row</em> for
  each credit line you want in the header, and drag rows to reorder them.
</p>

<p>
  <strong>Accolades</strong> works the same way and is for award and press blurbs. Leave it empty if
  there are none; empty rows display as gaps.
</p>

<p>
  The rest of the tab is text boxes:
</p>

<ul>
  <li><strong>Additional Widget Content</strong> — a short extra, such as star ratings, shown on cards like the ones on the home page.</li>
  <li><strong>Intro Description (season page)</strong> — the paragraph about the show on its season page.</li>
  <li><strong>Content Advisory</strong> — shown in the Content Advisory tab on the show's page.</li>
  <li><strong>Spoilers</strong> — hidden behind a button at the bottom of the Content Advisory section, so it is safe to be specific in there.</li>
</ul>

<h3>Tickets 🎟️</h3>

<p>
  Three link fields — <strong>Choose Your Seats</strong>, <strong>SaverTIX</strong> and
  <strong>Pay What You Choose</strong>. Paste the full ticketing address into whichever apply. As soon
  as any of them has a link, the show's page gets a <strong>Get Tickets</strong> button, which opens a
  window with one card per ticket type, and a <strong>Free for Members</strong> button that goes to the
  Member Portal.
</p>

<ul>
  <li>A ticket type you leave empty still shows its card, greyed out with no button.</li>
  <li>Each link has a switch beside it that reads <strong>On Sale</strong>. Flip it to <strong>Sold out</strong> and that card shows “Sold Out” instead of a button. Flip it back when seats open up.</li>
  <li><strong>Presale link</strong> is for before tickets go on sale. It shows as a <strong>Ticket Info</strong> button and disappears by itself once any of the three ticket links is filled in.</li>
  <li>After the <strong>Closing</strong> date passes, all the ticket buttons hide themselves. There is nothing to remove by hand.</li>
</ul>

<p>
  <strong>Ticketing Info</strong> at the bottom of the tab does not currently appear on the show's
  page.
</p>

<h3>Media 🎥📷</h3>

<p>
  Four sections; click a heading to open it.
</p>

<ul>
  <li><strong>Show Artwork 🖼️</strong> — <strong>Preview</strong> (square, also used as the thumbnail), <strong>Poster</strong> (3:4) and <strong>Banner</strong> (4:1, 1500×375).</li>
  <li><strong>Videos 🎥</strong> — <strong>Production Trailer</strong>, <strong>Rehearsal Trailer</strong> and <strong>Accolades Trailer</strong>. Paste the ordinary YouTube address, not embed code.</li>
  <li><strong>Photos 📷</strong> — <strong>Production Photos</strong> and <strong>Rehearsal Photos</strong>, the two galleries in the Photos tab on the show's page. <?php chance_manual_see('workflow-production-photos', 'Adding production photos'); ?>.</li>
  <li><strong>Files 📄</strong> — <strong>Playbill</strong> and <strong>Press Release</strong>. Each one, once filled in, adds a button to the show's sidebar (<strong>See Playbill</strong>, <strong>Press Release</strong>) that opens the PDF in a pop-up. <?php chance_manual_see('workflow-press-release-production', 'Attaching a press release'); ?>.</li>
</ul>

<h3>Calendar 📆</h3>

<p>
  <strong>Events</strong> lists the galas, talkbacks and auditions linked to this show. The link works
  both ways: pick an event here and the event's <strong>Related Production</strong> is filled in for
  you, and the other way round. <?php chance_manual_see('adding-events', 'More on events'); ?>.
</p>

<p>
  <strong>Performances</strong> is the repeating list of dates and times for the run — a row per
  performance, each with a <strong>Date</strong>, a <strong>Time</strong> and an optional
  <strong>Note</strong> for things like “opening night” or “ASL interpreted”. The show's sidebar lists
  the next five; past dates drop off on their own. To take a performance off, delete its row.
</p>

<h3>Buzz 🗨️</h3>

<ul>
  <li><strong>Quotes 💬</strong> — review pull-quotes for the show's page. Each row has the <strong>Quote</strong>, who said it (<strong>Cite</strong>), and optionally <strong>Link (press post)</strong>: pick the blog post the quote comes from and the source's name becomes a link to it.</li>
  <li><strong>Awards 🏆</strong> — awards this production won. These appear on the Past Productions page.</li>
  <li><strong>Posts 🔗</strong> — blog posts about the show. Like Events, this links both ways. <?php chance_manual_see('workflow-production-post', 'Linking a post to a show'); ?>.</li>
</ul>

<h3>OTR Readings and Visiting Companies</h3>

<p>
  These two series get a shorter panel with four tabs:
</p>

<ul>
  <li><strong>Basic ℹ️</strong> — the same dates, run time and venue fields, plus <strong>Description</strong>, the paragraph shown on the season page.</li>
  <li><strong>Content 📝</strong> — <strong>Bylines</strong>, <strong>Accolades</strong>, <strong>Performances</strong> and <strong>Posts 🔗</strong>.</li>
  <li><strong>Media 🎥📷</strong> — <strong>Preview</strong>, <strong>Poster</strong>, <strong>Workshop Photos</strong> (shown in the Photos tab on the page) and <strong>Press Release</strong>.</li>
  <li><strong>Tickets 🎟️</strong> — <strong>Presale link</strong> and a single <strong>Ticket Link</strong>. Ticket Link makes one <strong>Get Tickets</strong> button that goes straight to that address; there are no ticket-type cards or sold-out switches. It also hides after the Closing date.</li>
</ul>

<p>
  There is no Quotes, Awards or Events field for these series.
</p>

<h2>4. Set the featured image</h2>

<p>
  In the right-hand sidebar, set a <strong>featured image</strong>. This is what appears in
  listings, on season pages and in social previews. Filling in Poster does not set it for you. If you
  leave it blank the site falls back to a generic default image, which looks like a mistake. Always
  set one.
</p>

<h2>5. File it: season and categories</h2>

<p>
  Still in the sidebar:
</p>

<ul>
  <li><strong>Season</strong> — which season the show belongs to. This is what puts it on the right season page.</li>
  <li><strong>Series</strong> — already set in step 1. Change it only if you picked the wrong one, and save and reload afterwards.</li>
  <li><strong>Global categories</strong> and <strong>Tags</strong> — optional, used for cross-site grouping.</li>
</ul>

<p>
  A show with no season will not appear on any season page. If a finished production seems to
  be missing from a listing, this is the first thing to check.
</p>

<h2>6. Add the cast and creative team</h2>

<p>
  Scroll to the <strong>Production Credits</strong> panel. This has its own topic, because it
  behaves differently from everything else on the page —
  <?php chance_manual_see('production-credits', 'read it before you start'); ?>.
</p>

<h2>7. Leave the template alone</h2>

<p>
  The <strong>Template</strong> option in the sidebar is set for you. Most shows use
  <strong>Single Production</strong>; OTR Readings switch to <strong>Single Production OTR</strong> and
  Visiting Companies to <strong>Single Production Visiting Company</strong> when the series is saved.
  Older shows that were never moved to the new layout use <strong>Single Production (old)</strong>.
  You should not need to change any of these.
</p>

<h2>8. Preview, then publish</h2>

<p>
  Use <strong>Preview</strong> and read the page as a visitor would before publishing. Check
  the dates, that the poster appears, that the ticket buttons go where they should, and that no
  credit lines are blank.
</p>

<?php chance_manual_go('edit.php?post_type=production', 'See all productions'); ?>

<h2>If something is missing afterwards</h2>

<p>
  The most common causes, in order: no season assigned, the opening or closing date is wrong,
  the production is still a draft, or the page is cached. Missing ticket buttons on a show that
  has closed are expected.
  <?php chance_manual_see('why-isnt-my-change-showing', 'Work through the checklist'); ?>.
</p>
