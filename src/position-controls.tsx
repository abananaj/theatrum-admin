/**
 * Custom Block Position Control — for any block declaring `supports.position.sticky`, replaces core's sticky-only Position panel (Sticky/Fixed + one Top offset) with Relative/Absolute/Fixed/Sticky plus independent Top/Right/Bottom/Left offsets.
 * Laid out in the same plus-shaped grid as core's BorderBoxControl, but built from plain UnitControl fields since BorderBoxControl expects {color,style,width} border values, not plain offset lengths.
 */
import { createElement as el, Fragment } from '@wordpress/element';
import { addFilter } from '@wordpress/hooks';
// @ts-ignore
import { InspectorControls } from '@wordpress/block-editor';
// @ts-ignore
import {
	PanelBody,
	SelectControl,
	__experimentalGrid as Grid,
	__experimentalUnitControl as UnitControl,
} from '@wordpress/components';
// @ts-ignore
import { getBlockType } from '@wordpress/blocks';

const POSITION_TYPE_OPTIONS = [
	{ label: 'Default (static)', value: 'static' },
	{ label: 'Relative', value: 'relative' },
	{ label: 'Absolute', value: 'absolute' },
	{ label: 'Fixed', value: 'fixed' },
	{ label: 'Sticky', value: 'sticky' },
];

/**
 * A block is eligible for our Position panel once it carries the `positionType` attribute, injected by an inline script on the 'wp-blocks' handle (see chance_inline_position_attribute_filter() in inc/position-controls.php) so it always runs before registerBlockType() — a normally enqueued script has no dependency edge forcing that order.
 * @param name
 */
function isPositionEligible(name: string): boolean {
	const blockType = getBlockType(name);
	return Boolean(blockType?.attributes?.positionType);
}

/**
 * Add Position controls to the inspector panel
 */
addFilter(
	'editor.BlockEdit',
	'chance/add-position-control',
	(BlockEdit: any) => {
		return (props: any) => {
			const { name, attributes, setAttributes } = props;

			if (!isPositionEligible(name)) {
				return el(BlockEdit, props);
			}

			const {
				positionType = 'static',
				positionTop = '',
				positionRight = '',
				positionBottom = '',
				positionLeft = '',
			} = attributes;

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
							title: 'Position',
							initialOpen: false,
						},
						el(SelectControl, {
							label: 'Position',
							value: positionType,
							options: POSITION_TYPE_OPTIONS,
							onChange: (value: string) =>
								setAttributes({ positionType: value }),
						}),
						positionType !== 'static'
							? el(Grid, {
									columns: 2,
									gap: 4,
									children: [
										el(UnitControl, {
											label: 'Top',
											value: positionTop,
											onChange: (next?: string) =>
												setAttributes({
													positionTop: next ?? '',
												}),
											style: {
												gridColumn: 'span 2',
												margin: '0 auto',
											},
										}),
										el(UnitControl, {
											label: 'Left',
											value: positionLeft,
											onChange: (next?: string) =>
												setAttributes({
													positionLeft: next ?? '',
												}),
										}),
										el(UnitControl, {
											label: 'Right',
											value: positionRight,
											onChange: (next?: string) =>
												setAttributes({
													positionRight: next ?? '',
												}),
										}),
										el(UnitControl, {
											label: 'Bottom',
											value: positionBottom,
											onChange: (next?: string) =>
												setAttributes({
													positionBottom: next ?? '',
												}),
											style: {
												gridColumn: 'span 2',
												margin: '0 auto',
											},
										}),
									],
								})
							: null
					)
				)
			);
		};
	}
);

/**
 * Reflect the chosen position styles on the block's outer wrapper in the editor canvas, so the live preview matches the frontend render.
 */
addFilter(
	'editor.BlockListBlock',
	'chance/add-position-preview',
	(BlockListBlock: any) => {
		return (props: any) => {
			const { name, attributes } = props;

			if (!isPositionEligible(name)) {
				return el(BlockListBlock, props);
			}

			const {
				positionType = 'static',
				positionTop = '',
				positionRight = '',
				positionBottom = '',
				positionLeft = '',
			} = attributes;

			if (positionType === 'static') {
				return el(BlockListBlock, props);
			}

			const wrapperProps = {
				...props.wrapperProps,
				style: {
					...(props.wrapperProps ? props.wrapperProps.style : null),
					position: positionType,
					...(positionTop ? { top: positionTop } : {}),
					...(positionRight ? { right: positionRight } : {}),
					...(positionBottom ? { bottom: positionBottom } : {}),
					...(positionLeft ? { left: positionLeft } : {}),
				},
			};

			return el(BlockListBlock, { ...props, wrapperProps });
		};
	}
);
