<?php

/**
 * Site Manual workflow: making a new page.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  A new standing page — a programme, a policy, a fundraising appeal. The page template only gives
  you the site header and footer; everything in between is yours to build, and the first block is
  always the shared page header.
</p>

<h2>1. Create the page and give it a parent</h2>

<?php chance_manual_go('post-new.php?post_type=page', 'Add a new page'); ?>

<p>
  Type the title at the top. Then, in the right-hand panel under <strong>Page → Parent</strong>, pick
  the section it belongs to (Education, Get Involved, Donate and so on). The parent decides three
  things: the page's address (<code>/education/your-page/</code>), its breadcrumb, and which colour
  scheme it picks up. A page with no parent sits loose at the top of the site.
</p>

<h2>2. Add the featured image</h2>

<p>
  In the same panel, <strong>Featured image → Set featured image</strong>. The page header shows it
  beside the title. Landscape photos work best; a logo or a square graphic will be cropped.
</p>

<h2>3. Insert the page header</h2>

<p>
  Click <strong>+</strong>, open <strong>Patterns</strong> and choose <strong>Page Header</strong>
  (or <strong>Page Header, parent page</strong> for a section landing page with a full-width photo).
  It arrives with a purple outline because it is shared — but four parts of it are yours to fill in
  on this page only:
</p>

<ul>
  <li><strong>Pretitle</strong> — the small line above the title. Leave it empty to hide it.</li>
  <li><strong>Title</strong> — usually the same as the page title, but can be longer or friendlier.</li>
  <li><strong>Subtitle</strong> — optional.</li>
  <li><strong>Intro Text</strong> — one or two sentences under the title.</li>
</ul>

<p>
  Anything else in the header — the layout, the breadcrumb, the photo frame — is shared. Changing it
  changes every page. <?php chance_manual_see('patterns'); ?>
</p>

<h2>4. Build the content in sections</h2>

<p>
  Below the header, add your content. Group each topic into its own <strong>Group</strong> block and,
  in the Group's settings, set <strong>HTML element → &lt;section&gt;</strong> and give it an
  <strong>HTML anchor</strong> (Advanced panel), e.g. <code>schedule</code>.
</p>

<p>
  That is all the page navigation under the header needs: it lists every anchored section on the page
  automatically, using the section's first heading as the button label, and scrolls to it when
  clicked. No anchored sections, no navigation bar — it removes itself.
</p>

<h2>5. Finish with a page footer (optional)</h2>

<p>
  Most pages end with a contact box or a call to action. Insert <strong>Page Footer CTA, simple</strong>
  from Patterns, or one of the <strong>Questions?</strong> patterns for the section the page is in.
</p>

<h2>6. Check it, then publish</h2>

<ul class="ct-manual__rules">
  <li><strong>Preview</strong> on a phone-sized window too — columns and rows stack differently there.</li>
  <li>Publish.</li>
  <li>
    Link it from its parent. Section landing pages (Get Involved, Education, Donate…) show a grid of
    cards for their child pages, and those grids are hand-built: open the parent page, duplicate one
    of the cards, then change its picture, title and link to the new page.
  </li>
  <li>
    Add it to the main menu only if it needs to be there:
    <?php chance_manual_go('site-editor.php?path=%2Fnavigation', 'Open the menus'); ?>
  </li>
</ul>
