<?php
/**
 * Title: Testimonials · Logo + quote
 * Slug: arneiron/testi-logo-quote
 * Categories: arneiron-testimonials
 * Keywords: testimonial, logo, quote
 * Viewport Width: 900
 * Description: A single quote with a brand logo placeholder.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:paragraph {"align":"center","textColor":"subtle","fontSize":"xl","style":{"typography":{"fontWeight":"700"}}} --><p class="has-text-align-center has-subtle-color has-text-color has-xl-font-size" style="font-weight:700"><?php esc_html_e( 'LOGO', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:quote {"className":"is-style-plain"} --><blockquote class="wp-block-quote is-style-plain"><!-- wp:paragraph {"align":"center","fontSize":"lg"} --><p class="has-text-align-center has-lg-font-size"><?php esc_html_e( 'We replaced three tools with this one theme.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Head of Web, Acme', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote -->
</section>
<!-- /wp:group -->
