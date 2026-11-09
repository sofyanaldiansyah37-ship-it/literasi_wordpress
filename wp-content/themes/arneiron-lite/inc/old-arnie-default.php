<?php
/**
 * The `wp-style-old-arnie` body class — the switch for assets/css/old-arnie.css.
 *
 * The "Old Arnie" CRT look is two layers: its palette, fonts and element styles
 * (a theme.json style variation, which WordPress applies by itself) and a
 * decoration layer theme.json cannot express — scanlines, vignette, HUD corners,
 * glow, gradient buttons — in assets/css/old-arnie.css, every rule scoped to
 * `body.wp-style-old-arnie`. WordPress core does NOT put a class for the active
 * style variation on <body>, so the theme adds it here, from the colour that
 * identifies the look: the palette's `base`.
 *
 *   - ArneIron Pro: Old Arnie is the variation styles/old-arnie.json. The class
 *     is on while the active palette's `base` equals that file's `base`.
 *   - ArneIron Lite: Old Arnie IS the default (theme.json carries it and Lite
 *     ships no styles/old-arnie.json). The class is on while the active `base`
 *     is the theme's own — choosing ArneIron Light, Gray, … switches it off.
 *
 * A style variation chosen in the Site Editor is user data, and core keys user
 * presets under the `custom` origin, so the active `base` is the `custom` one
 * when there is one and the theme's otherwise. Reading `theme` alone reports
 * the default for ever (that kept the CRT layer over ArneIron Light).
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_old_arnie_palette_base' ) ) {
	/**
	 * The `base` colour of a palette array, lower-cased, or ''.
	 *
	 * @param mixed $palette Palette entries ({slug, color}).
	 * @return string
	 */
	function arneiron_old_arnie_palette_base( $palette ) {
		foreach ( (array) $palette as $entry ) {
			if ( is_array( $entry ) && isset( $entry['slug'], $entry['color'] ) && 'base' === $entry['slug'] ) {
				return strtolower( (string) $entry['color'] );
			}
		}
		return '';
	}
}

if ( ! function_exists( 'arneiron_old_arnie_target_base' ) ) {
	/**
	 * The `base` colour that means "Old Arnie is showing".
	 *
	 * @return string
	 */
	function arneiron_old_arnie_target_base() {
		static $target = null;
		if ( null !== $target ) {
			return $target;
		}
		$target = '';
		$file   = get_template_directory() . '/styles/old-arnie.json';
		if ( is_readable( $file ) ) {
			$json   = json_decode( (string) file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local theme file.
			$target = arneiron_old_arnie_palette_base( $json['settings']['color']['palette'] ?? array() );
		} else {
			$theme  = WP_Theme_JSON_Resolver::get_theme_data()->get_settings();
			$target = arneiron_old_arnie_palette_base( $theme['color']['palette']['theme'] ?? array() );
		}
		return $target;
	}
}

if ( ! function_exists( 'arneiron_old_arnie_is_active' ) ) {
	/**
	 * Whether the Old Arnie look is the one showing.
	 *
	 * @return bool
	 */
	function arneiron_old_arnie_is_active() {
		$target  = arneiron_old_arnie_target_base();
		$palette = wp_get_global_settings( array( 'color', 'palette' ) );
		$active  = arneiron_old_arnie_palette_base( $palette['custom'] ?? array() );
		if ( '' === $active ) {
			$active = arneiron_old_arnie_palette_base( $palette['theme'] ?? array() );
		}
		return '' !== $target && $target === $active;
	}
}

if ( ! function_exists( 'arneiron_old_arnie_body_class' ) ) {
	/**
	 * Add `wp-style-old-arnie` to <body> while the Old Arnie look is showing.
	 *
	 * @param string[] $classes Body classes.
	 * @return string[]
	 */
	function arneiron_old_arnie_body_class( $classes ) {
		if ( arneiron_old_arnie_is_active() ) {
			$classes[] = 'wp-style-old-arnie';
		}
		return $classes;
	}
	add_filter( 'body_class', 'arneiron_old_arnie_body_class' );
}
