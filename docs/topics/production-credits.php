<?php if ( ! defined('ABSPATH')) { exit; } ?>

<p class="ct-manual__intro">
  Credits are managed in the <strong>Production Credits</strong> panel on a production's edit
  screen. It is the one part of the editor that does not behave like the rest of the page, so
  it is worth five minutes of reading before your first show.
</p>

<h2>Three things to know first</h2>

<ol class="ct-manual__rules">
  <li>
    <strong>Save the production before adding credits.</strong> On a brand new show the panel
    says “Save the post first to manage credits.” and will not let you add anyone. Save a draft, then continue.
  </li>
  <li>
    <strong>Credits save separately from the page.</strong> The panel has its own
    <strong>Save Credits</strong> button. Clicking <em>Update</em> on the production does
    <em>not</em> save credit changes, and saving credits does not save the rest of your edits.
    Use both.
  </li>
  <li>
    <strong>Credits only live in this panel.</strong> The previous version of the site had a
    separate Credits area; it is now hidden from the menu, and nothing needs to be added there.
    Everything goes through this panel.
  </li>
</ol>

<h2>The three tabs</h2>

<p>
  Which tab you add someone to is what files them correctly — there is no separate “role type”
  setting to choose.
</p>

<ul>
  <li><strong>Cast</strong> — performers. Search for the artist, then type their character in the Role box.</li>
  <li><strong>Creative Team</strong> — director, designers, choreographer, playwright, stage management and so on. Same two fields; the specific job is simply typed into Role.</li>
  <li><strong>Producers</strong> — this one searches <strong>Supporters</strong>, not Artists. If you cannot find a person here, they most likely exist as an artist but not as a supporter.</li>
</ul>

<h2>Adding and arranging</h2>

<ol>
  <li>Pick the tab.</li>
  <li>Click <strong>Add Credit</strong>.</li>
  <li>Start typing a name and choose from the results. Only existing artists and supporters appear — if someone is missing, create their profile first, then come back.</li>
  <li>Type the role exactly as it should appear on the page. It is printed as written, so mind the capitalisation.</li>
  <li>Drag the handle on a row to reorder. The order here is the order visitors see.</li>
  <li>Click <strong>Save Credits</strong>.</li>
</ol>

<p>
  Roles are free text, so spelling matters. “Stage Manager” and “stage manager” will both
  appear, exactly as typed. Copy the wording from a recent show to stay consistent.
</p>

<h2>Removing someone</h2>

<p>
  Use the <strong>Remove credit</strong> button on the row, then <strong>Save Credits</strong>. This removes the credit
  from the production; it does not delete the artist's profile, which is what you want.
</p>

<h2>Checking your work</h2>

<p>
  There is a read-only list of every credit on the site, which is useful for spotting a
  misspelt role or a duplicate entry. It is no longer in the Productions menu; use the link below.
  It is a browsing tool only — click a production name to open it and make the edit there.
</p>

<?php chance_manual_go('edit.php?post_type=production&page=theatrum-credits-list', 'Browse all credits'); ?>

<h2>Season producers are set somewhere else</h2>

<p>
  Season-level roles — resident playwright, season producers, associate producers, season
  sponsors — belong to the <em>season</em>, not to any single show. They are set on the season
  itself: <strong>Seasons → All Seasons</strong>, then edit the season to find
  <strong>Resident Playwright</strong>, <strong>Season Producers</strong>,
  <strong>Associate Season Producers</strong> and <strong>OTR Sponsors</strong>. Do not add them here; they will attach to one production instead
  of the whole season.
</p>

<h2>If an artist disappears from a page</h2>

<p>
  Credits point at artist and supporter profiles. If a profile is unpublished or deleted, the
  credit stays behind pointing at nothing, and it fails quietly. When you retire a profile,
  search for the productions that referenced it and tidy those up in the same sitting.
</p>
