<?php
/**
 * Title: Commerce · Order summary
 * Slug: arneiron/commerce-order-summary
 * Categories: arneiron-commerce
 * Keywords: commerce, order, summary, checkout
 * Viewport Width: 700
 * Description: A gray order summary card.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"480px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"className":"is-style-card","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group is-style-card">
		<!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Order summary', 'arneiron-lite' ); ?></h3><!-- /wp:heading -->
		<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} --><div class="wp-block-group"><!-- wp:paragraph {"fontSize":"sm","textColor":"subtle"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Pro plan (yearly)', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><?php esc_html_e( '$190.00', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} --><div class="wp-block-group"><!-- wp:paragraph {"fontSize":"sm","textColor":"subtle"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Tax', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><?php esc_html_e( '$15.20', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:separator {"className":"is-style-hairline"} --><hr class="wp-block-separator has-alpha-channel-opacity is-style-hairline"/><!-- /wp:separator -->
		<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} --><div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} --><p style="font-weight:700"><?php esc_html_e( 'Total', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}}} --><p style="font-weight:700"><?php esc_html_e( '$205.20', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Pay now', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
