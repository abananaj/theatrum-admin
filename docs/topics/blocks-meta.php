<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Meta blocks pull a field value — from the post, a term, or Site Options — onto the page.
  One section below per block.
</p>

<h2>How they all work</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>You type the field's name.</strong> Each block has a <strong>Key</strong> box in the
    right-hand panel where you type the field's internal name, such as <code>opening</code> or
    <code>video_trailer_url</code>. There is no list to choose from, so copy names from an existing
    block or ask the developer.
  </li>
  <li>
    <strong>They read the post they're on.</strong> In a template or pattern that means whichever
    show, event or page is being viewed. Inside a post list (Query Loop), each item reads its own
    post.
  </li>
  <li>
    <strong>The editor shows the real value</strong> for the post you're editing. If the field is
    empty you'll see its name in brackets, like <code>[opening]</code>.
  </li>
  <li>
    <strong>Empty fields hide themselves</strong> on the live site. Put a heading and a meta block
    together in one Group and the heading hides too when the field is empty; a Group holding only
    empty meta blocks and headings disappears entirely.
  </li>
  <li>
    <strong>Prepend / Append</strong> add words before or after the value, e.g. “Taught by ”. They
    only show when there is a value.
  </li>
</ul>

<h2>Meta Field</h2>

<p>
  Shows a field's value as text. Type the field name in <strong>Key</strong>.
</p>

<ul>
  <li><strong>HTML Tag</strong> — what kind of text it is: a paragraph, a heading, or a link.</li>
  <li><strong>Render as HTML (WYSIWYG)</strong> — for formatted text fields, keeping their paragraphs and bold/italic.</li>
  <li><strong>Fallback to post content when empty</strong> — shows the post's main text if the field is blank.</li>
  <li><strong>Prepend</strong> / <strong>Append</strong>.</li>
</ul>

<p>
  It shows the value exactly as stored, so dates and similar fields look raw — use Meta Date or
  Meta Time for those.
</p>

<h2>Meta Date</h2>

<p>
  Shows a date field, formatted. Type the field in <strong>Date Field Key</strong> — for shows,
  <code>opening</code> and <code>closing</code>.
</p>

<ul>
  <li><strong>Display Format</strong> — Jan 1st, January 1, Sunday, January 1, and so on, or <em>Custom</em>.</li>
  <li><strong>Custom Format</strong> — letter codes for your own format; the help text under the box lists them. <code>M j</code> gives “Nov 26”.</li>
  <li><strong>Prepend</strong> / <strong>Append</strong> — e.g. “– ” before a closing date.</li>
</ul>

<p>
  Pick a format: until you do, dates show as 2026-11-26. A value that isn't a recognisable date is
  shown as typed.
</p>

<h2>Meta Time</h2>

<p>
  Shows a time field, formatted. Type the field in <strong>Time Field Key</strong>, then choose a
  <strong>Display Format</strong> — 2:30 PM, 02:30 PM, 14:30, or Custom. Events use it for their
  start and end times.
</p>

<h2>Meta Image</h2>

<p>
  Shows an image field, such as a show's poster or banner. Type the field in
  <strong>Meta Key</strong>.
</p>

<ul>
  <li><strong>Image Size</strong> — which size to load; smaller loads faster.</li>
  <li><strong>Link To</strong> — nothing, the image file, or a web address of your choice.</li>
  <li><strong>Show caption</strong> — uses the caption from the Media Library.</li>
</ul>

<p>
  The image's description for screen readers is its Alt Text in the Media Library — set it there,
  not on the block.
</p>

<h2>Meta Gallery</h2>

<p>
  Shows a gallery field as a grid of photos — class pages use it for their photos. Type the field
  in <strong>Meta Key</strong> (Gallery settings).
</p>

<ul>
  <li><strong>Columns</strong>, <strong>Columns (Tablet)</strong>, <strong>Columns (Mobile)</strong> — photos per row at each screen size.</li>
  <li><strong>Aspect Ratio</strong> and <strong>Image Crop</strong> — make every photo the same shape.</li>
  <li><strong>Limit number of images</strong> — show only the first few; leave empty for all.</li>
  <li><strong>Random order</strong> — shuffle on each visit.</li>
  <li><strong>Fallback Text</strong> — a message to show when there are no photos. Leave it empty and the gallery, and its heading, simply disappear.</li>
</ul>

<h2>Meta File Link</h2>

<p>
  A link to a file field — the playbill or a press release PDF. Type the field in
  <strong>Meta Key</strong>.
</p>

<ul>
  <li><strong>Link Text</strong> — your own words, or the file's title or name.</li>
  <li><strong>Show multiple files as a list</strong> — when the field holds several files, one per line.</li>
  <li><strong>Embed PDF on the page</strong> — shows the PDF itself on the live page, not just a link.</li>
  <li><strong>Fallback Text</strong> — a message when there's no file. Leave empty to hide the block.</li>
</ul>

<h2>Meta Embed</h2>

<p>
  Embeds a video or other media from a web address stored in a field. There are two versions in the
  inserter: <strong>Meta Embed</strong> for any address, and <strong>YouTube Video</strong>, which
  accepts any style of YouTube link and uses YouTube's privacy-friendly player. The production
  trailer tab uses <code>video_trailer_url</code>.
</p>

<p>
  In templates the editor shows a placeholder instead of the video; check the live page.
</p>

<h2>Meta Related</h2>

<p>
  Shows the name of another post a field points to — a show's venue, or who teaches a class. Type
  the field in <strong>Meta Key</strong>.
</p>

<ul>
  <li><strong>Link to post</strong> — makes the name a link to that post (off by default).</li>
  <li><strong>Separator</strong> — goes between names when there are several (a comma to start).</li>
  <li><strong>Prepend text</strong> / <strong>Append text</strong> — e.g. “Taught by ”.</li>
</ul>

<h2>Meta Repeater</h2>

<p>
  Lists the rows of a repeating field, such as a show's bylines or accolades. Type the field in
  <strong>Repeater Field Key</strong>, then name up to two parts of each row in
  <strong>Subfield A</strong> and <strong>Subfield B</strong> (for bylines: <code>lead</code> and
  <code>text</code>).
</p>

<ul>
  <li><strong>Block Format</strong> — paragraphs, a bulleted list or a numbered list.</li>
  <li><strong>Tag</strong> (per subfield) — how each part is marked up, once a list format is chosen.</li>
</ul>

<p>Rows with nothing in them are skipped.</p>

<h2>Meta Button</h2>

<p>
  A button whose link comes from a field. Type the field holding the web address in
  <strong>URL Field Key</strong> and the words in <strong>Button Text</strong> (“Learn More” to
  start). It looks like a normal button, opens in the same tab, and disappears when the field is
  empty.
</p>

<h2>Term Meta</h2>

<p>
  Shows a field stored on a category-type item rather than a post — most often a season, for its
  season producers or press release.
</p>

<ul>
  <li><strong>Taxonomy</strong> and <strong>Term</strong> — which season (or series, etc.). Choose <strong>Current term (from post)</strong> to use whichever season the page belongs to, so one pattern works for every season.</li>
  <li><strong>Meta Key</strong> — the field name.</li>
  <li><strong>HTML Tag</strong> — choose <em>List</em> to show several items one per line.</li>
  <li><strong>Link to post</strong> — when the field holds people or posts, links their names.</li>
</ul>

<h2>Site Option</h2>

<p>
  Shows one of the site-wide settings from <?php chance_manual_see('site-options'); ?> — the People
  page uses it for board and staff positions.
</p>

<ul>
  <li><strong>Option Name</strong> — the setting's internal name, which always starts with <code>options_</code>.</li>
  <li><strong>Post Meta Key</strong> — when the setting points to a person, also show one of their fields (e.g. their title).</li>
  <li><strong>Link Post Title</strong> — links the person's name to their page.</li>
  <li><strong>Prepend</strong> / <strong>Append</strong>, each with a style: italic, bold or small.</li>
</ul>
