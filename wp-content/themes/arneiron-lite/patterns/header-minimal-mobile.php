<?php
/**
 * Title: Header · Minimal (Mobile) (ArneIron)
 * Slug: arneiron/header-minimal-mobile
 * Categories: arneiron, header
 * Block Types: core/template-part, core/template-part/uncategorized
 * Viewport Width: 1280
 * Description: The ≤782px half of the minimal header — brand and menu only, no cart, account or balance chips. Paired with Header · Minimal by the <variant>-mobile naming convention.
 *
 * The mobile half of the `header-minimal` pair. `parts/header-mobile.html` and
 * `parts/mobile-menu.html` ship NO pattern today, so this is the first
 * recoverable mobile bar in the theme.
 *
 * `Block Types` here is a pair of guesses made explicit rather than silently:
 * this part's area is `uncategorized`, and the editor builds its replace-list
 * key as `core/template-part/<area>`, so both the bare block name and the
 * `uncategorized` form are declared. Which of the two the editor actually
 * honours was MEASURED live rather than assumed — see the #4364 evidence
 * comment.
 *
 * Keep this byte-identical to parts/header-minimal-mobile.html: it is the only way back to
 * this variant once the part has been replaced from the editor, because a
 * replaced part is stored in the database and shadows the theme file FOR THE
 * THEME IT IS BOUND TO — invisibly, until that theme is the active stylesheet.
 *
 * @package ArneIron
 */
?>
<!-- Header · Minimal (Mobile) (hub#4364). The ≤782px half of the `header-minimal`
     variant, paired by the naming convention `<variant>-mobile` in
     inc/page-parts.php. Brand + menu only: no cart, account or balance chips,
     matching the desktop variant's "no distractions" intent.

     It MUST carry `header-mobile arneiron-mobile-bar` or ds.css §14b will not
     show it below 782px, and the phone would have NO header at all — the exact
     regression caught on /checkout/ earlier in this issue. -->

<!-- wp:group {"tagName":"header","className":"site-header header-mobile arneiron-mobile-bar arneiron-mobile-bar--minimal","backgroundColor":"surface","layout":{"type":"constrained"}} -->
<header class="wp-block-group site-header header-mobile arneiron-mobile-bar arneiron-mobile-bar--minimal has-surface-background-color has-background">
	<!-- wp:group {"className":"arneiron-mobile-bar__row","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap","verticalAlignment":"center"}} -->
	<div class="wp-block-group arneiron-mobile-bar__row" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30)">
		<!-- wp:group {"className":"arneiron-mobile-bar__brand","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group arneiron-mobile-bar__brand">
			<!-- wp:site-logo {"width":36} /-->
			<!-- wp:site-title {"className":"arneiron-mobile-bar__title","level":0} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"arneiron-mobile-bar__icons","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group arneiron-mobile-bar__icons">
			<!-- wp:html -->
			<button type="button" class="nav-toggle arneiron-mobile-bar__toggle" data-nav-toggle aria-expanded="false" aria-controls="arneiron-mobile-menu" aria-label="<?php esc_attr_e( 'Open menu', 'arneiron-lite' ); ?>"><span class="nav-toggle__box" aria-hidden="true"><span class="nav-toggle__bar"></span></span></button>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"mobile-menu","area":"uncategorized"} /-->
</header>
<!-- /wp:group -->
