<?php

/**
 * Site Manual workflow: a press release on a production.
 */

if (! defined('ABSPATH')) {
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
  Open the production, go to the <strong>Details</strong> panel, and choose the
  <strong>Buzz&nbsp;🗨️</strong> tab. The first field is <strong>Press Release</strong>. Click
  <strong>Add File</strong> and pick the PDF you just uploaded.
</p>

<p>
  Update the production. The show's page now offers the release as a download.
</p>

<h2>What else is on that tab</h2>

<p>
  <strong>Buzz 🗨️</strong> is also where <strong>Quotes 💬</strong> and <strong>Awards 🏆</strong>
  live — the review pull-quotes and award lines that appear on the show's page. If you are adding a
  press release you are often adding those at the same time.
  <?php chance_manual_see('adding-a-production', 'The production walkthrough'); ?>.
</p>

<h2>If the link does not appear</h2>

<p>
  The download link is drawn by a shared pattern on the production page. If the file is attached but
  nothing shows, that pattern is missing from the page rather than the file being wrong — which is a
  different problem from the usual ones.
  <?php chance_manual_see('why-isnt-my-change-showing', 'Work through the checklist'); ?>.
</p>

<p>
  For a release covering a whole season rather than one show, see
  <?php chance_manual_see('workflow-press-release-season'); ?>.
</p>
