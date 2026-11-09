<?php
/**
 * Title: Front page with latest posts
 * Slug: arneiron/template-front-landing
 * Categories: arneiron-page
 * Keywords: front page, home, landing, posts
 * Viewport Width: 1400
 * Inserter: no
 * Description: A hero, three feature cards and the latest posts.
 *
 * ArneIron Lite's front page while Settings > Reading shows "Your latest posts"
 * (inc/front-landing.php). The template shows this pattern so its words are
 * translatable. The intro (hero + feature cards) shows on the first page only;
 * later pages list posts only, with a visually hidden h1.
 *
 * @package ArneIron_Lite
 */

?>
<!-- wp:site-title {"level":1,"isLink":false,"className":"screen-reader-text arneiron-front-paged-h1"} /-->

<!-- wp:group {"align":"full","className":"arneiron-front-intro","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull arneiron-front-intro">
	<!-- wp:pattern {"slug":"arneiron/hero"} /-->

	<!-- wp:group {"align":"full","anchor":"features","layout":{"type":"constrained"}} -->
	<div id="features" class="wp-block-group alignfull">
		<!-- wp:pattern {"slug":"arneiron/features-icon-3col"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"arneiron-front-posts","style":{"spacing":{"padding":{"top":"var:preset|spacing|7","bottom":"var:preset|spacing|8"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group arneiron-front-posts" style="padding-top:var(--wp--preset--spacing--7);padding-bottom:var(--wp--preset--spacing--8)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Latest posts', 'arneiron-lite' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:query {"className":"query-compact","queryId":2,"query":{"perPage":6,"postType":"post","order":"desc","orderBy":"date","inherit":true},"style":{"spacing":{"margin":{"top":"var:preset|spacing|6"}}}} -->
	<div class="wp-block-query query-compact" style="margin-top:var(--wp--preset--spacing--6)">
		<!-- wp:post-template -->
			<!-- wp:group {"tagName":"article","className":"card query-compact__item","style":{"border":{"radius":"var(--wp--custom--radius--md)"},"spacing":{"padding":{"top":"var:preset|spacing|5","right":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|5"}},"color":{"background":"var:preset|color|surface"}}} -->
			<article class="wp-block-group card query-compact__item has-background" style="background-color:var(--wp--preset--color--surface);border-radius:var(--wp--custom--radius--md);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--5);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--5)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"var(--wp--custom--radius--sm)"}}} /-->

				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"xl","style":{"typography":{"letterSpacing":"normal","textTransform":"none"}}} /-->

				<!-- wp:post-date {"fontSize":"sm","className":"query-compact__date"} /-->

				<!-- wp:post-excerpt {"showMoreOnNewLine":false} /-->
			</article>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"><?php esc_html_e( 'When you publish a post, it will appear here automatically.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:query -->
</section>
<!-- /wp:group -->
