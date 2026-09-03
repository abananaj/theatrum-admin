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

<h2>Don't create entries in the old Credits area</h2>

<p>
  There is a leftover Credits section from the previous version of the site. Cast and creative
  credits belong in the <strong>Production Credits</strong> panel on the show itself —
  <?php chance_manual_see('production-credits'); ?>.
</p>

<h2>Don't choose “Season Page” from the Template menu</h2>

<p>
  It appears in the template list on pages, but there is nothing behind it yet, so the page
  will not display as you expect. Leave the template setting alone unless you have been told
  otherwise for a specific page.
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

<h2>Don't use “Website Manual”</h2>

<p>
  There is a page called <em>Website Manual</em> in the Pages list. Despite the name it is a
  developer's scratch page for testing layouts, not documentation. The manual you want is the
  one you are reading. Do not edit it, link to it, or use it as a starting point for a real
  page.
</p>

<h2>Don't bulk-edit or bulk-delete without checking the filter</h2>

<p>
  The lists are long — over two thousand artists, hundreds of productions. <em>Select all</em>
  on a filtered list selects every matching item, not just the ones on screen. Check what is
  actually selected before applying a bulk action.
</p>
