/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";
import { Fragment } from "@wordpress/element";
import { _x } from "@wordpress/i18n";

const TEMPLATE = [
    [
        "core/paragraph",
        {
            placeholder: _x(
                "Add blocks here, which will be displayed as the accordion header.",
                "Placeholder",
                "sb-accordion"
            ),
        },
    ],
];

export default function edit() {
    const blockProps = useBlockProps();
    const innerBlocksProps = useInnerBlocksProps(blockProps, {
        template: TEMPLATE,
        templateLock: false,
    });

    return (
        <Fragment>
            <div {...innerBlocksProps} />
        </Fragment>
    );
}
