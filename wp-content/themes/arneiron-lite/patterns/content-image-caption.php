<?php
/**
 * Title: Content · Image with caption
 * Slug: arneiron/content-image-caption
 * Categories: arneiron-content
 * Keywords: content, image, caption
 * Viewport Width: 900
 * Description: A wide framed image with a caption.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:image {"align":"wide","className":"is-style-frame"} --><figure class="wp-block-image alignwide is-style-frame"><img alt=""/><figcaption class="wp-element-caption"><?php esc_html_e( 'A wide, framed image with a muted caption.', 'arneiron-lite' ); ?></figcaption></figure><!-- /wp:image -->
</section>
<!-- /wp:group -->
