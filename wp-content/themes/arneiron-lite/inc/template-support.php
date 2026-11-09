<?php
/**
 * Template support + theme feature wiring.
 * =============================================================================
 * Split out of functions.php so the bootstrap stays readable. Anything that
 * touches WP template resolution belongs here.
 *
 * @package ArneIronBase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Skip link: WordPress adds one to every block theme (wp_enqueue_block_template_skip_link),
 * first in the page and pointing at the template's <main> (it gives <main> an id
 * when the template has none). The theme's own second link was a duplicate, and
 * on templates without <main id="main"> it pointed nowhere, so it is gone.
 */

/* =============================================================================
 * Template part AREAS — the groups at the top of the Patterns screen
 * -----------------------------------------------------------------------------
 * That list (All template parts / Header / Footer / General / ...) is NOT the
 * pattern-category list below it. It enumerates template part AREAS, and only a
 * `wp_template_part` can appear there — a `wp_pattern_category` term never can,
 * however it is named. WooCommerce's "Add to Cart + Options" and "Mini-Cart"
 * rows are the proof that third parties extend it this way.
 *
 * Registering an area is what puts a named group in that sidebar and, more
 * usefully, gives every part in it the same native inserter: `core/template-part`
 * drops one anywhere a block can go, with no custom block required.
 *
 * A NOTE THAT WILL SAVE SOMEONE A DAY. A `wp_template_part` row in the database
 * SHADOWS the theme file of the same slug for the theme it is bound to, and it
 * is invisible until that theme is active — this is the same trap documented on
 * inc/page-parts.php, and the reason the dev header lived in DB part 867 while
 * `parts/header.html` sat unread. Parts authored through this area live only in
 * the database, so they travel with the SITE, not with the theme zip.
 * ========================================================================== */

if ( ! function_exists( 'arneiron_template_part_areas' ) ) {
	/**
	 * Add the "Embeded" area to the Site Editor's template-part groups.
	 *
	 * Placed DIRECTLY AFTER `footer`, because the sidebar renders the list in
	 * array order and the owner asked for it under Footer specifically. Appending
	 * left `General` (core's `uncategorized`) sitting between the two.
	 *
	 * Splicing moves core's later areas down by one but never changes their order
	 * RELATIVE TO EACH OTHER, and removes nothing. If `footer` is ever absent —
	 * a filter ran before this one and dropped it — the area is appended instead,
	 * so the group still appears rather than vanishing on a technicality.
	 *
	 * @param array $areas Registered areas.
	 * @return array
	 */
	function arneiron_template_part_areas( $areas ) {
		$areas = (array) $areas;

		foreach ( $areas as $existing ) {
			if ( isset( $existing['area'] ) && 'embeded' === $existing['area'] ) {
				return $areas; // already registered — never define it twice.
			}
		}

		$embeded = array(
			'area'        => 'embeded',
			'label'       => __( 'Embeded', 'arneiron-lite' ),
			'description' => __( 'Reusable sections you can drop anywhere with a Template Part block.', 'arneiron-lite' ),
			'icon'        => 'layout',
			'area_tag'    => 'div',
		);

		$after = -1;
		foreach ( $areas as $i => $existing ) {
			if ( isset( $existing['area'] ) && 'footer' === $existing['area'] ) {
				$after = $i;
				break;
			}
		}

		if ( $after < 0 ) {
			$areas[] = $embeded;

			return $areas;
		}

		array_splice( $areas, $after + 1, 0, array( $embeded ) );

		return $areas;
	}
}
add_filter( 'default_wp_template_part_areas', 'arneiron_template_part_areas' );

/* =============================================================================
 * EVERY TEMPLATE THAT RENDERS A HEADER MUST RENDER THE MOBILE BAR WITH IT
 * -----------------------------------------------------------------------------
 * `.site-header` is `display: none` below 782px (ds.css §14b) and the mobile bar
 * is what replaces it. So a template that references `header` WITHOUT
 * `header-mobile` has no header at all on a phone — not a degraded one, none.
 *
 * `inc/woocommerce.php` records this being shipped once already on checkout and
 * caught only by measuring the breakpoint on /checkout/ itself. The cure there
 * was a THEME copy of `page-checkout.html` carrying both parts, which fixed that
 * one template and left every other plugin template exactly as it was. Measured
 * on dev 2026-08-29, `get_block_templates()` returned SIX more with the same
 * defect, all from WooCommerce:
 *
 *     archive-product · single-product · page-cart · order-confirmation
 *     taxonomy-product_attribute · product-search-results
 *
 * Confirmed on the rendered pages: `/` and `/my-account/` carry the mobile bar,
 * `/shop/` and `/cart/` carry zero of it.
 *
 * Copying six more plugin templates into the theme would fix it the same way and
 * cost the same thing SIX TIMES OVER — a WooCommerce update would stop reaching
 * any of them, silently. So this pairs the parts at resolution time instead: any
 * template that names a header part and not its mobile twin gets the twin
 * inserted directly after it. WooCommerce keeps ownership of its templates, and
 * a plugin nobody has installed yet is covered on the day it arrives.
 *
 * It runs in the editor too, deliberately. A template that RENDERS one thing and
 * EDITS as another is the worse failure, and the insertion is idempotent — a
 * template that already carries the part is returned untouched, including one
 * that was saved to the database after being shown this way.
 * ========================================================================== */

/**
 * The mobile twin for each header part this theme ships.
 *
 * Both files exist in `parts/`; a header with no twin here is left alone rather
 * than paired with a part that would 404.
 *
 * @return array<string,string> header slug => mobile slug
 */
function arneiron_mobile_header_twins() {
	return array(
		'header'         => 'header-mobile',
		'header-minimal' => 'header-minimal-mobile',
	);
}

/**
 * Insert the mobile header part after the desktop one, where it is missing.
 *
 * @param string $content Template content.
 * @param string $slug    Template slug, for the log line only.
 * @return string Content, unchanged when nothing was missing or nothing matched.
 */
function arneiron_pair_mobile_header( $content, $slug = '' ) {
	if ( ! is_string( $content ) || '' === $content ) {
		return $content;
	}

	$twins = arneiron_mobile_header_twins();

	// Already paired — including a template saved with the injection in it.
	foreach ( $twins as $mobile ) {
		if ( false !== strpos( $content, '"' . $mobile . '"' ) ) {
			return $content;
		}
	}

	// The attribute JSON of a template-part comment carries no nested object in
	// any template core, WooCommerce or this theme emits, so a flat `{...}` is
	// enough and avoids a recursive matcher for a shape that does not occur.
	$pattern = '#<!--\s*wp:template-part\s+(\{[^{}]*\})\s*/-->#';
	if ( ! preg_match_all( $pattern, $content, $matches, PREG_OFFSET_CAPTURE ) ) {
		return $content;
	}

	foreach ( $matches[1] as $i => $attr ) {
		$parsed = json_decode( $attr[0], true );
		$name   = is_array( $parsed ) && isset( $parsed['slug'] ) ? $parsed['slug'] : '';
		if ( ! isset( $twins[ $name ] ) ) {
			continue;
		}

		$whole  = $matches[0][ $i ];
		$insert = $whole[0] . "\n"
			. '<!-- wp:template-part {"slug":"' . $twins[ $name ] . '","area":"uncategorized"} /-->';

		return substr_replace( $content, $insert, $whole[1], strlen( $whole[0] ) );
	}

	/*
	 * A header part was named — that is why we are here — but not in a form this
	 * matcher could place. Report it rather than swallow it: a silent return here
	 * looks identical to "nothing needed doing", which is exactly how the
	 * original defect stayed invisible.
	 */
	error_log( // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		sprintf(
			'[arneiron] template %s references a header part but no mobile twin could be placed; it will have NO header below 782px.',
			$slug ? $slug : '(unknown)'
		)
	);
	return $content;
}

/**
 * Pair the mobile header into every resolved template that is missing it.
 *
 * @param WP_Block_Template[] $templates     Query result.
 * @param array               $query         Unused.
 * @param string              $template_type 'wp_template' or 'wp_template_part'.
 * @return WP_Block_Template[]
 */
function arneiron_pair_mobile_header_in_templates( $templates, $query = array(), $template_type = 'wp_template' ) {
	// Parts are not templates: a header PART must not get a copy of itself.
	if ( 'wp_template' !== $template_type || ! is_array( $templates ) ) {
		return $templates;
	}
	foreach ( $templates as $t ) {
		if ( isset( $t->content ) ) {
			$t->content = arneiron_pair_mobile_header( $t->content, $t->slug ?? '' );
		}
	}
	return $templates;
}
/*
 * Priority 9999 for the reason documented at length on
 * `arneiron_hide_woocommerce_checkout_header_part`: WooCommerce registers its
 * own templates on this same filter at priority 10, so a callback registered at
 * 10 can run BEFORE the entries it is meant to act on exist and change nothing
 * while appearing to work.
 */
add_filter( 'get_block_templates', 'arneiron_pair_mobile_header_in_templates', 9999, 3 );

/**
 * The singular resolution path — `get_block_template()` does not run the plural
 * filter, so a template fetched by id would keep the defect.
 *
 * @param WP_Block_Template|null $template      Resolved template.
 * @param string                 $id            Unused.
 * @param string                 $template_type 'wp_template' or 'wp_template_part'.
 * @return WP_Block_Template|null
 */
function arneiron_pair_mobile_header_in_template( $template, $id = '', $template_type = 'wp_template' ) {
	if ( 'wp_template' === $template_type && $template instanceof WP_Block_Template && isset( $template->content ) ) {
		$template->content = arneiron_pair_mobile_header( $template->content, $template->slug ?? '' );
	}
	return $template;
}
add_filter( 'get_block_template', 'arneiron_pair_mobile_header_in_template', 9999, 3 );

/**
 * Posts page title (#5426).
 * -----------------------------------------------------------------------------
 * The blog index (is_home) has no heading of its own. Core has no native way to
 * print the title of the page assigned as "Posts page": core/query-title only
 * knows archive, search and the post type LABEL; core/post-title prints the
 * GLOBAL post and the core/post-data binding reads the postId context, and on
 * the blog index both are the first post of the loop. So home.html places the
 * SAME block the page template uses for its title, core/post-title level 1,
 * marked with the class `arneiron-posts-page-title`, and the filters below
 * point that one block at the posts page. Same block = same markup, typography and spacing as every
 * other page title; the text is the posts page's own title (rename the page
 * and the heading follows).
 */

/**
 * Whether a parsed block is the marked posts-page title.
 *
 * @param array $parsed_block Parsed block.
 * @return bool
 */
function arneiron_is_posts_page_title_block( $parsed_block ) {
	if ( 'core/post-title' !== ( $parsed_block['blockName'] ?? '' ) ) {
		return false;
	}
	$classes = preg_split( '/\s+/', (string) ( $parsed_block['attrs']['className'] ?? '' ) );
	return in_array( 'arneiron-posts-page-title', $classes, true );
}

/**
 * The page assigned as "Posts page", when the current request is the blog index.
 *
 * @return WP_Post|null
 */
function arneiron_posts_page_for_title() {
	if ( ! is_home() ) {
		return null;
	}
	$page_id = (int) get_option( 'page_for_posts' );
	$page    = $page_id > 0 ? get_post( $page_id ) : null;
	return ( $page instanceof WP_Post ) ? $page : null;
}

/**
 * Make $page the global post (or, with $restore, put the previous one back).
 *
 * @param WP_Post|null $page    Post to make global.
 * @param bool         $restore Restore the post saved by the last swap.
 * @return void
 */
function arneiron_posts_page_title_swap( $page = null, $restore = false ) {
	static $saved = array();
	global $post;
	if ( $restore ) {
		if ( $saved ) {
			$post = array_pop( $saved ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		}
		return;
	}
	$saved[] = $post;
	$post    = $page; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}

/**
 * Point the marked title at the posts page on the blog index. core/post-title
 * prints get_the_title() of the GLOBAL post (WP 6.3+) and uses its postId
 * context only as a guard and for the link, so both are set: the context, and
 * the global post for the duration of this one block (restored right after it
 * renders, in arneiron_posts_page_title_render()).
 *
 * @param array $context      Block context.
 * @param array $parsed_block Parsed block.
 * @return array
 */
function arneiron_posts_page_title_context( $context, $parsed_block ) {
	if ( ! arneiron_is_posts_page_title_block( $parsed_block ) ) {
		return $context;
	}
	$page = arneiron_posts_page_for_title();
	if ( $page ) {
		$context['postId']   = $page->ID;
		$context['postType'] = $page->post_type;
		arneiron_posts_page_title_swap( $page );
	}
	return $context;
}
add_filter( 'render_block_context', 'arneiron_posts_page_title_context', 10, 2 );

/**
 * Restore the global post after the marked title rendered; render nothing when
 * there is no posts page to name (latest posts on the front page, or the block
 * used outside the blog index), instead of the first post's title.
 *
 * @param string $block_content Rendered block.
 * @param array  $block         Parsed block.
 * @return string
 */
function arneiron_posts_page_title_render( $block_content, $block ) {
	if ( ! arneiron_is_posts_page_title_block( $block ) ) {
		return $block_content;
	}
	if ( arneiron_posts_page_for_title() ) {
		arneiron_posts_page_title_swap( null, true );
		return $block_content;
	}
	return '';
}
add_filter( 'render_block_core/post-title', 'arneiron_posts_page_title_render', 10, 2 );

/**
 * Page links for posts split with the classic `<!--nextpage-->` tag.
 *
 * Core's Post Content block prints wp_link_pages() only when the post has a
 * core/nextpage BLOCK, so a classic multi-page post (WordPress Theme Unit Test
 * "Template: Paginated") showed page 1 with no way to reach page 2.
 *
 * @param string $html  Rendered block.
 * @param array  $block Parsed block.
 * @return string
 */
function arneiron_classic_page_links( $html, $block ) {
	unset( $block );
	if ( ! is_singular() || has_block( 'core/nextpage' ) ) {
		return $html;
	}
	$links = wp_link_pages(
		array(
			'before' => '<nav class="post-nav-links" aria-label="' . esc_attr__( 'Page', 'arneiron-lite' ) . '"><span class="post-nav-links__label">' . esc_html__( 'Pages:', 'arneiron-lite' ) . '</span>',
			'after'  => '</nav>',
			'echo'   => 0,
		)
	);
	return '' === $links ? $html : $html . $links;
}
add_filter( 'render_block_core/post-content', 'arneiron_classic_page_links', 10, 2 );

/**
 * `templates/front-page.html` is a static front page (the page's content, no
 * title). When Settings > Reading shows "Your latest posts" on the front page
 * (WordPress's default), it rendered one post's content instead of the post
 * list, so the theme steps aside then and WordPress uses home.html.
 *
 * @param string[] $templates Front page template candidates.
 * @return string[]
 */
function arneiron_front_page_only_when_static( $templates ) {
	return 'page' === get_option( 'show_on_front' ) ? $templates : array();
}
add_filter( 'frontpage_template_hierarchy', 'arneiron_front_page_only_when_static' );

/**
 * The blog index's visually hidden site-title h1 (templates/home.html) is for
 * the case where the posts-page title above it prints nothing ("Your latest
 * posts" on the front page): when a posts page's own title is shown, it is the
 * page's h1 and the hidden one steps aside, so there is always exactly one.
 *
 * @param string $html  Rendered block.
 * @param array  $block Parsed block.
 * @return string
 */
function arneiron_home_hidden_h1( $html, $block ) {
	$classes = preg_split( '/\s+/', (string) ( $block['attrs']['className'] ?? '' ) );
	if ( in_array( 'arneiron-home-h1', $classes, true ) && arneiron_posts_page_for_title() ) {
		return '';
	}
	return $html;
}
add_filter( 'render_block_core/site-title', 'arneiron_home_hidden_h1', 10, 2 );

if ( ! function_exists( 'arneiron_blog_sidebar_hide_empty_tags' ) ) {
	/**
	 * The blog sidebar's Tags card shows only when the site has tags.
	 *
	 * core/tag-cloud renders nothing on the front end when there are no tags,
	 * which left a card holding only its "Tags" heading (dev.arneiron.net,
	 * 2026-10-14). The card carries `blog-sidebar__panel--tags`
	 * (patterns/blog-sidebar.php).
	 *
	 * @param string $html  Rendered block.
	 * @param array  $block Parsed block.
	 * @return string
	 */
	function arneiron_blog_sidebar_hide_empty_tags( $html, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'blog-sidebar__panel--tags' ) ) {
			return $html;
		}
		return false === strpos( $html, 'wp-block-tag-cloud' ) ? '' : $html;
	}
}
add_filter( 'render_block_core/group', 'arneiron_blog_sidebar_hide_empty_tags', 10, 2 );
