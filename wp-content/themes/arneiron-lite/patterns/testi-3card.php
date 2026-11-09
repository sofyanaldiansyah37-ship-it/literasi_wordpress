<?php
/**
 * Title: Testimonials · 3-card grid
 * Slug: arneiron/testi-3card
 * Categories: arneiron-testimonials
 * Keywords: testimonials, quotes, reviews
 * Viewport Width: 1200
 * Description: Three testimonial cards.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":2} --><h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'What people say', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column --><div class="wp-block-column"><!-- wp:quote {"className":"is-style-card"} --><blockquote class="wp-block-quote is-style-card"><!-- wp:paragraph --><p><?php esc_html_e( 'It saved our team weeks of design work.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Alex, Product Lead', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:quote {"className":"is-style-card"} --><blockquote class="wp-block-quote is-style-card"><!-- wp:paragraph --><p><?php esc_html_e( 'The grayscale base makes theming effortless.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Priya, Designer', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:quote {"className":"is-style-card"} --><blockquote class="wp-block-quote is-style-card"><!-- wp:paragraph --><p><?php esc_html_e( 'Accessible, fast, and easy to extend.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Sam, Engineer', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
