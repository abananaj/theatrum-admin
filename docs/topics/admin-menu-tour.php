<?php

/**
 * Site Manual topic: a tour of the admin menu.
 */

if ( ! defined('ABSPATH')) {
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
  <li>
    <strong>Site Manual</strong> — this manual. Its submenu has one row per section, each opening
    that section's first page.
  </li>
</ul>

<h2>Content</h2>

<p>
  Most of these menus open the same way: the list, the <strong>Add New</strong> link, a thin
  divider line, then the extras that belong to that kind of content.
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>Media</strong> — every image, PDF and video. Its submenu has more in it than
    standard WordPress: <strong>Assistant</strong> is a more powerful table view of the same
    library, <strong>Att. Category</strong> and <strong>Att. Tag</strong> are the media library's
    own filing labels, and <strong>Icons</strong> is a separate screen for interface icons that
    are hidden from the main library. See <?php chance_manual_see('images-and-media'); ?>.
  </li>
  <li>
    <strong>Pages</strong> — the standing pages: About, Visit, Support Us. Below the divider,
    <strong>Archived Pages</strong> lists pages that have been taken off the site but kept.
    New season pages are not made from here — use <strong>Seasons → New Season</strong>.
  </li>
  <li>
    <strong>Blog</strong> — this is WordPress's “Posts”, renamed. Press, announcements, photos,
    interviews. Its <strong>Categories</strong> and <strong>Tags</strong> sit below the divider.
    See <?php chance_manual_see('blog-posts'); ?>.
  </li>
  <li>
    <strong>Artists</strong> — everyone ever credited on a show, plus staff. Below the divider,
    <strong>Chance Staff</strong> is where staff roles are filled in — the same fields as the
    staff list in Site Options. See <?php chance_manual_see('adding-an-artist'); ?>.
  </li>
  <li>
    <strong>Events</strong> — individual dated events. <strong>Add Audition</strong>, right under
    Add New Event, starts an event already set up as an audition
    (<?php chance_manual_see('workflow-auditions', 'Auditions'); ?>). Below the divider are
    <strong>Event Types</strong> and <strong>Add New Event Sub-page</strong>.
  </li>
  <li>
    <strong>Productions</strong> — the shows. The first four rows are all the same list, filtered
    differently: <strong>All Productions</strong> is everything; <strong>Chance Productions</strong>
    leaves out the Visiting Companies and the OTR readings (an OTR show that is also in the Main
    series stays in); <strong>OTR Readings</strong> and <strong>Visiting Companies</strong> are
    one series each. <strong>Add New Production</strong> is below the divider — it asks which
    series the show is in before anything else, and that choice sets up the right fields.
    See <?php chance_manual_see('adding-a-production'); ?>.
  </li>
  <li>
    <strong>Supporters</strong> — donors and sponsors. Below the divider: <strong>Tags</strong>,
    <strong>Support Levels</strong>, and <strong>Board Positions</strong>, where board roles are
    filled in (the same fields as the board list in Site Options).
  </li>
  <li>
    <strong>Conservatory</strong> — the classes. The menu says Conservatory; the content type
    is called Class, which is why some screens say one and some say the other. Programs and
    Sessions are below the divider.
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
    the staff and board listings and the fallback images. See
    <?php chance_manual_see('site-options'); ?>.
  </li>
  <li>
    <strong>Seasons</strong> — everything to do with seasons in one place:
    <ul>
      <li><strong>All Seasons</strong> — the list of seasons, with the form for adding a new one.</li>
      <li><strong>New Season</strong> — starts a new season <em>page</em>, already laid out.</li>
      <li><strong>Series</strong> — Main, OTR, TYA, Holiday and the rest.</li>
      <li>
        <strong>Season Settings</strong> — which season is current. Administrators only.
      </li>
    </ul>
    See <?php chance_manual_see('seasons-and-series'); ?>.
  </li>
  <li>
    <strong>Global Categories</strong> — the colour schemes. This is where the Onstage,
    Education, Donate and Membership palettes are defined. You choose one on a page; you
    almost never need to edit one here.
  </li>
  <li>
    <strong>Tags</strong> — one shared tag list for the whole site. Tagging a page, an artist
    and a blog post with the same tag puts them in one list together, and this screen is how
    you see that list: the number beside a tag opens everything carrying it. Tags in square
    brackets, like <code>[main pg]</code>, are internal housekeeping.
  </li>
  <li>
    <strong>WPForms</strong> — forms and their submissions. Administrators only.
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
    <strong>Tags appears under several menus, but it is one list.</strong> The Tags rows under
    Media, Blog, Supporters and Conservatory are the same shared list, filtered to that kind of
    content. Renaming a tag in one place renames it everywhere.
  </li>
  <li>
    <strong>Most of the site is not in Pages.</strong> Shows, events, artists, classes and
    venues each have their own menu. If you cannot find something, it is almost always because
    you are looking in Pages.
  </li>
</ul>
