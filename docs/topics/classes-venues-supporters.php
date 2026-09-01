<?php

/**
 * Site Manual topic: classes, venues and supporters.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Three smaller content types, each with a short list of fields. None of them is complicated;
  they are grouped here because you will edit them rarely enough to forget how.
</p>

<h2>Classes</h2>

<p>
  In the menu this is called <strong>Conservatory</strong>; the content type is called Class,
  which is why some screens say one and some the other.
</p>

<?php chance_manual_go('edit.php?post_type=class', 'Open the class list'); ?>

<p>
  Title, featured image and description work as they do everywhere. The
  <strong>Details</strong> panel below is where a class gets its schedule:
</p>

<ul class="ct-manual__rules">
  <li><strong>Teaching Artist</strong> — points at an Artist record, so the person must exist there first.</li>
  <li><strong>Registration Link</strong> — the full URL people sign up through.</li>
  <li><strong>Session</strong> and <strong>Program</strong> — which term it runs in, and which strand of the Conservatory it belongs to.</li>
  <li><strong>Date Start</strong> and <strong>Date End</strong> — the run of the course.</li>
  <li><strong>Day of Week</strong>, <strong>Time Start</strong> and <strong>Time End</strong> — the weekly slot.</li>
</ul>

<div class="notice notice-info inline ct-manual__warning">
  <p>
    <strong>If the schedule does not fit those boxes</strong> — it moves around, or it is a
    weekend intensive — leave the day and time fields empty and type it into
    <strong>Custom schedule</strong> instead. That text is shown as-is on the site.
    Filling in both is what produces a class page contradicting itself.
  </p>
</div>

<h2>Venues</h2>

<?php chance_manual_go('edit.php?post_type=venue', 'Open the venue list'); ?>

<p>
  There are ten of these and they change almost never. A venue's page draws its address from
  four fields under <strong>Address</strong>: <strong>Street Address</strong>,
  <strong>City</strong>, <strong>State</strong> (as a two-letter abbreviation) and
  <strong>Zip</strong>. Those four are the ones that appear on the site.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Ignore the two fields marked “fix later ⚠️”.</strong> Below the address there is a
    collapsed section holding a second address field and a Google Maps field, both flagged.
    They are unfinished, they are empty on every venue, and nothing on the site reads them.
    Anything you type into them will not appear anywhere.
  </p>
</div>

<p>
  So: fill in the four plain address fields, and leave the flagged section alone until someone
  says it has been sorted out.
</p>

<h2>Supporters</h2>

<p>
  Donors and sponsors. These feed the donor listings and the sponsor strip on production pages.
</p>

<?php chance_manual_go('edit.php?post_type=supporter', 'Open the supporter list'); ?>

<ul>
  <li><strong>Title</strong> — the supporter's name as it should be credited.</li>
  <li><strong>Supporter Type</strong> — <strong>Individual</strong> or <strong>Institutional</strong>. Institutional ones are the sponsors with logos.</li>
  <li><strong>Support Level</strong> — the giving tier: Diamond, Sapphire, Ruby, Angel, Patron, Benefactor, Advocate, Supporter, Friend.</li>
  <li><strong>Website</strong> — used to link the logo, mostly for institutional supporters.</li>
  <li><strong>Featured image</strong> — the logo.</li>
</ul>

<p>
  Two tick boxes decide where a supporter shows up, and they are independent:
</p>

<ul class="ct-manual__rules">
  <li><strong>Show in production sidebar?</strong> — puts them alongside shows.</li>
  <li><strong>Show in donors?</strong> — puts them in the donor listing.</li>
</ul>

<p>
  A supporter with neither ticked is on the site but visible nowhere, which is the usual reason
  someone reports that a sponsor “didn't save”.
</p>

<h2>One thing all three share</h2>

<p>
  Nothing here updates the other side. A class points at its teaching artist; the artist has no
  idea it exists. A supporter points at no production, and a production's sponsor strip is built
  from the tick box above, not from the show. Deleting any of these records leaves whatever
  referenced them pointing at nothing, silently — the same rule as everywhere else on this site.
</p>
