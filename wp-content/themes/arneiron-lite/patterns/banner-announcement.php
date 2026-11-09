<?php
/**
 * Title: Banner · Announcement
 * Slug: arneiron/banner-announcement
 * Categories: arneiron-banners
 * Keywords: banner, announcement, bar
 * Viewport Width: 1200
 * Description: A full-width announcement bar.
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"contrast","textColor":"accent-contrast","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-accent-contrast-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-contrast"},"typography":{"textDecoration":"underline"}}}},"fontSize":"sm"} --><p class="has-text-align-center has-link-color has-sm-font-size"><?php esc_html_e( 'ArneIron Base 1.0 is here.', 'arneiron-lite' ); ?> <a href="#"><?php esc_html_e( 'Read the notes', 'arneiron-lite' ); ?></a></p><!-- /wp:paragraph -->
</section>
<!-- /wp:group -->
