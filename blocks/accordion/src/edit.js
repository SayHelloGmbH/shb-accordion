/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

const TEMPLATE = [
	[
		"shb/accordion-title",
	],
	[
		"shb/accordion-content",
	],
];

export default function edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: TEMPLATE,
		templateLock: 'all',
	} );

	if ( !attributes.accordionID ) {
		setAttributes( { accordionID: blockProps[ 'data-block' ] } );
	}

	return (
		<>
			<div {...innerBlocksProps} /> <
		/>
	);
}