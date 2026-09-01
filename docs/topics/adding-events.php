<?php

/**
 * Site Manual topic: events and performance dates.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  An <strong>Event</strong> is one dated thing: a gala, an audition, a talkback, a wine night,
  a design preview party. Performances of a show are handled by the production itself — an
  Event is for the things around the shows rather than the shows themselves.
</p>

<?php chance_manual_go('post-new.php?post_type=event', 'Add a new event'); ?>

<h2>The header is inside the event, not the template</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    A new event arrives with a block already in it, called <strong>Event Header</strong>.
    <strong>Do not delete it.</strong> It draws the title, the featured image, the date and
    time, the venue, the breadcrumbs and the Buy Tickets button. Remove it and the event page
    is left with nothing but whatever you typed.
  </p>
</div>

<p>
  Write your own content <em>below</em> that block, not in place of it. And because it is a
  shared pattern, editing its insides changes every event on the site — see
  <?php chance_manual_see('patterns'); ?>.
</p>

<h2>The details panel</h2>

<p>
  Below the content is <strong>Details, event 📅</strong>. This is where the event actually
  gets its date — typing a date into the content does nothing.
</p>

<ul class="ct-manual__rules">
  <li>
    <strong>Date 📆</strong>, <strong>Start ⏳</strong> and <strong>End⌛</strong> — the when.
    Fill in all three where you can; the end time is what lets the site show a range rather
    than a single time.
  </li>
  <li>
    <strong>Add another date?</strong> — a tick box. Turn it on and a second set of fields
    appears: <strong>Date 2</strong>, <strong>Start 2⏳</strong> and <strong>End 2⌛</strong>.
    This is for an event that genuinely happens twice, such as a two-night gala. If you cannot
    see those fields, the tick box is the reason.
  </li>
  <li>
    <strong>Buy Tickets Link</strong> — the full URL of the ticketing page. Leave it empty and
    no button appears, which is the right answer for a free event.
  </li>
  <li>
    <strong>Related Production</strong> — the show this event belongs to, if any.
  </li>
  <li>
    <strong>Venue</strong> — where it happens. Required if you have not set a Related
    Production; with a production set, the venue can come from the show instead.
  </li>
  <li>
    <strong>BATAC Room</strong> — appears only when the venue is the Bette Aitken Theater Arts
    Center. Choose the room: Cripe Stage, Fyda-Mar Stage, Classroom, Lobby, Offsite, or
    <em>Inherit from Production</em> to use whatever the show is using.
  </li>
</ul>

<h2>Event Types and Seasons</h2>

<p>
  In the sidebar, <strong>Event Types</strong> says what kind of event it is — Gala, Auditions,
  Wine Night, Design Preview Party, Director's Dinner, Fundraiser, Talkback, Pride Night and so
  on. Pick from the existing list rather than adding new ones; the site builds lists from these.
</p>

<p>
  <strong>Seasons</strong> files the event under a season, the same way productions are filed.
  Worth setting so the event stays findable once it is in the past.
</p>

<h2>Getting it onto the show's page</h2>

<p>
  A production page runs a list of every event pointed at it, so <strong>Related Production is
  what puts an event on the show's page</strong>. There is no second step and no way to add it
  from the production side.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>The link only runs one way.</strong> Nothing on the production tells you which
    events point at it, and unpublishing a production does not warn you that events still do.
  </p>
</div>

<h2>Events can have sub-events</h2>

<p>
  Events are one of the few content types on this site that nest — hence
  <strong>Add New Event Sub-page</strong> in the menu. A parent event with children is the right
  shape for something like a festival with several sessions under it. Most events need no parent
  at all, so leave it alone unless you are deliberately building a group.
</p>

<h2>Before you publish</h2>

<ul>
  <li>Check the date and the times, and check them against the Buy Tickets page if there is one.</li>
  <li>Add a featured image — without one the event falls back to a generic image in every list it appears in.</li>
  <li>
    Preview it. The header is drawn from the fields rather than from what you typed, so the
    editor is a poor guide to how it will look.
  </li>
</ul>

<p>
  Past events stay on the site. They are not deleted when the date passes, and they should not
  be — see <?php chance_manual_see('things-not-to-touch'); ?>.
</p>
