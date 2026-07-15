/**
 * Custom Rich Text Formats
 *
 * Adds extra inline formatting options to the RichText "more" toolbar
 * dropdown (the chevron shown when editing text in the block editor).
 */
import { createElement as el } from "@wordpress/element"
// @ts-ignore
import { RichTextToolbarButton } from "@wordpress/block-editor"
// @ts-ignore
import { registerFormatType, toggleFormat } from "@wordpress/rich-text"
// @ts-ignore
import { quote, formatLowercase } from "@wordpress/icons"

interface FormatEditProps {
	isActive: boolean
	value: any
	onChange: (value: any) => void
}

/**
 * Inline Quote — wraps the selection in <q></q>
 */
registerFormatType("chance/inline-quote", {
	title: "Inline quote",
	tagName: "q",
	className: null,
	edit({ isActive, value, onChange }: FormatEditProps) {
		const onToggle = () =>
			onChange(
				toggleFormat(value, {
					type: "chance/inline-quote",
					title: "Inline quote",
				}),
			)

		return el(RichTextToolbarButton, {
			icon: quote,
			title: "Inline quote",
			onClick: onToggle,
			isActive,
			role: "menuitemcheckbox",
		})
	},
})

/**
 * Small Text — wraps the selection in <small></small>
 */
registerFormatType("chance/small-text", {
	title: "Small text",
	tagName: "small",
	className: null,
	edit({ isActive, value, onChange }: FormatEditProps) {
		const onToggle = () =>
			onChange(
				toggleFormat(value, {
					type: "chance/small-text",
					title: "Small text",
				}),
			)

		return el(RichTextToolbarButton, {
			icon: formatLowercase,
			title: "Small text",
			onClick: onToggle,
			isActive,
			role: "menuitemcheckbox",
		})
	},
})
