<?php
/**
 * Title: Footer · Default
 * Slug: arneiron/footer-default
 * Categories: arneiron, footer
 * Block Types: core/template-part/footer
 * Viewport Width: 1280
 * Description: The site title on the left; on the right a "Designed with WordPress" line and the theme credit. Pick this to restore the default footer.
 *
 * ArneIron Lite's footer (parts/footer.html shows this pattern, so its words are
 * translatable). WordPress.org rules: the front end may show the site owner's
 * name but never the theme author's copyright, plus at most one credit link to
 * the Theme URI or Author URI and one to WordPress.org.
 *
 * @package ArneIron_Lite
 */

?>
<!-- wp:group {"className":"site-footer app-footer","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group site-footer app-footer"><!-- wp:site-title {"level":0,"className":"app-footer__title"} /-->

<!-- wp:paragraph {"className":"app-footer__credit"} -->
<p class="app-footer__credit"><?php /* translators: 1: link to WordPress.org, 2: link to the ArneIron Lite page. */ printf( esc_html__('Designed with %1$s. Theme: %2$s.', 'arneiron-lite'), '<a href="' . esc_url('https://wordpress.org/') . '">WordPress</a>', '<a href="' . esc_url('https://arneiron.net/lite/') . '">ArneIron Lite</a>'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
