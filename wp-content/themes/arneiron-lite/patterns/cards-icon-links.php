<?php
/**
 * Title: Cards · Icon links
 * Slug: arneiron/cards-icon-links
 * Categories: arneiron-cards
 * Keywords: cards, icons, links
 * Viewport Width: 1000
 * Description: A grid of compact icon link cards.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"12rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"is-style-bordered","layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group is-style-bordered"><!-- wp:paragraph {"fontSize":"lg"} --><p class="has-lg-font-size">&#9673;</p><!-- /wp:paragraph --><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Overview', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-bordered","layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group is-style-bordered"><!-- wp:paragraph {"fontSize":"lg"} --><p class="has-lg-font-size">&#9635;</p><!-- /wp:paragraph --><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Settings', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-bordered","layout":{"type":"flex","verticalAlignment":"center"}} --><div class="wp-block-group is-style-bordered"><!-- wp:paragraph {"fontSize":"lg"} --><p class="has-lg-font-size">&#9634;</p><!-- /wp:paragraph --><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Billing', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
