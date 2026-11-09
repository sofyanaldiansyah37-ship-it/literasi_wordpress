<?php
/**
 * Title: Gallery · Masonry
 * Slug: arneiron/gallery-masonry
 * Categories: arneiron-gallery
 * Keywords: gallery, masonry, images
 * Viewport Width: 1100
 * Description: A masonry-style gallery.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":2} --><h2 class="wp-block-heading"><?php esc_html_e( 'Gallery', 'arneiron-lite' ); ?></h2><!-- /wp:heading -->
	<!-- wp:gallery {"columns":3,"linkTo":"none","align":"wide","className":"is-style-masonry"} -->
	<figure class="wp-block-gallery has-nested-images columns-3 is-cropped alignwide is-style-masonry"><!-- wp:image {"className":"is-style-rounded"} --><figure class="wp-block-image is-style-rounded"><img alt=""/></figure><!-- /wp:image --><!-- wp:image {"className":"is-style-rounded"} --><figure class="wp-block-image is-style-rounded"><img alt=""/></figure><!-- /wp:image --><!-- wp:image {"className":"is-style-rounded"} --><figure class="wp-block-image is-style-rounded"><img alt=""/></figure><!-- /wp:image --></figure>
	<!-- /wp:gallery -->
</section>
<!-- /wp:group -->
