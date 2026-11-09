<?php
/**
 * Title: Account · Dashboard
 * Slug: arneiron/account-dashboard
 * Categories: arneiron-account
 * Keywords: account, dashboard, panel
 * Viewport Width: 1100
 * Description: Gray account dashboard surface with summary cards.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":1,"fontSize":"xl"} --><h1 class="wp-block-heading has-xl-font-size"><?php esc_html_e( 'Dashboard', 'arneiron-lite' ); ?></h1><!-- /wp:heading -->
	<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"16rem"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'Balance', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:heading {"level":4,"fontSize":"2xl","style":{"typography":{"fontFamily":"var:preset|font-family|mono"}}} --><h4 class="wp-block-heading has-2-xl-font-size" style="font-family:var(--wp--preset--font-family--mono)"><?php esc_html_e( '4,200', 'arneiron-lite' ); ?></h4><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"xs"} --><p class="has-subtle-color has-text-color has-xs-font-size"><?php esc_html_e( 'credits', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'Projects', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:heading {"level":4,"fontSize":"2xl","style":{"typography":{"fontFamily":"var:preset|font-family|mono"}}} --><h4 class="wp-block-heading has-2-xl-font-size" style="font-family:var(--wp--preset--font-family--mono)"><?php esc_html_e( '7', 'arneiron-lite' ); ?></h4><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"xs"} --><p class="has-subtle-color has-text-color has-xs-font-size"><?php esc_html_e( 'active', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"className":"is-style-card","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-card"><!-- wp:heading {"level":3,"className":"is-style-kicker"} --><h3 class="wp-block-heading is-style-kicker"><?php esc_html_e( 'Plan', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:heading {"level":4,"fontSize":"lg"} --><h4 class="wp-block-heading has-lg-font-size"><?php esc_html_e( 'Pro', 'arneiron-lite' ); ?></h4><!-- /wp:heading --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Manage', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
