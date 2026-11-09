<?php
/**
 * Title: CTA · Centered band
 * Slug: arneiron/cta-centered
 * Categories: arneiron-cta
 * Keywords: cta, banner, centered
 * Viewport Width: 1000
 * Description: A centered call-to-action band.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"contrast","textColor":"accent-contrast","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<section class="wp-block-group alignfull has-accent-contrast-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"2xl"} --><h2 class="wp-block-heading has-text-align-center has-2-xl-font-size"><?php esc_html_e( 'Start building today', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center","textColor":"surface-3"} --><p class="has-text-align-center has-surface-3-color has-text-color"><?php esc_html_e( 'No credit card required.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"surface","textColor":"contrast"} --><div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-surface-background-color has-text-color has-background wp-element-button" href="#"><?php esc_html_e( 'Get started', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</section>
<!-- /wp:group -->
