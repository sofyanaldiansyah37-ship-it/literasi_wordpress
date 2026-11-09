<?php
/**
 * Title: Account · Usage & balance
 * Slug: arneiron/account-usage-balance
 * Categories: arneiron-account
 * Keywords: account, usage, balance
 * Viewport Width: 900
 * Description: A usage/balance panel with a progress bar.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"className":"is-style-card","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group is-style-card">
		<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} --><div class="wp-block-group"><!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Usage this month', 'arneiron-lite' ); ?></h3><!-- /wp:heading --><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( '5,800 / 10,000', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></div><!-- /wp:group -->
		<!-- wp:group {"style":{"border":{"radius":"var:custom|radius|pill"}},"backgroundColor":"surface-3","layout":{"type":"constrained"}} --><div class="wp-block-group has-surface-3-background-color has-background" style="border-radius:var(--wp--custom--radius--pill)"><!-- wp:group {"style":{"dimensions":{"minHeight":"10px"},"border":{"radius":"var:custom|radius|pill"}},"backgroundColor":"contrast","layout":{"type":"constrained"},"className":"arneiron-w-58"} --><div class="wp-block-group arneiron-w-58 has-contrast-background-color has-background" style="border-radius:var(--wp--custom--radius--pill);min-height:10px"></div><!-- /wp:group --></div><!-- /wp:group -->
		<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Buy more credits', 'arneiron-lite' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
