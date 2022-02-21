/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

const TEMPLATE = [
	[
		"core/paragraph",
		{
			placeholder: "Add blocks here, which will be displayed as the accordion content.",
		},
	],
];

export default function edit() {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: TEMPLATE,
	} );
	return (
		<>
			<div {...innerBlocksProps} /> < />
	);
}