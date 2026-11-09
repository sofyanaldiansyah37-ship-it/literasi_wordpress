<?php
/**
 * Title: Commerce · Checkout steps
 * Slug: arneiron/commerce-checkout-steps
 * Categories: arneiron-commerce
 * Keywords: commerce, checkout, steps
 * Viewport Width: 900
 * Description: A three-step checkout progress row.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group"><!-- wp:paragraph {"backgroundColor":"contrast","textColor":"accent-contrast","fontSize":"sm","style":{"border":{"radius":"var:custom|radius|pill"},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} --><p class="has-accent-contrast-color has-contrast-background-color has-text-color has-background has-sm-font-size" style="border-radius:var(--wp--custom--radius--pill);padding:var(--wp--preset--spacing--10) var(--wp--preset--spacing--30)"><?php esc_html_e( '1', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Cart', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group"><!-- wp:paragraph {"backgroundColor":"surface-3","textColor":"subtle","fontSize":"sm","style":{"border":{"radius":"var:custom|radius|pill"},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} --><p class="has-subtle-color has-surface-3-background-color has-text-color has-background has-sm-font-size" style="border-radius:var(--wp--custom--radius--pill);padding:var(--wp--preset--spacing--10) var(--wp--preset--spacing--30)"><?php esc_html_e( '2', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"textColor":"subtle","style":{"typography":{"fontWeight":"600"}}} --><p class="has-subtle-color has-text-color" style="font-weight:600"><?php esc_html_e( 'Payment', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group"><!-- wp:paragraph {"backgroundColor":"surface-3","textColor":"subtle","fontSize":"sm","style":{"border":{"radius":"var:custom|radius|pill"},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} --><p class="has-subtle-color has-surface-3-background-color has-text-color has-background has-sm-font-size" style="border-radius:var(--wp--custom--radius--pill);padding:var(--wp--preset--spacing--10) var(--wp--preset--spacing--30)"><?php esc_html_e( '3', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"textColor":"subtle","style":{"typography":{"fontWeight":"600"}}} --><p class="has-subtle-color has-text-color" style="font-weight:600"><?php esc_html_e( 'Done', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
