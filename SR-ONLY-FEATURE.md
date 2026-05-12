# Screen Reader Only Block Feature

## Overview
This feature adds a "Screen Reader Only" toggle to heading and paragraph blocks in the WordPress block editor. When enabled, the block will be hidden visually using the `sr-only` CSS class, making it visible only to screen readers and other assistive technologies.

## How to Use

### In the Block Editor:
1. Select a heading or paragraph block
2. Look for the "Accessibility" panel in the right sidebar (Inspector Controls)
3. Toggle the "Screen Reader Only" checkbox
4. When enabled, a blue "SR-ONLY" badge will appear in the top-right corner of the block outline

### Visual Indicators:
- **Blue SR-ONLY badge**: Appears on the block outline in the editor when the sr-only option is enabled
- **Information notice**: Shows in the Accessibility panel when SR-Only is active

### Frontend Display:
When the sr-only class is applied to the block, it will:
- Be hidden visually from sighted users
- Remain accessible to screen readers and assistive technologies
- Still be rendered in the HTML (not removed)

## Implementation Details

### Files Modified:
- `inc/sr-only-blocks.php` - Backend attribute registration and rendering logic
- `src/sr-only-blocks.ts` - Editor UI controls and visual indicators
- `src/sr-only.scss` - Styles for sr-only class and editor badge
- `theatrum-admin.php` - Plugin initialization and asset enqueueing
- `vite.config.js` - Build configuration
- `package.json` - Dependencies

### Supported Blocks:
- `core/heading` (all heading levels)
- `core/paragraph`

### CSS Classes:
- `.sr-only` - Applied to the block element to hide it visually
- `.wp-block-sr-only-wrapper` - Wrapper for the badge indicator
- `.wp-block-sr-only-badge` - Visual badge showing "SR-ONLY" status

## Technical Details

### PHP Backend:
- Registers `srOnly` boolean attribute on heading and paragraph blocks via `register_block_type_args` filter
- Uses `render_block` filter to add `sr-only` class to block HTML when `srOnly` attribute is true
- Properly handles existing class attributes and adds the sr-only class seamlessly

### JavaScript/TypeScript:
- Uses WordPress hooks to extend block editor functionality
- Implements two filters:
  1. `editor.BlockEdit` - Adds the toggle control to the inspector panel
  2. `editor.BlockListBlock` - Adds the visual badge to the block outline
- Uses `@wordpress/element` for element creation (no JSX required)

### Styling:
- SCSS is compiled to CSS during the Vite build process
- Styles are enqueued only in the block editor context via `enqueue_block_editor_assets`
- The sr-only styles are standard accessibility patterns used across the web

## Build Process:
```bash
cd wp-content/plugins/theatrum-admin
npm install  # Install dependencies
npm run build # Build the assets
```

This generates:
- `dist/sr-only-blocks.js` - Compiled editor controls
- `dist/sr-only-blocks.css` - Compiled styles

## Accessibility Notes:
The `sr-only` class uses a combination of CSS properties to hide content visually while maintaining it for screen readers:
- `clip: rect()` - Old clip property for older browsers
- `clip-path: inset(50%)` - Modern clipping approach
- `height: 1px; width: 1px;` - Minimal dimensions
- `position: absolute; margin: -1px;` - Positioning
- `overflow: hidden` - Hide any overflow

This ensures maximum compatibility with assistive technologies across different browsers and devices.
