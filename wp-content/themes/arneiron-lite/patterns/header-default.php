<?php
/**
 * Title: Header · Default (ArneIron)
 * Slug: arneiron/header-default
 * Categories: arneiron, header
 * Block Types: core/template-part/header
 * Viewport Width: 1280
 * Description: The default ArneIron header — logo, site title, primary navigation, search, account and a call to action in one row, all core blocks. With WooCommerce active its own account and mini-cart blocks render here (the core Log in / Log out link stands down); with Polylang active its language switcher block renders before them. Pick this to restore the stock header after trying another design.
 *
 * Keep this byte-identical to parts/header.html: it is the only way back to the
 * stock header once a template part has been replaced from the editor, because
 * a replaced part is stored in the database and shadows the theme file.
 *
 * @package ArneIron
 */
?>
<!-- wp:group {"className":"site-header app-header","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group site-header app-header"><!-- wp:site-logo {"className":"brand-logo"} /-->

<!-- wp:site-title {"className":"brand","level":0} /-->

<!-- wp:navigation {"className":"app-nav","ariaLabel":"Primary","overlayMenu":"mobile"} /-->

<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search…","buttonText":"Search","buttonUseIcon":true,"buttonPosition":"button-only","className":"app-header-search"} /-->

<!-- wp:loginout {"className":"arneiron-account-fallback arneiron-account-icon"} /-->

<!-- wp:buttons {"className":"app-header-cta"} -->
<div class="wp-block-buttons app-header-cta"><!-- wp:button {"className":"btn btn--sm btn--primary"} -->
<div class="wp-block-button btn btn--sm btn--primary"><a class="wp-block-button__link wp-element-button" href="#"><?php esc_html_e( 'Get started', 'arneiron-lite' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
