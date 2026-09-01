<?php

/**
 * Site Manual topic: a tour of the admin menu.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  The menu down the left of every admin screen has been rearranged for this site, so it does
  not match what you will see in a WordPress tutorial. This is a walk down it, top to bottom,
  with the surprises flagged. If you have an Editor account rather than an administrator one,
  you will see the content half of this list and not the settings half.
</p>

<h2>The top</h2>

<ul>
  <li><strong>Dashboard</strong> — the landing screen. Nothing important lives here.</li>
  <li><strong>Site Manual</strong> — this manual.</li>
</ul>

<h2>Content</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>Media</strong> — every image, PDF and video. Its submenu has more in it than
    standard WordPress: <strong>Assistant</strong> is a more powerful table view of the same
    library, and <strong>Icons</strong> is a separate screen for interface icons that are
    hidden from the main library. See <?php chance_manual_see('images-and-media'); ?>.
  </li>
  <li>
    <strong>Pages</strong> — the standing pages: About, Visit, Support Us. Its submenu also
    lists several taxonomies (Categories, Event Types, Programs, Seasons, Series) which are
    there for convenience rather than because they belong to pages.
  </li>
  <li>
    <strong>Blog</strong> — this is WordPress's “Posts”, renamed. Press, announcements, photos,
    interviews. See <?php chance_manual_see('blog-posts'); ?>.
  </li>
  <li>
    <strong>Artists</strong> — everyone ever credited on a show, plus staff.
    See <?php chance_manual_see('adding-an-artist'); ?>.
  </li>
  <li>
    <strong>Events</strong> — individual dated events and performances.
  </li>
  <li>
    <strong>Productions</strong> — the shows. Its submenu is worth reading properly:
    <strong>Chance Productions</strong> is the full list, <strong>Visiting Companies</strong>
    is that same list filtered to one series, and <strong>Credits</strong> opens the credits
    records directly — which is not how you add a credit
    (see <?php chance_manual_see('production-credits'); ?>).
  </li>
  <li>
    <strong>Supporters</strong> — donors and sponsors, with their own Support Levels.
  </li>
  <li>
    <strong>Conservatory</strong> — the classes. The menu says Conservatory; the content type
    is called Class, which is why some screens say one and some say the other.
  </li>
  <li>
    <strong>Venues</strong> — the performance spaces.
  </li>
</ul>

<h2>Below the divider</h2>

<ul>
  <li>
    <strong>Comments</strong> — deliberately moved down here and out of the way.
  </li>
  <li>
    <strong>Site Options</strong> — sitewide settings that are not really WordPress settings:
    the current season, the staff and board listings, fallback images. Small screen, wide reach.
  </li>
  <li>
    <strong>Global Categories</strong> — the colour schemes. This is where the Onstage,
    Education, Donate and Membership palettes are defined. You choose one on a page; you
    almost never need to edit one here.
  </li>
  <li>
    <strong>Tags</strong> — one shared tag list for the whole site. Tagging a page, an artist
    and a blog post with the same tag puts them in one list together, and this screen is how
    you see that list. Tags in square brackets, like <code>[main pg]</code>, are internal
    housekeeping.
  </li>
  <li>
    <strong>WPForms</strong> — forms and their submissions.
    See <?php chance_manual_see('forms'); ?>.
  </li>
</ul>

<h2>The administrator half</h2>

<p>
  Everything from here down changes how the site works rather than what is on it. If you can
  see these, you are an administrator.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Appearance → Editor edits the site itself</strong> — headers, footers, the frame
    around every page — not one page. It is the fastest way to break something sitewide. See
    <?php chance_manual_see('things-not-to-touch'); ?>.
  </p>
</div>

<ul>
  <li>
    <strong>Appearance</strong> — Editor, Templates, Patterns and Parts. Patterns is the one
    you may legitimately need; read <?php chance_manual_see('patterns'); ?> first.
  </li>
  <li><strong>Plugins</strong>, <strong>Tools</strong>, <strong>Settings</strong> — leave alone unless you know exactly why you are there.</li>
  <li>
    <strong>Users</strong> — accounts. Adding one is fine; changing someone's role or deleting
    an account is not a casual action, because a deleted user's posts have to be reassigned.
  </li>
  <li>
    <strong>ACF</strong> — this is where the custom fields themselves are defined. Editing here
    changes the shape of the editing screens for everyone. Not a content tool.
  </li>
</ul>

<h2>Two things that catch people out</h2>

<ul>
  <li>
    <strong>The same taxonomy appears under several menus.</strong> Seasons under Blog, Pages,
    Events and Productions is one list, not four. Editing it in one place edits it everywhere.
  </li>
  <li>
    <strong>Most of the site is not in Pages.</strong> Shows, events, artists, classes and
    venues each have their own menu. If you cannot find something, it is almost always because
    you are looking in Pages.
  </li>
</ul>
