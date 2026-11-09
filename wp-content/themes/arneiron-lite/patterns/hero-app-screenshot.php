<?php
/**
 * Title: Hero · App Screenshot
 * Slug: arneiron/hero-app-screenshot
 * Categories: arneiron-hero
 * Keywords: hero, app, screenshot, saas
 * Viewport Width: 1400
 * Description: Centered app hero with a large framed screenshot below.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"3xl"} -->
		<h1 class="wp-block-heading has-text-align-center has-3-xl-font-size"><?php esc_html_e( 'Your workspace, unified.', 'arneiron-lite' ); ?></h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","fontSize":"md","textColor":"subtle"} -->
		<p class="has-text-align-center has-subtle-color has-text-color has-md-font-size"><?php esc_html_e( 'One place for everything your team ships.', 'arneiron-lite' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Try it free', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"wide","style":{"dimensions":{"minHeight":"420px"},"border":{"width":"1px","radius":"var:custom|radius|lg"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"borderColor":"border","backgroundColor":"surface-3","layout":{"type":"constrained","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide has-border-color has-border-border-color has-surface-3-background-color has-background" style="border-width:1px;border-radius:var(--wp--custom--radius--lg);min-height:420px;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:paragraph {"align":"center","textColor":"subtle","fontSize":"sm"} -->
		<p class="has-text-align-center has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'App screenshot', 'arneiron-lite' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
