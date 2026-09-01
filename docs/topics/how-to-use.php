<?php if (! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  This manual lives inside the website itself, so it is always here when you need it and
  always describes <em>this</em> site rather than WordPress in general. You can get back to it
  any time from <strong>Site Manual</strong> at the top of the left-hand menu.
</p>

<h2>What is in here</h2>

<p>
  Topics are grouped by the job you are trying to do, not by how the site is built. If you
  want to put a show up, look under <em>Putting content on the site</em>. If something looks
  wrong, look under <em>When something looks wrong</em>.
</p>

<p>
  Some topics are marked <span class="ct-manual__badge">not written yet</span>. That is
  honest rather than broken — they are planned and will be filled in. Ask in the meantime,
  and the answer will end up on that page.
</p>

<h2>The five rules that matter most</h2>

<ol class="ct-manual__rules">
  <li>
    <strong>Editing a pattern can change many pages at once.</strong> Most patterns on this
    site are shared between pages. Before you edit one, check how many pages use it.
    <?php chance_manual_see('patterns', 'How to check'); ?>.
  </li>
  <li>
    <strong>Nothing cleans up after you.</strong> If you delete or unpublish an artist, every
    place that referenced them — production credits, the staff and board lists, season
    listings — keeps pointing at someone who is no longer there. It will not warn you.
    Unpublish deliberately, and fix the references yourself.
  </li>
  <li>
    <strong>Save the page before you expect anything to work.</strong> Several parts of the
    editor — production credits in particular — need the post to exist before they will let
    you add to it.
  </li>
  <li>
    <strong>A blank space is usually a block in the wrong place, not a broken block.</strong>
    Some blocks only display when they sit on the right kind of page.
    <?php chance_manual_see('why-isnt-my-change-showing', 'What to check'); ?>.
  </li>
  <li>
    <strong>If you are unsure, save a draft instead of publishing.</strong> Drafts are free.
    Undoing a published mistake is not always quick.
  </li>
</ol>

<h2>Finding your way around</h2>

<p>
  The left-hand menu has been rearranged for this site — it is not the standard WordPress
  layout. <em>Posts</em> is called <strong>Blog</strong>, media and pages come first, and the
  content types specific to the theatre (Productions, Events, Artists, Venues, Classes,
  Supporters) each have their own section.
</p>

<?php chance_manual_go('index.php', 'Go to the Dashboard'); ?>

<h2>When you are stuck</h2>

<p>
  Two things make a question much faster to answer: the <strong>address of the page</strong>
  you were on (copy it from the browser bar) and <strong>what you expected to happen</strong>
  instead of what did. A screenshot beats a description.
</p>
