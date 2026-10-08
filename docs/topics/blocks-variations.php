<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Blocks that show one production's (or one artist's) information: performance dates, press
  quotes and credits. They are in the <strong>Production</strong> category of the inserter. None
  of them has text to type — they read the show's Details fields or its credits, so you change what
  they show there, not on the block.
</p>

<h2>Performances List</h2>

<p>
  The next five performances of a show, starting today — each on one line, for example
  “Sat Apr 26th 7:30 PM PREVIEW”, with any note at the end of the line. It sits in the production
  page sidebar.
</p>

<p>
  There is nothing to set on the block itself. It reads the show's <strong>Performances</strong>
  list in its Details fields — on the <strong>Calendar 📆</strong> tab for Chance productions, on
  the <strong>Basic ℹ️</strong> tab for OTR Readings and Visiting Companies. Each row has a
  <strong>Date</strong>, <strong>Time</strong> and <strong>Note</strong>. Past dates drop off on
  their own. To take a date off the list (a cancelled performance), delete its row.
</p>

<p>
  When a show has no upcoming dates the block shows nothing — in the editor too — and the
  “Performances” heading grouped with it hides as well, so the sidebar doesn't show an empty
  section.
</p>

<h2>Production Quotes</h2>

<p>
  The press quotes on a production page, each on its own card with the source underneath. It sits
  in the Info tab.
</p>

<p>
  It reads the <strong>Quotes 💬</strong> list on the show's <strong>Buzz 🗨️</strong> tab: the
  <strong>Quote</strong>, who said it (<strong>Cite</strong>), and optionally a
  <strong>Link (press post)</strong> — pick one of the site's own posts, such as the review it came
  from, and the source's name becomes a link to it. Rows without quote text are skipped. Add,
  remove and reorder quotes in the Details fields.
</p>

<p>
  With no quotes at all the block shows nothing on the live page (“No quotes found” in the
  editor). Unlike the Meta blocks, a heading placed next to it does <em>not</em> hide itself. OTR
  Readings and Visiting Companies have no Quotes list, so the block is always empty on those
  shows.
</p>

<h2>Production Credits</h2>

<p>
  The people credited on a show — each with their headshot, name and role, linking to their artist
  page. Production pages get it through the shared <strong>Credits</strong> pattern (Cast and
  Creative Team). The names come from the show's Credits panel; see
  <?php chance_manual_see('production-credits'); ?>. They appear in the order set there.
</p>

<p>
  The inserter offers it four ways — <strong>Production Credits</strong> (everyone),
  <strong>Production Team</strong> (directors, designers and crew),
  <strong>Production Cast</strong> (actors) and <strong>Production Partners</strong> (producers).
  You can switch between them later with <strong>Display</strong> in the right-hand panel. The
  <strong>Layout</strong> panel sets how the cards line up (<strong>Justify content</strong>,
  <strong>Align items</strong>) and how wide each one is (<strong>Item width</strong>, 160px to
  start).
</p>

<p>
  If a show has nobody in that group the block shows nothing, but a heading next to it stays — so
  a show with no cast credits still shows the “Cast” heading.
</p>

<h2>Artist Credits</h2>

<p>
  On an artist's page, the shows they have been credited in, newest first: the show's name (linking
  to it), a series tag such as “Main” or “OTR”, their role and the year. It is part of the artist and supporter
  page templates, so you don't add it yourself. The list comes from each show's credits — to
  change it, edit the credits on the show, not the artist. The <strong>Layout</strong> panel works
  as on Production Credits (240px wide to start).
</p>

<h2>Artist Classes</h2>

<p>
  Also on the artist page template: the classes this person teaches, newest first, with the
  program and session. It lists every published class whose <strong>Teaching Artist</strong> field
  includes them, so to add or remove a class, change that field on the class. It has no settings.
</p>
