<?php
/**
 * Header behaviour settings — Sticky, Full-width, and Sticky on mobile.
 *
 * Three site-wide switches surfaced in the Site Editor on the HEADER template
 * part, applied as classes on <body>, and implemented by
 * assets/css/header-chrome.css.
 *
 * WHY THESE LIVE IN THE PARENT. They are MECHANICS, not appearance: nothing here
 * decides what a header looks like, only whether it pins, whether its row is
 * boxed to the layout width, and whether it pins on small screens too. Every
 * site on this theme gets the switches, and because each default reproduces the
 * behaviour that was already in effect, no site changes appearance until someone
 * flips one. A child theme that wants a different look keeps that look in its own
 * stylesheet and simply keys off these classes.
 *
 * BOXED is expressed against `--wp--style--global--content-size` rather than a
 * literal width, so it tracks Styles → Layout instead of hard-coding the number a
 * second time and drifting from it later.
 *
 * @package ArneIronBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_header_settings' ) ) {
	/**
	 * Resolve the three switches.
	 *
	 * @return array{sticky:bool,full:bool,sticky_mobile:bool}
	 */
	function arneiron_header_settings() {
		return array(
			'sticky'        => (bool) get_option( 'arneiron_header_sticky', true ),
			'full'          => (bool) get_option( 'arneiron_header_full_width', false ),
			'sticky_mobile' => (bool) get_option( 'arneiron_header_sticky_mobile', false ),
		);
	}
}


if ( ! function_exists( 'arneiron_header_body_class' ) ) {
	/**
	 * Put the state on <body>.
	 *
	 * ON THE BODY rather than on the header element itself because the sticky rule
	 * has to reach the header's TEMPLATE-PART WRAPPER, and a class on an element
	 * inside that wrapper cannot style its own ancestor.
	 *
	 * Both halves of each switch are emitted (`-sticky` / `-static`,
	 * `-full` / `-boxed`) instead of only the "on" half. That costs one class and
	 * buys the ability to write the OFF state as a positive rule, which a child
	 * theme needs when it has to undo something the parent does by default.
	 *
	 * @param string[] $classes Body classes.
	 * @return string[]
	 */
	function arneiron_header_body_class( $classes ) {
		$s = arneiron_header_settings();

		$classes[] = $s['sticky'] ? 'arneiron-header-sticky' : 'arneiron-header-static';
		$classes[] = $s['full'] ? 'arneiron-header-full' : 'arneiron-header-boxed';

		if ( $s['sticky_mobile'] ) {
			$classes[] = 'arneiron-header-sticky-mobile';
		}

		return $classes;
	}
	add_filter( 'body_class', 'arneiron_header_body_class' );
}

if ( ! function_exists( 'arneiron_header_chrome_styles' ) ) {
	/**
	 * Front-end stylesheet implementing the switches.
	 *
	 * PRIORITY 0, AND THAT IS LOAD-BEARING. These are BASE mechanics that a child
	 * theme is expected to override — an overlay masthead, for instance, has to
	 * replace `position: sticky` with its own positioning. The selectors here and
	 * in a child are naturally identical, so the winner is decided by SOURCE
	 * ORDER, which means this file has to print first. It is not enough to pick a
	 * "late-ish" number: arneiron-child enqueues its own chrome at priority 1, so
	 * anything above that would silently beat the child and pin a header the child
	 * had deliberately taken out of flow. 0 is below every child in the estate.
	 *
	 * @return void
	 */
	function arneiron_header_chrome_styles() {
		$rel = 'assets/css/header-chrome.css';

		if ( ! file_exists( ARNEIRON_DIR . '/' . $rel ) ) {
			return;
		}

		wp_enqueue_style(
			'arneiron-header-chrome',
			ARNEIRON_URI . '/' . $rel,
			array(),
			arneiron_asset_ver( $rel )
		);
	}
	add_action( 'wp_enqueue_scripts', 'arneiron_header_chrome_styles', 0 );
}

if ( ! function_exists( 'arneiron_header_stuck_script' ) ) {
	/**
	 * Toggle `body.arneiron-header-stuck` once the header has been scrolled past.
	 *
	 * THIS CLASS IS NOT WHAT MAKES THE HEADER PIN — `position: sticky` in
	 * header-chrome.css does that, with no JavaScript and no placeholder. This
	 * exists for the SECOND half of the behaviour: a theme that wants the bar to
	 * change once it is pinned (collapse its height, swap a translucent
	 * background for a solid one) cannot express "is currently stuck" in CSS.
	 * `:stuck` does not exist. So the state is published as a class and every
	 * value that responds to it lives in a stylesheet.
	 *
	 * Emitted only when the toggle is on, so a static header carries no listener.
	 *
	 * The threshold is the header's own height: the class flips exactly as the
	 * space the header occupied leaves the viewport, which is what makes the
	 * change read as continuous rather than as the bar jumping.
	 *
	 * `passive: true`, and the work is one classList toggle behind a
	 * requestAnimationFrame gate, so scrolling cannot queue layout work per frame.
	 *
	 * @return void
	 */
	function arneiron_header_stuck_script() {
		$s = arneiron_header_settings();

		if ( empty( $s['sticky'] ) && empty( $s['sticky_mobile'] ) ) {
			return;
		}
		?>
<script id="arneiron-header-stuck">
( function () {
	var b = document.body, t = 100, ticking = false;
	/* The template-part wrapper, which is what header-chrome.css positions.
	   Falls back to any .site-header for themes that render the header without
	   a template part. */
	var hdr = document.querySelector( '.wp-site-blocks > header.wp-block-template-part' )
		|| document.querySelector( 'header.wp-block-template-part' )
		|| document.querySelector( '.site-header' );

	if ( hdr ) {
		var h = Math.round( hdr.getBoundingClientRect().height );
		if ( h > 0 ) { t = h; }
	}

	function apply() {
		ticking = false;
		var y = window.pageYOffset || document.documentElement.scrollTop || 0;
		b.classList.toggle( 'arneiron-header-stuck', y > t );
	}

	window.addEventListener( 'scroll', function () {
		if ( ! ticking ) { ticking = true; window.requestAnimationFrame( apply ); }
	}, { passive: true } );

	apply();
} )();
</script>
		<?php
	}
	add_action( 'wp_footer', 'arneiron_header_stuck_script', 30 );
}

