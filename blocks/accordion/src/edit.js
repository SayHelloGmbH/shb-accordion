/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

/**
 * Styles
 */
import './editor.scss';

const TEMPLATE = [
	[
		"shb/accordion-header",
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

	console.log( blockProps );

	if ( !attributes.accordionID ) {
		setAttributes( { accordionID: blockProps[ 'data-block' ] } );
	}

	return (
		<>
			<div {...innerBlocksProps} /> <
		/>
	);
}