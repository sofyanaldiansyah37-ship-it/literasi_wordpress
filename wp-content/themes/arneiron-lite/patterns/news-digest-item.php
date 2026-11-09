<?php
/**
 * Title: Blog · News digest item (images beside the text)
 * Slug: arneiron/news-digest-item
 * Categories: arneiron-blog
 * Keywords: news, digest, item, images, side, aside, l2
 * Viewport Width: 1200
 * Description: One item of a 24-hour news digest: its text, with its own images in a side column above 1000px and stacked beneath the text below that.
 *
 * Built for hub#5409 (owner call 2026-10-12). The owner's reference is the Kant
 * "L2" layer on vania-novikau.me — but L2 renders NO images at desktop widths
 * (`.d-lg-none` hides its image track above 1000px), so this is new work rather
 * than a repositioning. L2 supplies the breakpoint and the mobile stack; the
 * desktop side column did not previously exist anywhere in this estate.
 *
 * Deliberately 100% CORE blocks:
 *   - the owner's own ingest pipeline must be able to emit it;
 *   - it has to survive KSES (a CLI/REST write is KSES-stripped while both the
 *     DB and the wire still read green — only the rendered page shows the loss);
 *   - the AIWP agent can write core blocks and cannot write a bespoke one.
 *
 * `core/gallery` and not `core/media-text`, because the requirement is image*s*:
 * "каждая новость содержит картинки отдельные". media-text holds exactly one.
 *
 * @package ArneIron
 */

?>
<!-- wp:group {"tagName":"article","className":"news-item","layout":{"type":"constrained"}} -->
<article class="wp-block-group news-item">
	<!-- wp:columns {"className":"is-style-news-item"} -->
	<div class="wp-block-columns is-style-news-item">

		<!-- wp:column {"className":"news-item__body"} -->
		<div class="wp-block-column news-item__body">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php esc_html_e( 'Headline of this news item', 'arneiron-lite' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"news-item__meta"} -->
			<p class="news-item__meta"><?php esc_html_e( 'Source · 14:05 UTC', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'The body of the item. Keep it to the length a reader will actually finish — the side column is an illustration track, not a second article, and the two should end at roughly the same place.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'A second paragraph, so the measure of the text column is visible while editing and the side images have something to sit beside.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"news-item__media"} -->
		<div class="wp-block-column news-item__media">
			<!-- wp:gallery {"columns":1,"linkTo":"none","className":"is-style-news-item-media"} -->
			<figure class="wp-block-gallery has-nested-images columns-1 is-cropped is-style-news-item-media"><!-- wp:image {"className":"is-style-rounded"} --><figure class="wp-block-image is-style-rounded"><img alt=""/></figure><!-- /wp:image --><!-- wp:image {"className":"is-style-rounded"} --><figure class="wp-block-image is-style-rounded"><img alt=""/></figure><!-- /wp:image --></figure>
			<!-- /wp:gallery -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->
</article>
<!-- /wp:group -->
