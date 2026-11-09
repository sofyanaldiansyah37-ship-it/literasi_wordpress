<?php
/**
 * ArneIron Lite — theme bootstrap.
 *
 * Presentation only: theme supports, assets, block styles, template and
 * pattern wiring, and the core-block chrome. No blocks, shortcodes, post types,
 * roles, bundled plugins or external requests.
 *
 * This file and inc/about.php are the Lite-specific sources
 * (design/theme-build/arneiron-lite-src in the hub repo); every other file is
 * generated from ArneIron Pro by ops/release/split-themes.py.
 *
 * @package ArneIron_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ARNEIRON_VERSION' ) ) {
	require_once __DIR__ . '/inc/version.php';
	$arneiron_version = arneiron_theme_version_from_style( __DIR__ . '/style.css' );
	define( 'ARNEIRON_VERSION', '' !== $arneiron_version ? $arneiron_version : '1.0.0' );
	unset( $arneiron_version );
}
if ( ! defined( 'ARNEIRON_DIR' ) ) {
	define( 'ARNEIRON_DIR', __DIR__ );
}
if ( ! defined( 'ARNEIRON_URI' ) ) {
	// This directory's own URL, whether Lite is the active theme or the parent
	// of a child theme (hub#1592).
	$arneiron_is_stylesheet = (
		rtrim( str_replace( '\\', '/', __DIR__ ), '/' )
		=== rtrim( str_replace( '\\', '/', (string) get_stylesheet_directory() ), '/' )
	);
	define( 'ARNEIRON_URI', $arneiron_is_stylesheet ? get_stylesheet_directory_uri() : get_template_directory_uri() );
	unset( $arneiron_is_stylesheet );
}

/**
 * Cache-busting version for a theme asset.
 *
 * @param string $rel Path relative to the theme root.
 * @return string
 */
function arneiron_asset_ver( $rel ) {
	unset( $rel );
	return ARNEIRON_VERSION;
}

foreach (
	array(
		'setup',
		'enqueue',
		'block-patterns',
		'block-styles',
		'buttons',
		'template-support',
		'header-settings',
		'group-decor',
		'woocommerce',
		'polylang',
		'icons',
		'chrome-integrations',
		'plugin-blocks',
		'old-arnie-default',
		'scroll-story',
		'media-video',
		'comment-box',
		'about',
		'front-landing',
	) as $arneiron_module
) {
	$arneiron_module_path = ARNEIRON_DIR . '/inc/' . $arneiron_module . '.php';
	if ( is_readable( $arneiron_module_path ) ) {
		require_once $arneiron_module_path;
	} else {
		error_log( // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			sprintf( '[arneiron-lite] theme module not found: inc/%s.php (searched %s)', $arneiron_module, ARNEIRON_DIR )
		);
	}
}
unset( $arneiron_module_path );
unset( $arneiron_module );
