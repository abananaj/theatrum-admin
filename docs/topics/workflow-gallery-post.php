<?php

/**
 * Site Manual workflow: a photo gallery blog post.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  A gallery post is a normal post about a show, plus a set of photos. It is
  <?php chance_manual_see('workflow-production-post', 'the ordinary blog post workflow'); ?> with two
  extra steps — and one of those steps is a field that is invisible until you do something else
  first.
</p>

<h2>1. Get the photos into the library first</h2>

<p>
  The post picks its images <em>from</em> the media library, so they need to be in there before you
  start writing. Upload them with the batch routine in
  <?php chance_manual_see('workflow-production-photos', 'Adding production photos'); ?> — that gets
  them categorised and attached to the show in one pass, which is worth doing even though this post
  is a separate thing.
</p>

<h2>2. Create the post and tick the Photos category</h2>

<?php chance_manual_go('post-new.php', 'Add a new post'); ?>

<p>
  Write the post as normal, then in the sidebar tick the <strong>Photos</strong> category.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Tick Photos before you look for the gallery field.</strong> The
    <strong>Featured Images</strong> gallery only exists on posts in the Photos category — until that
    box is ticked, the field is not on the page at all. This is the most common “the field has
    disappeared” question, and the answer is never visible from the screen you are looking at.
  </p>
</div>

<h2>3. Fill the gallery</h2>

<p>
  With Photos ticked, a <strong>Featured Images</strong> panel appears below the content. Open it,
  click to add images, and select your photos from the media library. Drag them into the order you
  want — that is the order visitors see.
</p>

<p>
  Alt text is worth the effort here more than anywhere else on the site, because a gallery is
  nothing but images. <?php chance_manual_see('images-and-media', 'Writing good alt text'); ?>.
</p>

<h2>4. Link it to the show</h2>

<p>
  Exactly as with any other post: in <strong>Related Posts 🔗 (for blog posts)</strong>, set
  <strong>Related Production 🎭</strong>. That is what puts it on the show's page, gallery or not.
</p>

<h2>5. Preview before publishing</h2>

<p>
  Galleries are the thing most likely to look different from how the editor suggests, especially on
  a phone. Use <strong>Preview</strong>, and check the mobile view before you publish.
</p>
