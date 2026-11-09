<?php
/**
 * Title: Content · Two-column text
 * Slug: arneiron/content-2col
 * Categories: arneiron-content
 * Keywords: content, columns, text
 * Viewport Width: 1000
 * Description: Two columns of body text.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p><?php esc_html_e( 'The base theme keeps opinions to a minimum so your content leads. Typography, spacing, and color all come from a small set of tokens.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p><?php esc_html_e( 'Because everything references tokens, a single skin file can transform the whole look without touching a line of markup.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
