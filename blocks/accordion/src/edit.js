/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

/**
 * Styles
 */
import "./editor.scss";

const TEMPLATE = [["shb/accordion-header"], ["shb/accordion-content"]];

export default function edit({ setAttributes }) {
    const blockProps = useBlockProps();

    const innerBlocksProps = useInnerBlocksProps(blockProps, {
        template: TEMPLATE,
        templateLock: "all",
    });

    setAttributes({ accordionID: blockProps.id });

    return <div {...innerBlocksProps} />;
}
