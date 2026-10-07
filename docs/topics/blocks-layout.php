<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Structural and display blocks — carousels, tabs, tables, and the other pieces pages are
  built from. One section below per block.
</p>

<h2>Carousel</h2>

<p>
  A row of cards that scrolls sideways, with previous/next arrows. Use it when you have more
  cards than fit across the page and visitors can browse them in any order.
</p>

<p>
  It starts with three <strong>Carousel Items</strong>. Each item works like a Group: it begins
  with an image, a card title and a subtitle, and can hold any blocks. Add more items with the
  <strong>+</strong> button inside the carousel.
</p>

<p>Settings worth knowing, in the right-hand panel:</p>

<ul>
  <li><strong>Card Width</strong> — how wide each card is (175px to start). Leave it empty and each card sizes to its content.</li>
  <li><strong>Grid Gap</strong> — the space between cards.</li>
  <li><strong>Show scrollbar</strong> — a thin scrollbar under the row.</li>
  <li><strong>Arrow Position</strong> — Outside (the default), Inside, or Hidden. Outside arrows move inside on their own when there is no room, for example near the edge of a phone screen.</li>
  <li><strong>Arrow Colors</strong> — the arrow and its background.</li>
</ul>

<p>
  On the live site visitors can drag, swipe or use the arrows; each arrow click moves about half
  a screen. Arrows only appear when there is more to see. On phones a card is never wider than
  70% of the screen.
</p>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    Galleries and Query Loops have a separate <em>Carousel</em> style in their Styles panel
    (Rental Information's photos use it). That style is not this block — it turns an existing
    gallery or post list into a scrolling row.
  </p>
</div>

<h2>Slider</h2>

<p>
  A slideshow that shows one slide at a time and fades between them, with arrows and a dot per
  slide. Each slide gets a small “2 / 5” counter in its corner automatically.
</p>

<p>
  It starts with two <strong>Slider Items</strong>, each an image with a caption. Like carousel
  items, a slide can hold any blocks.
</p>

<ul>
  <li><strong>Autoplay</strong> — moves to the next slide on its own.</li>
  <li><strong>Autoplay speed (ms)</strong> — how long each slide stays, in thousandths of a second; 5000 is five seconds. Only shown when Autoplay is on.</li>
  <li><strong>Arrow Styles</strong> and <strong>Arrow Colors</strong> — as for the Carousel, except the arrows sit inside the slides by default.</li>
</ul>

<p>
  The arrows loop round from the last slide to the first. In the editor, the slide you have
  selected is the one shown.
</p>

<h2>Tabs</h2>

<p>
  Content split into tabs on a computer, which turns into an accordion — stacked headings that
  open one at a time — on phones. The production pages' Info / Trailer / Advisory / Events /
  Photos / Buzz row is built with it.
</p>

<p>
  It starts with two <strong>Tab</strong> blocks; add more with <strong>+</strong>. Each tab has
  a <strong>Tab Heading</strong> (the label) and a <strong>Tab Content</strong> area that takes
  any blocks. The heading can't be removed — a tab needs a label.
</p>

<ul>
  <li><strong>Equal width tabs</strong> (select the Tabs block, Settings) — on by default, so the labels share the row evenly.</li>
  <li><strong>Normal Colors</strong>, <strong>Hover Colors</strong> and <strong>Active Colors</strong> (select a Tab Heading, Styles) — text and background for each state. Leave Hover or Active empty and it uses the Normal colours.</li>
</ul>

<p>
  The first tab is open when the page loads. In the editor, whichever tab you click on is the one
  shown.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Tab labels never wrap onto two lines, so keep them to a word or two. Too many tabs for the
    row and the extras drop to a second row.
  </p>
</div>

<h2>Popover</h2>

<p>
  A small floating box that appears above something when a visitor points at it — a photo
  that pops up over a name, say. On phones it opens with a tap and closes with a second tap or
  a tap anywhere else.
</p>

<p>It comes in two fixed parts:</p>

<ul>
  <li><strong>Popover Trigger</strong> — what visitors point at. Starts as a paragraph; any blocks work.</li>
  <li><strong>Popover Content</strong> — what appears in the box. Starts as an image; any blocks work.</li>
</ul>

<p>
  Set the box's width under <strong>Popover Size</strong> when Popover Content is selected
  (300px to start). There is no link setting: if the trigger should go somewhere, put a button
  or a linked image inside it.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    The box is centred above the trigger and doesn't move to stay on screen, so a wide box on
    something near the edge of the page can be cut off. Keep it narrow there.
  </p>
</div>

<h2>Popup</h2>

<p>
  A window that opens over the page — the production pages' ticket chooser is one. A popup
  has no button of its own; buttons elsewhere on the page open it.
</p>

<p>To set one up:</p>

<ol>
  <li>Select the Popup and, under <strong>Advanced</strong>, give it an <strong>HTML anchor</strong> — one word, e.g. <code>tickets</code>.</li>
  <li>Link any button on the page to <code>#tickets</code> (the hash, then the anchor). Several buttons can open the same popup.</li>
  <li>Put whatever you like inside the popup: text, a form, a pattern.</li>
</ol>

<ul>
  <li><strong>Position</strong> — Center is a box over the middle of the page; Top, Right, Bottom and Left slide a panel in from that edge.</li>
  <li><strong>Size</strong> — Small, Medium, Large or Full.</li>
  <li><strong>Auto-open after (seconds)</strong> — opens the popup by itself after that many seconds, once per visit. 0 means never.</li>
  <li><strong>Dialog Label</strong> — what screen readers announce; uses the anchor if empty.</li>
</ul>

<p>
  Visitors close it with the X, by clicking outside it, or with Esc. A link from another page
  ending in <code>#tickets</code> opens the popup as that page loads.
</p>

<p>
  In the editor the popup only shows while it's selected; use the eye icon in its toolbar to
  keep it open, and List View to find it when it's closed.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    If a button doesn't open anything, check the spelling — the button link and the anchor
    must match exactly, and the link needs the <code>#</code>. Nothing on the page warns you.
  </p>
</div>

<h2>Expand Card</h2>

<p>
  An image card with a title that reveals more text when clicked or hovered. The Onstage and Up
  Next cards on the home page are Expand Cards.
</p>

<p>
  It holds two groups — a <strong>Card header</strong> (the title) and a <strong>Card body</strong>
  (the hidden text) — and either can take any blocks. The image is not a block: choose it in the
  <strong>Card Image</strong> panel.
</p>

<ul>
  <li><strong>Reveal Style</strong> — <em>Expand</em> opens the body below the title, over whatever sits beneath, so the page doesn't jump. <em>Overlay</em> slides the title and body up over the image.</li>
  <li><strong>Activate On</strong> — <em>Click</em> (click the card to open, again to close) or <em>Hover</em>. Phones have no hover, so hover cards open on a tap.</li>
  <li><strong>Use the post's featured image</strong> — inside a post list, each card shows its own post's image; the image you chose becomes the fallback.</li>
  <li><strong>Link the image to the post</strong> — only with Hover.</li>
  <li><strong>Image Size &amp; Fit</strong> — shape (Square, 4:3, Portrait and so on), focal point and quality.</li>
</ul>

<p>Only one card is open at a time; opening another closes the first.</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Don't leave the Card header empty — with Click and Expand the card then can't be closed. The
    panel shows a yellow warning when this happens.
  </p>
</div>

<h2>Scroll Reveal Card</h2>

<p>
  A wide card whose picture grows in from the left as it scrolls into view, pushing the text
  across. The past-production archive cards use it.
</p>

<p>
  It holds a <strong>Card header</strong> (a heading that always shows) and a
  <strong>Card body</strong> (text that scrolls inside the card if it's long). Pick the image in
  the <strong>Card Image</strong> panel, as for the Expand Card.
</p>

<ul>
  <li><strong>Width</strong> — how much of the card the picture takes (20% to start).</li>
  <li><strong>Height</strong> — the height of the whole card; longer text scrolls inside it.</li>
  <li><strong>Object Fit</strong> and <strong>Focal Point</strong> — how the picture fills its space.</li>
</ul>

<p>
  The reveal plays once and doesn't reverse. Visitors who have reduced motion turned on see
  the finished card straight away. In the editor the picture always shows fully open.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Leave the two groups' class names (under Advanced) alone — without them the body text gets
    cut off instead of scrolling.
  </p>
</div>

<h2>Icon List</h2>

<p>
  A list where each item can have its own small picture or icon instead of a bullet. The
  Internships page and the production sidebar notes use it.
</p>

<p>
  Type items as in any list. To give an item its icon, select that item and use the
  <strong>Icon</strong> panel: <strong>Select Icon</strong> picks one from the Media Library, or
  paste an address under <strong>Or enter an icon URL</strong>.
</p>

<p>Select the whole list for <strong>Icon Settings</strong>:</p>

<ul>
  <li><strong>Icon Size</strong> — 24px to start.</li>
  <li><strong>Icon Position</strong> — left, top, right or bottom of the text.</li>
  <li><strong>Align</strong> — top, middle or bottom of the text.</li>
  <li>More options — spacing, icon colour, show-on-hover — are under the panel's <strong>⋮</strong> menu.</li>
</ul>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Icon Color</strong> only recolours SVG icons, not photos or PNGs. Avoid
    <strong>Show icon on hover only</strong>: phones can't hover, so the icons never appear there.
    The icon's description for screen readers is its Alt Text in the Media Library.
  </p>
</div>

<h2>Thumbnail List</h2>

<p>
  A list of headings where pointing at a row slides a small picture in beside it. Rental
  Information and Membership use it.
</p>

<p>
  It starts with two items, each a heading and a paragraph; add more with <strong>+</strong>.
  Select an item to give it a picture in the <strong>Thumbnail Image</strong> panel.
</p>

<ul>
  <li><strong>Hide Description Until Hover</strong> — each paragraph only shows while its row is pointed at.</li>
  <li><strong>Thumbnail Position</strong> — the picture slides in on the left or the right.</li>
  <li><strong>Aspect Ratio</strong> and <strong>Object Fit</strong> — the picture's shape and how it fills it.</li>
  <li><strong>Animation Speed</strong> — how fast the picture slides.</li>
</ul>

<p>
  The first item's picture shows when the page loads. On tablets and phones the list becomes a
  single column with a still picture beneath, and nothing slides.
</p>

<h2>Blockquote</h2>

<p>
  A quotation with an optional source line underneath, such as “— Author, <em>Work Title</em>”.
  The quote itself holds paragraphs; select the source line and use <strong>Cite work title</strong>
  in its toolbar to set a title in italics.
</p>

<p>
  Turn the source line on or off with <strong>Add citation</strong>. Turning it off deletes what
  was typed there. <strong>Source URL</strong> records where the quote came from but isn't shown to
  visitors.
</p>

<h2>Advanced Table</h2>

<p>
  A table whose cells can hold any blocks — images, lists, icons — not just text. Advertising
  dates, donor levels and rental rates are built with it.
</p>

<p>
  It starts with a <strong>Table Title</strong>, a <strong>Table Header</strong> and a
  <strong>Table Body</strong>, made of rows and cells. Add rows and cells with
  <strong>+</strong>; turn a cell into a heading cell through the block's Transform menu.
</p>

<ul>
  <li><strong>Header row</strong> / <strong>Footer row</strong> — add or remove those sections.</li>
  <li><strong>Fixed column widths</strong> — then give each header cell a Width (Dimensions) to size its column.</li>
  <li><strong>Sticky header row</strong> — the header stays in view while a long table scrolls.</li>
  <li><strong>Sticky first column</strong> — the first column stays in view while the table scrolls sideways.</li>
  <li><strong>Column span</strong> / <strong>Row span</strong> (select a cell) — merge a cell across columns or rows.</li>
  <li><strong>Stripes</strong> (Styles) and <strong>Subsection Heading</strong> (a row's Styles) — a striped table, and a row that labels a group of rows.</li>
</ul>

<p>
  On the live site, pointing at a cell highlights its row and column, and a table taller than the
  screen scrolls inside itself. On phones the table scrolls sideways, fading at the edge where
  there's more to see, and fixed column widths are ignored so no column gets crushed.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Turning <strong>Header row</strong> or <strong>Footer row</strong> off deletes that section
    and everything in it. The editor also shows merged cells and column widths inaccurately —
    check the live page.
  </p>
</div>

<h2>Table of Contents</h2>

<p>
  A list of the page's headings that builds itself and keeps up as you edit. It only counts
  Heading blocks.
</p>

<ul>
  <li><strong>Unordered</strong> / <strong>Ordered</strong> (toolbar) — bullets or numbers.</li>
  <li><strong>Include headings down to level</strong> — e.g. Heading 3 to leave out smaller sub-headings.</li>
  <li><strong>Convert to static list</strong> (toolbar) — turns it into an ordinary list that no longer updates.</li>
</ul>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    A heading is only clickable in the list if it has an <strong>HTML anchor</strong> (select the
    heading, Advanced). Without one it's listed but doesn't jump anywhere.
  </p>
</div>

<h2>Title (Advanced)</h2>

<p>
  The title group at the top of a page: a small <strong>Pretitle</strong> line, the page title,
  and a <strong>Subtitle</strong>. You'll mostly meet it inside the page header patterns, where you
  type the three lines straight into the header — see <?php chance_manual_see('titles'); ?>.
</p>

<p>
  Inserted fresh on its own, the Pretitle and Subtitle are tied to the page's Pretitle and
  Subtitle fields: they look locked in the editor and fill in on the live page.
</p>

<h2>Fancy Breadcrumbs</h2>

<p>
  The “you are here” trail at the top of a page, such as Backstage › Blog. It builds itself from
  the page's parent pages — or, for shows and events, from their section — so there is nothing to
  type. The editor only shows a sample trail; check the live page.
</p>

<ul>
  <li><strong>Show home breadcrumb</strong> — starts the trail with Home (off by default).</li>
  <li><strong>Show current breadcrumb</strong> — ends the trail with this page (on by default).</li>
  <li><strong>Prefer taxonomy terms</strong> — follow the page's category instead of its parent page.</li>
</ul>

<p>It never shows on the home page.</p>

<h2>Page Nav</h2>

<p>
  A row of buttons that jump to sections further down the same page. It builds itself — you
  don't type any links.
</p>

<p>For a section to get a button:</p>

<ol>
  <li>Wrap the section in a Group.</li>
  <li>Under <strong>Advanced</strong>, set its HTML element to <code>&lt;section&gt;</code> and give it an <strong>HTML anchor</strong> (one word, e.g. <code>cast</code>).</li>
  <li>Start the section with a heading — the heading becomes the button's text.</li>
</ol>

<p>
  A post list (Query Loop) with an HTML anchor also gets a button for each post, named after the
  post; these show on the live page but not in the editor.
</p>

<p>
  On the live site the button for the section you're reading lights up as you scroll, and clicks
  scroll smoothly to just below the header. With six or more buttons, a small “Jump to section”
  menu appears once the row scrolls out of view. On phones the buttons wrap onto several rows.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    A section without a heading or an anchor gets no button, and sections inside Tabs are
    skipped. If no button appears, check those two things first.
  </p>
</div>

<h2>Query Filter</h2>

<p>
  A drop-down that lets visitors filter or re-sort a list of posts on the same page — the Press
  Room's season picker is one. Choosing an option updates the list without reloading the page.
</p>

<ul>
  <li><strong>Target Query Loop</strong> — which list on the page it controls. Needed when the page has more than one.</li>
  <li><strong>Filter Type</strong> — filter by <em>Taxonomy</em> (Season, Series or Tags), or <em>Sort Order</em> (newest, oldest, A–Z, Z–A).</li>
  <li><strong>Label</strong> / <strong>Show label</strong> — the text beside the drop-down.</li>
  <li><strong>“All” option label</strong> — what the show-everything choice says.</li>
  <li><strong>Term order</strong> — A → Z, or Z → A to put the newest season first.</li>
  <li><strong>Layout</strong> — horizontal or vertical.</li>
</ul>

<p>Seasons, series or tags with nothing in them are left out of the drop-down automatically.</p>

<h2>Theatrum Query Loop</h2>

<p>
  Not a separate block: ready-made versions of WordPress's Query Loop, set to one kind of
  content. In the inserter they appear as <strong>Production Loop</strong>, <strong>Event Loop</strong>,
  <strong>Class Loop</strong>, <strong>Blog Loop</strong>, <strong>Artist Loop</strong>,
  <strong>Supporter Loop</strong> and <strong>Venue Loop</strong>.
</p>

<p>
  Each starts at 10 items, newest first, and moves between pages without a full reload. Its
  settings are the normal Query Loop ones, minus the post type, which is fixed. The home page's
  production and class lists are built with them.
</p>
