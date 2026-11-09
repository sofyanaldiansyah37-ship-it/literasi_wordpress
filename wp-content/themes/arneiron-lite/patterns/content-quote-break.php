<?php
/**
 * Title: Content · Quote break
 * Slug: arneiron/content-quote-break
 * Categories: arneiron-content
 * Keywords: content, quote, pullquote
 * Viewport Width: 780
 * Description: A large pullquote to break up an article.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:pullquote {"className":"is-style-bracketed"} --><figure class="wp-block-pullquote is-style-bracketed"><blockquote><p><?php esc_html_e( 'Good defaults are invisible; you only notice bad ones.', 'arneiron-lite' ); ?></p></blockquote></figure><!-- /wp:pullquote -->
</section>
<!-- /wp:group -->
