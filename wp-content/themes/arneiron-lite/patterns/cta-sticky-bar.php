<?php
/**
 * Title: CTA · Sticky bar
 * Slug: arneiron/cta-sticky-bar
 * Categories: arneiron-cta
 * Keywords: cta, sticky, bar
 * Viewport Width: 1200
 * Description: A full-width sticky CTA bar (position sticky).
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"contrast","textColor":"accent-contrast","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"position":{"type":"sticky","top":"0px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-accent-contrast-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Limited-time launch offer', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
		<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"surface","textColor":"contrast"} --><div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-surface-background-color has-text-color has-background wp-element-button" href="#"><?php esc_html_e( 'Claim it', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
