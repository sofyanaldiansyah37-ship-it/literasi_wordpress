<?php
/**
 * Title: Banner · Promo strip
 * Slug: arneiron/banner-promo
 * Categories: arneiron-banners
 * Keywords: banner, promo, sale
 * Viewport Width: 1200
 * Description: A promotional strip with a CTA.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-3","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-3-background-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} --><div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Save 20% on annual plans', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-pill"} --><div class="wp-block-button is-style-pill"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Upgrade', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->
</section>
<!-- /wp:group -->
