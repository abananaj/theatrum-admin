/**
 * Custom Rich Text Formats — adds Inline Quote to the RichText "more" toolbar dropdown. The <small> format lives in theatrum-blocks (src/rich-text-formats/small.js); a second registration on the same tag was rejected by core with a console error on every editor load.
 */
import { createElement as el } from '@wordpress/element';
// @ts-ignore
import { RichTextToolbarButton } from '@wordpress/block-editor';
// @ts-ignore
import { registerFormatType, toggleFormat } from '@wordpress/rich-text';
// @ts-ignore
import { quote } from '@wordpress/icons';

interface FormatEditProps {
	isActive: boolean;
	value: any;
	onChange: (value: any) => void;
}

/**
 * Inline Quote — wraps the selection in <q></q>
 */
registerFormatType('chance/inline-quote', {
	title: 'Inline quote',
	tagName: 'q',
	className: null,
	edit({ isActive, value, onChange }: FormatEditProps) {
		const onToggle = () =>
			onChange(
				toggleFormat(value, {
					type: 'chance/inline-quote',
					title: 'Inline quote',
				})
			);

		return el(RichTextToolbarButton, {
			icon: quote,
			title: 'Inline quote',
			onClick: onToggle,
			isActive,
			role: 'menuitemcheckbox',
		});
	},
});
