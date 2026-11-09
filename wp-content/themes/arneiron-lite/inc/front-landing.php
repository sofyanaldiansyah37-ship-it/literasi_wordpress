<?php
/**
 * ArneIron Lite — the front page a fresh install shows.
 *
 * WordPress's default is "Your latest posts" on the front page (Settings >
 * Reading). For that case Lite uses templates/front-page-landing.html: a hero,
 * feature cards and the latest posts, all core blocks from the theme's own
 * patterns, so the site looks like the theme's screenshot on activation without
 * importing anything (the Theme Review rules leave demo imports to plugins).
 * The text is placeholder copy the owner replaces in Appearance > Editor; the
 * edited template is the owner's own (a wp_template post) from then on.
 *
 * A static front page (Settings > Reading > A static page) keeps
 * templates/front-page.html, which shows that page's own content.
 *
 * @package ArneIron_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Front page template candidates: the landing for "Your latest posts", the
 * static front page template otherwise. Runs after inc/template-support.php's
 * arneiron_front_page_only_when_static (priority 10), which empties the list for
 * "Your latest posts".
 *
 * @param string[] $templates Front page template candidates.
 * @return string[]
 */
function arneiron_front_landing_hierarchy( $templates ) {
	if ( 'page' === get_option( 'show_on_front' ) ) {
		return $templates;
	}
	return array( 'front-page-landing' );
}
add_filter( 'frontpage_template_hierarchy', 'arneiron_front_landing_hierarchy', 20 );

/**
 * Name and describe the template in the Site Editor (otherwise it is listed by
 * its slug).
 *
 * @param array $types Default template types.
 * @return array
 */
function arneiron_front_landing_template_type( $types ) {
	$types['front-page-landing'] = array(
		'title'       => _x( 'Front Page (Latest Posts)', 'Template name', 'arneiron-lite' ),
		'description' => __( 'The front page while Settings > Reading shows your latest posts: a starter hero, feature cards and the latest posts. Replace the placeholder text with your own.', 'arneiron-lite' ),
	);
	return $types;
}
add_filter( 'default_template_types', 'arneiron_front_landing_template_type' );

/**
 * On page 2 and later of the latest posts, show only the posts: the intro
 * (hero + feature cards) steps aside and a visually hidden site title becomes
 * the page's h1; on page 1 the hero's heading is the h1 and the hidden one
 * steps aside, so there is always exactly one.
 *
 * @param string $html  Rendered block.
 * @param array  $block Parsed block.
 * @return string
 */
function arneiron_front_landing_paged( $html, $block ) {
	$classes = preg_split( '/\s+/', (string) ( $block['attrs']['className'] ?? '' ) );
	if ( in_array( 'arneiron-front-intro', $classes, true ) && is_paged() ) {
		return '';
	}
	if ( in_array( 'arneiron-front-paged-h1', $classes, true ) && ! is_paged() ) {
		return '';
	}
	return $html;
}
add_filter( 'render_block_core/group', 'arneiron_front_landing_paged', 10, 2 );
add_filter( 'render_block_core/site-title', 'arneiron_front_landing_paged', 10, 2 );
