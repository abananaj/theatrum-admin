/**
 * Caption Copy-On-Click Block Editor Control — toggle lets visitors click a caption on the frontend to copy its text.
 */

import { createElement as el, Fragment } from "@wordpress/element"
import { addFilter } from "@wordpress/hooks"
// @ts-ignore
import { InspectorControls } from "@wordpress/block-editor"
import { PanelBody, ToggleControl } from "@wordpress/components"

const targetBlocks = ["core/image", "theatrum/meta-image", "theatrum/meta-gallery"]

addFilter("editor.BlockEdit", "chance/add-copy-caption-control", (BlockEdit: any) => {
	return (props: any) => {
		const { name, attributes, setAttributes } = props

		if (!targetBlocks.includes(name)) {
			return el(BlockEdit, props)
		}

		const { allowCaptionCopy = false } = attributes

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
						title: "Caption",
						initialOpen: false,
					},
					el(ToggleControl, {
						label: "Allow caption copy on click?",
						help: allowCaptionCopy
							? "Visitors can click the caption to copy its text."
							: "Caption text is not clickable.",
						checked: allowCaptionCopy,
						onChange: (value: boolean) => setAttributes({ allowCaptionCopy: value }),
					}),
				),
			),
		)
	}
})
