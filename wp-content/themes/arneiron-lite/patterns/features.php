<?php
/**
 * Title: Features
 * Slug: arneiron/features
 * Description: 3-up value-proposition grid of cards. Each card has an icon, H3, body, and optional ghost link. Reflows on mobile.
 * Categories: arneiron
 * Inserter: yes
 * Pattern: Features (3-up value proposition grid)
 * =============================================================================
 * Empty-state-safe: the three cards are placeholder copy the user edits. The
 * grid uses auto-fit minmax so it collapses on mobile without a media query
 * (grid-spacing / responsive-design skills).
 *
 * @package ArneIronBase
 */

?>
<!-- wp:group {"tagName":"section","id":"features","className":"features","style":{"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8"}}},"layout":{"type":"constrained"}} -->
<section id="features" class="wp-block-group features" style="padding-top:var(--wp--preset--spacing--8);padding-bottom:var(--wp--preset--spacing--8)">

	<!-- wp:heading {"level":2,"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Why this site', 'arneiron-lite' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"features__grid","style":{"spacing":{"margin":{"top":"var:preset|spacing|7"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group features__grid" style="margin-top:var(--wp--preset--spacing--7)">

		<?php for ( $arneiron_i = 1; $arneiron_i <= 3; $arneiron_i++ ) : ?>
			<!-- wp:group {"className":"card features__card","style":{"border":{"radius":"var(--wp--custom--radius--md)"},"spacing":{"padding":{"top":"var:preset|spacing|6","right":"var:preset|spacing|6","bottom":"var:preset|spacing|6","left":"var:preset|spacing|6"}},"color":{"background":"var:preset|color|surface"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group card features__card has-background" style="background-color:var(--wp--preset--color--surface);border-radius:var(--wp--custom--radius--md);padding-top:var(--wp--preset--spacing--6);padding-right:var(--wp--preset--spacing--6);padding-bottom:var(--wp--preset--spacing--6);padding-left:var(--wp--preset--spacing--6)">

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php echo esc_html( sprintf( /* translators: %d: number of the feature card (1, 2, 3). */ __( 'Feature %d', 'arneiron-lite' ), $arneiron_i ) ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php esc_html_e( 'Describe one tangible benefit your visitor gets. Keep it to one sentence — detail belongs on its own page.', 'arneiron-lite' ); ?></p>
				<!-- /wp:paragraph -->

			</div>
			<!-- /wp:group -->
		<?php endfor; ?>

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->
