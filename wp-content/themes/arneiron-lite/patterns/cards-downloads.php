<?php
/**
 * Title: Cards · Downloads
 * Slug: arneiron/cards-downloads
 * Categories: arneiron-cards
 * Keywords: cards, downloads, files
 * Viewport Width: 1000
 * Description: Download cards using the file block.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":2,"fontSize":"xl"} --><h2 class="wp-block-heading has-xl-font-size"><?php esc_html_e( 'Downloads', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:file {"href":"#","textLinkHref":"#","displayPreview":false} --><div class="wp-block-file"><a href="#"><?php esc_html_e( 'Brand guidelines (PDF)', 'arneiron-lite' ); ?></a><a href="#" class="wp-block-file__button wp-element-button" download><?php esc_html_e( 'Download', 'arneiron-lite' ); ?></a></div><!-- /wp:file -->
	<!-- wp:file {"href":"#","textLinkHref":"#","displayPreview":false} --><div class="wp-block-file"><a href="#"><?php esc_html_e( 'Press kit (ZIP)', 'arneiron-lite' ); ?></a><a href="#" class="wp-block-file__button wp-element-button" download><?php esc_html_e( 'Download', 'arneiron-lite' ); ?></a></div><!-- /wp:file -->
</section>
<!-- /wp:group -->
