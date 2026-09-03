<?php

/**
 * Site Manual topic: forms and form entries.
 */

if ( ! defined('ABSPATH')) {
  exit;
}

?>

<p class="ct-manual__intro">
  Every form on the site — contact, rentals, group sales, auditions, job applications, the
  Speak Up forms — is built in <strong>WPForms</strong>, which has its own menu. There are
  several dozen live forms and a much longer list of retired ones sitting in the trash.
</p>

<?php chance_manual_go('admin.php?page=wpforms-overview', 'Open All Forms'); ?>

<h2>Finding what someone submitted</h2>

<p>
  <strong>WPForms → Entries</strong> lists every form, with a count. Click a form to see its
  submissions, and click a submission to read it in full. Entries can be exported from there
  if someone needs a spreadsheet.
</p>

<p>
  Submissions are also emailed out when they arrive, but email is the part most likely to go
  wrong — filters, full mailboxes, a changed address. <strong>Entries is the record that
  matters.</strong> If someone says they submitted a form and nobody received it, check Entries
  before assuming it failed.
</p>

<h2>Editing an existing form</h2>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>A form is one thing used in many places.</strong> Editing it changes it on every
    page it appears on, immediately. Check where it is used before changing anything more than
    a wording tweak.
  </p>
</div>

<p>
  Open a form and you get three tabs across the top:
</p>

<ul>
  <li><strong>Fields</strong> — the questions. Drag to reorder, click a field to change its label or options.</li>
  <li>
    <strong>Settings</strong> — the form's name, the button text, the
    <strong>Notifications</strong> (who gets emailed when someone submits) and the
    <strong>Confirmation</strong> (what the visitor sees afterwards).
  </li>
  <li><strong>Marketing</strong> and <strong>Payments</strong> — connections to other services. Leave these alone.</li>
</ul>

<p>
  Safe to change: field labels, help text, the order of fields, the confirmation message, the
  notification recipients.
</p>

<div class="notice notice-warning inline ct-manual__warning">
  <p>
    <strong>Deleting a field deletes it from the entries too.</strong> Old submissions lose that
    answer, and it does not come back. If a question is no longer needed, it is safer to make a
    new form than to strip fields out of one with a submission history.
  </p>
</div>

<h2>Putting a form on a page</h2>

<p>
  Edit the page, add a <strong>WPForms</strong> block, and pick the form from its dropdown. That
  is the whole job — the form's styling comes with it.
</p>

<p>
  A few forms sit inside shared patterns rather than directly on a page. If the form you are
  looking at is inside a purple-outlined block, you are editing a pattern and the rules in
  <?php chance_manual_see('patterns'); ?> apply.
</p>

<h2>Making a new form</h2>

<p>
  <strong>Duplicate an existing form rather than starting from blank.</strong> The existing ones
  already have the right notification settings and confirmation wording; a blank form emails
  its results to the site's default address, which is probably not who wants them.
</p>

<p>
  Duplicate from the All Forms list, rename it, then change what needs changing — and check the
  Notifications tab before you use it anywhere.
</p>

<h2>Things forms cannot currently do</h2>

<p>
  WPForms has optional add-ons for taking payments, collecting signatures, syncing to
  spreadsheets and registering users. They are installed but <strong>switched off</strong> on
  this site. If a new form needs to take money or do anything beyond collecting answers, that is
  a conversation before it is a form.
</p>

<h2>Do not delete old forms</h2>

<p>
  A deleted form takes its entries with it, and any page still embedding it simply shows
  nothing — no error, no gap you would notice. The trash is already full of retired forms and
  they cost nothing sitting there. Leave them.
</p>
