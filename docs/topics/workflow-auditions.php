<?php

/**
 * Site Manual workflow: putting an audition up.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>
<p class="ct-manual__intro">
  An audition is an Event with its own starting layout. What makes it its own job is that it usually
  needs three things pointing at each other: the event itself, the show it is casting, and a signup
  form.
</p>

<h2>1. Create it from Add Audition</h2>

<?php chance_manual_go('post-new.php?post_type=event&ct_layout=audition', 'Add an audition'); ?>

<p>
  Use <strong>Events → Add Audition</strong>, not the ordinary Add New. It does three things for you:
  it ticks <strong>Auditions</strong> under <strong>Event Types</strong>, it shows the audition
  details panel, and it fills the page with the audition layout. Title the event plainly — the name of
  the show and the word Auditions is enough.
</p>

<p>
  If you started from the ordinary Add New by mistake, tick <strong>Auditions</strong> in the sidebar,
  save and reload to get the right panel, then copy the layout from an existing audition. It is
  usually quicker to start again from Add Audition.
</p>

<h2>2. Set the date and times</h2>

<p>
  In the <strong>Details, event audition 📅</strong> panel, fill in <strong>Date 📆</strong>,
  <strong>Start ⏳</strong> and <strong>End⌛</strong>. Typing a date into the body of the page does
  nothing; these fields are what the site reads.
</p>

<p>
  For a call spread over two days, tick <strong>Add another date?</strong> and a second set of
  fields appears. If you cannot see them, that tick box is why.
</p>

<h2>3. Point it at the show</h2>

<p>
  Set <strong>Related Production</strong> to the show being cast. That lists the audition on the
  show's page, adds it to the show's <strong>Events</strong> field, and fills the “about the show”
  card in the audition layout with the show's dates.
</p>

<p>
  If the auditions are general — a season call, or a company audition with no single show attached —
  leave it empty. In that case <strong>Venue</strong> becomes the field that matters, because
  without a related production there is no show for the site to take the location from.
</p>

<h2>4. Fill in the layout</h2>

<p>
  The top of the page is a shared layout, <strong>Layout — Audition</strong>. Most of it is locked
  and fills itself in from the fields above. The pieces you can click into and type over are the
  <strong>Pretitle</strong> and <strong>Subtitle</strong>, the <strong>Address</strong> and
  <strong>Directions link</strong>, and the audition dates: <strong>By appt</strong>,
  <strong>Open call time</strong>, <strong>Submission deadline</strong>,
  <strong>Callback date</strong>, <strong>Rehearsal start</strong>, <strong>Performance dates</strong>,
  <strong>Performance times</strong> and <strong>Special performance</strong>. What you type there
  stays on this audition only. <?php chance_manual_see('patterns', 'How shared layouts work'); ?>.
</p>

<p>
  Below it is a <strong>Character Breakdown</strong> section. That part is ordinary content: replace
  each <strong>CHARACTER</strong> heading and its description, and add or delete rows as needed.
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
  The audition panel has no Buy Tickets Link, so link to the signup page from the content instead.
</p>

<h2>Before you publish</h2>

<ul>
  <li>Check the date, and check the times against whatever has already gone out to people.</li>
  <li>Preview it — the layout is built from the fields, so the editor is a poor guide to how it looks.</li>
  <li>Leave it on the site after the date passes. Past events are not deleted here.</li>
</ul>
