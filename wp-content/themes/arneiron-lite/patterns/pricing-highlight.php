<?php
/**
 * Title: Pricing · Single highlight
 * Slug: arneiron/pricing-highlight
 * Categories: arneiron-pricing
 * Keywords: pricing, single, highlight
 * Viewport Width: 800
 * Description: A single highlighted plan card.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"560px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"className":"is-style-card","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group is-style-card">
		<!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} --><h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'All access', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
		<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"3xl"} --><h3 class="wp-block-heading has-text-align-center has-3-xl-font-size"><?php esc_html_e( '$29', 'arneiron-lite' ); ?><span style="font-size:var(--wp--preset--font-size--sm)"><?php esc_html_e( '/mo', 'arneiron-lite' ); ?></span></h3><!-- /wp:heading -->
		<!-- wp:list {"className":"is-style-check"} --><ul class="wp-block-list is-style-check"><!-- wp:list-item --><li><?php esc_html_e( 'Unlimited projects', 'arneiron-lite' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'All patterns and skins', 'arneiron-lite' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'Priority support', 'arneiron-lite' ); ?></li><!-- /wp:list-item --></ul><!-- /wp:list -->
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Start free trial', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
