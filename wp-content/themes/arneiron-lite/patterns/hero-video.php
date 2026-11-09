<?php
/**
 * Title: Hero · Video
 * Slug: arneiron/hero-video
 * Categories: arneiron-hero
 * Keywords: hero, video
 * Viewport Width: 1400
 * Description: Hero with a video placeholder and headline.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"2xl"} -->
	<h1 class="wp-block-heading has-text-align-center has-2-xl-font-size"><?php esc_html_e( 'See it in motion.', 'arneiron-lite' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:group {"align":"wide","style":{"dimensions":{"minHeight":"440px"},"border":{"radius":"var:custom|radius|lg"}},"backgroundColor":"contrast-2","textColor":"surface","layout":{"type":"constrained","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide has-surface-color has-contrast-2-background-color has-text-color has-background" style="border-radius:var(--wp--custom--radius--lg);min-height:440px">
		<!-- wp:paragraph {"align":"center","fontSize":"lg"} -->
		<p class="has-text-align-center has-lg-font-size">&#9658; <?php esc_html_e( 'Play video', 'arneiron-lite' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
