<?php
/**
 * Title: Hero · Centered
 * Slug: arneiron/hero-centered
 * Categories: arneiron-hero
 * Keywords: hero, centered, cta
 * Viewport Width: 1200
 * Description: Centered headline hero with two CTAs.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
	<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Introducing ArneIron Base', 'arneiron-lite' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"3xl"} -->
	<h1 class="wp-block-heading has-text-align-center has-3-xl-font-size"><?php esc_html_e( 'Everything you need, in gray.', 'arneiron-lite' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center","fontSize":"md","textColor":"subtle"} -->
	<p class="has-text-align-center has-subtle-color has-text-color has-md-font-size"><?php esc_html_e( 'A calm, accessible design system that any brand can make its own.', 'arneiron-lite' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Start now', 'arneiron-lite' ); ?></a></div>
		<!-- /wp:button -->
		<!-- wp:button {"className":"is-style-ghost"} -->
		<div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'View docs', 'arneiron-lite' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
