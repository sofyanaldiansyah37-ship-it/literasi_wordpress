<?php
/**
 * Title: FAQ · Accordion
 * Slug: arneiron/faq-accordion
 * Categories: arneiron-faq
 * Keywords: faq, accordion, details, questions
 * Viewport Width: 800
 * Description: Accessible disclosure-based FAQ.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"textAlign":"center","level":2} --><h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Frequently asked questions', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:details --><details class="wp-block-details"><summary><?php esc_html_e( 'Is it really all core blocks?', 'arneiron-lite' ); ?></summary><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Yes. No custom blocks, no plugins required.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></details><!-- /wp:details -->
	<!-- wp:details --><details class="wp-block-details"><summary><?php esc_html_e( 'Can I change the colors?', 'arneiron-lite' ); ?></summary><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Swap one skin file and the whole site recolors.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></details><!-- /wp:details -->
	<!-- wp:details --><details class="wp-block-details"><summary><?php esc_html_e( 'Is it accessible?', 'arneiron-lite' ); ?></summary><!-- wp:paragraph {"textColor":"subtle","fontSize":"sm"} --><p class="has-subtle-color has-text-color has-sm-font-size"><?php esc_html_e( 'Built to WCAG 2.2 AA, with an AAA skin available.', 'arneiron-lite' ); ?></p><!-- /wp:paragraph --></details><!-- /wp:details -->
</section>
<!-- /wp:group -->
