<?php
/**
 * Title: Gallery · Before / after
 * Slug: arneiron/gallery-before-after
 * Categories: arneiron-gallery
 * Keywords: gallery, before, after, compare
 * Viewport Width: 900
 * Description: Two-panel before/after comparison.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'Before', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:group {"style":{"dimensions":{"minHeight":"260px"},"border":{"radius":"var:custom|radius|lg"}},"backgroundColor":"surface-2","layout":{"type":"constrained"}} --><div class="wp-block-group has-surface-2-background-color has-background" style="border-radius:var(--wp--custom--radius--lg);min-height:260px"></div><!-- /wp:group --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'After', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:group {"style":{"dimensions":{"minHeight":"260px"},"border":{"radius":"var:custom|radius|lg"}},"backgroundColor":"surface-3","layout":{"type":"constrained"}} --><div class="wp-block-group has-surface-3-background-color has-background" style="border-radius:var(--wp--custom--radius--lg);min-height:260px"></div><!-- /wp:group --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
