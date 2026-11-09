<?php
/**
 * Block style variations — register_block_style library (ported from
 * arneiron-base Lane C as part of P0b, issue ArneIron-net/hub#1230).
 *
 * Each variation is class-driven: register_block_style( $block, 'name' => 'x' )
 * exposes an inserter style whose markup class is `is-style-x`, matched by rules
 * in assets/css/blocks.css. Token-only; previews in the inserter; works in both
 * the editor and the front (blocks.css is loaded in both via add_editor_style).
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_register_block_styles' ) ) {
	/**
	 * Register the theme's block style variations.
	 *
	 * @return void
	 */
	function arneiron_register_block_styles() {
		$styles = array(
			// --- ArneIron block consolidation (hub#3614 items 2b + 2c) ---------
			// Two ArneIron blocks were absorbed into their singular/legacy
			// counterparts rather than deleted outright, so nothing they could
			// do is lost:
			//
			//   arneiron/testimonials     (3-column grid)  -> arneiron/testimonial
			//   arneiron/pricing-packages (token cards)    -> arneiron/price-table
			//
			// Each survivor gained the retired block's LOOK as a style variation
			// and its ATTRIBUTES in block.json, and each render.php branches on
			// the `is-style-*` class below to emit the retired block's markup
			// verbatim. CSS is in assets/css/blocks.css. A testimonial carousel
			// is now composed from Carousel + Testimonial, which is what made
			// the fixed 3-column block redundant.
			// (Quote Card / Token Packages for arneiron/testimonial and
			// arneiron/price-table are registered by ArneIron Blocks 1.2.0+,
			// which owns those blocks.)

			// --- ArneIron block retirement (hub#3614 item 3) -------------------
			// arneiron/title, arneiron/button and arneiron/section duplicated
			// core Heading, Buttons and Row/Group. Everything those blocks
			// offered that CORE ALREADY HAS is left to core — alignment, font
			// size, colour, spacing, layout width, background, border radius.
			// Only the settings core has no equivalent for become styles here,
			// so authors keep the capability after the blocks are deleted.
			array( 'core/heading', 'arneiron-title', __( 'ArneIron Title', 'arneiron-lite' ) ),
			array( 'core/heading', 'arneiron-title-decor', __( 'ArneIron Title + Decor', 'arneiron-lite' ) ),
			array( 'core/heading', 'arneiron-nowrap', __( 'ArneIron No Wrap', 'arneiron-lite' ) ),
			array( 'core/button', 'arneiron-shadow', __( 'ArneIron Shadow', 'arneiron-lite' ) ),
			array( 'core/button', 'arneiron-shadow-lift', __( 'ArneIron Shadow Lift', 'arneiron-lite' ) ),

			// Buttons (core "fill" stays the default).
			array( 'core/button', 'outline', __( 'Outline', 'arneiron-lite' ) ),
			array( 'core/button', 'ghost', __( 'Ghost', 'arneiron-lite' ) ),
			array( 'core/button', 'link', __( 'Link', 'arneiron-lite' ) ),
			array( 'core/button', 'pill', __( 'Pill', 'arneiron-lite' ) ),
			array( 'core/button', 'block', __( 'Full width', 'arneiron-lite' ) ),
			array( 'core/button', 'icon', __( 'Icon', 'arneiron-lite' ) ),

			// Group surfaces.
			array( 'core/group', 'card', __( 'Card', 'arneiron-lite' ) ),
			array( 'core/group', 'panel', __( 'Panel', 'arneiron-lite' ) ),
			array( 'core/group', 'bordered', __( 'Bordered', 'arneiron-lite' ) ),
			array( 'core/group', 'well', __( 'Well', 'arneiron-lite' ) ),
			array( 'core/group', 'plain', __( 'Plain', 'arneiron-lite' ) ),

			// Group notice / callout variations (achromatic tonal grays).
			array( 'core/group', 'notice-info', __( 'Notice: Info', 'arneiron-lite' ) ),
			array( 'core/group', 'notice-note', __( 'Notice: Note', 'arneiron-lite' ) ),
			array( 'core/group', 'notice-warning', __( 'Notice: Warning', 'arneiron-lite' ) ),
			array( 'core/group', 'notice-tip', __( 'Notice: Tip', 'arneiron-lite' ) ),

			// Columns.
			array( 'core/columns', 'cards', __( 'Cards', 'arneiron-lite' ) ),
			array( 'core/columns', 'divided', __( 'Divided', 'arneiron-lite' ) ),

			// --- hub#5409: news-digest item, images beside the text ----------
			// The owner's reference is the Kant "L2" layer on vania-novikau.me,
			// whose image track is `.d-lg-none` and is therefore HIDDEN above
			// 1000px — desktop L2 shows no images at all. So this variation is
			// new work, not a repositioning: it puts each digest item's own
			// images in a side column above 1000px and keeps the existing
			// stacked behaviour below. Breakpoint is 1000px, taken from L2
			// rather than from this theme's 781/599px column breakpoints,
			// because matching the owner's reference is the point. Do not
			// "tidy" it to the theme default.
			array( 'core/columns', 'news-item', __( 'News item (images aside)', 'arneiron-lite' ) ),
			array( 'core/gallery', 'news-item-media', __( 'News item media column', 'arneiron-lite' ) ),

			// Image.
			array( 'core/image', 'frame', __( 'Frame', 'arneiron-lite' ) ),
			array( 'core/image', 'rounded', __( 'Rounded', 'arneiron-lite' ) ),
			array( 'core/image', 'circle', __( 'Circle', 'arneiron-lite' ) ),
			array( 'core/image', 'polaroid', __( 'Polaroid', 'arneiron-lite' ) ),
			array( 'core/image', 'duotone-gray', __( 'Duotone Gray', 'arneiron-lite' ) ),

			// Quote.
			array( 'core/quote', 'plain', __( 'Plain', 'arneiron-lite' ) ),
			array( 'core/quote', 'bordered', __( 'Bordered', 'arneiron-lite' ) ),
			array( 'core/quote', 'card', __( 'Card', 'arneiron-lite' ) ),

			// Pullquote.
			array( 'core/pullquote', 'plain', __( 'Plain', 'arneiron-lite' ) ),
			array( 'core/pullquote', 'bracketed', __( 'Bracketed', 'arneiron-lite' ) ),
			array( 'core/pullquote', 'large', __( 'Large', 'arneiron-lite' ) ),

			// List.
			array( 'core/list', 'check', __( 'Checklist', 'arneiron-lite' ) ),
			array( 'core/list', 'arrow', __( 'Arrow', 'arneiron-lite' ) ),
			array( 'core/list', 'dash', __( 'Dash', 'arneiron-lite' ) ),
			array( 'core/list', 'none', __( 'Unstyled', 'arneiron-lite' ) ),
			array( 'core/list', 'inline', __( 'Inline', 'arneiron-lite' ) ),

			// Separator.
			array( 'core/separator', 'hairline', __( 'Hairline', 'arneiron-lite' ) ),
			array( 'core/separator', 'dots', __( 'Dots', 'arneiron-lite' ) ),
			array( 'core/separator', 'wide', __( 'Wide', 'arneiron-lite' ) ),
			array( 'core/separator', 'short-center', __( 'Short Center', 'arneiron-lite' ) ),

			// Table.
			array( 'core/table', 'stripes', __( 'Stripes', 'arneiron-lite' ) ),
			array( 'core/table', 'bordered', __( 'Bordered', 'arneiron-lite' ) ),
			array( 'core/table', 'plain', __( 'Plain', 'arneiron-lite' ) ),
			array( 'core/table', 'compact', __( 'Compact', 'arneiron-lite' ) ),

			// Heading labels.
			array( 'core/heading', 'overline', __( 'Overline', 'arneiron-lite' ) ),
			array( 'core/heading', 'eyebrow', __( 'Eyebrow', 'arneiron-lite' ) ),
			array( 'core/heading', 'kicker', __( 'Kicker', 'arneiron-lite' ) ),

			// Social links.
			array( 'core/social-links', 'outline', __( 'Outline', 'arneiron-lite' ) ),
			array( 'core/social-links', 'filled', __( 'Filled', 'arneiron-lite' ) ),
			array( 'core/social-links', 'plain', __( 'Plain', 'arneiron-lite' ) ),
			array( 'core/social-links', 'pill', __( 'Pill', 'arneiron-lite' ) ),

			// Cover.
			array( 'core/cover', 'text-card', __( 'Text Card', 'arneiron-lite' ) ),

			// Featured image.
			array( 'core/post-featured-image', 'rounded', __( 'Rounded', 'arneiron-lite' ) ),
			array( 'core/post-featured-image', 'frame', __( 'Frame', 'arneiron-lite' ) ),
			array( 'core/post-featured-image', 'wide-bleed', __( 'Wide Bleed', 'arneiron-lite' ) ),

			// Navigation desktop link treatments.
			array( 'core/navigation', 'underline', __( 'Underline', 'arneiron-lite' ) ),
			array( 'core/navigation', 'pill', __( 'Pill', 'arneiron-lite' ) ),
			array( 'core/navigation', 'plain', __( 'Plain', 'arneiron-lite' ) ),

			// Query loop + latest posts.
			array( 'core/post-template', 'list-divided', __( 'Divided List', 'arneiron-lite' ) ),
			array( 'core/post-template', 'cards', __( 'Cards', 'arneiron-lite' ) ),
			array( 'core/post-template', 'minimal', __( 'Minimal', 'arneiron-lite' ) ),
			array( 'core/latest-posts', 'cards', __( 'Cards', 'arneiron-lite' ) ),
			array( 'core/latest-posts', 'minimal', __( 'Minimal', 'arneiron-lite' ) ),
		);

		foreach ( $styles as $style ) {
			list( $block, $name, $label ) = $style;
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'arneiron_register_block_styles' );
