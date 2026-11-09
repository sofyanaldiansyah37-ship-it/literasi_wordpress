<?php
/**
 * Title: Blog · Post list
 * Slug: arneiron/blog-list
 * Categories: arneiron-blog
 * Keywords: blog, list, posts
 * Viewport Width: 900
 * Description: A simple divided list of posts.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:query {"queryId":0,"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"is-style-list-divided","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
		<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"lg"} /-->
		<!-- wp:post-date {"fontSize":"xs","textColor":"subtle"} /-->
		<!-- wp:post-excerpt {"excerptLength":24} /-->
		<!-- /wp:post-template -->
		<!-- wp:query-no-results --><!-- wp:paragraph {"textColor":"subtle"} --><p class="has-subtle-color has-text-color"><?php esc_html_e( 'No posts yet.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
