<?php
/**
 * Title: Contact · Form + info
 * Slug: arneiron/contact-form-info
 * Categories: arneiron-contact
 * Keywords: contact, form, info
 * Viewport Width: 1000
 * Description: Contact details beside a comment-style form placeholder.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"xl"} --><h2 class="wp-block-heading has-xl-font-size"><?php esc_html_e( 'Get in touch', 'arneiron-lite' ); ?></h2><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle"} --><p class="has-subtle-color has-text-color"><?php esc_html_e( 'We usually reply within one business day.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:list {"className":"is-style-none"} --><ul class="wp-block-list is-style-none"><!-- wp:list-item --><li><?php esc_html_e( 'hello@example.com', 'arneiron-lite' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( '+1 555 0100', 'arneiron-lite' ); ?></li><!-- /wp:list-item --></ul><!-- /wp:list --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Add your contact form plugin block here.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
