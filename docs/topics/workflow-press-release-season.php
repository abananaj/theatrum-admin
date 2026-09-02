<?php

/**
 * Site Manual workflow: a season press release.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Same PDF, different place. A season announcement — the release that covers a whole year rather than
  a single show — attaches to the <strong>season</strong> instead of to a production.
</p>

<p>
  Everything about what counts as a press release, and how to file it in the media library, is the
  same as for a show: <?php chance_manual_see('workflow-press-release-production', 'start there'); ?>
  if you have not done one before.
</p>

<h2>1. Upload the PDF</h2>

<p>
  As before — upload it and tick <strong>Att. Categories → Press Release</strong>.
</p>

<h2>2. Open the season</h2>

<?php chance_manual_go('edit-tags.php?taxonomy=season&post_type=production', 'Open the Seasons list'); ?>

<p>
  Click the season's name to open it for editing. This is the term itself, not a page — the fields
  below belong to the season and are read wherever the season appears.
</p>

<h2>3. Attach it</h2>

<p>
  Find <strong>Season Press Release</strong> and click <strong>Add Press Release</strong>. Unlike the
  production's field, this one holds more than one file, so a season with a launch announcement and a
  later update can carry both.
</p>

<p>
  Update the season. It is drawn onto the season's page by a shared pattern, the same way the
  production one is.
</p>

<h2>While you are in there</h2>

<p>
  The season term also holds <strong>Resident Playwright</strong>, <strong>Season Producers</strong>,
  <strong>Associate Season Producers</strong> and <strong>OTR Sponsors</strong>. If you are attaching
  a season announcement, those are often the same conversation.
  <?php chance_manual_see('seasons-and-series', 'Seasons and series'); ?>.
</p>
