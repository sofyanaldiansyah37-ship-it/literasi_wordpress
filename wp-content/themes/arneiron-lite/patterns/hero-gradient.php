<?php
/**
 * Title: Hero · Gradient
 * Slug: arneiron/hero-gradient
 * Categories: arneiron-hero
 * Keywords: hero, gradient
 * Viewport Width: 1200
 * Description: Centered hero on a soft gray gradient.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","gradient":"surface-sheen","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<section class="wp-block-group alignfull has-surface-sheen-gradient-background has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"3xl"} -->
	<h1 class="wp-block-heading has-text-align-center has-3-xl-font-size"><?php esc_html_e( 'Subtle by default.', 'arneiron-lite' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center","fontSize":"md","textColor":"subtle"} -->
	<p class="has-text-align-center has-subtle-color has-text-color has-md-font-size"><?php esc_html_e( 'Gradients built from theme tokens — they re-skin with the rest of the site.', 'arneiron-lite' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Explore', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div>
	<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
