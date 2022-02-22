/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

const TEMPLATE = [
	[
		"core/paragraph",
		{
			placeholder: "Add blocks here, which will be displayed as the accordion header.",
		},
	],
];

export default function edit( props, { attributes } ) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: TEMPLATE,
		templateLock: false,
		allowedBlocks: [
			'core/heading',
			'core/paragraph',
			'core/button',
			'core/post-title',
			'core/post-excerpt',
			'core/post-author',
			'core/post-date',
			'core/post-categories',
			'core/post-tag'
		]
	} );

	return (
		<>
			<div {...innerBlocksProps} /> < />
	);
}