<?php

/**
 * Plugin Name:       Block: Accordion
 * Description:       Provides a block which acts like an accordion.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Say Hello GmbH
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       shb-accordion
 *
 * @package shb
 */

$baseClass = 'shb-accordion';

/**
 * Renders the `shb/accordion` block on the server.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapper for the block.
 */
function render_block_shb_accordion($attributes, $content, $block)
{
	if (empty(trim($content))) {
		return '';
	}

	$blockWrapperAttributes = get_block_wrapper_attributes();
	$blockWrapperAttributes = shb_accordion_extend_wrapper_classes($blockWrapperAttributes);
	$accordionID = isset($block->attributes['accordionID']) ? $block->attributes['accordionID'] : '';


	return sprintf(
		'<div %1$s data-accordion>%2$s</div>',
		$blockWrapperAttributes,
		$content
	);
}

/**
 * Renders the `shb/accordion-title` block on the server.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapper for the block.
 */
function render_block_shb_accordion_title($attributes, $content, $block)
{
	if (empty(trim($content))) {
		return '';
	}

	global $baseClass;
	$blockWrapperAttributes = get_block_wrapper_attributes();
	$blockWrapperAttributes = shb_accordion_extend_wrapper_classes($blockWrapperAttributes, 'header');
	$accordionID = isset($block->context['accordionID']) ? $block->context['accordionID'] : '';

	$button = '<button data-accordion-toggler aria-expanded="false"';
	$button .= ' className="' . $baseClass . '__trigger' . '"';
	$button .= ' aria-controls="accordion-' . $accordionID . '"';
	$button .= '>';
	$button .= '<span className="screen-reader-text">' . _x('Diesen Bereich zu-/aufklappen', 'Accordion button text', 'shb-accordion') . '</span>';
	$button .= '<span className="' . $baseClass . '__triggericon' . '"></span>';
	$button .= '</button>';

	return sprintf(
		'<div %1$s data-accordion-title>%2$s%3$s</div>',
		$blockWrapperAttributes,
		'<div class="' . $baseClass . '__title' . '">' . $content . '</div>',
		$button
	);
}

/**
 * Renders the `shb/accordion-content` block on the server.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapper for the block.
 */
function render_block_shb_accordion_content($attributes, $content, $block)
{
	if (empty(trim($content))) {
		return '';
	}

	$blockWrapperAttributes = get_block_wrapper_attributes();
	$blockWrapperAttributes = shb_accordion_extend_wrapper_classes($blockWrapperAttributes, 'content');
	$accordionID = isset($block->context['accordionID']) ? $block->context['accordionID'] : '';

	return sprintf(
		'<div %1$s data-accordion-content id="accordion-' . $accordionID . '" aria-hidden="true">%2$s</div>',
		$blockWrapperAttributes,
		$content
	);
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_shb_accordion_blocks_init()
{
	register_block_type_from_metadata(
		__DIR__ . '/blocks/accordion-title/build',
		[
			'render_callback' => 'render_block_shb_accordion_title',
		]
	);
	register_block_type_from_metadata(
		__DIR__ . '/blocks/accordion-content/build',
		[
			'render_callback' => 'render_block_shb_accordion_content',
		]
	);
	register_block_type_from_metadata(
		__DIR__ . '/blocks/accordion/build',
		[
			'render_callback' => 'render_block_shb_accordion',
		]
	);
}
add_action('init', 'create_block_shb_accordion_blocks_init');

/**
 * Searches for class="" attribute in string. Extracts the value and extends the value with the appropriate element class.
 *
 * @param array  $string     The string from get_block_wrapper_attributes().
 * @param string $element    Specify accordion element.
 *
 * @return string Returns the string extended with element class.
 */
function shb_accordion_extend_wrapper_classes($string = '', $element = 'accordion')
{
	global $baseClass;

	// get value between class="" from input string
	preg_match_all('/class="(.*?)"/s', $string, $match);
	$classes = '';

	switch ($element) {
		case 'header':
		case 'content':
			if (!empty($match[0])) {
				// if class attribute exists and value found
				$classes = $match[1][0];
				$extendedString = str_replace($classes, $classes . ' ' . $baseClass . '__' . $element, $string);
			} else {
				// if class attribute does not exist
				$extendedString .= ' class="' . $baseClass . '__' . $element;
			}
			break;

		default:
			if (!empty($match[0])) {
				// if class attribute exists and value found
				$classes = $match[1][0];
				$extendedString = str_replace($classes, $classes . ' ' . $baseClass, $string);
			} else {
				// if class attribute does not exist
				$extendedString .= ' class="' . $baseClass . '"';
			}
			break;
	}

	if (empty($extendedString) || 'string' != gettype($extendedString)) {
		return $string;
	} else {
		return $extendedString;
	}
}
