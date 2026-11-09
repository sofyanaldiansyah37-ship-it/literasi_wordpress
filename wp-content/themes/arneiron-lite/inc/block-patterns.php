<?php
/**
 * Block pattern category + registration notes.
 * =============================================================================
 * WP auto-discovers `patterns/*.php` since 6.0 and uses each file's header
 * comment for category + title. We only need to REGISTER the category slug so
 * pattern files can reference it ("Categories: arneiron").
 *
 * No auto-insert: every pattern is opt-in via the editor Patterns tab
 * (theme-spec §2 "No programmatic content".
 *
 * @package ArneIronBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_register_pattern_category' ) ) {
	/**
	 * Register the block pattern categories:
	 *   - `arneiron`        — composable patterns (hero, features, query-compact, sidebar-default).
	 *   - `arneiron-blocks` — block-author patterns provided by the ported block library (Strategy 2).
	 *   - `arneiron-*`      — the 17 organisational sub-categories ported from arneiron-base
	 *                         in P0d (issue ArneIron-net/hub#1230), referenced by the 82
	 *                         core-block patterns Categories: header.
	 *
	 * @return void
	 */
	function arneiron_register_pattern_category() {
		// Generic catch-all + block-author categories.
		register_block_pattern_category(
			'arneiron',
			array( 'label' => __( 'ArneIron', 'arneiron-lite' ) )
		);
		register_block_pattern_category(
			'arneiron-blocks',
			array( 'label' => __( 'ArneIron Blocks', 'arneiron-lite' ) )
		);

		// 17 organisational sub-categories (label = human-readable group name).
		$subcategories = array(
			'arneiron-account'       => __( 'ArneIron · Account', 'arneiron-lite' ),
			'arneiron-banners'       => __( 'ArneIron · Banners', 'arneiron-lite' ),
			'arneiron-blog'          => __( 'ArneIron · Blog', 'arneiron-lite' ),
			'arneiron-cards'         => __( 'ArneIron · Cards', 'arneiron-lite' ),
			'arneiron-commerce'      => __( 'ArneIron · Commerce', 'arneiron-lite' ),
			'arneiron-contact'       => __( 'ArneIron · Contact', 'arneiron-lite' ),
			'arneiron-content'       => __( 'ArneIron · Content', 'arneiron-lite' ),
			'arneiron-cta'           => __( 'ArneIron · Call to Action', 'arneiron-lite' ),
			'arneiron-faq'           => __( 'ArneIron · FAQ', 'arneiron-lite' ),
			'arneiron-features'      => __( 'ArneIron · Features', 'arneiron-lite' ),
			'arneiron-gallery'       => __( 'ArneIron · Gallery', 'arneiron-lite' ),
			'arneiron-hero'          => __( 'ArneIron · Hero', 'arneiron-lite' ),
			'arneiron-page'          => __( 'ArneIron · Page', 'arneiron-lite' ),
			'arneiron-pricing'       => __( 'ArneIron · Pricing', 'arneiron-lite' ),
			'arneiron-stats'         => __( 'ArneIron · Stats', 'arneiron-lite' ),
			'arneiron-team'          => __( 'ArneIron · Team', 'arneiron-lite' ),
			'arneiron-testimonials'  => __( 'ArneIron · Testimonials', 'arneiron-lite' ),
		);
		foreach ( $subcategories as $slug => $label ) {
			register_block_pattern_category( $slug, array( 'label' => $label ) );
		}
	}
}
add_action( 'init', 'arneiron_register_pattern_category' );

/**
 * Deterministically register every `patterns/*.php` via register_block_pattern().
 * =============================================================================
 * WP 6.0+ auto-discovers `patterns/*.php` via the theme-files cache transient
 * (key `wp_theme_files_patterns-<cache_hash>` in WP 6.6+). That cache can go
 * stale when a deploy ships the same theme Version (no auto-invalidation), and
 * on WP 7.0 the auto-registration lifecycle does not always fire in every code
 * path (templates referencing `<!-- wp:pattern -->` may run before the
 * registration step). This belt-and-suspenders loader reads each file's
 * doc-block header + body and registers it directly, so the namespaced slug
 * (`arneiron/<slug>`) always exists.
 *
 * Safe alongside auto-discovery: register_block_pattern() is idempotent —
 * re-registering the same name on top of an auto-discovered one is a no-op.
 */
if ( ! function_exists( 'arneiron_register_patterns_explicit' ) ) {
	function arneiron_register_patterns_explicit() {
		$dir = ARNEIRON_DIR . '/patterns';
		if ( ! is_dir( $dir ) ) {
			return;
		}

		// Header fields WP itself reads from pattern files.
		//
		// This list must stay in step with WP_Theme::get_block_patterns()'s
		// $default_headers. register_block_pattern() REPLACES an existing entry
		// rather than skipping it, so any field missing here is stripped from
		// the auto-discovered pattern when this loader runs at init:11 — which
		// is how `Block Types: core/template-part/header` went missing and left
		// the header template part with nothing to switch back to.
		$headers = array(
			'title'         => 'Title',
			'slug'          => 'Slug',
			'description'   => 'Description',
			'viewportWidth' => 'Viewport Width',
			'categories'    => 'Categories',
			'keywords'      => 'Keywords',
			'blockTypes'    => 'Block Types',
			'postTypes'     => 'Post Types',
			'templateTypes' => 'Template Types',
			'inserter'      => 'Inserter',
		);

		foreach ( glob( $dir . '/*.php' ) as $file ) {
			$data    = get_file_data( $file, $headers );
			$slug    = isset( $data['slug'] ) ? trim( $data['slug'] ) : '';
			$title   = isset( $data['title'] ) ? trim( $data['title'] ) : '';
			if ( '' === $slug || '' === $title ) {
				continue; // Skip files without the required WP headers.
			}

			// Read the body markup: strip the leading PHP open + doc-block + the
			// close-tag so only the block markup remains. Buffer + ob_get_clean()
			// also runs any PHP-translatable strings in the pattern (e.g. esc_html_e).
			ob_start();
			include $file;
			$content = ob_get_clean();

			// Drop the leading PHP open-tag + doc-block if ob captured them as text.
			$content = preg_replace( '/^\s*<\?php.*?\?>/s', '', $content );
			$content = trim( $content );
			if ( '' === $content ) {
				continue;
			}

			$pattern = array(
				'title'       => $title,
				'description' => isset( $data['description'] ) ? $data['description'] : '',
				'content'     => $content,
				'categories'  => array_filter( array_map( 'trim', explode( ',', $data['categories'] ?? 'arneiron' ) ) ),
				'inserter'    => isset( $data['inserter'] ) ? 'no' !== strtolower( trim( $data['inserter'] ) ) : true,
			);
			if ( ! empty( $data['keywords'] ) ) {
				$pattern['keywords'] = array_filter( array_map( 'trim', explode( ',', $data['keywords'] ) ) );
			}
			if ( ! empty( $data['viewportWidth'] ) ) {
				$pattern['viewportWidth'] = (int) $data['viewportWidth'];
			}
			// Comma-separated list fields. `blockTypes` is the one that decides
			// whether a pattern is offered when replacing a template part, so a
			// header pattern without it can be inserted but never chosen as the
			// header's design.
			foreach ( array( 'blockTypes', 'postTypes', 'templateTypes' ) as $list_field ) {
				if ( ! empty( $data[ $list_field ] ) ) {
					$pattern[ $list_field ] = array_filter( array_map( 'trim', explode( ',', $data[ $list_field ] ) ) );
				}
			}

			// Namespaced slug, matching what templates reference (`arneiron/<slug>`).
// Namespaced slug: pattern `Slug:` headers already carry the
			// `arneiron/` prefix, so only prepend it when bare.
			// Avoids ghost `arneiron/arneiron/<slug>` duplicates vs WP auto-discovery.
			$namespaced = ( false !== strpos( $slug, '/' ) ) ? $slug : 'arneiron/' . $slug;
			register_block_pattern( $namespaced, $pattern );
		}
	}
}
add_action( 'init', 'arneiron_register_patterns_explicit', 11 ); // after the category (priority 10).
