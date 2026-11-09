<?php
/**
 * Title: Content · Code sample
 * Slug: arneiron/content-code
 * Categories: arneiron-content
 * Keywords: content, code, sample
 * Viewport Width: 780
 * Description: A code sample block.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Example', 'arneiron-lite' ); ?></h3><!-- /wp:heading -->
	<!-- wp:code --><pre class="wp-block-code"><code>add_theme_support( 'appearance-tools' );</code></pre><!-- /wp:code -->
</section>
<!-- /wp:group -->
