<?php
/**
 * Title: Features · Tabbed (details)
 * Slug: arneiron/features-tabs
 * Categories: arneiron-features
 * Keywords: features, tabs, accordion, details
 * Viewport Width: 900
 * Description: Disclosure-based feature groups.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Explore the details', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:details {"showContent":true} --><details class="wp-block-details" open><summary><?php esc_html_e( 'Design system', 'arneiron-lite' ); ?></summary><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Tokens for color, type, spacing, radius and shadow.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></details><!-- /wp:details -->
	<!-- wp:details --><details class="wp-block-details"><summary><?php esc_html_e( 'Templates', 'arneiron-lite' ); ?></summary><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Every WordPress view, ready to edit.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></details><!-- /wp:details -->
	<!-- wp:details --><details class="wp-block-details"><summary><?php esc_html_e( 'Patterns', 'arneiron-lite' ); ?></summary><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Drop-in sections for any page.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></details><!-- /wp:details -->
</section>
<!-- /wp:group -->
