<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Short list. None of these will break the site instantly, but each one causes damage that is
  slow and irritating to undo. Nothing else in the admin is off limits — if it is not here,
  you can explore it.
</p>

<h2>Don't edit a shared pattern to fix one page</h2>

<p>
  The single most common way to change forty pages by accident. Detach a copy instead —
  <?php chance_manual_see('patterns', 'how to do that safely'); ?>.
</p>

<h2>Don't delete artists, venues or supporters that have been used</h2>

<p>
  Deleting a profile does not remove the references to it. Credits, staff and board listings,
  season pages and production bylines will all keep pointing at something that no longer
  exists, and they fail silently rather than warning you.
</p>

<p>
  If someone should no longer appear, remove the specific credits and listings first, then
  retire the profile. If you are unsure whether a profile is in use, ask before deleting —
  finding the references afterwards is much harder than checking beforehand.
</p>

<h2>Don't change a page's Template</h2>

<p>
  Every page and show already has the right template: new productions get theirs from their
  series, and pages keep the one they were built with. The <strong>Template</strong> list in the sidebar also
  offers designs that belong to other kinds of content — <em>Single Production OTR</em> shows up
  on pages, for example — and picking one gives the page the wrong header and layout. Leave the
  setting alone unless you have been told otherwise for a specific page.
</p>

<h2>Don't edit templates in the Site Editor</h2>

<p>
  <em>Appearance → Editor</em> changes the layout of every page of that type at once — every
  production, every artist profile — and once a template is edited there, later design updates
  stop appearing until someone removes the edited copy. Page-level changes belong in the page,
  not the template.
</p>

<h2>Don't deactivate or delete plugins</h2>

<p>
  Several of them provide the fields and blocks this site is built from. Turning one off
  removes content from live pages immediately. Updates are handled as part of site
  maintenance — if you see an update prompt, leave it.
</p>

<h2>Don't use the “[demos]” page</h2>

<p>
  There is a page called <em>[demos]</em> in the Pages list (its address still ends in
  <em>/website-manual</em>). It is a developer's scratch page for testing layouts, not
  documentation. The manual you want is the one you are reading. Do not edit it, link to it, or use it as a starting point for a real
  page.
</p>

<h2>Don't bulk-edit or bulk-delete without checking the filter</h2>

<p>
  The lists are long — over two thousand artists, hundreds of productions. <em>Select all</em>
  on a filtered list selects every matching item, not just the ones on screen. Check what is
  actually selected before applying a bulk action.
</p>
