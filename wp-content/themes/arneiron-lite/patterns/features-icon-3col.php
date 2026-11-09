<?php
/**
 * Title: Features · 3-column icons
 * Slug: arneiron/features-icon-3col
 * Categories: arneiron-features
 * Keywords: features, grid, icons
 * Viewport Width: 1200
 * Description: Three feature cards in a responsive grid.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":2} -->
	<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Why teams choose us', 'arneiron-lite' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-card">
				<!-- wp:paragraph {"fontSize":"2xl"} --><p class="has-2-xl-font-size">&#9673;</p><!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Fast', 'arneiron-lite' ); ?></h3><!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Ship in minutes with sensible defaults everywhere.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-card">
				<!-- wp:paragraph {"fontSize":"2xl"} --><p class="has-2-xl-font-size">&#9635;</p><!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Flexible', 'arneiron-lite' ); ?></h3><!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Token-driven styling adapts to any brand.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group is-style-card">
				<!-- wp:paragraph {"fontSize":"2xl"} --><p class="has-2-xl-font-size">&#9634;</p><!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Accessible', 'arneiron-lite' ); ?></h3><!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'AA contrast and keyboard support out of the box.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
