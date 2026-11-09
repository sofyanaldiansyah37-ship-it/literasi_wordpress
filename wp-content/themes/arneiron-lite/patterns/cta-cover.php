<?php
/**
 * Title: CTA · Full-bleed cover
 * Slug: arneiron/cta-cover
 * Categories: arneiron-cta
 * Keywords: cta, cover
 * Viewport Width: 1400
 * Description: Full-bleed cover CTA.
 */
?>
<!-- wp:cover {"overlayColor":"contrast-2","dimRatio":60,"minHeight":48,"minHeightUnit":"vh","align":"full","contentPosition":"center center"} -->
<div class="wp-block-cover alignfull" style="min-height:48vh">
	<span aria-hidden="true" class="wp-block-cover__background has-contrast-2-background-color has-background-dim-60 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"2xl","textColor":"surface"} --><h2 class="wp-block-heading has-text-align-center has-surface-color has-text-color has-2-xl-font-size"><?php esc_html_e( 'Build something great', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"surface","textColor":"contrast"} --><div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-surface-background-color has-text-color has-background wp-element-button" href="#"><?php esc_html_e( 'Get started', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	</div>
</div>
<!-- /wp:cover -->
