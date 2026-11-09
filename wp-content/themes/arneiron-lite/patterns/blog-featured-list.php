<?php
/**
 * Title: Blog · Featured + list
 * Slug: arneiron/blog-featured-list
 * Categories: arneiron-blog
 * Keywords: blog, featured, list
 * Viewport Width: 1100
 * Description: A featured post beside a compact list.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"60%"} --><div class="wp-block-column" style="flex-basis:60%"><!-- wp:query {"queryId":0,"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false}} --><div class="wp-block-query"><!-- wp:post-template --><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","className":"is-style-rounded"} /--><!-- wp:post-title {"isLink":true,"level":2,"fontSize":"xl"} /--><!-- wp:post-excerpt /--><!-- /wp:post-template --></div><!-- /wp:query --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'More posts', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:latest-posts {"postsToShow":4,"displayPostDate":true,"className":"is-style-minimal"} /--></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
