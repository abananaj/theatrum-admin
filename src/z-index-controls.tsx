/**
 * Group/Columns Block Z-Index — an integer field in the Advanced panel that sets `z-index` on the wrapper (empty = unset).
 * Attributes are declared by an inline script on 'wp-blocks' and rendered by a render_block filter — see inc/z-index-controls.php.
 */
import { createElement as el, Fragment } from '@wordpress/element';
import { addFilter } from '@wordpress/hooks';
// @ts-ignore
import { InspectorControls } from '@wordpress/block-editor';
// @ts-ignore
import { __experimentalNumberControl as NumberControl } from '@wordpress/components';

const Z_INDEX_BLOCKS = ['core/group', 'core/columns'];

const isValidZIndex = (value: string) => /^-?\d+$/.test(value);

addFilter(
	'editor.BlockEdit',
	'chance/add-z-index-control',
	(BlockEdit: any) => {
		return (props: any) => {
			const { name, attributes, setAttributes } = props;

			if (!Z_INDEX_BLOCKS.includes(name)) {
				return el(BlockEdit, props);
			}

			const { zIndex = '' } = attributes;

			return el(
				Fragment,
				null,
				el(BlockEdit, props),
				el(
					InspectorControls,
					{ group: 'advanced' },
					el(NumberControl, {
						label: 'Z-index',
						value: zIndex,
						step: 1,
						isDragEnabled: false,
						onChange: (next?: string) => {
							const value = (next ?? '').trim();
							if (value === '' || isValidZIndex(value)) {
								setAttributes({ zIndex: value });
							}
						},
						help: 'Stacking order relative to sibling blocks. Leave empty for auto. Also adds position: relative unless the block is sticky/fixed.',
						__next40pxDefaultSize: true,
					})
				)
			);
		};
	}
);

/**
 * Reflect z-index on the block's wrapper in the editor canvas so the preview matches the frontend render.
 */
addFilter(
	'editor.BlockListBlock',
	'chance/add-z-index-preview',
	(BlockListBlock: any) => {
		return (props: any) => {
			const { name, attributes } = props;

			if (
				!Z_INDEX_BLOCKS.includes(name) ||
				!attributes.zIndex ||
				!isValidZIndex(attributes.zIndex)
			) {
				return el(BlockListBlock, props);
			}

			const wrapperProps = {
				...props.wrapperProps,
				style: {
					...(props.wrapperProps ? props.wrapperProps.style : null),
					...(attributes.style?.position?.type
						? {}
						: { position: 'relative' }),
					zIndex: Number(attributes.zIndex),
				},
			};

			return el(BlockListBlock, { ...props, wrapperProps });
		};
	}
);
