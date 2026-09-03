<?php

/**
 * Site Manual workflow: a form page for an event.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Sometimes an event needs a page of its own for people to fill something in — an audition signup, an
  RSVP, an application. That page belongs <em>under the event</em>, not in with the ordinary pages of
  the site.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Do not use Pages → Add New Page for this.</strong> A regular page has no parent event and
    none of the event fields, so it will not carry the date, the venue or the event's framing, and it
    will not sit underneath the event where people expect to find it.
  </p>
</div>

<h2>1. Start from the Events menu</h2>

<p>
  Under <strong>Events</strong> in the left-hand menu there is an item called
  <strong>Add New Event Sub-page</strong>. That is the one.
</p>

<?php chance_manual_go('post-new.php?post_type=event&ct_event_subpage=1', 'Add a new event sub-page'); ?>

<h2>2. Choose the parent event</h2>

<p>
  A window opens as soon as the editor loads, asking which event this page belongs under. Pick the
  event — the audition, the gala, whatever it is — and carry on.
</p>

<p>
  If you close that window by accident, the same setting is still available: open
  <strong>Page Attributes</strong> in the sidebar and set <strong>Parent</strong> there. The window
  exists only because that panel is easy to miss.
</p>

<h2>3. Put the form on the page</h2>

<p>
  Add a block and search for <strong>WPForms</strong>. Insert it, and choose the form you want from
  its dropdown.
</p>

<p>
  <strong>Look before you build.</strong> There are already dozens of forms on this site — auditions,
  volunteering, rentals, internships, sponsorship, ticket cancellations. Making a second version of
  one that exists means entries arriving in two places.
  <?php chance_manual_see('forms', 'The forms topic'); ?>.
</p>

<p>
  You may also come across <code>[wpforms id="123"]</code> written into older pages. That is the
  original way of doing the same thing and it still works, but use the block for anything new.
</p>

<h2>4. Add whatever the form needs around it</h2>

<p>
  A line or two above the form about what happens next — when people will hear back, who to contact —
  saves a lot of email. Set a featured image too, since this page can show up in listings.
</p>

<h2>5. Where the answers go</h2>

<p>
  Submissions do not arrive as posts or pages. They are collected under the form itself, in
  <strong>Entries</strong>, and that is the record that matters — not the notification email.
  <?php chance_manual_see('forms', 'Finding form entries'); ?>.
</p>
