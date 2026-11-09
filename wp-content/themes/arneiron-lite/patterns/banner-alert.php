<?php
/**
 * Title: Banner · Alert
 * Slug: arneiron/banner-alert
 * Categories: arneiron-banners
 * Keywords: banner, alert, notice
 * Viewport Width: 1000
 * Description: A status alert banner.
 */
?>
<!-- wp:group {"tagName":"section","align":"wide","className":"is-style-notice-warning","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<section class="wp-block-group alignwide is-style-notice-warning">
	<!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><strong><?php esc_html_e( 'Scheduled maintenance:', 'arneiron-lite' ); ?></strong> <?php esc_html_e( 'Some features may be briefly unavailable this weekend.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
</section>
<!-- /wp:group -->
