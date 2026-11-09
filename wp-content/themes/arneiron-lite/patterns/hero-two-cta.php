<?php
/**
 * Title: Hero · Two-column CTA
 * Slug: arneiron/hero-two-cta
 * Categories: arneiron-hero
 * Keywords: hero, cta, split
 * Viewport Width: 1200
 * Description: Headline left, action card right.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"border":{"radius":"var:custom|radius|lg"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-2-background-color has-background" style="border-radius:var(--wp--custom--radius--lg);padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:heading {"level":1,"fontSize":"2xl"} -->
			<h1 class="wp-block-heading has-2-xl-font-size"><?php esc_html_e( 'Ready when you are.', 'arneiron-lite' ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"subtle"} -->
			<p class="has-subtle-color has-text-color"><?php esc_html_e( 'Start free, upgrade whenever it makes sense.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"38%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:38%">
			<!-- wp:buttons {"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"width":100} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Create account', 'arneiron-lite' ); ?></a></div>
				<!-- /wp:button -->
				<!-- wp:button {"width":100,"className":"is-style-outline"} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Talk to sales', 'arneiron-lite' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
