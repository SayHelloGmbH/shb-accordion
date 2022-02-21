import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import edit from "./edit";
import save from "./save";

/**
 * Styles
 */
import './style.scss';

registerBlockType("shb/accordion", {
	edit,
	save,
});