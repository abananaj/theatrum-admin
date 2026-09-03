<?php

/**
 * Site Manual workflow: adding production photos.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Production and rehearsal photos arrive in batches, so this is worth doing properly once rather
  than one file at a time. The trick is that most of the work happens <em>before</em> you upload
  anything — and that uploading is only half the job.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Uploading photos does not put them on the show's page.</strong> That is step 5, and it
    is a separate thing done on the production itself. Skip it and you will have sixty beautifully
    labelled photos that appear nowhere.
  </p>
</div>

<h2>1. Have the production open in another tab</h2>

<p>
  You will need to point the photos at the show. The easy way is to not look up anything at all —
  there is a search button for it in step 3. But if you would rather have the number: open the
  production for editing and read the address bar. It ends
  <code>post.php?post=1234&amp;action=edit</code>, and <strong>1234</strong> is the production's ID.
</p>

<h2>2. Open the bulk edit area</h2>

<?php chance_manual_go('media-new.php', 'Go to Add Media File'); ?>

<p>
  On that screen, click <strong>Open Bulk Edit area</strong> — the red button on the right, just
  below the box you drop files into. It stays closed until you click it, which is the only reason
  people miss it.
</p>

<p>
  It carries its own warning, and it means it: <em>make your entries before uploading new items.</em>
  Anything you type in here is applied to every file in the batch as it uploads. Fill it in after
  and it applies to nothing.
</p>

<h2>3. Fill it in</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>Att. Categories</strong> — tick <strong>Photo</strong> in the list.
  </li>
  <li>
    <strong>Att. Tags</strong> — a box you type into, rather than a list to tick. Type
    <strong>Production</strong> or <strong>Rehearsal</strong>; both already exist. Because it is free
    typing, something close but different — “production photos” — quietly creates a second tag that
    means the same thing, so stick to the two words.
  </li>
  <li>
    <strong>Parent ID</strong> — click <strong>Select</strong> next to the box. A
    <strong>Select Parent</strong> window opens. Change the dropdown from
    <strong>— All Post Types —</strong> to <strong>Production</strong>, type the show's name in the
    search box and press <strong>Search</strong>, click the circle beside the right one, then
    <strong>Update</strong>. No need to know the number at all.
  </li>
  <li>
    <strong>Title, Caption, Description, ALT Text</strong> — only fill these in if the whole batch
    genuinely shares them. A photo credit in the Caption is a good use of this. Alt text usually is
    not: each photo shows something different, so it is better to leave ALT Text empty here and
    write it per photo afterwards.
  </li>
</ul>

<p>
  Each taxonomy box has an <strong>Add / Remove / Replace</strong> choice beneath it.
  <em>Add</em> is what you want when uploading new files.
</p>

<h2>4. Upload</h2>

<p>
  Now drag the files in, or use <strong>Select Files</strong>. Everything you set above is stamped
  onto each one as it goes.
</p>

<p>
  Name your files sensibly before you upload — the filename cannot be changed afterwards and it is
  what makes a photo findable in two years.
  <?php chance_manual_see('images-and-media', 'More on naming and alt text'); ?>.
</p>

<h2>5. Put them on the show's page</h2>

<p>
  Open the production, go to the <strong>Details</strong> panel and the
  <strong>Photos&nbsp;📸</strong> tab. There are two galleries:
</p>

<ul>
  <li><strong>Production Photos</strong> — performance and publicity shots.</li>
  <li><strong>Rehearsal Photos</strong> — the rehearsal room.</li>
</ul>

<p>
  Add your images to whichever applies, and update the production. <strong>This is the step that
  makes them appear on the site.</strong> Until a photo is in one of these two galleries, the show's
  page says “No photos yet, check back soon!” no matter how many files are attached to it.
</p>

<h2>So what was the Parent ID for?</h2>

<p>
  Findability, and nothing else. Attaching a photo to a production is how you or anyone after you
  finds all of a show's images in the library later. It does not display them. The gallery fields in
  step 5 display them. Both are worth doing, for different reasons.
</p>
