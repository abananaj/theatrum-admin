<?php

/**
 * Site Manual workflow: a press release on a production.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  A press release on this site is <strong>a PDF file</strong> attached to a show. It is not a blog
  post, and it is not written into the page. Once you know that, the job is three minutes long.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>The blog's “Press” category is not for press releases.</strong> That category holds
    coverage <em>of</em> us — reviews, features, articles other people wrote. Putting a release in
    there files it with several hundred things it is not, and it will not appear on the show's page.
  </p>
</div>

<h2>1. Upload the PDF</h2>

<?php chance_manual_go('media-new.php', 'Go to Add Media File'); ?>

<p>
  Upload the file, and file it under <strong>Att. Categories → Press Release</strong>. Well over a
  hundred releases are already filed that way, which is what makes them findable as a set later.
</p>

<p>
  Give it a filename that says which show and which year before you upload it — the filename cannot
  be changed afterwards.
</p>

<h2>2. Attach it to the show</h2>

<p>
  Open the production, go to the <strong>Details</strong> panel, choose the
  <strong>Media&nbsp;🎥📷</strong> tab and open the <strong>Files&nbsp;📄</strong> section. Under
  <strong>Press Release</strong>, click <strong>Add File</strong> and pick the PDF you just uploaded.
</p>

<p>
  For an OTR Reading or a Visiting Company, <strong>Press Release</strong> sits directly on the
  <strong>Media&nbsp;🎥📷</strong> tab, with no sections to open.
</p>

<p>
  Update the production. Three places pick it up:
</p>

<ul>
  <li>The show's page gets a <strong>Press Release</strong> button in its sidebar, next to <strong>See Playbill</strong>. It opens the PDF in a pop-up, with a link to view or download it.</li>
  <li>The show's card in the Press Room links to it.</li>
  <li>The show's card on the Past Productions page links to it.</li>
</ul>

<p>
  With the field empty there is no button, so a show without a release looks finished rather than
  broken.
</p>

<h2>What else to update while you are there</h2>

<p>
  The review pull-quotes and award lines live on the <strong>Buzz&nbsp;🗨️</strong> tab —
  <strong>Quotes 💬</strong> and <strong>Awards 🏆</strong>. If you are adding a press release you are
  often adding those at the same time.
  <?php chance_manual_see('adding-a-production', 'The production walkthrough'); ?>.
</p>

<h2>If the button does not appear</h2>

<p>
  The button is drawn by the shared <strong>Production Sidebar</strong> pattern on the production
  page. If the file is attached but nothing shows, check that the page still has that sidebar — a
  show whose layout was rebuilt by hand may have lost it — and then work through the usual causes.
  <?php chance_manual_see('why-isnt-my-change-showing', 'Work through the checklist'); ?>.
</p>

<p>
  For a release covering a whole season rather than one show, see
  <?php chance_manual_see('workflow-press-release-season'); ?>.
</p>
