<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Production-specific blocks that don't fit the meta or layout groups. One section below per
  block.
</p>

<h2>Performances List</h2>

<p>
  The next five performances of a show, starting today — for example “Sat Apr 26th 7:30 PM”, with
  any note on the line below. It sits in the production page sidebar.
</p>

<p>
  There is nothing to set on the block itself. It reads the show's
  <strong>Performances</strong> list in its Details fields: each row's date, time and note. Rows
  ticked <strong>hide</strong> are skipped, and past dates drop off on their own.
</p>

<p>
  When a show has no upcoming dates the block shows nothing, and a heading grouped with it hides
  too, so the sidebar doesn't show an empty “Performances” section.
</p>

<h2>Production Quotes</h2>

<p>
  The press quotes on a production page, each on its own card with the source underneath. It sits
  in the Info tab.
</p>

<p>
  It reads the show's <strong>Quotes</strong> list in its Details fields: the quote text, who said
  it, and optionally a link to a press post, which turns the source's name into a link. Rows
  without quote text are skipped; with no quotes at all, nothing shows. There are no settings on
  the block — add, remove and reorder quotes in the Details fields.
</p>
