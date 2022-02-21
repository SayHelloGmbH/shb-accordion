import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import edit from "./edit";
import save from "./save";

registerBlockType("shb/accordion-content", {
	edit,
	save,
});