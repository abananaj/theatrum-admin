<?php

/**
 * Site Manual workflow: putting a blog post on a production's page.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  A show's page carries a list of related news — announcements, features, interviews. Getting a post
  into that list is one field, on either the post or the show.
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
  That is the whole mechanism. There is nothing to publish separately. Update the post and it appears
  on the show's page.
</p>

<p>
  The link works from either end. The production has a <strong>Posts 🔗</strong> field on its
  <strong>Buzz&nbsp;🗨️</strong> tab (on the <strong>Content&nbsp;📝</strong> tab for OTR Readings and
  Visiting Companies). Setting Related Production on the post adds the post there, and adding a post
  there fills in the post's Related Production. Use whichever screen you already have open.
</p>

<p>
  The same panel has <strong>Related Event(s) 📆</strong> if the post is about a specific event, and
  a general <strong>Related Other</strong> field for linking to pages, venues, supporters, artists and
  classes. Those two link one way only, from the post.
</p>

<h2>4. Check it</h2>

<p>
  Open the show's page as a visitor and look for the post in the news list. If it is not there, the
  usual causes are that the post is still a draft or the page is cached.
  <?php chance_manual_see('why-isnt-my-change-showing', 'The full checklist'); ?>.
</p>

<p>
  If the post is mainly a set of photos rather than writing, there is an extra step —
  <?php chance_manual_see('workflow-gallery-post'); ?>.
</p>
