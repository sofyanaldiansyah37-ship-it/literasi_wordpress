<?php
/**
 * Title: Blog · Magazine grid
 * Slug: arneiron/blog-magazine
 * Categories: arneiron-blog
 * Keywords: blog, magazine, grid
 * Viewport Width: 1200
 * Description: A magazine-style post grid.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:query {"queryId":0,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"align":"wide"} -->
	<div class="wp-block-query alignwide">
		<!-- wp:post-template {"layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","className":"is-style-rounded"} /-->
		<!-- wp:post-terms {"term":"category","fontSize":"xs","textColor":"accent"} /-->
		<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"md"} /-->
		<!-- /wp:post-template -->
		<!-- wp:query-no-results --><!-- wp:paragraph {"textColor":"subtle"} --><p class="has-subtle-color has-text-color"><?php esc_html_e( 'No posts yet.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
