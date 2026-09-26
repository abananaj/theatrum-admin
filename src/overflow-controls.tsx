/**
 * Group Block Overflow Clip — a toggle in the Advanced panel that sets `overflow: clip`, revealing a unit field for `overflow-clip-margin` (empty = 0) while on.
 * Attributes are declared by an inline script on 'wp-blocks' and rendered by a render_block filter — see inc/overflow-controls.php.
 */
import { createElement as el, Fragment } from '@wordpress/element';
import { addFilter } from '@wordpress/hooks';
// @ts-ignore
import { InspectorControls } from '@wordpress/block-editor';
// @ts-ignore
import {
	ToggleControl,
	__experimentalUnitControl as UnitControl,
} from '@wordpress/components';

const OVERFLOW_CLIP_BLOCKS = ['core/group'];

// overflow-clip-margin accepts lengths only — no percentages.
const CLIP_MARGIN_UNITS = [
	{ value: 'px', label: 'px', default: 0 },
	{ value: 'rem', label: 'rem', default: 0 },
	{ value: 'em', label: 'em', default: 0 },
];

addFilter(
	'editor.BlockEdit',
	'chance/add-overflow-clip-toggle',
	(BlockEdit: any) => {
		return (props: any) => {
			const { name, attributes, setAttributes } = props;

			if (!OVERFLOW_CLIP_BLOCKS.includes(name)) {
				return el(BlockEdit, props);
			}

			const { overflowClip = false, overflowClipMargin = '' } =
				attributes;

			return el(
				Fragment,
				null,
				el(BlockEdit, props),
				el(
					InspectorControls,
					{ group: 'advanced' },
					el(ToggleControl, {
						label: 'Clip overflow',
						checked: overflowClip,
						onChange: (value: boolean) =>
							setAttributes({ overflowClip: value }),
						help: 'Adds overflow: clip — clips content like overflow: hidden, but without breaking sticky-positioned blocks inside.',
					}),
					overflowClip
						? el(UnitControl, {
								label: 'Overflow clip margin',
								value: overflowClipMargin || '0px',
								units: CLIP_MARGIN_UNITS,
								min: 0,
								onChange: (next?: string) =>
									setAttributes({
										overflowClipMargin: next ?? '',
									}),
								help: 'How far content may paint past the edge before clipping (e.g. to keep focus rings or shadows visible).',
								__next40pxDefaultSize: true,
							})
						: null
				)
			);
		};
	}
);

/**
 * Reflect the overflow styles on the block's wrapper in the editor canvas so the preview matches the frontend render.
 */
addFilter(
	'editor.BlockListBlock',
	'chance/add-overflow-clip-preview',
	(BlockListBlock: any) => {
		return (props: any) => {
			const { name, attributes } = props;

			if (
				!OVERFLOW_CLIP_BLOCKS.includes(name) ||
				!attributes.overflowClip
			) {
				return el(BlockListBlock, props);
			}

			const wrapperProps = {
				...props.wrapperProps,
				style: {
					...(props.wrapperProps ? props.wrapperProps.style : null),
					overflow: 'clip',
					...(attributes.overflowClipMargin
						? { overflowClipMargin: attributes.overflowClipMargin }
						: {}),
				},
			};

			return el(BlockListBlock, { ...props, wrapperProps });
		};
	}
);
