<?php

/**
 * Site Manual topic: blog posts and news.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Everything dated goes here: press coverage, announcements, production photos, interviews,
  awards. In the menu it is called <strong>Blog</strong> — WordPress's own name for it is
  “Posts”, which is why other guides call it that.
</p>

<?php chance_manual_go('post-new.php', 'Start a new post'); ?>

<h2>Writing one</h2>

<p>
  A post is written with the same blocks as a page, so
  <?php chance_manual_see('editing-a-page'); ?> covers the editing itself. Four things are
  worth doing on every post:
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>A title that reads well out of context.</strong> It will appear in lists next to
    posts from twelve years ago, with nothing else to explain it.
  </li>
  <li>
    <strong>A featured image.</strong> This is what shows in every list, card and preview of
    the post. Without one the card falls back to a generic image.
  </li>
  <li>
    <strong>An excerpt</strong>, in the settings sidebar. If you leave it empty WordPress
    takes the first few lines of the post instead, which is usually a worse summary than one
    you would write.
  </li>
  <li>
    <strong>The date.</strong> Posts sort by it, so if you are adding something that happened
    last month, set the date to last month rather than today.
  </li>
</ul>

<h2>Categories say what kind of post it is</h2>

<p>
  Categories are the important classification, and the site uses them to build its own lists.
  The main ones in use are <strong>Press</strong>, <strong>Chance Blog</strong>,
  <strong>Photos</strong>, <strong>Awards</strong>, <strong>Special Announcement</strong>,
  <strong>Interview</strong>, <strong>Trailer</strong>, <strong>Behind the Scenes</strong>
  and <strong>Casting</strong>, alongside a set named for individual outlets — Broadway World,
  StageSceneLA, OC Register and so on.
</p>

<ul>
  <li>Pick one that says what the post <em>is</em>, and add an outlet category as well if it is a press piece.</li>
  <li>
    <strong>Avoid inventing new categories.</strong> The list is already long, and a new one
    with a single post in it makes the site's own lists harder to trust. Use a tag instead.
  </li>
</ul>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>The Photos category unlocks an extra field.</strong> Tick <strong>Photos</strong>
    and save, and a <strong>Featured Images</strong> gallery field appears below the content —
    that is where a photo set goes. It is hidden on every other kind of post, so if you cannot
    find it, the category is the reason.
  </p>
</div>

<h2>Tags are shared with the whole site</h2>

<p>
  Tags are not specific to blog posts. The same tag list is used by pages, artists and other
  content, and there is a top-level <strong>Tags</strong> menu that shows everything carrying a
  given tag, regardless of type. Some tags in that list are internal housekeeping — anything in
  square brackets, like <code>[main pg]</code> — and are not meant for posts.
</p>

<h2>Linking a post to a show: the field that actually does something</h2>

<p>
  Below the content there is a panel called <strong>Related Posts 🔗</strong> with three fields:
</p>

<ul>
  <li>
    <strong>Related Production 🎭</strong> — the show this post is about. This one has a visible
    effect: the production's own page runs a list of every post pointed at it, so setting this
    is what makes a review or a photo set appear on the show's page. Nothing else adds it there.
  </li>
  <li>
    <strong>Related Event(s) 📆</strong> — the same idea for a specific event.
  </li>
  <li>
    <strong>Related Other</strong> — a loose link to any other page, artist, venue, class or
    supporter.
  </li>
</ul>

<p>
  This is the single most useful minute you can spend on a post. A press review with no Related
  Production is findable only by searching the blog; with it, it appears on the show it is
  about, permanently.
</p>

<h2>The link goes one way</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Nothing updates the other side.</strong> Setting Related Production on a post does
    not change the production; unpublishing or deleting the production does not warn you that
    posts still point at it. If a show is removed, its press coverage quietly stops appearing
    anywhere.
  </p>
</div>

<h2>Publishing</h2>

<ul>
  <li><strong>Publish</strong> is immediate and public. There is no review step.</li>
  <li>
    <strong>Save draft</strong> if it is not ready. Drafts are invisible to visitors but visible
    to everyone with a login.
  </li>
  <li>
    <strong>Preview</strong> before publishing — the post looks quite different on the site than
    it does in the editor, particularly the header.
  </li>
</ul>

<p>
  A newly published post appears at the top of the blog and in the “more from the blog” list at
  the bottom of every other post. If it has not appeared, see
  <?php chance_manual_see('why-isnt-my-change-showing', 'Why isn\'t my change showing?'); ?>
</p>
