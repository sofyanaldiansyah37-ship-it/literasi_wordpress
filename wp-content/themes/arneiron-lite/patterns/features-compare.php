<?php
/**
 * Title: Features · Comparison
 * Slug: arneiron/features-compare
 * Categories: arneiron-features
 * Keywords: features, comparison, table
 * Viewport Width: 1000
 * Description: A comparison table.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":2} --><h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Compare plans', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:table {"className":"is-style-stripes"} -->
	<figure class="wp-block-table is-style-stripes"><table><thead><tr><th><?php esc_html_e( 'Feature', 'arneiron-lite' ); ?></th><th><?php esc_html_e( 'Free', 'arneiron-lite' ); ?></th><th><?php esc_html_e( 'Pro', 'arneiron-lite' ); ?></th></tr></thead><tbody><tr><td><?php esc_html_e( 'Templates', 'arneiron-lite' ); ?></td><td>&#10003;</td><td>&#10003;</td></tr><tr><td><?php esc_html_e( 'Patterns', 'arneiron-lite' ); ?></td><td>&#10003;</td><td>&#10003;</td></tr><tr><td><?php esc_html_e( 'Priority support', 'arneiron-lite' ); ?></td><td>&#8212;</td><td>&#10003;</td></tr></tbody></table></figure>
	<!-- /wp:table -->
</section>
<!-- /wp:group -->
