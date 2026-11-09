<?php
/**
 * Title: Hero · Minimal Headline
 * Slug: arneiron/hero-minimal
 * Categories: arneiron-hero
 * Keywords: hero, minimal, headline
 * Viewport Width: 1000
 * Description: A minimal editorial headline block.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":1,"fontSize":"4xl","style":{"typography":{"lineHeight":"1.05"}}} -->
	<h1 class="wp-block-heading has-4-xl-font-size" style="line-height:1.05"><?php esc_html_e( 'Design that gets out of the way.', 'arneiron-lite' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"fontSize":"lg","textColor":"subtle","style":{"layout":{"selfStretch":"fixed","flexSize":"66ch"}}} -->
	<p class="has-subtle-color has-text-color has-lg-font-size"><?php esc_html_e( 'No color opinions. No noise. Just a precise gray system you can extend.', 'arneiron-lite' ); ?></p>
	<!-- /wp:paragraph -->
</section>
<!-- /wp:group -->
