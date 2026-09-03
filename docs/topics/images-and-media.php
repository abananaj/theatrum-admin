<?php

/**
 * Site Manual topic: images and the media library.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Every image, PDF and video on the site lives in one shared library — around seventeen
  thousand files at the time of writing. That scale is the reason for most of the advice
  below: anything you upload is permanent, shared, and findable only if you give it a
  sensible name.
</p>

<?php chance_manual_go('upload.php', 'Open the media library'); ?>

<h2>Two ways to look at the library</h2>

<ul>
  <li>
    <strong>Media → Library</strong> is the standard grid. Fine for finding something you
    uploaded recently.
  </li>
  <li>
    <strong>Media → Assistant</strong> is a more powerful table view, with sortable columns
    and filters. Worth learning if you spend real time in here.
  </li>
  <li>
    <strong>Media → Icons</strong> is a special case, explained below.
  </li>
</ul>

<h2>Uploading</h2>

<p>
  The easiest way is to drag a file straight onto the page you are editing, into an Image
  block. It uploads and gets inserted in one go. <strong>Media → Add New</strong> does the
  same thing without placing it anywhere.
</p>

<p>
  Two habits worth forming before you upload:
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>Name the file properly first.</strong> <code>hedwig-2026-production-photo.jpg</code>
    is findable in two years. <code>IMG_4471.jpg</code> is not, and renaming it after upload
    does not change the filename.
  </li>
  <li>
    <strong>Don't upload the enormous original.</strong> The site automatically makes smaller
    copies of everything at several sizes, but the file you upload is still stored and still
    sent to some visitors. Something in the region of 2000 pixels on its longest edge is
    plenty for a full-width image.
  </li>
</ul>

<p>
  Uploads are copied to cloud storage automatically. You do not have to do anything about
  that, but it does mean an image can take a moment longer than you expect to appear the
  very first time.
</p>

<h2>Alt text</h2>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>Alt text is the single most useful thing you can add to an image.</strong>
    Most images already on this site have none — a legacy of the old site, and not something
    you are expected to fix retrospectively. Just add it to everything from here on.
  </p>
</div>

<p>
  Alt text is the description read aloud to someone using a screen reader, and shown if the
  image fails to load. You will find the box in the block settings panel when an image is
  selected, and in the media library when a file is open.
</p>

<ul>
  <li>
    <strong>Describe what matters about the image</strong>, in a sentence — “Two actors
    mid-scene on a bare stage, lit in red” rather than “production photo”.
  </li>
  <li>
    <strong>Skip “image of” and “photo of”.</strong> The screen reader already says it is an
    image.
  </li>
  <li>
    <strong>Don't repeat the caption.</strong> If a caption already says who is in the photo,
    the alt text should add something else, or be left empty.
  </li>
  <li>
    <strong>Leave it empty for purely decorative images</strong> — a background texture, a
    divider. An empty box is the correct answer there, and better than a description.
  </li>
  <li>
    <strong>If the image is a poster with words on it</strong>, put those words in the alt
    text. Text baked into an image is invisible to everything but a human eye.
  </li>
</ul>

<h2>Captions, and the copy-on-click option</h2>

<p>
  Captions appear under the image on the page. Photo credits belong here.
</p>

<p>
  Image blocks also have a <strong>Caption</strong> panel with a toggle,
  <strong>Allow caption copy on click?</strong> Turning it on lets a visitor click the caption
  to copy its text — useful for a photo credit that press are meant to reuse. It is off by
  default, which is the right setting for most images.
</p>

<h2>Where the icons went</h2>

<p>
  The library contains a set of small interface icons that are part of the site's design, not
  content. They are deliberately hidden from the library, the Assistant view and the image
  picker, so that searching for a photo doesn't return ninety icons.
</p>

<p>
  If you do need them, they are all in one place:
</p>

<?php chance_manual_go('upload.php?page=ct-media-icons', 'Open the icon set'); ?>

<h2>Categories and tags on files</h2>

<p>
  Files can be filed under <strong>Att. Categories</strong> — Photo, Logo, Poster, Playbill,
  Press Release, Graphic — and given <strong>Att. Tags</strong>. Only a small fraction of the
  library is filed this way so far, so treat it as a helpful habit rather than a rule, and
  apply it where it will actually save someone a search: press releases, logos, season
  artwork.
</p>

<h2>Replacing an image</h2>

<p>
  There is no “replace this file” button, and this catches people out. If you upload a new
  version of a photo, it becomes a <em>separate</em> file — every page still points at the
  old one until you go and change them.
</p>

<p>
  So: if the image appears in one place, upload the new one and swap it on that page. If it
  appears in many, or you don't know how many, ask before starting — swapping it everywhere is
  a job worth doing in one pass rather than discovering the last one months later.
</p>

<h2>Deleting</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Deleting a file is permanent and it does not warn you what is using it.</strong>
    Every page, show and post that displayed that image simply loses it.
  </p>
</div>

<p>
  With a library this size there is very little to gain from tidying it up, and a lot to lose.
  If something is wrong, upload the correct version and stop using the old one. Leave deleting
  to a deliberate cleanup, not a stray moment.
</p>

<h2>Finding things in seventeen thousand files</h2>

<ul>
  <li>Search matches the filename, the title and the caption — which is the argument for naming files well.</li>
  <li>The Assistant view lets you filter by date, type and category, and sort by column.</li>
  <li>
    If you know which show a photo belongs to, it is often faster to open that show's page and
    find the image there than to search the library at all.
  </li>
</ul>

<p>
  If an image looks right in the editor but not on the live site, that is usually something
  else — see <?php chance_manual_see('why-isnt-my-change-showing', 'Why isn\'t my change showing?'); ?>
</p>
