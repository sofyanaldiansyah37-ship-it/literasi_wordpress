<?php
/**
 * Title: Header · Minimal (ArneIron)
 * Slug: arneiron/header-minimal
 * Categories: arneiron, header
 * Block Types: core/template-part/header
 * Viewport Width: 1280
 * Description: A minimal ArneIron header — the site title alone, centred, with no navigation and no call to action. For landing, campaign and checkout-like pages where the nav is a leak. Pairs automatically with the minimal mobile bar below 782px.
 *
 * Per-page header VARIANT for the hub#4364 selection system. Selecting it on a
 * page stores only the STRING `header-minimal` in page meta — no
 * `wp_template_part` row is written, so a theme update still reaches every page
 * that points at this part.
 *
 * This pattern exists so the variant is RECOVERABLE. `Block Types:
 * core/template-part/header` is what makes WordPress offer it when someone
 * deletes or replaces the header part; without that line a pattern can be
 * inserted but never chosen as the header's design, which is the original
 * "delete the header and you can't bring it back" wall one level down.
 *
 * Keep this byte-identical to parts/header-minimal.html: it is the only way back to
 * this variant once the part has been replaced from the editor, because a
 * replaced part is stored in the database and shadows the theme file FOR THE
 * THEME IT IS BOUND TO — invisibly, until that theme is the active stylesheet.
 *
 * @package ArneIron
 */
?>
<!-- Header · Minimal (hub#4364). A per-page header VARIANT: brand only, centred,
     no navigation and no call to action — for landing, checkout-like and
     campaign pages where the nav is a leak.

     It MUST carry `site-header` or ds.css §14b will not hide it below 782px and
     the page would show this header AND the mobile bar at the same time. The
     paired `parts/header-minimal-mobile.html` is what renders there instead. -->

<!-- wp:group {"className":"site-header app-header app-header--minimal","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group site-header app-header app-header--minimal"><!-- wp:site-title {"className":"brand","level":0} /--></div>
<!-- /wp:group -->
