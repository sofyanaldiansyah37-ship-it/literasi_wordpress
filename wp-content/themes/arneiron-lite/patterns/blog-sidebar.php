<?php
/**
 * Title: Blog sidebar (ArneIron)
 * Slug: arneiron/blog-sidebar
 * Categories: arneiron
 * Block Types: core/template-part/uncategorized
 * Viewport Width: 400
 * Description: The sidebar of the blog and archive pages: search, categories with post counts, and a tag cloud, each in a card. parts/blog-sidebar.html shows this pattern; pick it to restore the stock sidebar.
 *
 * Owner request 2026-10-14 ("add sidebar to blog as on demo"): the layout that
 * demo.arneiron.net carried only in its database (template part 6808 + the
 * home/archive/category/tag/search templates + a global-styles CSS block),
 * built into the theme so every site gets it. The styles are in
 * assets/css/blocks.css ("Blog sidebar").
 *
 * @package ArneIron
 */

?>
<!-- wp:group {"tagName":"aside","className":"blog-sidebar","ariaLabel":"<?php echo esc_attr__( 'Blog sidebar', 'arneiron-lite' ); ?>","style":{"spacing":{"blockGap":"var:preset|spacing|6"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<aside aria-label="<?php echo esc_attr__( 'Blog sidebar', 'arneiron-lite' ); ?>" class="wp-block-group blog-sidebar"><!-- wp:group {"tagName":"section","className":"card blog-sidebar__panel","style":{"border":{"radius":"var(--wp--custom--radius--md)"},"spacing":{"padding":{"top":"var:preset|spacing|5","right":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|5"},"blockGap":"var:preset|spacing|4"},"color":{"background":"var:preset|color|surface"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group card blog-sidebar__panel has-background" style="background-color:var(--wp--preset--color--surface);border-radius:var(--wp--custom--radius--md);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--5);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--5)"><!-- wp:heading {"className":"is-style-eyebrow blog-sidebar__title","fontSize":"sm"} -->
<h2 class="wp-block-heading is-style-eyebrow blog-sidebar__title has-sm-font-size"><?php esc_html_e( 'Search', 'arneiron-lite' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:search {"label":"<?php echo esc_attr__( 'Search the blog', 'arneiron-lite' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search posts…', 'arneiron-lite' ); ?>","buttonText":"<?php echo esc_attr__( 'Search', 'arneiron-lite' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true,"query":{"post_type":"post"}} /--></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"card blog-sidebar__panel","style":{"border":{"radius":"var(--wp--custom--radius--md)"},"spacing":{"padding":{"top":"var:preset|spacing|5","right":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|5"},"blockGap":"var:preset|spacing|4"},"color":{"background":"var:preset|color|surface"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group card blog-sidebar__panel has-background" style="background-color:var(--wp--preset--color--surface);border-radius:var(--wp--custom--radius--md);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--5);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--5)"><!-- wp:heading {"className":"is-style-eyebrow blog-sidebar__title","fontSize":"sm"} -->
<h2 class="wp-block-heading is-style-eyebrow blog-sidebar__title has-sm-font-size"><?php esc_html_e( 'Categories', 'arneiron-lite' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:categories {"showPostCounts":true,"className":"blog-sidebar__categories"} /--></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"card blog-sidebar__panel blog-sidebar__panel--tags","style":{"border":{"radius":"var(--wp--custom--radius--md)"},"spacing":{"padding":{"top":"var:preset|spacing|5","right":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|5"},"blockGap":"var:preset|spacing|4"},"color":{"background":"var:preset|color|surface"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group card blog-sidebar__panel blog-sidebar__panel--tags has-background" style="background-color:var(--wp--preset--color--surface);border-radius:var(--wp--custom--radius--md);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--5);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--5)"><!-- wp:heading {"className":"is-style-eyebrow blog-sidebar__title","fontSize":"sm"} -->
<h2 class="wp-block-heading is-style-eyebrow blog-sidebar__title has-sm-font-size"><?php esc_html_e( 'Tags', 'arneiron-lite' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"smallestFontSize":"0.8125rem","largestFontSize":"1.0625rem","className":"blog-sidebar__tags"} /--></section>
<!-- /wp:group --></aside>
<!-- /wp:group -->
