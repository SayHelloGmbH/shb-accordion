<?php

/**
 * Plugin Name:       Block: Accordion
 * Description:       Provides a block which acts like an accordion.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.2
 * Author:            Say Hello GmbH
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       shb-accordion
 *
 * @package shb
 */

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

	$accordionID = isset($block->attributes['accordionID']) ? $block->attributes['accordionID'] : '';

	return sprintf(
		'<div %1$s data-shb-accordion>%2$s</div>',
		$blockWrapperAttributes,
		$content
	);
}

/**
 * Renders the `shb/accordion-header` block on the server.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapper for the block.
 */
function render_block_shb_accordion_header($attributes, $content, $block)
{
	if (empty(trim($content))) {
		return '';
	}

	$blockWrapperAttributes = get_block_wrapper_attributes();
	preg_match_all('/class="(.*?)"/s', $blockWrapperAttributes, $match);
	$classNameBase = $match[1][0] ?? 'UNDEFINED_CLASS_NAME_BASE';

	$accordionID = isset($block->context['accordionID']) ? $block->context['accordionID'] : '';

	$button = '<button data-shb-accordion-toggler aria-expanded="false"';
	$button .= ' class="' . $classNameBase . '__trigger' . '"';
	$button .= ' aria-controls="shb-accordion-' . $accordionID . '"';
	$button .= '>';
	$button .= '<span class="screen-reader-text">' . _x('Diesen Bereich zu-/aufklappen', 'Accordion button text', 'shb-accordion') . '</span>';
	$button .= '<span class="' . $classNameBase . '__triggericon' . '"></span>';
	$button .= '</button>';

	return sprintf(
		'<div %1$s data-shb-accordion-header>%2$s%3$s</div>',
		$blockWrapperAttributes,
		'<div class="' . $classNameBase . '__title' . '">' . $content . '</div>',
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

	$accordionID = isset($block->context['accordionID']) ? $block->context['accordionID'] : '';

	return sprintf(
		'<div %1$s data-shb-accordion-content id="shb-accordion-' . $accordionID . '" aria-hidden="true">%2$s</div>',
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
		__DIR__ . '/blocks/accordion-header/build',
		[
			'render_callback' => 'render_block_shb_accordion_header',
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
