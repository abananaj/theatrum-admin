<?php

/**
 * Site Manual workflow: putting a blog post on a production's page.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  A show's page carries a list of related news — announcements, features, interviews. Getting a post
  into that list is one field, and it is on the post rather than on the show.
</p>

<h2>1. Write the post</h2>

<?php chance_manual_go('post-new.php', 'Add a new post'); ?>

<p>
  An ordinary blog post. Give it a title, write it, and pick a
  <strong>category</strong> in the sidebar. <?php chance_manual_see('blog-posts', 'Writing posts'); ?>.
</p>

<h2>2. Set a featured image</h2>

<p>
  The list on the production page shows each post as a card with its image. Without a featured image
  the card falls back to a generic one, which looks like a mistake next to the others.
</p>

<h2>3. Link it to the show</h2>

<p>
  Below the content is a panel called <strong>Related Posts 🔗 (for blog posts)</strong>. In it, set
  <strong>Related Production 🎭</strong> to the show.
</p>

<p>
  That is the whole mechanism. There is no second step, nothing to do on the production, and nothing
  to publish separately. Update the post and it appears on the show's page.
</p>

<p>
  The same panel has <strong>Related Event(s) 📆</strong> if the post is about a specific event, and
  a general <strong>Related Other</strong> field for linking to pages, venues, artists and classes.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Do not do this from the production instead.</strong> The production has a
    <strong>Posts 🔗</strong> field, and it fills itself in when you link a post to the show from
    this side. Adding a post to it directly does not link back — the post will not know about the
    show, and it will not appear where you expect. Always link from the post.
  </p>
</div>

<h2>4. Check it</h2>

<p>
  Open the show's page as a visitor and look for the post in the news list. If it is not there, the
  usual causes are that the post is still a draft, or that Related Production was set on the
  production side rather than the post side.
  <?php chance_manual_see('why-isnt-my-change-showing', 'The full checklist'); ?>.
</p>

<p>
  If the post is mainly a set of photos rather than writing, there is an extra step —
  <?php chance_manual_see('workflow-gallery-post'); ?>.
</p>
