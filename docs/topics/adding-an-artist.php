<?php

/**
 * Site Manual topic: adding an artist.
 */

if (! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  <strong>Artists</strong> holds everyone who has ever been credited on a Chance production —
  actors, designers, directors, staff — around two and a quarter thousand of them. An artist
  record is small: a name, a headshot, a bio. Everything else about them is assembled from
  their credits.
</p>

<?php chance_manual_go('edit.php?post_type=artist', 'Open the Artists list'); ?>

<h2>Check they are not already there</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Search first, every time.</strong> With this many records, duplicates are easy to
    create and tedious to merge — and a duplicate splits an artist's credit history across two
    pages, so neither page shows their real work.
  </p>
</div>

<p>
  Search for the surname on its own. People are entered under stage names, married names and
  the odd typo, so a full-name search can miss someone who is already in there.
</p>

<h2>The fields</h2>

<ul class="ct-manual__rules">
  <li>
    <strong>Title</strong> — the artist's name, as they want it credited. Nothing else goes in
    this box.
  </li>
  <li>
    <strong>Featured image</strong> — the headshot. Square or close to it works best; the site
    crops it. If you have none, leave it empty and a placeholder is used.
  </li>
  <li>
    <strong>The main content area</strong> — the bio. Plain paragraphs. This is the programme
    bio, so it is usually supplied rather than written from scratch.
  </li>
</ul>

<p>
  Below the content is a panel called <strong>Details, artist 🎨</strong>:
</p>

<ul>
  <li>
    <strong>Profession</strong> — the general discipline: Actor, Lighting Designer, Director.
    It shows under the name on their page.
  </li>
  <li>
    <strong>Title</strong> — a specific job title, for staff: General Manager, Artistic
    Director. Also shown under the name.
  </li>
  <li>
    <strong>Artist Tags</strong> — four checkboxes: <strong>Chance Staff</strong>,
    <strong>Teaching Artist</strong>, <strong>Resident Artist</strong> and
    <strong>Resident Playwright</strong>. These are what put someone into the corresponding
    listing on the site, so tick them deliberately.
  </li>
  <li>
    <strong>Resident Artist Title</strong> — only if their title on the Resident Artists page
    should differ from the Title above. Leave it empty and the Title is used.
  </li>
  <li>
    <strong>Teaching Bio</strong> — only if their bio on the Teaching Artists page should differ
    from the main bio. Leave it empty and the main bio is used.
  </li>
  <li>
    <strong>Links</strong> — a repeating list of website links, each with an icon, a name and a
    URL. Barely used so far; fine to skip.
  </li>
</ul>

<h2>You do not type their production history</h2>

<p>
  An artist's page lists every show they have been credited on, and that list is built
  automatically from the Credits Manager on each production. You never add it by hand, and
  editing the artist cannot change it.
</p>

<p>
  Which means the way to give an artist a credit is to go to the <em>production</em> and add
  them there — see <?php chance_manual_see('production-credits'); ?>. Creating the artist
  record is only step one.
</p>

<h2>Renaming, and what happens to old credits</h2>

<p>
  Changing the Title changes the name everywhere it appears, including on every past
  production — which is usually what you want when someone changes their name. Their existing
  credits are not affected in any other way.
</p>

<h2>Removing someone</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    Unpublishing or deleting an artist does <strong>not</strong> clear them out of anything
    else. Their credits, and any staff or board listing they appear in, keep pointing at a
    record that is no longer there — silently, with no warning on either screen.
  </p>
</div>

<p>
  So prefer editing over deleting. If someone genuinely must come off the site, remove them
  from the credits and listings first, and delete the record last.
</p>
