<?php
/**
 * Title: Content · TOC + content
 * Slug: arneiron/content-toc
 * Categories: arneiron-content
 * Keywords: content, toc, table of contents
 * Viewport Width: 1000
 * Description: A sticky-ish table of contents beside content.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"30%"} --><div class="wp-block-column" style="flex-basis:30%"><!-- wp:group {"className":"is-style-panel","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-panel"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'On this page', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li><?php esc_html_e( 'Overview', 'arneiron-lite' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'Setup', 'arneiron-lite' ); ?></li><!-- /wp:list-item --><!-- wp:list-item --><li><?php esc_html_e( 'Skins', 'arneiron-lite' ); ?></li><!-- /wp:list-item --></ul><!-- /wp:list --></div><!-- /wp:group --></div><!-- /wp:column -->
		<!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"lg"} --><h2 class="wp-block-heading has-lg-font-size"><?php esc_html_e( 'Overview', 'arneiron-lite' ); ?></h2><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle"} --><p class="has-subtle-color has-text-color"><?php esc_html_e( 'A short overview of what the theme provides and how to extend it.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
