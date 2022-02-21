/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

const TEMPLATE = [
	[
		"core/paragraph",
		{
			placeholder: "Add blocks here, which will be displayed as the accordion title.",
		},
	],
];

export default function edit( props, { attributes } ) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: TEMPLATE,
	} );

	// console.log( 'title', props, innerBlocksProps, blockProps );

	return (
		<>
			<div {...innerBlocksProps} /> < />
	);
}