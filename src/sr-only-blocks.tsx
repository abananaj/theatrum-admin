/**
 * Screen Reader Only Block Editor Control — toggle on heading/paragraph blocks, with a visual indicator when SR-Only is enabled.
 */

// @ts-ignore
import "./scss/sr-only.scss"
import { createElement as el, Fragment } from "@wordpress/element"
import { addFilter } from "@wordpress/hooks"
// @ts-ignore
import { InspectorControls } from "@wordpress/block-editor"
import { PanelBody, ToggleControl, Notice } from "@wordpress/components"

/**
 * Add SR-Only toggle control to inspector panel
 */
addFilter("editor.BlockEdit", "chance/add-sr-only-control", (BlockEdit: any) => {
	return (props: any) => {
		const { name, attributes, setAttributes } = props
		const targetBlocks = ["core/heading", "core/paragraph"]

		// Only show for heading and paragraph blocks
		if (!targetBlocks.includes(name)) {
			return el(BlockEdit, props)
		}

		const { srOnly = false } = attributes

		return el(
			Fragment,
			null,
			el(BlockEdit, props),
			el(
				InspectorControls,
				null,
				el(
					PanelBody,
					{
						title: "Accessibility",
						initialOpen: false,
					},
					el(ToggleControl, {
						label: "Screen Reader Only",
						help: srOnly ? "This content is only visible to screen readers" : "Make this content visible only to screen readers",
						checked: srOnly,
						onChange: (value: boolean) => setAttributes({ srOnly: value }),
					}),
					srOnly
						? el(Notice, {
								status: "info",
								isDismissible: false,
								children: "The sr-only class will be applied to hide this content visually.",
							})
						: null,
				),
			),
		)
	}
})

/**
 * Add visual badge to block outlines when SR-Only is enabled
 */
addFilter("editor.BlockListBlock", "chance/add-sr-only-badge", (BlockListBlock: any) => {
	return (props: any) => {
		const { name, attributes } = props
		const targetBlocks = ["core/heading", "core/paragraph"]

		// Only add badge for heading and paragraph blocks
		if (!targetBlocks.includes(name)) {
			return el(BlockListBlock, props)
		}

		const { srOnly = false } = attributes

		if (!srOnly) {
			return el(BlockListBlock, props)
		}

		return el("div", { className: "wp-block-sr-only-wrapper" }, el(BlockListBlock, props), el("div", { className: "wp-block-sr-only-badge" }, "SR-ONLY"))
	}
})

