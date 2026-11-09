<?php
/**
 * Title: Blog · Author box
 * Slug: arneiron/blog-author-box
 * Categories: arneiron-blog
 * Keywords: blog, author, bio
 * Viewport Width: 800
 * Description: An author bio box for the end of a post.
 */
?>
<!-- wp:group {"tagName":"section","className":"is-style-panel","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<section class="wp-block-group is-style-panel" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
	<!-- wp:group {"style":{"dimensions":{"minHeight":"64px"},"border":{"radius":"var:custom|radius|pill"}},"backgroundColor":"surface-3","layout":{"type":"constrained"},"className":"arneiron-minw-64"} --><div class="wp-block-group arneiron-minw-64 has-surface-3-background-color has-background" style="border-radius:var(--wp--custom--radius--pill);min-height:64px"></div><!-- /wp:group -->
	<!-- wp:group {"layout":{"type":"constrained"}} --><div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}}} --><p style="font-weight:600"><?php esc_html_e( 'Written by Jamie Lee', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Founder and lead designer. Writes about calm, accessible interfaces.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
</section>
<!-- /wp:group -->
