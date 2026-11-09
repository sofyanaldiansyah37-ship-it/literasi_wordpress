<?php
/**
 * Title: Cards · Blog grid
 * Slug: arneiron/cards-blog
 * Categories: arneiron-cards
 * Keywords: cards, blog, grid, posts
 * Viewport Width: 1200
 * Description: A query-loop of blog cards.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Latest posts', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:query {"queryId":0,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide">
		<!-- wp:post-template {"className":"is-style-cards","layout":{"type":"grid","minimumColumnWidth":"18rem"}} -->
		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","className":"is-style-rounded"} /-->
		<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"md"} /-->
		<!-- wp:post-excerpt {"excerptLength":18} /-->
		<!-- /wp:post-template -->
		<!-- wp:query-no-results --><!-- wp:paragraph {"textColor":"subtle"} --><p class="has-subtle-color has-text-color"><?php esc_html_e( 'No posts yet.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --><!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
