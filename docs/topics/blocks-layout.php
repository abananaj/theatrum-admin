<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Structural and display blocks — carousels, tabs, tables, and the other pieces pages are
  built from. One section below per block. Most are in the inserter's <strong>Custom Blocks</strong>
  category; Tabs, Popup and Table of Contents are in <strong>Design</strong>, Advanced Table and
  Title (Advanced) in <strong>Text</strong>, and Fancy Breadcrumbs and Page Nav in <strong>Theme</strong>.
  Icon Accordion is a style of the ordinary Accordion block.
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
  <li><strong>Card Width</strong> — how wide each card is. Leave it empty for the standard 175px.</li>
  <li><strong>Grid Gap</strong> — the space between cards.</li>
  <li><strong>Show scrollbar</strong> — a thin scrollbar under the row.</li>
  <li><strong>Arrow Styles</strong> — <strong>Arrow Position</strong> (Outside, the default; Inside; or Hidden), <strong>Arrow Background</strong> on or off, and <strong>Arrow Size</strong>. Outside arrows move inside on their own when there is no room, for example near the edge of a phone screen.</li>
  <li><strong>Arrow Colors</strong> — the arrow and its background.</li>
</ul>

<p>
  On the live site visitors can drag, swipe or use the arrows; each arrow click moves the row by
  half the carousel's width. The arrows are always there — the one pointing past the end of the
  row fades out. On phones a card is never wider than 70% of the screen.
</p>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    Galleries and Query Loops have separate <em>Carousel</em> and <em>Slider</em> styles in their
    Styles panel, and the comments list has a <em>Carousel</em> style too (the home page's post
    rows use the carousel one). Those styles are not these blocks — they turn an existing gallery,
    post list or comments list into a scrolling row or slideshow.
  </p>
</div>

<h2>Slider</h2>

<p>
  A slideshow that shows one slide at a time, with arrows and a dot per slide. Slides switch
  straight over, with no fade. Each slide gets a small “2 / 5” counter in its corner
  automatically.
</p>

<p>
  It starts with two <strong>Slider Items</strong>, each an image with a caption. Like carousel
  items, a slide can hold any blocks.
</p>

<ul>
  <li><strong>Autoplay</strong> — moves to the next slide on its own, and adds a pause/play button beside the dots.</li>
  <li><strong>Autoplay speed (ms)</strong> — how long each slide stays, in thousandths of a second, from 100 to 10000; 5000 is five seconds. Only shown when Autoplay is on.</li>
  <li><strong>Arrow Styles</strong> and <strong>Arrow Colors</strong> — as for the Carousel, except the arrows sit inside the slides by default.</li>
</ul>

<p>
  The arrows loop round from the last slide to the first. Visitors who have reduced motion turned
  on get an autoplay slider that starts paused; they can press play. In the editor, the slide you
  have selected is the one shown.
</p>

<h2>Tabs</h2>

<p>
  Content split into tabs on wider screens, which turns into an accordion — stacked headings
  that open one at a time — on screens narrower than 782px (most tablets held upright, and all
  phones). The production pages' Info / Trailer / Advisory / Events / Photos / Buzz row is built
  with it.
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
  <li>Link a Button block on the page to <code>#tickets</code> (the hash, then the anchor). Several buttons can open the same popup.</li>
  <li>Put whatever you like inside the popup: text, a form, a pattern.</li>
</ol>

<ul>
  <li><strong>Position</strong> — Center is a box over the middle of the page; Top, Right, Bottom and Left slide a panel in from that edge.</li>
  <li><strong>Size</strong> — Small, Medium, Large or Full.</li>
  <li><strong>Dialog Label</strong> — what screen readers announce; uses the anchor if empty.</li>
  <li><strong>Auto-open after (seconds)</strong> — in the <strong>Automatic Opening</strong> panel, which starts collapsed. Opens the popup by itself after that many seconds, once per visit. 0 means never.</li>
</ul>

<p>
  Visitors close it with the X, by clicking outside it, or with Esc. A link from another page
  ending in <code>#tickets</code> opens the popup as that page loads.
</p>

<p>
  In the editor the popup only shows while it, or something inside it, is selected. The eye icon
  in its toolbar shows or hides the preview for now — it goes back to following your selection
  as soon as you click elsewhere. Use List View to find a popup when it's closed.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Use a Button block to open a popup. A plain text link to <code>#tickets</code> only works the
    first time it's clicked. If a button doesn't open anything, check the spelling — the button
    link and the anchor must match exactly, and the link needs the <code>#</code>. Nothing on the
    page warns you.
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
  <li><strong>Image Size &amp; Fit</strong> — <strong>Aspect Ratio</strong> (Auto, which uses the Height you set; Square 1:1; Standard 4:3; Portrait 3:4; Widescreen 16:9; Vertical 9:16), Width, Height, <strong>Object Fit</strong>, <strong>Focal Point</strong> and <strong>Resolution</strong> (which size of the image file to load — smaller loads faster).</li>
</ul>

<p>
  Only one card is open at a time; opening another closes the first, and clicking anywhere
  outside an open card closes it.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Don't leave the Card header empty. With the <em>Expand</em> style and <em>Click</em>, the card
    then shows permanently open and can't be closed; with the other settings, visitors see
    nothing to open. The panel shows a yellow warning when the header is empty.
  </p>
</div>

<h2>Scroll Reveal Card</h2>

<p>
  A wide card whose picture grows in from the left as it scrolls into view, pushing the text
  across. It isn't used on the site yet.
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

<h2>Icon Accordion</h2>

<p>
  A stack of coloured cards, each with a strip down its left edge (the “rail”) holding an icon,
  that open in place to show their content. The artist pages' credits sidebar and the Membership
  and Ticketing FAQs use it.
</p>

<p>
  It isn't a separate block: it's WordPress's Accordion with this site's look. Insert
  <strong>Icon Accordion</strong> from the inserter to get five starter cards, or give any
  existing Accordion the <strong>Icon Accordion</strong> style in its Styles panel. Each card is
  an Accordion Item with a heading and a panel that takes any blocks. Inserted fresh, opening one
  card closes the others; an accordion given the style afterwards keeps its own setting for that.
</p>

<p>Select a single card for its <strong>Icon</strong> panel:</p>

<ul>
  <li><strong>Rail icon</strong> — any image from the Media Library; an SVG icon works best. Without one the rail shows the accordion's open/close “+”.</li>
  <li><strong>Icon background</strong> — colours the rail behind the icon. It's tucked under the panel's <strong>⋮</strong> menu; left unset, the rail is a tinted strip of the card's own colour.</li>
</ul>

<p>
  The icon is decoration only, so it needs no alt text — the card's heading says what it is. On
  the live site SVG icons take the card's text colour; other images, and every icon in the editor,
  keep the colours they were uploaded with.
</p>

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
  <li>More options are under the panel's <strong>⋮</strong> menu: <strong>Icon Spacing</strong>, <strong>Icon Color</strong> and <strong>Hover Only</strong>.</li>
</ul>

<p>
  <strong>Icon Color</strong> is a text box, not a colour picker: type a colour such as
  <code>#000000</code>. Left empty, icons follow the text colour.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    SVG icons always come out in a single colour (the Icon Color, or the text colour), even if the
    file itself has several. Photos and PNGs keep their own colours and ignore Icon Color. Avoid
    <strong>Show icon on hover only</strong>: phones can't hover, so the icons never appear there.
  </p>
</div>

<p>
  The icon's description for screen readers is copied from its Alt Text in the Media Library at
  the moment you pick it. If you fix the alt text later, pick the icon again to pick up the change.
</p>

<h2>Thumbnail List</h2>

<p>
  A list of headings with one small picture (48px to start) beside it. As a visitor points at a
  row, the picture slides level with that row and flips over to show that row's image. Rental
  Information and Membership use it.
</p>

<p>
  It starts with two items, each a heading and a paragraph; add more with <strong>+</strong>.
  Select an item to give it a picture in the <strong>Thumbnail Image</strong> panel.
</p>

<p>Select the whole list for its settings:</p>

<ul>
  <li><strong>Display Settings</strong> — <strong>Hide Description Until Hover</strong>, <strong>Thumbnail Position</strong> (left or right), <strong>Item Height</strong>, the picture's <strong>Thumbnail Width</strong> and height, and <strong>Animation Speed</strong>.</li>
  <li><strong>Image Settings</strong> — <strong>Resolution</strong>, <strong>Aspect Ratio</strong> and <strong>Object Fit</strong>: which size of image file to load, the picture's shape, and how it fills that shape.</li>
</ul>

<p>
  The first item's picture shows when the page loads. On screens narrower than 782px the picture
  stops moving and sits above the list instead, on the list's side; tapping a row still changes
  it.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Hide Description Until Hover</strong> only reveals a paragraph while a mouse pointer
    is over its row. Keyboard users never see it, and on phones it depends on the browser — leave
    it off if the text matters.
  </p>
</div>

<h2>Blockquote</h2>

<p>
  A quotation with an optional source line underneath, such as “— Author, <em>Work Title</em>”.
  The quote itself holds paragraphs. To set a title in italics, select it in the source line and
  choose <strong>Cite work title</strong> from the toolbar's <strong>⌄</strong> (More) menu.
</p>

<p>
  Turn the source line on or off with <strong>Add citation</strong> (select the outer Blockquote).
  Turning it off deletes what was typed there. <strong>Source URL</strong> (select the inner
  <strong>Text</strong> block) records where the quote came from but isn't shown to visitors.
</p>

<h2>Advanced Table</h2>

<p>
  A table whose cells can hold more than text — images, lists, icons. Advertising dates, donor
  levels and rental rates are built with it.
</p>

<p>
  It starts with a <strong>Table Title</strong>, a <strong>Table Header</strong> and a
  <strong>Table Body</strong>, made of rows and cells. Add rows and cells with
  <strong>+</strong>; turn a cell into a heading cell through the block's Transform menu. A cell
  can hold paragraphs, lists, images, galleries, video, audio, files, covers, groups and icons.
</p>

<ul>
  <li><strong>Header row</strong> / <strong>Footer row</strong> — add or remove those sections.</li>
  <li><strong>Fixed column widths</strong> — then give each header cell a Width (Dimensions) to size its column.</li>
  <li><strong>Sticky header row</strong> — the header stays in view while the table scrolls inside its own box.</li>
  <li><strong>Sticky first column</strong> — the first column stays in view while the table scrolls sideways.</li>
  <li><strong>Column span</strong> / <strong>Row span</strong> (select a cell) — merge a cell across columns or rows.</li>
  <li><strong>Subsection Heading</strong> (a row's Styles) — a row that labels the group of rows below it.</li>
</ul>

<p>
  Every table is striped automatically, so there's no stripes setting. On the live site, pointing
  at a cell highlights its row and column. A table taller than about nine-tenths of the screen
  scrolls inside its own box, and the sticky header sticks to the top of that box, not the top of
  the page. On screens narrower than 782px the table scrolls sideways, fading at the edge where
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
  <li><strong>Unordered</strong> / <strong>Ordered</strong> (toolbar) — bullets or numbers. Numbers to start.</li>
  <li><strong>Include headings down to level</strong> — e.g. Heading 3 to leave out smaller sub-headings.</li>
  <li><strong>Only include current page</strong> — for a post split into pages, lists just this page's headings.</li>
  <li><strong>Convert to static list</strong> (toolbar) — turns it into an ordinary list that no longer updates.</li>
</ul>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    A heading is only clickable in the list if it has an <strong>HTML anchor</strong> (select the
    heading, Advanced). Without one it's listed but doesn't jump anywhere. The list is saved with
    the page, so it only changes on the live site when this page is updated — if a heading comes
    from a pattern that was edited elsewhere, open this page and Update it.
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
  The “you are here” trail at the top of a page, such as Backstage › Blog. It builds itself, so
  there is nothing to type: pages follow their parent pages, and shows follow All Productions,
  then the show's category. The editor only shows a sample trail; check the live page.
</p>

<ul>
  <li><strong>Show home breadcrumb</strong> — starts the trail with Home (off by default).</li>
  <li><strong>Show current breadcrumb</strong> — ends the trail with this page (on by default).</li>
  <li><strong>Prefer taxonomy terms</strong> — for pages and events, follow the category instead of the parent page. Shows always use their category, whatever this is set to.</li>
  <li><strong>Show on homepage</strong> — off by default, so the trail doesn't appear on the home page.</li>
</ul>

<h2>Page Nav</h2>

<p>
  A row of buttons that jump to sections further down the same page. It builds itself — you
  don't type any links. It only works on pages, shows and events.
</p>

<p>For a section to get a button:</p>

<ol>
  <li>Wrap the section in a Group.</li>
  <li>Under <strong>Advanced</strong>, set its HTML element to <code>&lt;section&gt;</code> and give it an <strong>HTML anchor</strong> (one word, e.g. <code>cast</code>).</li>
  <li>Start the section with a heading — the heading becomes the button's text.</li>
</ol>

<p>
  A post list (Query Loop) with an HTML anchor also gets a button for each post, named after the
  post — so each card in it needs a Post Title block. These show on the live page but not in the
  editor.
</p>

<p>
  Clicks scroll smoothly to just below the header. The buttons wrap onto more rows whenever they
  don't fit. With six or more buttons, a small “Jump to section” menu appears once the row
  scrolls out of view.
</p>

<p>
  The button for the section you're reading isn't highlighted, by design. The exception is a Page
  Nav in a sticky bar on a page other than a show (the Blog's, for example), where the current
  section's button is underlined.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    A section without a heading or an anchor gets no button, and sections inside a tab that isn't
    open are skipped. If no button appears, check those first.
  </p>
</div>

<h2>Query Filter</h2>

<p>
  A drop-down that lets visitors filter or re-sort a list on the same page. Choosing an option
  applies it straight away; the <strong>Apply</strong> button beside it does the same.
</p>

<ul>
  <li><strong>Target Query Loop</strong> — which post list (Query Loop) on the page it controls. Always choose one: a Query Loop is only filtered when it's chosen here.</li>
  <li><strong>Filter Type</strong> — filter by <em>Taxonomy</em> (Season, Series or Tags), or <em>Sort Order</em> (newest, oldest, A–Z, Z–A).</li>
  <li><strong>Label</strong> / <strong>Show label</strong> — the text beside the drop-down.</li>
  <li><strong>“All” option label</strong> — what the show-everything choice says.</li>
  <li><strong>Term order</strong> — A → Z, or Z → A to put the newest season first.</li>
  <li><strong>URL parameter name</strong> — the word that appears in the page address after filtering, e.g. <code>?season=2024</code>. Leave it as it is.</li>
  <li><strong>Layout</strong> — horizontal or vertical.</li>
</ul>

<p>
  With a Query Loop chosen, the list updates without reloading the page. The Press Room and Past
  Productions season pickers work differently: they filter a list of seasons (a Terms Query), not
  posts, so no Target Query Loop is chosen and the whole page reloads.
</p>

<p>
  Seasons, series or tags with nothing at all in them — no posts of any kind — are left out of the
  drop-down automatically.
</p>

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
