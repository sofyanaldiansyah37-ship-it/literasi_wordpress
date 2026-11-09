<?php
/**
 * WooCommerce surface support (ported from arneiron-base Lane D in P1-2,
 * issue ArneIron-net/hub#1230).
 *
 * SURFACES ONLY — no payment logic. This module declares WooCommerce theme
 * support so Woo does not emit its "your theme does not declare WooCommerce
 * support" notice, and enqueues a token-only gray stylesheet (assets/css/
 * woocommerce.css) that neutralises Woo's default chrome onto the base tokens
 * so every skin recolors the shop, cart, checkout and account surfaces
 * automatically. No hex here; all colour via base tokens.
 *
 * The live token/EUR balance is a separate concern: see the header balance
 * seam. This module never touches money.
 *
 * Everything is guarded on class_exists('WooCommerce') so the theme is a no-op
 * where Woo is not installed.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_woocommerce_support' ) ) {
	/**
	 * Declare WooCommerce support + product gallery features (surfaces only).
	 *
	 * @return void
	 */
	function arneiron_woocommerce_support() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 640,
			'single_image_width'    => 1200,
			'product_grid'          => array(
				'default_columns' => 3,
				'default_rows'    => 3,
			),
		) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'arneiron_woocommerce_support' );

if ( ! function_exists( 'arneiron_woocommerce_styles' ) ) {
	/**
	 * Enqueue the gray, token-only WooCommerce surface stylesheet on Woo pages.
	 *
	 * @return void
	 */
	function arneiron_woocommerce_styles() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}
		$rel = 'assets/css/woocommerce.css';
		if ( is_readable( ARNEIRON_DIR . '/' . $rel ) ) {
			/*
			 * Sort AFTER WooCommerce's own front-end stylesheets.
			 *
			 * Until now this handle depended only on 'arneiron-blocks', so it
			 * happened to be emitted after Woo's sheets purely because this
			 * callback runs at priority 20 and WC_Frontend_Scripts::load_scripts
			 * runs at 10. That is an accident of hook order, not a contract: it
			 * makes "ArneIron overrides WooCommerce on equal specificity" true
			 * by luck. Declaring the dependency hands the ordering to WP's
			 * dependency resolver, where it is guaranteed.
			 *
			 * Only handles that are ALREADY ENQUEUED at this point are added,
			 * and that guard is load-bearing in both directions:
			 *   - naming an UNREGISTERED handle makes wp_enqueue_style drop this
			 *     stylesheet entirely and silently, which would un-style every
			 *     Woo surface;
			 *   - naming a REGISTERED-but-not-enqueued handle would force that
			 *     Woo stylesheet onto pages that never asked for it.
			 * So this can only ever tighten ordering; it can never add or remove
			 * a stylesheet.
			 *
			 * Residual, deliberately not addressed here: WooCommerce Blocks
			 * enqueues 'wc-blocks-style' during block RENDER, i.e. after this
			 * callback has run, so on some templates (/my-account/) it is still
			 * printed last. No dependency declared at this point can reach it.
			 * Anything ArneIron needs to win against that sheet must win on
			 * specificity instead.
			 */
			$deps = array( 'arneiron-blocks' );
			foreach ( array(
				'woocommerce-layout',
				'woocommerce-smallscreen',
				'woocommerce-general',
				'woocommerce-blocktheme',
				'wc-blocks-style',
			) as $arneiron_wc_handle ) {
				if ( wp_style_is( $arneiron_wc_handle, 'enqueued' ) ) {
					$deps[] = $arneiron_wc_handle;
				}
			}

			wp_enqueue_style(
				'arneiron-woocommerce',
				ARNEIRON_URI . '/' . $rel,
				$deps,
				arneiron_asset_ver( $rel )
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'arneiron_woocommerce_styles', 20 );

/* The woo-products block's add-to-cart script and its Buy-now handling moved
 * to ArneIron Blocks (includes/woocommerce.php) with the block, in Pro 0.10.0. */

/**
 * "Checkout Header" must not exist as a choice anywhere the owner looks.
 * ArneIron-net/hub#4364.
 *
 * The first attempt solved the wrong half. It made checkout RENDER the site
 * header by rewriting the `theme` pin on WooCommerce's `checkout-header` part,
 * and shipped `parts/checkout-header.html` to point at `header`. Checkout looked
 * right and the entry was still in the editor's part picker — worse than before,
 * in fact, because it had been a plugin part and was now a THEME part with our
 * name on it. The ask was to remove the concept, not to change its owner.
 *
 * What removes it:
 *
 *   1. `templates/page-checkout.html` — a THEME template outranks the plugin
 *      template of the same slug, and it references `header` + `header-mobile`
 *      directly. Nothing references `checkout-header` any more.
 *   2. `parts/checkout-header.html` is deleted, so the theme contributes no part
 *      by that name and the render-time pin rewrite is gone with it.
 *   3. The filter below drops WooCommerce's own `checkout-header` from the part
 *      list, so the name disappears from the picker too.
 *
 * The cost of (1), stated honestly: the theme now owns the checkout template, so
 * a WooCommerce update no longer reaches it. That was the reason the first
 * attempt used a filter instead. It is accepted here because the requirement is
 * that the part not exist, and a filter cannot deliver that while the plugin
 * template still references the slug. The template body is otherwise a verbatim
 * copy of WooCommerce 10.7's, so a future Woo change to it is a diff to re-apply,
 * not a silent divergence — check it on WooCommerce upgrades.
 *
 * The mobile bar is paired in deliberately: `.site-header` is display:none below
 * 782px (ds.css §14b) and a checkout with no mobile bar has NO header on a
 * phone. That regression was shipped once today and caught only by measuring the
 * breakpoint on /checkout/ itself.
 *
 * @param WP_Block_Template[] $templates Query result.
 * @return WP_Block_Template[]
 */
function arneiron_hide_woocommerce_checkout_header_part( $templates ) {
	if ( ! is_array( $templates ) ) {
		return $templates;
	}
	return array_values(
		array_filter(
			$templates,
			static function ( $t ) {
				return ! (
					'checkout-header' === ( $t->slug ?? '' )
					&& 0 === strpos( (string) ( $t->theme ?? '' ), 'woocommerce/' )
				);
			}
		)
	);
}
/*
 * Priority 9999, and that is load-bearing.
 *
 * WooCommerce registers its own parts on this same filter, via
 * `BlockTemplatesController::add_db_templates_with_woo_slug`, at priority 10 —
 * the SAME priority as this callback, so ordering falls to registration order
 * and Woo's ran second. Registered at 10, this filter was attached, callable,
 * and firing, and removed NOTHING: instrumenting it showed it receiving 9 items
 * with no `checkout-header` among them, because the entry it is meant to drop
 * did not exist yet when it ran. Every static check passed while the picker
 * still showed the part.
 *
 * At 9999 it runs after every producer: 16 items in, 15 out, entry gone.
 */
add_filter( 'get_block_templates', 'arneiron_hide_woocommerce_checkout_header_part', 9999 );

/**
 * `templates/page-checkout.html` is WooCommerce's checkout page (its blocks are
 * WooCommerce blocks). Without WooCommerce it would only show "block not
 * supported" placeholders in the Site Editor and catch a page whose slug is
 * "checkout", so the theme's copy is offered only while WooCommerce is active.
 *
 * @param WP_Block_Template[] $templates Query result.
 * @return WP_Block_Template[]
 */
function arneiron_woocommerce_template_only_with_woo( $templates ) {
	if ( class_exists( 'WooCommerce' ) || ! is_array( $templates ) ) {
		return $templates;
	}
	return array_values(
		array_filter(
			$templates,
			static function ( $t ) {
				return ! ( 'page-checkout' === ( $t->slug ?? '' ) && 'theme' === ( $t->source ?? '' ) );
			}
		)
	);
}
add_filter( 'get_block_templates', 'arneiron_woocommerce_template_only_with_woo', 9999 );
