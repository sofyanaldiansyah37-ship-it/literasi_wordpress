<?php
/**
 * Title: Content · Table section
 * Slug: arneiron/content-table
 * Categories: arneiron-content
 * Keywords: content, table, data
 * Viewport Width: 900
 * Description: A striped data table in a content section.
 */
?>
<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"level":3,"fontSize":"md"} --><h3 class="wp-block-heading has-md-font-size"><?php esc_html_e( 'Specifications', 'arneiron-lite' ); ?></h3><!-- /wp:heading -->
	<!-- wp:table {"className":"is-style-stripes"} --><figure class="wp-block-table is-style-stripes"><table><thead><tr><th><?php esc_html_e( 'Property', 'arneiron-lite' ); ?></th><th><?php esc_html_e( 'Value', 'arneiron-lite' ); ?></th></tr></thead><tbody><tr><td><?php esc_html_e( 'Content width', 'arneiron-lite' ); ?></td><td><?php esc_html_e( '720px', 'arneiron-lite' ); ?></td></tr><tr><td><?php esc_html_e( 'Wide width', 'arneiron-lite' ); ?></td><td><?php esc_html_e( '1200px', 'arneiron-lite' ); ?></td></tr><tr><td><?php esc_html_e( 'Color tokens', 'arneiron-lite' ); ?></td><td><?php esc_html_e( '14', 'arneiron-lite' ); ?></td></tr></tbody></table></figure><!-- /wp:table -->
</section>
<!-- /wp:group -->
