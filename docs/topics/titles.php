<?php

/**
 * Site Manual topic: pretitle, short title and subtitle.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Every show, post, page and event has three extra title fields besides the main title. They exist so
  that one long official title can still look tidy on a small card.
</p>

<h2>Where they are</h2>

<p>
  Open anything for editing and look in the right-hand panel for the <strong>Title Settings</strong>
  box. It holds three fields:
</p>

<ul>
  <li>
    <strong>Pretitle</strong> — a small line above the title on cards, e.g.
    <em>Presented by Unbound Productions</em> on a visiting company's show.
  </li>
  <li>
    <strong>Short title</strong> — a shorter name used in place of the full title on cards, e.g.
    <em>Jagged Little Pill</em> instead of <em>Alanis Morissette's Jagged Little Pill: The Musical</em>.
  </li>
  <li><strong>Subtitle</strong> — a line underneath the title.</li>
</ul>

<p>All three are optional. Empty ones simply do not appear.</p>

<h2>When the short title is used</h2>

<p>
  Only where a title has been set up to ask for it. A <strong>Post Title</strong> block has a
  <strong>Use short title</strong> switch in its settings. It is switched on in most of the site's
  cards — the home page grids, season rows, class cards, visiting-company cards, the Press Room — and
  in the header at the top of every show's own page. Search results, the browser tab and anything
  not set up this way use the full title.
</p>

<p>
  If you set a short title and nothing changes, the card you are looking at does not use it. If a
  card uses it and you leave it empty, the full title appears instead; nothing breaks.
</p>

<h2>Rules of thumb</h2>

<ul class="ct-manual__rules">
  <li>
    Keep the <strong>main title</strong> as the full official title — it is what search results and
    the browser tab show. Do the shortening in Short title, never in the main title.
  </li>
  <li>
    Do not put <code>[PHOTOS]</code>, <code>[PRESS]</code> or similar tags in a title. Give the post
    the matching <strong>category</strong> instead — the site labels and filters by category.
  </li>
  <li>
    Visiting companies: the company's name goes in <strong>Pretitle</strong> (<em>Presented by …</em>),
    the show's name in the title, and a shortened show name in <strong>Short title</strong> if it is
    long.
  </li>
</ul>
