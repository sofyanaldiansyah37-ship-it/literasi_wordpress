<?php
/**
 * Title: Contact · Split
 * Slug: arneiron/contact-split
 * Categories: arneiron-contact
 * Keywords: contact, split, cta
 * Viewport Width: 900
 * Description: A split contact CTA with heading and details.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center"} --><div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":2,"fontSize":"xl"} --><h2 class="wp-block-heading has-xl-font-size"><?php esc_html_e( 'Questions? Talk to us.', 'arneiron-lite' ); ?></h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"center"} --><div class="wp-block-column is-vertically-aligned-center"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Email us', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:column --></div><!-- /wp:columns -->
</section>
<!-- /wp:group -->
