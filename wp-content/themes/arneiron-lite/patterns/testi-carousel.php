<?php
/**
 * Title: Testimonials · Carousel (static)
 * Slug: arneiron/testi-carousel
 * Categories: arneiron-testimonials
 * Keywords: testimonial, carousel, scroll
 * Viewport Width: 1000
 * Description: A horizontally scrollable row of testimonial cards.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Loved by builders', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"className":"arneiron-scroll-x"} -->
	<div class="wp-block-group alignwide arneiron-scroll-x">
		<!-- wp:quote {"className":"is-style-card arneiron-minw-18rem","style":{"dimensions":{"minHeight":"160px"}}} --><blockquote class="wp-block-quote is-style-card arneiron-minw-18rem" style="min-height:160px"><!-- wp:paragraph --><p><?php esc_html_e( 'Fast to adopt.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Riley', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote -->
		<!-- wp:quote {"className":"is-style-card arneiron-minw-18rem"} --><blockquote class="wp-block-quote is-style-card arneiron-minw-18rem"><!-- wp:paragraph --><p><?php esc_html_e( 'Great defaults.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Noor', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote -->
		<!-- wp:quote {"className":"is-style-card arneiron-minw-18rem"} --><blockquote class="wp-block-quote is-style-card arneiron-minw-18rem"><!-- wp:paragraph --><p><?php esc_html_e( 'Just works.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><cite><?php esc_html_e( 'Diego', 'arneiron-lite' ); ?></cite></blockquote><!-- /wp:quote -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
