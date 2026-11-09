<?php
/**
 * Title: Stats · 2x2
 * Slug: arneiron/stats-2x2
 * Categories: arneiron-stats
 * Keywords: stats, metrics, grid
 * Viewport Width: 800
 * Description: Four metrics in a two-by-two grid.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"12rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
	<div class="wp-block-group">
		<!-- wp:group {"className":"is-style-panel","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-panel"><!-- wp:heading {"level":3,"fontSize":"2xl","style":{"typography":{"fontFamily":"var:preset|font-family|mono"}}} --><h3 class="wp-block-heading has-2-xl-font-size" style="font-family:var(--wp--preset--font-family--mono)"><?php esc_html_e( '2M+', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Requests/day', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-panel","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-panel"><!-- wp:heading {"level":3,"fontSize":"2xl","style":{"typography":{"fontFamily":"var:preset|font-family|mono"}}} --><h3 class="wp-block-heading has-2-xl-font-size" style="font-family:var(--wp--preset--font-family--mono)"><?php esc_html_e( '40ms', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Median latency', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-panel","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-panel"><!-- wp:heading {"level":3,"fontSize":"2xl","style":{"typography":{"fontFamily":"var:preset|font-family|mono"}}} --><h3 class="wp-block-heading has-2-xl-font-size" style="font-family:var(--wp--preset--font-family--mono)"><?php esc_html_e( '120', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Countries', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-panel","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-panel"><!-- wp:heading {"level":3,"fontSize":"2xl","style":{"typography":{"fontFamily":"var:preset|font-family|mono"}}} --><h3 class="wp-block-heading has-2-xl-font-size" style="font-family:var(--wp--preset--font-family--mono)"><?php esc_html_e( '4.9', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Avg rating', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
