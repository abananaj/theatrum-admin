<?php

/**
 * Site Manual topic: accessibility.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  A theatre website gets read by people using screen readers, people navigating by keyboard,
  people zoomed in to 200%, and a great many people on a phone in bright sun. Almost all of the
  work of accommodating them is already done in the site's design. What is left is a short list
  of things only the person writing the content can get right.
</p>

<h2>The four that matter</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>Alt text on images.</strong> The biggest single win, and covered in full in
    <?php chance_manual_see('images-and-media'); ?>.
  </li>
  <li>
    <strong>Headings in order.</strong> A screen-reader user navigates a page by jumping
    between headings, so the levels have to descend sensibly.
  </li>
  <li>
    <strong>Link text that says where it goes.</strong> “Read the full review” works;
    “click here” does not.
  </li>
  <li>
    <strong>Use the 🌐 colours.</strong> They are guaranteed to stay legible against the
    background they sit on. Hand-picked colours are not.
  </li>
</ul>

<h2>Headings, properly</h2>

<p>
  A heading level is structure, not size. Every page has one <strong>Heading 1</strong> — the
  page's title — and the sections below it are <strong>Heading 2</strong>, with
  <strong>Heading 3</strong> for subsections inside those.
</p>

<ul>
  <li><strong>Do not skip a level</strong> to get a smaller heading. Going from H2 straight to H4 reads, to a screen reader, as a missing section.</li>
  <li><strong>Do not use a heading to make text big.</strong> If you want large text that is not a section title, use a paragraph and set its size.</li>
  <li><strong>Do not bold a paragraph instead of using a heading.</strong> It looks the same and is invisible as structure.</li>
</ul>

<p>
  <strong>List View</strong> in the editor's top toolbar shows the heading levels down the page,
  which is the quickest way to spot a level that has gone astray.
</p>

<h2>Two controls built for this</h2>

<ul>
  <li>
    <strong>Screen Reader Only</strong>, in a block's settings under Accessibility. Hides a block
    visually while leaving it readable by screen readers. Use it when the design makes something
    obvious to a sighted reader that a screen-reader user would otherwise miss — the heading
    above a list of shows, for instance.
  </li>
  <li>
    <strong>Mark as &lt;hgroup&gt;</strong>, on a Group block. When a heading and its subtitle
    are stacked together, this tells the site they are one unit, so the subtitle is not
    announced as a separate section.
  </li>
</ul>

<h2>Writing that helps</h2>

<ul>
  <li>
    <strong>Don't rely on colour alone</strong> to carry meaning — “the shows in red are sold
    out” is invisible to a lot of people. Say it in words too.
  </li>
  <li>
    <strong>Spell out dates and times</strong> rather than using a layout to imply them.
    “Thursday 12 March, 7:30pm” survives being read aloud; a column of bare numbers does not.
  </li>
  <li>
    <strong>Write link text that stands alone.</strong> Screen-reader users can pull up a list of
    every link on a page, with no surrounding sentence to explain them.
  </li>
  <li>
    <strong>Avoid text baked into an image.</strong> A poster with the dates on it is unreadable
    to a screen reader and unsearchable. Put the same information in the page as well.
  </li>
</ul>

<h2>Checking a page</h2>

<p>
  There is no automated accessibility checker switched on at the moment. Two checks you can do
  yourself catch most of what one would find:
</p>

<ul>
  <li>
    <strong>Open List View</strong> and read the headings top to bottom. If they descend
    sensibly and there is exactly one H1, the page structure is sound.
  </li>
  <li>
    <strong>Press Tab repeatedly</strong> on the published page. The focus outline should move
    through every link and button in a sensible order, and always be visible. If it disappears,
    something is wrong.
  </li>
</ul>

<p>
  Neither of those needs a plugin, and both take under a minute.
</p>
