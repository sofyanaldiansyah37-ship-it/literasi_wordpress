<?php
/**
 * Title: Query Compact
 * Slug: arneiron/query-compact
 * Description: Card list of recent posts. Includes a styled empty state (when no posts exist) and pagination.
 * Categories: arneiron
 * Inserter: yes
 * Pattern: Query Loop — compact card list (empty-state-safe)
 * =============================================================================
 * The single content-listing component reused by front-page, home, archive,
 * search and index (component-design / template-hierarchy skills). The
 * `wp:query-no-results` branch is what makes a freshly-installed, empty site
 * look intentional instead of broken (empty-states / QA #21, #22).
 *
 * Cards are <article> with a heading (single H1 rule preserved by the owning
 * template — here they are H3) and an accessible byline.
 *
 * @package ArneIronBase
 */

?>
<!-- wp:query {"className":"query-compact","queryId":1,"query":{"perPage":6,"postType":"post","order":"desc","orderBy":"date"}} -->
<div class="wp-block-query query-compact">

	<!-- wp:post-template -->

		<!-- wp:group {"tagName":"article","className":"card query-compact__item","style":{"border":{"radius":"var(--wp--custom--radius--md)"},"spacing":{"padding":{"top":"var:preset|spacing|5","right":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|5"}},"color":{"background":"var:preset|color|surface"}}} -->
		<article class="wp-block-group card query-compact__item has-background" style="border-radius:var(--wp--custom--radius--md);background-color:var(--wp--preset--color--surface);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--5);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--5)">

			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"var(--wp--custom--radius--sm)"}}} /-->

			<!-- wp:post-title {"level":3,"isLink":true} /-->

			<!-- wp:post-date {"fontSize":"sm","className":"query-compact__date"} /-->

			<!-- wp:post-excerpt {"showMoreOnNewLine":false} /-->

		</article>
		<!-- /wp:group -->

	<!-- /wp:post-template -->

	<?php /* Empty state — styled, actionable, not a bare "Nothing found" line. */ ?>
	<!-- wp:query-no-results -->
		<!-- wp:group {"className":"empty","style":{"spacing":{"padding":{"top":"var:preset|spacing|7","bottom":"var:preset|spacing|7"}},"color":{"background":"var:preset|color|surface"}}} -->
		<div class="wp-block-group empty has-background" style="background-color:var(--wp--preset--color--surface);padding-top:var(--wp--preset--spacing--7);padding-bottom:var(--wp--preset--spacing--7)">

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"><?php esc_html_e( 'Nothing here yet.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
			<p class="has-text-align-center has-sm-font-size"><?php esc_html_e( 'When you publish a post, it will appear here automatically.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->
	<!-- /wp:query-no-results -->

	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

</div>
<!-- /wp:query -->
