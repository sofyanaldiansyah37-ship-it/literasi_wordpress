<?php
/**
 * Title: Footer · Minimal
 * Slug: arneiron/footer-minimal
 * Categories: arneiron, footer
 * Block Types: core/template-part/footer
 * Viewport Width: 1280
 * Description: One centred line: the site title and the theme credit, for landing and campaign pages.
 *
 * @package ArneIron_Lite
 */

?>
<!-- wp:group {"className":"site-footer app-footer app-footer--minimal","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group site-footer app-footer app-footer--minimal"><!-- wp:site-title {"level":0,"className":"app-footer__title"} /-->

<!-- wp:paragraph {"className":"app-footer__credit"} -->
<p class="app-footer__credit"><?php /* translators: %s: link to the ArneIron Lite page. */ printf( esc_html__('Theme: %s.', 'arneiron-lite'), '<a href="' . esc_url('https://arneiron.net/lite/') . '">ArneIron Lite</a>'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
