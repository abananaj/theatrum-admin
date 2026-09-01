<?php if (! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Work through these in order. The first three explain almost every case, and none of them
  means anything is broken.
</p>

<h2>1. Is it actually published?</h2>

<p>
  Check the top of the editor. A post can be saved as a <strong>draft</strong>, scheduled for a
  future date, or set to <strong>private</strong> — all of which look saved to you and are
  invisible to visitors. Look for the blue <em>Publish</em> button; if it is still there, the
  page has never gone live.
</p>

<p>
  Related: a production with no season assigned, or with dates that have already passed, is
  published but will not appear in the listings you expected.
</p>

<h2>2. Are you looking at the right site?</h2>

<p>
  There is more than one copy of this website while the new one is being built. A change made
  on one will not appear on the other. Check the address in your browser against whichever
  address you were told to use for the task you are doing, and if the two differ, that is your
  answer.
</p>

<h2>3. Is it cached?</h2>

<p>
  The site keeps a saved copy of each page so it loads quickly, and that copy can lag a few
  minutes behind an edit. Two quick tests:
</p>

<ul>
  <li>Reload the page bypassing your own browser cache — <strong>Ctrl+Shift+R</strong> (Windows) or <strong>Cmd+Shift+R</strong> (Mac).</li>
  <li>Open the page in a private or incognito window. If the change is there, it was your browser, and everyone else is already seeing the new version.</li>
</ul>

<p>
  If it is still stale after a few minutes, the site-wide cache can be cleared — ask rather
  than hunting for the button, as there are several and only one of them is the right one.
</p>

<h2>4. Is the block in a place where it can work?</h2>

<p>
  This is the one that looks like a bug and is not. Several blocks built for this site pull
  information from the page they are sitting on — the show's dates, its poster, its quotes.
  Placed somewhere with nothing to read, they display nothing at all rather than an error.
</p>

<p>
  Symptoms: a block looks fine in the editor but leaves an empty gap on the live page, or
  shows a placeholder in the editor and nothing beyond it.
</p>

<p>
  Common causes:
</p>

<ul>
  <li>A field-based block placed on an ordinary page instead of on a show, or outside the list it was meant to sit inside.</li>
  <li>The on-page navigation block used somewhere other than a page, production or event.</li>
  <li>A quotes or performance-dates block on a show where those fields were never filled in.</li>
  <li>A filter block that has not been pointed at the list it is supposed to filter.</li>
</ul>

<p>
  The fix is nearly always to move the block, not to replace it.
</p>

<h2>5. Did the change land somewhere you did not expect?</h2>

<p>
  If editing one page changed several, you edited a shared pattern.
  <?php chance_manual_see('patterns', 'How shared patterns work'); ?> — and how to put it back.
</p>

<h2>Still stuck?</h2>

<p>
  Send three things: the address of the page, what you expected to see, and a screenshot of
  what you got instead. That is almost always enough to identify it without a call.
</p>
