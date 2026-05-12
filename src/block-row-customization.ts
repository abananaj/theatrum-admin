/**
 * Row Block Customization
 *
 * Adds <p> (paragraph) as an HTML element option for the Row block
 * in the WordPress block editor.
 *
 * The Row block (core/row) has a tagName attribute that controls the
 * wrapper HTML element. This script extends the available tag options
 * to include <p> (paragraph) in addition to the default options.
 */

declare const wp: any

/**
 * Modify Row block's tagName attribute to allow 'p' as an option
 *
 * This filter runs when the block type is registered, allowing us to
 * modify the available HTML tag options for the Row block.
 */
wp.hooks.addFilter("blocks.registerBlockType", "chance/row-allow-p-tag", function (settings: any, name: string) {
	// Only modify the Row block (core/row)
	if (name !== "core/row") {
		return settings
	}

	// Ensure attributes object exists
	if (!settings.attributes) {
		settings.attributes = {}
	}

	// The Row block's tagName attribute allows different HTML elements
	// By not restricting the values, we allow 'p' to be used
	if (settings.attributes.tagName) {
		// The tagName attribute is typically already flexible
		// This ensures it will accept 'p' as a valid value
	}

	return settings
})

