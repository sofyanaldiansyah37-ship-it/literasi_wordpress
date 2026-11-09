<?php
/**
 * Front-end + block-editor asset enqueues (extracted from functions.php in
 * P1-1, issue ArneIron-net/hub#1230).
 *
 * Loads in order, on the front:
 *   ds.css       — design-system source of truth (token-driven structural CSS)
 *   blocks.css   — the 28 is-style-* block-style variations (P0b)
 *   old-arnie.css — CRT Style Variation decoration layer (inert under default skin)
 *   theme.js     — progressive enhancement only (deferred)
 * In the editor iframe we mirror ds/editor/blocks so canvas == front.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_enqueue' ) ) {
	/**
	 * Enqueue the design-system stylesheet and the progressive-enhancement script.
	 *
	 * @return void
	 */
	function arneiron_enqueue() {
		// Front-end design layer (the single source of truth for component CSS).
		wp_enqueue_style(
			'arneiron-ds',
			ARNEIRON_URI . '/assets/css/ds.css',
			array(),
			arneiron_asset_ver( 'assets/css/ds.css' )
		);

		// Block-style variations (is-style-*) for core blocks. Ported from
		// arneiron-base via P0b. Loaded after ds.css so variations layer on the
		// design system. Also injected into the editor via arneiron_editor_assets()
		// so the editor canvas matches the front end.
		wp_enqueue_style(
			'arneiron-blocks',
			ARNEIRON_URI . '/assets/css/blocks.css',
			array( 'arneiron-ds' ),
			arneiron_asset_ver( 'assets/css/blocks.css' )
		);

		// Progressive enhancement only (nav toggle). defer => non-blocking.
		wp_enqueue_script(
			'arneiron-theme',
			ARNEIRON_URI . '/assets/js/theme.js',
			array(),
			arneiron_asset_ver( 'assets/js/theme.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		// Labels theme.js sets on markup it enhances (the drawer is a core/group, which
		// cannot save aria-* attributes): translated here, read by theme.js.
		wp_localize_script(
			'arneiron-theme',
			'arneironThemeI18n',
			array(
				'mobileMenu' => __( 'Mobile menu', 'arneiron-lite' ),
			)
		);

		// "Old Arnie" CRT Style Variation decoration layer.
		// The base ds.css + presets come from theme.json / the variation json; this
		// adds the scanline + HUD + glow + gradient layer that a Style Variation
		// cannot express. It is ALWAYS loaded but every rule is scoped to
		// `body.wp-style-old-arnie`, which the THEME adds while the Old Arnie look
		// is showing (inc/old-arnie-default.php — WordPress core emits no class for
		// the active variation), so it is inert under every other variation.
		wp_enqueue_style(
			'arneiron-old-arnie',
			ARNEIRON_URI . '/assets/css/old-arnie.css',
			array( 'arneiron-ds' ),
			arneiron_asset_ver( 'assets/css/old-arnie.css' )
		);

		/*
		 * The CHILD theme's style.css — the documented place for custom CSS
		 * (hub#2132).
		 *
		 * arneiron-child/style.css carries a header that tells authors, in so
		 * many words, "Your custom CSS goes here ... Rules here win on equal
		 * specificity because the child stylesheet enqueues after the parent's."
		 * Nothing enqueued it. The child's own functions.php shipped the
		 * enqueue only as a COMMENTED-OUT example, and the parent enqueued
		 * ds/blocks/old-arnie and stopped. So every rule written into the file
		 * the theme itself nominates was silently inert — including anything
		 * the agent writes there, which is the file-plane style path #2233
		 * depends on.
		 *
		 * Fixed parent-side rather than in the bundled child, deliberately:
		 * a child-side fix would only reach children created AFTER it ships,
		 * while live tenants (skaryna) run hand-written children that would
		 * never receive it. One conditional here covers every child, present
		 * and future, and is a no-op when no child is active.
		 *
		 * Two details are load-bearing:
		 *
		 * 1. `array( 'arneiron-old-arnie' )` — the LAST parent handle, so the
		 *    child stylesheet is emitted after every parent layer and the
		 *    "wins on equal specificity" promise in its header is true.
		 *
		 * 2. The version is the child stylesheet's own `filemtime`, NOT
		 *    `arneiron_asset_ver()`. That helper returns `ARNEIRON_VERSION` —
		 *    a constant — unless `WP_DEBUG` is true, and it resolves paths
		 *    against ARNEIRON_DIR (the PARENT) so it cannot see this file at
		 *    all. Versioning the child stylesheet with a constant would mean an
		 *    agent writes CSS, the write genuinely lands, and the browser keeps
		 *    serving the cached copy: "applied" reported on a page that did not
		 *    change. That is the phantom-success window, and it is precisely
		 *    the failure this enqueue exists to prevent. filemtime, always.
		 *    (`arneiron_asset_ver`'s WP_DEBUG-only cache-busting is a separate
		 *    defect for the parent's own assets — hub#2105 context; not widened
		 *    here.)
		 */
		if ( is_child_theme() ) {
			$arneiron_child_css = get_stylesheet_directory() . '/style.css';

			if ( is_readable( $arneiron_child_css ) ) {
				wp_enqueue_style(
					'arneiron-child-style',
					get_stylesheet_uri(),
					array( 'arneiron-old-arnie' ),
					(string) filemtime( $arneiron_child_css )
				);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'arneiron_enqueue' );

/* Swiper (`arneiron-swiper`) is registered by ArneIron Blocks since Pro 0.10.0:
 * it is vendored inside arneiron/carousel, which lives in the plugin now. */



// NOTE: Editor-iframe styles (editor.css, ds.css, blocks.css) are registered
// via add_editor_style() in inc/setup.php. As of WP 7, enqueuing them on
// 'enqueue_block_editor_assets' no longer injects them into the editor iframe
// and instead logs:
//   "<handle>-css was added to the iframe incorrectly. Please use block.json
//    or enqueue_block_assets to add styles to the iframe."
// The shared design layer (ds.css + blocks.css) is enqueued on the front end
// via arneiron_enqueue() above and mirrors into the editor iframe via
// add_editor_style(), the canonical WP path for theme editor styles. That path
// also correctly resolves the relative @import that previously lived in
// editor.css (the old "./ds.css" import resolved against /wp-admin/ in the
// iframe and 404'd with text/html -> "Refused to apply style ... strict MIME").
