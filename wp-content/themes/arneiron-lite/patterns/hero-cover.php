<?php
/**
 * Title: Hero · Full-bleed Cover
 * Slug: arneiron/hero-cover
 * Categories: arneiron-hero
 * Keywords: hero, cover, overlay
 * Viewport Width: 1400
 * Description: Full-bleed cover hero with overlaid headline card.
 */
?>
<!-- wp:cover {"overlayColor":"contrast-2","dimRatio":70,"minHeight":72,"minHeightUnit":"vh","align":"full","className":"is-style-text-card"} -->
<div class="wp-block-cover alignfull is-style-text-card" style="min-height:72vh">
	<span aria-hidden="true" class="wp-block-cover__background has-contrast-2-background-color has-background-dim-70 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:heading {"level":1,"fontSize":"3xl"} -->
		<h1 class="wp-block-heading has-3-xl-font-size"><?php esc_html_e( 'Build on solid ground.', 'arneiron-lite' ); ?></h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"subtle"} -->
		<p class="has-subtle-color has-text-color"><?php esc_html_e( 'A cover hero that puts your message in a legible card over any image.', 'arneiron-lite' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Get started', 'arneiron-lite' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
</div>
<!-- /wp:cover -->
