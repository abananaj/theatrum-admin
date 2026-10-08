<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Meta blocks pull a field value — from the post, a term, or Site Options — onto the page.
  One section below per block. In the inserter they are in the <strong>Meta Blocks</strong> category.
</p>

<h2>How they all work</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>You type the field's name.</strong> Each block has a box in the right-hand panel where
    you type the field's internal name, such as <code>opening</code> or
    <code>video_trailer_url</code>. The box is labelled differently on each block —
    <strong>Key</strong>, <strong>Date Field Key</strong>, <strong>Meta Key</strong>,
    <strong>Option Name</strong> and so on — but it is the same idea. There is no list to choose
    from, so copy names from an existing block or ask the developer.
  </li>
  <li>
    <strong>They read the post they're on.</strong> In a template or pattern that means whichever
    show, event or page is being viewed. Inside a post list (Query Loop), each item reads its own
    post. The exceptions are Term Meta, which reads a season or other term, and Site Option, which
    reads a site-wide setting.
  </li>
  <li>
    <strong>The editor shows the real value</strong> for the post you're editing. If the field is
    empty you'll see its name in brackets, like <code>[opening]</code>. When you edit a template
    there is no single post to read, so you see the bracketed name there too.
  </li>
  <li>
    <strong>Empty fields hide themselves</strong> on the live site, and can take a heading with
    them. For that to work the heading and the meta block must sit directly inside the same Group
    — not in separate Groups, and not one level deeper. Note that one empty meta block hides
    <em>every</em> heading directly in its Group, even if another meta block there has a value, so
    give each heading-and-field pair its own Group. A Group holding nothing but empty meta blocks,
    headings and other Groups disappears entirely.
  </li>
  <li>
    <strong>Prepend / Append</strong> add words before or after the value, e.g. “Taught by ”. They
    only show when there is a value. Only Meta Field, Meta Date, Meta Time, Meta Related, Term Meta
    and Site Option have them.
  </li>
</ul>

<h2>Hiding any block when a field is empty</h2>

<p>
  Ordinary blocks — a button, a Group, a whole tab — can also be hidden when the show has no value
  for a field. Select the block, open <strong>Advanced</strong> in the right-hand panel, and add
  <code>ct-if-</code> followed by the field name to <strong>Additional CSS class(es)</strong>. For
  example <code>ct-if-playbill</code> on the production sidebar's Playbill Group hides it on any show without a
  playbill.
</p>

<ul>
  <li>Add several, separated by spaces, and the block shows when <em>any one</em> of those fields has a value — <code>ct-if-tickets_best ct-if-tickets_saver ct-if-tickets_pwyc</code> shows if any ticket link is set.</li>
  <li>It only reads fields on the post itself (not Site Options or seasons).</li>
  <li>It only takes effect on the live site. In the editor the block always shows.</li>
  <li>Ticket buttons using it also disappear once a show's closing date has passed.</li>
</ul>

<h2>Meta Field</h2>

<p>
  Shows a field's value as text. Type the field name in <strong>Key</strong>.
</p>

<ul>
  <li><strong>HTML Tag</strong> — what kind of text it is: <code>&lt;span&gt;</code> (the default, plain text inside a line), <code>&lt;p&gt;</code> (a paragraph), <code>&lt;h1&gt;</code>–<code>&lt;h6&gt;</code> (a heading), or <code>&lt;a&gt;</code> (a link).</li>
  <li><strong>Link URL</strong> — appears when the tag is <code>&lt;a&gt;</code>. Type the address the value should link to; it is the same address on every post.</li>
  <li><strong>Render as HTML (WYSIWYG)</strong> — for formatted text fields, keeping their paragraphs and bold/italic. With this on, HTML Tag, Prepend and Append disappear: formatted text is shown as-is.</li>
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
  <li><strong>Display Format</strong> — Jan 1st, January 1, 01-01-2026, 1-1-2026, Sunday, January 1, or <em>Custom</em>.</li>
  <li><strong>Custom Format</strong> — letter codes for your own format. <code>M j</code> gives “Nov 26”; <code>M j, Y</code> gives “Nov 26, 2026”.</li>
  <li><strong>HTML Tag</strong> — paragraph (the default), <code>&lt;span&gt;</code>, <code>&lt;time&gt;</code> or a heading.</li>
  <li><strong>Prepend</strong> / <strong>Append</strong> — e.g. “– ” before a closing date.</li>
</ul>

<p>
  <strong>Pick a format even if the box already says “Jan 1st”.</strong> A new block's real
  format is 2026-11-26; the dropdown just displays its first choice. Choose a different option and
  back again to set it properly. A value that isn't a recognisable date is cut down to its first
  word and shown as typed.
</p>

<h2>Meta Time</h2>

<p>
  Shows a time field, formatted. Type the field in <strong>Time Field Key</strong>, then choose a
  <strong>Display Format</strong> — 2:30 PM, 02:30 PM (the default), 14:30, or Custom. Events use
  it for their start and end times.
</p>

<h2>Meta Image</h2>

<p>
  Shows an image field, such as a show's poster or banner. Type the field in
  <strong>Meta Key</strong>.
</p>

<ul>
  <li><strong>Image Size</strong> — which size to load; smaller loads faster.</li>
  <li><strong>Link To</strong> — None, Media File (the full image), Attachment Page, or Custom URL.</li>
  <li><strong>Open in new tab</strong> — for a linked image.</li>
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
  <li><strong>Aspect Ratio</strong> and <strong>Crop images to same height</strong> — make every photo the same shape.</li>
  <li><strong>Limit number of images</strong> — show only the first few; leave empty for all.</li>
  <li><strong>Random order</strong> — shuffles the photos. The live site keeps a saved copy of each page, so the order changes when that copy is refreshed, not on every visit.</li>
  <li><strong>Fallback Text</strong> — in its own <strong>Fallback</strong> panel, closed by default. A message to show when there are no photos. Leave it empty and the gallery, and its heading, simply disappear.</li>
</ul>

<h2>Meta File Link</h2>

<p>
  A link to a file field — the playbill or a press release PDF. Type the field in
  <strong>Meta Key</strong>. The link opens in a new tab unless you turn
  <strong>Open in new tab</strong> off.
</p>

<ul>
  <li><strong>Link Text</strong> — your own words, or the file's title or name.</li>
  <li><strong>Show multiple files as a list</strong> — when the field holds several files, one per line.</li>
  <li><strong>Show file icon</strong> — a small file icon before the link (on by default).</li>
  <li><strong>Embed PDF on the page</strong> — shows the PDF itself below the link on the live page, not just a link. The production sidebar's Playbill and Press Release popups use this.</li>
  <li><strong>Fallback Text</strong> — a message when there's no file. Leave empty to hide the block.</li>
</ul>

<h2>Meta Embed</h2>

<p>
  Embeds a video or other media from a web address stored in a field. There are two versions in the
  inserter: <strong>Meta Embed</strong> for any address (box: <strong>Meta Key</strong>), and
  <strong>YouTube Video</strong> (box: <strong>YouTube URL Meta Key</strong>), which uses
  YouTube's privacy-friendly player. The production trailer tab uses
  <code>video_trailer_url</code>.
</p>

<p>
  YouTube Video understands the usual link styles — <code>youtube.com/watch?v=…</code>,
  <code>youtu.be/…</code>, <code>/embed/…</code> and <code>/shorts/…</code>. A
  <code>youtube.com/live/…</code> link does not work; open the video on YouTube and copy its
  ordinary Share link instead.
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
  <strong>Repeater Field Key</strong>, then name up to two parts of each row in the
  <strong>Key</strong> boxes under <strong>Subfield A</strong> and <strong>Subfield B</strong>
  (for bylines: <code>lead</code> and <code>text</code>).
</p>

<ul>
  <li><strong>Block Format</strong> — Paragraph text, Unordered List or Ordered List. This only changes how the rows are marked up for screen readers; no bullets or numbers appear on the page either way.</li>
  <li><strong>Tag</strong> (per subfield) — how each part is marked up, once a list format is chosen.</li>
  <li><strong>Override Post</strong> (in the <strong>Post Source</strong> panel) — read the rows from a different post instead of the one being viewed. Search by title or type the post's ID.</li>
</ul>

<p>
  Every row shows, including empty ones — an empty row leaves a gap — so delete rows you don't
  need rather than clearing them.
</p>

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
  <li><strong>HTML Tag</strong> — choose <em>List</em> to show several items one per line. Prepend and Append are hidden in List mode.</li>
  <li><strong>Link to post</strong> — when the field holds people or posts, links their names. On by default.</li>
</ul>

<h2>Site Option</h2>

<p>
  Shows one of the site-wide settings from <?php chance_manual_see('site-options'); ?> — the People
  page uses it for board and staff positions.
</p>

<ul>
  <li><strong>Option Name</strong> — the setting's internal name, which starts with <code>options_</code> (older names starting <code>option_</code> also work). Anything else shows nothing.</li>
  <li><strong>Post Meta Key</strong> — when the setting points to a person, also show one of their fields (e.g. their title). While this is set, <strong>Append</strong> is greyed out; use Append Style to style the extra field instead.</li>
  <li><strong>Link Post Title</strong> — links the person's name to their page.</li>
  <li><strong>Prepend</strong> / <strong>Append</strong>, each with a style: italic, bold or small.</li>
</ul>

<h2>The “(Meta Bound)” blocks</h2>

<p>
  The inserter also lists four purple-iconed blocks: <strong>Image (Meta Bound)</strong>,
  <strong>Button (Meta Bound)</strong>, <strong>Paragraph (Meta Bound)</strong> and
  <strong>Date (Meta Bound)</strong>. They are ordinary WordPress blocks whose image, link or text
  is filled from a field, typed in the <strong>Meta Key</strong> box of a
  <strong>Meta Source</strong> panel (Date also has a format choice).
</p>

<p>
  <strong>Use the Meta blocks above instead.</strong> The site's own patterns don't use them, and they
  don't hide themselves when the field is empty, so an empty one leaves a blank paragraph or a
  broken button. They exist only for the rare case where a normal block's own styling options are
  needed.
</p>
