<?php
/**
 * Title: Hero
 * Slug: arneiron/hero
 * Description: Single-column hero: eyebrow, H1, subhead, and one primary CTA. Designed for the landing page top fold.
 * Categories: arneiron
 * Inserter: yes
 * Pattern: Hero
 * =============================================================================
 * The site front-page hero. Introduces what the site is + a single primary
 * CTA (UX-analysis / 5-second test). Sits inside the `arneiron` category so
 * it shows up in the editor Patterns tab; never auto-inserted.
 *
 * The static text below is sensible placeholder copy — the user edits it in the
 * editor after install. Empty-state-safe: there is no required demo content.
 *
 * @package ArneIronBase
 */

?>
<!-- wp:group {"tagName":"section","className":"hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|9","bottom":"var:preset|spacing|9"}},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group hero" style="padding-top:var(--wp--preset--spacing--9);padding-bottom:var(--wp--preset--spacing--9)">

	<!-- wp:group {"className":"hero__inner","layout":{"type":"constrained","contentSize":"640px"}} -->
	<div class="wp-block-group hero__inner">

		<!-- wp:heading {"level":1,"textAlign":"center"} -->
		<h1 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Welcome to your new ArneIron site', 'arneiron-lite' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"lg"} -->
		<p class="has-text-align-center has-lg-font-size"><?php esc_html_e( 'Replace this line with a single sentence that explains what your site does and who it’s for.', 'arneiron-lite' ); ?></p>
		<!-- /wp:paragraph -->

		<?php /* One primary CTA. Secondary action lives below the fold (visual-hierarchy). */ ?>
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#features"><?php esc_html_e( 'Get started', 'arneiron-lite' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->
