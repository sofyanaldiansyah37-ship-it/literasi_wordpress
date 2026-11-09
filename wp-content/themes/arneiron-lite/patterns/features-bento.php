<?php
/**
 * Title: Features · Bento grid
 * Slug: arneiron/features-bento
 * Categories: arneiron-features
 * Keywords: bento, grid, features
 * Viewport Width: 1200
 * Description: A bento-style grid of feature tiles.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"14rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"is-style-card","style":{"dimensions":{"minHeight":"200px"}},"layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card" style="min-height:200px"><!-- wp:heading {"level":3,"fontSize":"lg"} --><h3 class="wp-block-heading has-lg-font-size"><?php esc_html_e( 'Fast by default', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Tiny footprint.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-panel","style":{"dimensions":{"minHeight":"200px"}},"layout":{"type":"constrained"}} --><div class="wp-block-group is-style-panel" style="min-height:200px"><!-- wp:heading {"level":3,"fontSize":"lg"} --><h3 class="wp-block-heading has-lg-font-size"><?php esc_html_e( 'Composable', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Mix any blocks.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-well","style":{"dimensions":{"minHeight":"200px"}},"layout":{"type":"constrained"}} --><div class="wp-block-group is-style-well" style="min-height:200px"><!-- wp:heading {"level":3,"fontSize":"lg"} --><h3 class="wp-block-heading has-lg-font-size"><?php esc_html_e( 'Skinnable', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'One file recolors all.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
