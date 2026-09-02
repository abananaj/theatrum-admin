<?php

/**
 * Site Manual workflow: putting an audition up.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  An audition is an Event like any other. What makes it its own job is that it usually needs three
  things pointing at each other: the event itself, the show it is casting, and a signup form.
</p>

<h2>1. Create the event</h2>

<?php chance_manual_go('post-new.php?post_type=event', 'Add a new event'); ?>

<p>
  Title it plainly — the name of the show and the word Auditions is enough. Leave the
  <strong>Event Header</strong> block that is already there alone; it draws the date, venue and
  buttons, and deleting it empties the page.
  <?php chance_manual_see('adding-events', 'More on events'); ?>.
</p>

<h2>2. Set the type</h2>

<p>
  In the sidebar, under <strong>Event Types</strong>, tick <strong>Auditions</strong>. The term
  already exists — pick it rather than typing a new one, because the site builds its lists from
  these and a near-duplicate simply goes missing.
</p>

<h2>3. Set the date and times</h2>

<p>
  In the <strong>Details, event 📅</strong> panel, fill in <strong>Date 📆</strong>,
  <strong>Start ⏳</strong> and <strong>End⌛</strong>. Typing a date into the body of the page does
  nothing; these fields are what the site reads.
</p>

<p>
  For a call spread over two days, tick <strong>Add another date?</strong> and a second set of
  fields appears. If you cannot see them, that tick box is why.
</p>

<h2>4. Point it at the show</h2>

<p>
  Set <strong>Related Production</strong> to the show being cast. That is what lists the audition on
  the show's page.
</p>

<p>
  If the auditions are general — a season call, or a company audition with no single show attached —
  leave it empty. In that case <strong>Venue</strong> becomes the field that matters, because
  without a related production there is no show for the site to take the location from.
</p>

<h2>5. Add a featured image</h2>

<p>
  Auditions appear in event lists alongside everything else. Without an image they fall back to a
  generic one.
</p>

<h2>6. The signup form</h2>

<p>
  There is already an <strong>Audition Form</strong> in the forms list — check whether it fits before
  building anything new. Getting it onto a page of its own is its own short job:
  <?php chance_manual_see('workflow-event-form-page', 'A form page for an event'); ?>.
</p>

<p>
  If you only need to send people somewhere to sign up, the <strong>Buy Tickets Link</strong> field
  will take any URL and puts a button on the event page.
</p>

<h2>Before you publish</h2>

<ul>
  <li>Check the date, and check the times against whatever has already gone out to people.</li>
  <li>Preview it — the header is built from the fields, so the editor is a poor guide to how it looks.</li>
  <li>Leave it on the site after the date passes. Past events are not deleted here.</li>
</ul>
