<?php
/**
 * Theme supports + nav menu registration (extracted from functions.php in P1-1,
 * issue ArneIron-net/hub#1230).
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_setup' ) ) {
	/**
	 * Register theme supports. Hooked on after_setup_theme.
	 *
	 * @return void
	 */
	function arneiron_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

		// Editor-iframe styles mirror the frontend so canvas == rendered page
		// (block-editor-compat skill). As of WP 7, editor styles MUST be added
		// via add_editor_style() (NOT wp_enqueue_style on
		// 'enqueue_block_editor_assets', which logs "added to the iframe
		// incorrectly"). Order matters: tokens first (ds.css), then the
		// is-style-* variations (blocks.css), then editor-only overrides.
		add_editor_style(
			array(
				'assets/css/ds.css',
				'assets/css/blocks.css',
				'assets/css/editor.css',
			)
		);

		// Menus are optional; the fallback in header.html (wp_page_menu) covers the
		// no-menu-assigned state, so even an empty install has working navigation.
		register_nav_menus(
			array(
				'primary' => __( 'Primary menu', 'arneiron-lite' ),
				'mobile'         => __( 'Mobile menu', 'arneiron-lite' ),
				'footer'  => __( 'Footer menu', 'arneiron-lite' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'arneiron_setup' );
