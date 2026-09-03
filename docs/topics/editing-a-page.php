<?php

/**
 * Site Manual topic: editing a page with blocks.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Pages on this site are built out of blocks — stacked chunks of content you can click,
  type into and rearrange. This page covers the parts that are specific to this site. The
  general business of typing and dragging is best learnt by doing, and the editor's own
  help is good at it.
</p>

<h2>Finding the page</h2>

<p>
  Pages are the standing parts of the site: About, Support Us, Visit, and so on.
</p>

<?php chance_manual_go('edit.php?post_type=page', 'Open the Pages list'); ?>

<p>
  A lot of the site is <em>not</em> a Page. Shows, artists, events, classes and venues each
  live in their own list in the left-hand menu, and are edited the same way but with extra
  fields below the content. If you cannot find something in Pages, it is almost certainly
  one of those.
</p>

<h2>Before you change anything: which kind of edit is this?</h2>

<p>
  There are three, and they carry very different risk.
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>Changing words on this page.</strong> Click into the text and type. Safe, as long
    as the text is not part of a shared pattern — which is the one thing worth checking first.
  </li>
  <li>
    <strong>Changing how a block looks.</strong> Select the block and use the settings panel
    on the right. Affects this page only, and is undoable.
  </li>
  <li>
    <strong>Changing layout — adding, deleting or moving blocks.</strong> Fine on an ordinary
    page. On a page assembled from shared patterns, this is where things go wrong.
  </li>
</ul>

<p>
  A shared pattern shows up in the editor as a single unit with a purple outline, and editing
  it changes every page that uses it. Read
  <?php chance_manual_see('patterns'); ?> before you edit anything with that outline.
</p>

<h2>The blocks built for this site</h2>

<p>
  Open the inserter (the <strong>+</strong> button, top left) and you will see the standard
  WordPress blocks plus four categories that belong to this site:
</p>

<ul>
  <li><strong>Custom Blocks</strong> — sliders, carousels, filters and the like.</li>
  <li>
    <strong>Meta Blocks</strong> — blocks that display information stored on the post
    itself: its dates, its poster image, a field, a gallery.
  </li>
  <li><strong>Production</strong> — show-specific blocks such as quotes and performance dates.</li>
</ul>

<p>
  If a block or one of its variations has <strong>(Deprecated)</strong> in its name, or its
  description says it has been replaced, it is only there so that older pages keep working.
  Use whatever it points you to instead.
</p>

<p>
  The Meta and Production blocks have a catch worth knowing in advance: they read information
  from the post they are placed on. Dropped onto an ordinary page, which has no show dates or
  poster to read, they display nothing at all — no error, just a gap. If a block seems to have
  vanished, see <?php chance_manual_see('why-isnt-my-change-showing', 'Why isn\'t my change showing?'); ?>
</p>

<h2>Colours: the globe rule</h2>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>Colour swatches with a 🌐 on their name are the ones to use.</strong>
    They follow the site's design; the plainly-named colours below them are fixed forever.
  </p>
</div>

<p>
  When you open a colour picker you will see two kinds of swatch. The first few are named
  <strong>Primary&nbsp;🌐</strong>, <strong>Secondary&nbsp;🌐</strong>,
  <strong>Tertiary&nbsp;🌐</strong>, <strong>Dark&nbsp;🌐</strong>,
  <strong>Light&nbsp;🌐</strong> and <strong>Muted&nbsp;🌐</strong>. These are roles rather
  than colours. They shift to match whichever section of the site the content is sitting in,
  and they are guaranteed to stay legible against each other.
</p>

<p>
  Below them is a long list of actual colours — Brick Red, Teal, Goldenrod and so on. Picking
  one of these pins that exact colour in place. It will not follow a section's colour scheme,
  and it will not update if the site's palette is ever revised. Use them only when a specific
  colour is genuinely the point.
</p>

<p>
  The short version: reach for a 🌐 swatch first, every time.
</p>

<h2>Colour categories on a section</h2>

<p>
  This is how the 🌐 colours know what to be. Select a <strong>Group</strong> block and look in
  the settings panel for a section called <strong>Global Categories</strong>, with a dropdown
  labelled <strong>Color category</strong>. Choosing a category — Onstage, Education, Donate,
  Membership, Backstage and so on — recolours everything inside that group to that category's
  scheme.
</p>

<p>
  Two things follow from that. Nesting works: a group set to one category, containing a group
  set to another, gives you two colour schemes on one page. And on a show or class page you
  usually do not need to set this at all — the page already carries its own category, and the
  colours are correct before you touch anything.
</p>

<h2>Width</h2>

<p>
  Most blocks offer three widths in the toolbar: the default, <strong>Wide</strong> and
  <strong>Full</strong>. Default keeps content in the readable centre column, Wide spills a
  little past it, and Full runs edge to edge. Full width is for images, video and coloured
  bands — it is not for paragraphs, which become very hard to read at that width.
</p>

<h2>A few controls you will not find in any WordPress guide</h2>

<p>
  These were added for this site and appear in the block settings panel:
</p>

<ul>
  <li>
    <strong>Screen Reader Only</strong>, under Accessibility — hides a block visually while
    leaving it readable by screen readers. Useful for a heading that a sighted reader gets
    from the design but a screen-reader user would otherwise miss.
  </li>
  <li>
    <strong>Mark as &lt;hgroup&gt;</strong>, on Group blocks — tells the site that a heading
    and its subtitle are one unit rather than two separate headings.
  </li>
  <li>
    <strong>Inline quote</strong> and <strong>Small text</strong>, in the text toolbar under
    the arrow at its right end — for styling a few words inside a paragraph.
  </li>
  <li>
    <strong>Position</strong> — moves a block out of the normal flow of the page. Powerful,
    easy to break a layout with, and a common cause of things overlapping on phones. Leave it
    alone unless someone has walked you through it.
  </li>
</ul>

<h2>List View is your friend</h2>

<p>
  The <strong>List View</strong> button in the top toolbar opens an outline of every block on
  the page. On this site's pages, which nest groups inside groups, it is far easier to select
  the right thing there than by clicking around the canvas — and it is the reliable way to see
  what a block actually sits inside.
</p>

<h2>Saving and checking your work</h2>

<ul>
  <li><strong>Save draft</strong> keeps changes without making them public — on a page that has never been published.</li>
  <li><strong>Update</strong> on an already-published page is live immediately. There is no separate approval step.</li>
  <li><strong>Preview</strong> shows the page as a visitor sees it. Always worth a look, especially on the mobile preview, before updating.</li>
</ul>

<p>
  If you have made a mess, the editor's undo (Ctrl+Z / Cmd+Z) works, and every save creates a
  revision you can roll back to from the settings sidebar. Neither of those helps with a shared
  pattern, which is why that one has a page of its own.
</p>

<h2>Leave these alone</h2>

<ul>
  <li>
    The <strong>Template</strong> dropdown in the page settings — it controls the whole frame
    around the content, and the wrong choice can blank a page. See
    <?php chance_manual_see('things-not-to-touch'); ?>.
  </li>
  <li>
    The <strong>Advanced</strong> panel at the bottom of a block's settings — the CSS class
    boxes there are how much of the site's styling is wired up, and clearing one silently
    changes the design.
  </li>
  <li>
    Anything in <strong>Appearance → Editor</strong>. That edits the site's templates — the
    header, footer and page frames — not a single page.
  </li>
</ul>
