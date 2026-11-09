<?php
/**
 * Title: Newsletter · Inline
 * Slug: arneiron/newsletter-inline
 * Categories: arneiron-commerce
 * Keywords: newsletter, signup, email, inline
 * Viewport Width: 560
 * Inserter: true
 * Description: Inline email + subscribe row (used by the footer).
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group">
	<!-- wp:group {"style":{"border":{"width":"1px","radius":"var:custom|radius|md"}},"borderColor":"border","backgroundColor":"surface","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group has-border-color has-border-border-color has-surface-background-color has-background" style="border-width:1px;border-radius:var(--wp--custom--radius--md)">
		<!-- wp:paragraph {"textColor":"subtle","fontSize":"sm","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} -->
		<p class="has-subtle-color has-text-color has-sm-font-size" style="padding:var(--wp--preset--spacing--20) var(--wp--preset--spacing--30)"><?php esc_html_e( 'you@example.com', 'arneiron-lite' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:buttons -->
	<div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Subscribe', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
