<?php
/**
 * ArneIron — theme version: the DERIVATION, not a declaration.
 * =============================================================================
 * SINGLE SOURCE OF TRUTH: the `Version:` header in this theme's `style.css`.
 *
 * That header is not optional and not ours to remove — WordPress reads it to
 * populate `wp_get_theme()->get('Version')`, the update channel compares
 * against it, and `wp theme list` prints it. So it is the one place the version
 * CAN live, and therefore the only place it MAY live.
 *
 * Every other consumer derives from it:
 *   - `ARNEIRON_VERSION` (functions.php) — this file, at runtime.
 *   - `tools/build-theme-zip.sh`         — awk over the same header, at build.
 *   - `ci/check-theme-version.sh`        — asserts the derivation still holds.
 *
 * WHY THIS EXISTS (hub#2362 / the 0.5.0 collision).
 * `ARNEIRON_VERSION` used to be a second, hand-maintained literal. Two literals
 * for one fact drift, and this one already had: at 0.4.x the theme shipped with
 * `style.css` saying 0.4.0 while `ARNEIRON_VERSION` said 0.4.1. That is not a
 * cosmetic inconsistency. `arneiron_asset_ver()` returns `ARNEIRON_VERSION`
 * verbatim unless `WP_DEBUG` is on, so the asset `?ver=` query string — the
 * whole cache-busting mechanism — is keyed on the literal that drifted, while
 * the theme the site *reports* running comes from the header that did not.
 * A release then ships new CSS behind an unchanged cache key, or an unchanged
 * theme behind a moved one. Both are silent.
 *
 * DELIBERATELY WP-FREE. This file uses no WordPress function, so:
 *   - it can be `require`d from `functions.php` at any point in the load order
 *     without depending on `get_file_data()` being available yet, and
 *   - CI can EXECUTE it (`php -r`) against a bare checkout and prove the
 *     derived string equals the header, rather than eyeballing two greps.
 *     An assertion you can only make by reading is an assertion nobody makes.
 *
 * @package ArneIron
 */

if ( ! function_exists( 'arneiron_theme_version_from_style' ) ) {
	/**
	 * Parse the `Version:` header out of a theme stylesheet.
	 *
	 * Mirrors WordPress's own header semantics (`get_file_data()`): read the
	 * first 8 KB only, tolerate leading comment/whitespace decoration, stop at
	 * a closing comment marker.
	 *
	 * @param string $style_css Absolute path to a theme `style.css`.
	 * @return string The version string, or '' when it cannot be parsed.
	 *                '' is a FAILURE signal and callers must treat it as one —
	 *                never as "no version, carry on".
	 */
	function arneiron_theme_version_from_style( $style_css ) {
		if ( ! is_string( $style_css ) || '' === $style_css || ! is_readable( $style_css ) ) {
			return '';
		}

		// Header window only: the first 8 KB, as get_file_data() reads it.
		$head = file_get_contents( $style_css, false, null, 0, 8192 ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

		if ( ! is_string( $head ) || '' === $head ) {
			return '';
		}

		// Normalise legacy Mac line endings the way get_file_data() does.
		$head = str_replace( array( "\r\n", "\r" ), "\n", $head );

		if ( ! preg_match( '/^[ \t\/*#@]*Version:(.*)$/mi', $head, $m ) ) {
			return '';
		}

		// Strip a trailing comment terminator and surrounding whitespace.
		return trim( preg_replace( '/\s*(?:\*\/|\?>).*/', '', $m[1] ) );
	}
}
