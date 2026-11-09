<?php
/**
 * Title: Content · Callout blocks
 * Slug: arneiron/content-callouts
 * Categories: arneiron-content
 * Keywords: content, callout, notice
 * Viewport Width: 780
 * Description: Info / note / warning / tip callouts.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"className":"is-style-notice-info","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-notice-info"><!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><strong><?php esc_html_e( 'Info:', 'arneiron-lite' ); ?></strong> <?php esc_html_e( 'Callouts are built from group block styles.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
	<!-- wp:group {"className":"is-style-notice-warning","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-notice-warning"><!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><strong><?php esc_html_e( 'Warning:', 'arneiron-lite' ); ?></strong> <?php esc_html_e( 'They stay achromatic until a skin colorizes them.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
	<!-- wp:group {"className":"is-style-notice-tip","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-notice-tip"><!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size"><strong><?php esc_html_e( 'Tip:', 'arneiron-lite' ); ?></strong> <?php esc_html_e( 'Use them to guide the reader.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
</section>
<!-- /wp:group -->
