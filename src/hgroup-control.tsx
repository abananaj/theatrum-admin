/**
 * <hgroup> Toggle for the Group Block — core hardcodes the "HTML element" dropdown options with no filter to extend it, so this adds a parallel toggle in the same Advanced panel that writes straight to `tagName`, disabling the native select while active so the two controls can't fight over the value.
 */
import {
	createElement as el,
	Fragment,
	useEffect,
	useRef,
} from '@wordpress/element';
import { addFilter } from '@wordpress/hooks';
// @ts-ignore
import { InspectorControls } from '@wordpress/block-editor';
// @ts-ignore
import { ToggleControl } from '@wordpress/components';

const HGROUP_TARGET_BLOCKS = ['core/group'];
const NATIVE_SELECT_SELECTOR =
	'.block-editor-block-inspector__advanced select.components-select-control__input';
const DEFAULT_TAG_NAME = 'div';

addFilter('editor.BlockEdit', 'chance/add-hgroup-toggle', (BlockEdit: any) => {
	return (props: any) => {
		const { name, attributes, setAttributes, isSelected } = props;

		if (!HGROUP_TARGET_BLOCKS.includes(name)) {
			return el(BlockEdit, props);
		}

		const { tagName = DEFAULT_TAG_NAME } = attributes;
		const isHgroup = tagName === 'hgroup';

		// Remember the last non-hgroup tag so unchecking restores it instead of always falling back to <div>.
		const previousTagName = useRef(isHgroup ? DEFAULT_TAG_NAME : tagName);
		useEffect(() => {
			if (tagName !== 'hgroup') {
				previousTagName.current = tagName;
			}
		}, [tagName]);

		// The native "HTML element" select has no prop to disable it from here, so reach into the DOM once it's mounted.
		useEffect(() => {
			if (!isSelected) {
				return;
			}

			const nativeSelect = document.querySelector<HTMLSelectElement>(
				NATIVE_SELECT_SELECTOR
			);
			if (!nativeSelect) {
				return;
			}

			const looksLikeHtmlElementSelect = Array.from(
				nativeSelect.options
			).some((option) => option.value === 'header');
			if (!looksLikeHtmlElementSelect) {
				return;
			}

			nativeSelect.disabled = isHgroup;
			nativeSelect.setAttribute('aria-disabled', String(isHgroup));
		}, [isSelected, isHgroup]);

		const onToggle = (value: boolean) => {
			setAttributes({
				tagName: value
					? 'hgroup'
					: previousTagName.current || DEFAULT_TAG_NAME,
			});
		};

		return el(
			Fragment,
			null,
			el(BlockEdit, props),
			el(
				InspectorControls,
				{ group: 'advanced' },
				el(ToggleControl, {
					label: 'Mark as <hgroup>',
					checked: isHgroup,
					onChange: onToggle,
					help: isHgroup
						? 'This Group renders as <hgroup>. Turn off to pick a different HTML element above.'
						: 'Wraps this Group in <hgroup> — intended for a heading followed by an optional subheading.',
				})
			)
		);
	};
});
