<?php
/**
 * Title: CTA · Inline banner
 * Slug: arneiron/cta-inline-banner
 * Categories: arneiron-cta
 * Keywords: cta, inline, banner
 * Viewport Width: 900
 * Description: A slim inline CTA banner.
 */
?>
<!-- wp:group {"tagName":"section","className":"is-style-notice-tip","align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
<section class="wp-block-group alignwide is-style-notice-tip">
	<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'New: pattern library expanded to 80+ sections.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-link"} --><div class="wp-block-button is-style-link"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'See what is new', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</section>
<!-- /wp:group -->
