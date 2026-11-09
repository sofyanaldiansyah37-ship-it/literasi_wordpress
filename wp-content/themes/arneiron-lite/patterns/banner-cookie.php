<?php
/**
 * Title: Banner · Cookie notice
 * Slug: arneiron/banner-cookie
 * Categories: arneiron-banners
 * Keywords: banner, cookie, consent
 * Viewport Width: 1000
 * Description: A cookie consent notice.
 */
?>
<!-- wp:group {"tagName":"section","align":"wide","className":"is-style-card","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
<section class="wp-block-group alignwide is-style-card">
	<!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><?php esc_html_e( 'We use cookies to improve your experience.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Decline', 'arneiron-lite' ); ?></a></div><!-- /wp:button --><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Accept', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</section>
<!-- /wp:group -->
