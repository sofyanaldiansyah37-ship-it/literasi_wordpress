<?php
/**
 * Title: Sidebar Default
 * Slug: arneiron/sidebar-default
 * Description: Default sidebar content: a heading and placeholder text the user replaces with their own blocks.
 * Categories: arneiron
 * Inserter: yes
 * Pattern: sidebar default (empty-state-safe)
 * =============================================================================
 * The default content of parts/sidebar.html. The pattern registers no widgets —
 * it's just sensible placeholder markup that degrades cleanly when admins remove
 * every block.
 *
 * @package ArneIronBase
 */

?>
<!-- wp:heading {"level":2,"fontSize":"lg"} -->
<h2 class="wp-block-heading has-lg-font-size"><?php esc_html_e( 'On this site', 'arneiron-lite' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"sm"} -->
<p class="has-sm-font-size"><?php esc_html_e( 'Drop blocks here from the editor — a contact form, recent posts, or a call to action.', 'arneiron-lite' ); ?></p>
<!-- /wp:paragraph -->
