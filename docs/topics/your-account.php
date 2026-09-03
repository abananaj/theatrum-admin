<?php

/**
 * Site Manual topic: your account and what you can do.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  What you can see and change on this site depends on the kind of account you have. There are
  two that matter here: <strong>Administrator</strong> and <strong>Editor</strong>.
</p>

<h2>Which one are you?</h2>

<p>
  Look at the left-hand menu. <strong>If you can see Appearance, Plugins, Tools and Settings
  near the bottom, you are an administrator.</strong> If the menu stops after WPForms or
  Tags, you are an Editor.
</p>

<?php chance_manual_go('profile.php', 'Open your profile'); ?>

<h2>Editor</h2>

<p>
  An Editor can do all of the day-to-day work of running the site:
</p>

<ul>
  <li>Write, edit, publish and delete <strong>any</strong> content — pages, blog posts, productions, events, artists, classes, venues, supporters — including other people's.</li>
  <li>Upload and manage everything in the media library.</li>
  <li>Manage categories, tags, seasons, series and the other classifications.</li>
  <li>Moderate comments.</li>
  <li>Open <strong>Site Options</strong> and this manual.</li>
</ul>

<p>
  An Editor cannot reach Appearance, Plugins, Users, Tools, Settings, the form builder, or the
  screens where the custom fields themselves are defined. That is deliberate: those are the
  screens where a wrong click affects the whole site rather than one page.
</p>

<h2>Administrator</h2>

<p>
  An administrator can do everything an Editor can, plus install and remove plugins, edit the
  site's templates, add and delete user accounts, and change sitewide settings.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Being an administrator is not a reason to use it.</strong> Almost all content work
    is Editor work. If you find yourself in Appearance, Plugins or Settings, it is worth
    stopping to ask whether you meant to be there — see
    <?php chance_manual_see('things-not-to-touch'); ?>.
  </p>
</div>

<h2>Your login</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>One account per person.</strong> Never share a login. When something goes wrong the
    first question is who changed it, and a shared account makes that unanswerable.
  </li>
  <li>
    <strong>Use a long, unique password</strong>, and let the browser or a password manager
    remember it. WordPress will generate a strong one for you on your profile page.
  </li>
  <li>
    <strong>Don't reuse your email password.</strong> A site login is worth far less to an
    attacker than the mailbox it can reset itself through.
  </li>
  <li>
    <strong>Log out on shared or box-office machines.</strong> A logged-in session in a public
    space is a logged-in session for whoever sits down next.
  </li>
</ul>

<h2>Changing your own details</h2>

<p>
  Your profile is under <strong>Users → Profile</strong>, or the “Howdy” menu at the top right.
  Your name and password are worth setting; the colour scheme and the rest are cosmetic.
</p>

<p>
  <strong>Display Name</strong> is what appears as the author on blog posts, so it is worth
  making it a real name rather than a username.
</p>

<h2>When someone leaves</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Do not simply delete a departing person's account.</strong> WordPress will ask what
    to do with everything they wrote, and getting that wrong deletes their posts along with
    them. Reassign their content to another account when prompted.
  </p>
</div>

<p>
  Removing an account is also not the same as removing the person from the site. If they appear
  in the staff or board listings, that is a separate job — see
  <?php chance_manual_see('site-options'); ?>.
</p>
