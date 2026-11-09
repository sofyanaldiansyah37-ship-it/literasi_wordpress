<?php
/**
 * Title: Contact · Map + form
 * Slug: arneiron/contact-map-form
 * Categories: arneiron-contact
 * Keywords: contact, map, form
 * Viewport Width: 1000
 * Description: A map placeholder beside a form placeholder.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"style":{"dimensions":{"minHeight":"320px"},"border":{"radius":"var:custom|radius|lg"}},"backgroundColor":"surface-3","layout":{"type":"constrained","justifyContent":"center"}} --><div class="wp-block-group has-surface-3-background-color has-background" style="border-radius:var(--wp--custom--radius--lg);min-height:320px"><!-- wp:paragraph {"align":"center","textColor":"subtle","fontSize":"sm"} --><p class="has-text-align-center has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Map', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Visit us', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( '123 Gray Street, Suite 100', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
