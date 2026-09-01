<?php

/**
 * Site Manual — topic registry.
 *
 * Order here is reading order. Each topic may declare:
 *
 *   title    (required) Nav label and page heading.
 *   summary  One line, shown on the index and in the stub notice.
 *   key      true to badge it "start here" on the index.
 *   status   'stub' to force the placeholder even if a partial exists.
 *   screens  Reserved. Phase 2 will use these screen IDs to attach native
 *            help tabs on the screens a topic describes.
 *
 * Adding a topic: one entry here, one file at docs/topics/<slug>.php.
 * A declared topic with no file renders the "not written yet" notice, which
 * is how the full outline stays browsable while it is being filled in.
 */

if (! defined('ABSPATH')) {
  exit;
}

return [

  'start-here' => [
    'label'  => __('Start here', 'theatrum-admin'),
    'topics' => [
      'how-to-use' => [
        'title'   => __('How to use this manual', 'theatrum-admin'),
        'summary' => __('What is in here, the five rules that matter most, and who to ask when you are stuck.', 'theatrum-admin'),
        'key'     => true,
      ],
      'your-account' => [
        'title'   => __('Your account and what you can do', 'theatrum-admin'),
        'summary' => __('Administrators and Editors, what each can see, and keeping your login safe.', 'theatrum-admin'),
        'status'  => 'stub',
      ],
      'admin-menu-tour' => [
        'title'   => __('A tour of the admin menu', 'theatrum-admin'),
        'summary' => __('The sidebar is customised for this site — what each item is and where the surprises are.', 'theatrum-admin'),
      ],
    ],
  ],

  'content' => [
    'label'  => __('Putting content on the site', 'theatrum-admin'),
    'topics' => [
      'adding-a-production' => [
        'title'   => __('Adding a production', 'theatrum-admin'),
        'summary' => __('The full walkthrough for putting a show on the site, start to finish.', 'theatrum-admin'),
        'key'     => true,
        'screens' => ['production'],
      ],
      'production-credits' => [
        'title'   => __('Cast and creative credits', 'theatrum-admin'),
        'summary' => __('Using the Credits Manager on a production: Cast, Creative Team and Producers.', 'theatrum-admin'),
        'key'     => true,
        'screens' => ['production'],
      ],
      'adding-events' => [
        'title'   => __('Events and performance dates', 'theatrum-admin'),
        'summary' => __('Creating events, linking them to a production, and handling two-date events.', 'theatrum-admin'),
      ],
      'adding-an-artist' => [
        'title'   => __('Adding an artist', 'theatrum-admin'),
        'summary' => __('Headshots, bios, the links list, and how artist tags work.', 'theatrum-admin'),
      ],
      'classes-venues-supporters' => [
        'title'   => __('Classes, venues and supporters', 'theatrum-admin'),
        'summary' => __('The three smaller content types and the fields each one needs.', 'theatrum-admin'),
        'status'  => 'stub',
      ],
      'blog-posts' => [
        'title'   => __('Blog posts and news', 'theatrum-admin'),
        'summary' => __('Writing a post, and linking it to a production or event.', 'theatrum-admin'),
      ],
    ],
  ],

  'pages' => [
    'label'  => __('Pages and layout', 'theatrum-admin'),
    'topics' => [
      'editing-a-page' => [
        'title'   => __('Editing a page', 'theatrum-admin'),
        'summary' => __('Working with blocks, and the blocks that were built specifically for this site.', 'theatrum-admin'),
      ],
      'patterns' => [
        'title'   => __('Patterns — read this before you edit one', 'theatrum-admin'),
        'summary' => __('Most patterns on this site are shared. Editing one changes every page that uses it.', 'theatrum-admin'),
        'key'     => true,
        'screens' => ['edit-wp_block'],
      ],
      'seasons-and-series' => [
        'title'   => __('Seasons and series', 'theatrum-admin'),
        'summary' => __('How a season page is assembled and how to move the site on to a new season.', 'theatrum-admin'),
        'status'  => 'stub',
      ],
    ],
  ],

  'media' => [
    'label'  => __('Images and media', 'theatrum-admin'),
    'topics' => [
      'images-and-media' => [
        'title'   => __('Images and the media library', 'theatrum-admin'),
        'summary' => __('Uploading, alt text, choosing the right size, and finding an image again later.', 'theatrum-admin'),
      ],
    ],
  ],

  'settings' => [
    'label'  => __('Sitewide settings', 'theatrum-admin'),
    'topics' => [
      'site-options' => [
        'title'   => __('Site Options', 'theatrum-admin'),
        'summary' => __('Current and next season, the staff and board listings, and fallback images.', 'theatrum-admin'),
        'screens' => ['toplevel_page_site-options'],
      ],
      'forms' => [
        'title'   => __('Forms and form entries', 'theatrum-admin'),
        'summary' => __('Finding submissions, and making small changes to an existing form.', 'theatrum-admin'),
      ],
    ],
  ],

  'trouble' => [
    'label'  => __('When something looks wrong', 'theatrum-admin'),
    'topics' => [
      'why-isnt-my-change-showing' => [
        'title'   => __('Why isn\'t my change showing?', 'theatrum-admin'),
        'summary' => __('The four things that cause this, in the order they are worth checking.', 'theatrum-admin'),
        'key'     => true,
      ],
      'things-not-to-touch' => [
        'title'   => __('Things not to touch', 'theatrum-admin'),
        'summary' => __('A short list of buttons that cause damage which is slow to undo.', 'theatrum-admin'),
        'key'     => true,
      ],
      'accessibility' => [
        'title'   => __('Accessibility', 'theatrum-admin'),
        'summary' => __('Alt text, heading order, link text, and two checks you can run yourself.', 'theatrum-admin'),
      ],
    ],
  ],

];
