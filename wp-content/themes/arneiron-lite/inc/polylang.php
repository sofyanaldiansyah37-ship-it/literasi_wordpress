<?php
/**
 * Polylang integration (inc/polylang.php)
 * =============================================================================
 * One job: make the block navigation follow the language switcher.
 *
 * The problem this solves, observed live on gvs.foundation 2026-08-19. Polylang
 * was configured correctly — both menu locations carried an English AND a German
 * menu:
 *
 *     "primary": {"en":26,"de":45},  "mobile": {"en":26,"de":45}
 *
 * and the mobile drawer duly rendered "Startseite / Über uns & Leistungen /
 * Kostenloses Essen" on /de/. The desktop header, one element away on the same
 * request, rendered "About & Services / Blog / Membership". Not a switcher bug:
 * the two headers read from two different systems.
 *
 * The drawer reads a CLASSIC menu location, which Polylang maps per language.
 * The desktop header is a `core/navigation` block, which reads a `wp_navigation`
 * POST — and Polylang does not treat that post type as translatable:
 *
 *     pll_is_translated_post_type( 'wp_navigation' )  =>  NO
 *
 * So one navigation post renders in every language, and the perfectly good
 * German menu sitting in the database is never asked for.
 *
 * Two halves to the fix, and both are needed:
 *
 *   1. Register `wp_navigation` as a translatable post type, so a German
 *      navigation post can exist and be LINKED as the translation of the
 *      English one. Polylang Pro does this for navigation blocks; on free it
 *      has to be declared.
 *
 *   2. Resolve the block's `ref` to the current language at render time. Even
 *      with the posts linked, the ref is a fixed integer baked into the header
 *      markup — nothing rewrites it per request.
 *
 * Both no-op without Polylang, so this file is inert on arneiron.net, skaryna.ai
 * and every single-language site that shares this parent theme.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declare `wp_navigation` translatable.
 *
 * Without this, `pll_get_post()` cannot return a translation for a navigation
 * post no matter how the posts are related, because Polylang refuses to track
 * languages for an untranslated type.
 *
 * @param string[] $types    Post types Polylang will translate, keyed by name.
 * @param bool     $is_settings Whether the list is being built for the settings screen.
 * @return string[] The list with wp_navigation added.
 */
function arneiron_pll_translate_navigation( $types, $is_settings = false ) {
	$types['wp_navigation'] = 'wp_navigation';
	return $types;
}
add_filter( 'pll_get_post_types', 'arneiron_pll_translate_navigation', 10, 2 );

/**
 * Point `core/navigation` at the current language's navigation post.
 *
 * Runs on `render_block_data`, which hands over the PARSED block before render,
 * so we can adjust attributes and let core do all of its own rendering — the
 * responsive overlay, the Interactivity API bindings, submenu handling. Nothing
 * about core's markup is reimplemented here, which is the point: rebuilding a
 * navigation block by hand is how you lose the mobile overlay.
 *
 * Two cases, and the second is the one that actually bit gvs:
 *
 *   - The block HAS a `ref`. Translate it. Simple.
 *
 *   - The block has NO `ref` — which is what gvs's header part 607 looks like.
 *     Core then falls back to "the most recently published wp_navigation post",
 *     a query that knows nothing about languages and so returns the same post
 *     on every request. We resolve one for THIS language and pin it, because a
 *     ref that is present always wins over the fallback.
 *
 * Bails on admin/REST so the editor keeps showing the post the author actually
 * selected, rather than silently swapping it under them while they edit.
 *
 * @param array $parsed_block A parsed block from the block tree.
 * @return array The block, possibly with `attrs.ref` re-pointed.
 */
function arneiron_pll_navigation_ref( $parsed_block ) {
	if ( ! is_array( $parsed_block ) || 'core/navigation' !== ( isset( $parsed_block['blockName'] ) ? $parsed_block['blockName'] : '' ) ) {
		return $parsed_block;
	}
	if ( ! function_exists( 'pll_current_language' ) || ! function_exists( 'pll_get_post' ) ) {
		return $parsed_block; // Polylang absent — every other site sharing this theme.
	}
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return $parsed_block;
	}

	$language = pll_current_language();
	if ( empty( $language ) ) {
		return $parsed_block;
	}

	$ref = isset( $parsed_block['attrs']['ref'] ) ? (int) $parsed_block['attrs']['ref'] : 0;

	if ( $ref > 0 ) {
		$translated = pll_get_post( $ref, $language );
		if ( $translated && (int) $translated !== $ref ) {
			$parsed_block['attrs']['ref'] = (int) $translated;
		}
		return $parsed_block;
	}

	// No ref: pin the navigation post belonging to this language.
	$candidates = get_posts(
		array(
			'post_type'        => 'wp_navigation',
			'post_status'      => 'publish',
			'numberposts'      => 1,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'lang'             => $language,
			'suppress_filters' => false, // Polylang filters on this; without it the lang arg is ignored.
			'fields'           => 'ids',
		)
	);

	if ( ! empty( $candidates ) ) {
		$parsed_block['attrs']['ref'] = (int) $candidates[0];
	}

	return $parsed_block;
}
add_filter( 'render_block_data', 'arneiron_pll_navigation_ref' );
