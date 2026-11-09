<?php
/**
 * Title: Hero · Split
 * Slug: arneiron/hero-split
 * Categories: arneiron-hero
 * Keywords: hero, split, image, cta
 * Viewport Width: 1400
 * Block Types: core/group
 * Description: Two-column hero — headline and CTAs beside a media placeholder.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|70"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
			<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Ship with confidence', 'arneiron-lite' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:heading {"level":1,"fontSize":"3xl"} -->
			<h1 class="wp-block-heading has-3-xl-font-size"><?php esc_html_e( 'The neutral base for every build.', 'arneiron-lite' ); ?></h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"md","textColor":"subtle"} -->
			<p class="has-subtle-color has-text-color has-md-font-size"><?php esc_html_e( 'A grayscale foundation of hundreds of working blocks and patterns — recolor everything with a single skin.', 'arneiron-lite' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Get started', 'arneiron-lite' ); ?></a></div>
				<!-- /wp:button -->
				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Learn more', 'arneiron-lite' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:group {"style":{"dimensions":{"minHeight":"320px"},"border":{"radius":"var:custom|radius|lg"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"surface-3","layout":{"type":"constrained","justifyContent":"center"}} -->
			<div class="wp-block-group has-surface-3-background-color has-background" style="border-radius:var(--wp--custom--radius--lg);min-height:320px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
				<!-- wp:paragraph {"align":"center","textColor":"subtle","fontSize":"sm"} -->
				<p class="has-text-align-center has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Product screenshot', 'arneiron-lite' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</section>
<!-- /wp:group -->
