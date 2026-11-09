<?php
/**
 * Title: Pricing · Monthly/Yearly toggle
 * Slug: arneiron/pricing-toggle
 * Categories: arneiron-pricing
 * Keywords: pricing, toggle, monthly, yearly
 * Viewport Width: 900
 * Description: Static monthly/yearly toggle above two plan cards.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-pill"} --><div class="wp-block-button is-style-pill"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Monthly', 'arneiron-lite' ); ?></a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-ghost"} --><div class="wp-block-button is-style-ghost"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Yearly', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Basic', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:heading {"level":4,"fontSize":"2xl"} --><h4 class="wp-block-heading has-2-xl-font-size"><?php esc_html_e( '$9', 'arneiron-lite' ); ?></h4><!-- /wp:heading --></div><!-- /wp:group --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Plus', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:heading {"level":4,"fontSize":"2xl"} --><h4 class="wp-block-heading has-2-xl-font-size"><?php esc_html_e( '$29', 'arneiron-lite' ); ?></h4><!-- /wp:heading --></div><!-- /wp:group --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
