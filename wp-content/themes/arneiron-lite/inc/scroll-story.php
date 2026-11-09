<?php
/**
 * "Scroll Story" — the default single-post layout since Pro 0.10.32
 * (templates/single.html; also selectable as the "Scroll Story" template, and
 * "Classic Post" = single-classic opts a post out). Posts only:
 * category, title, short description (the excerpt), a meta row with share
 * links, the featured image at the layout's wide size, the content as scroll
 * sections beside a sticky image panel, comments, and related posts.
 *
 * Everything here is theme-side and plugin-free:
 *   - share links:  render_block on the core/social-links that carries the
 *                   `arneiron-share` class (any template may use it);
 *   - related:      query_loop_block_query_vars on the Query Loop whose query
 *                   carries `"arneironRelated": true`;
 *   - sections:     an optional "Scroll Story section" style on core/group;
 *   - assets:       assets/css/scroll-story.css + assets/js/scroll-story.js,
 *                   enqueued only on a post that uses the template.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_scroll_story_is_current' ) ) {
	/**
	 * Whether the current request is a single post using the Scroll Story template.
	 *
	 * @return bool
	 */
	function arneiron_scroll_story_is_current() {
		if ( ! is_singular( 'post' ) ) {
			return false;
		}
		// Since Pro 0.10.32 Scroll Story is the default single-post layout
		// (templates/single.html); "Classic Post" (single-classic) is the opt-out.
		// The template WordPress resolved is the truth: it covers a site's own
		// saved `single` template, whichever layout that has.
		global $_wp_current_template_content;
		if ( is_string( $_wp_current_template_content ) && '' !== $_wp_current_template_content ) {
			return false !== strpos( $_wp_current_template_content, 'scroll-story' );
		}
		return in_array( get_page_template_slug( get_queried_object_id() ), array( '', 'single', 'single-scroll-story' ), true );
	}
}

if ( ! function_exists( 'arneiron_scroll_story_assets' ) ) {
	/**
	 * Enqueue the template's stylesheet and script on Scroll Story posts only.
	 *
	 * @return void
	 */
	function arneiron_scroll_story_assets() {
		if ( ! arneiron_scroll_story_is_current() ) {
			return;
		}
		wp_enqueue_style(
			'arneiron-scroll-story',
			ARNEIRON_URI . '/assets/css/scroll-story.css',
			array( 'arneiron-ds' ),
			arneiron_asset_ver( 'assets/css/scroll-story.css' )
		);
		wp_enqueue_script(
			'arneiron-scroll-story',
			ARNEIRON_URI . '/assets/js/scroll-story.js',
			array(),
			arneiron_asset_ver( 'assets/js/scroll-story.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		wp_localize_script(
			'arneiron-scroll-story',
			'arneironScrollStory',
			array( 'copied' => __( 'Link copied', 'arneiron-lite' ) )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'arneiron_scroll_story_assets', 20 );

if ( ! function_exists( 'arneiron_scroll_story_desc' ) ) {
	/**
	 * The story header's short description shows a hand-written excerpt only.
	 *
	 * core/post-excerpt falls back to the start of the content, so a post with
	 * no excerpt would repeat its own first lines right above them (all of a very
	 * short post). The Scroll Story header block carries `scroll-story__desc`.
	 *
	 * @param string   $html     Rendered block.
	 * @param array    $block    Parsed block.
	 * @param WP_Block $instance Block instance (context: postId).
	 * @return string
	 */
	function arneiron_scroll_story_desc( $html, $block, $instance = null ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( false === strpos( $class, 'scroll-story__desc' ) ) {
			return $html;
		}
		$post_id = ( $instance instanceof WP_Block && isset( $instance->context['postId'] ) ) ? (int) $instance->context['postId'] : (int) get_the_ID();
		return $post_id && has_excerpt( $post_id ) ? $html : '';
	}
}
add_filter( 'render_block_core/post-excerpt', 'arneiron_scroll_story_desc', 10, 3 );


if ( ! function_exists( 'arneiron_related_posts_query' ) ) {
	/**
	 * Related posts: the Query Loop whose `query` carries "arneironRelated":true
	 * lists posts from the current post's categories, never the post itself.
	 * When those categories hold no other post, it lists the latest posts
	 * (still excluding the current one).
	 *
	 * @param array    $query Query vars.
	 * @param WP_Block $block The core/post-template block.
	 * @return array
	 */
	function arneiron_related_posts_query( $query, $block ) {
		if ( empty( $block->context['query']['arneironRelated'] ) ) {
			return $query;
		}
		$post_id = get_queried_object_id();
		if ( ! $post_id || 'post' !== get_post_type( $post_id ) ) {
			return $query;
		}
		$query['post__not_in']        = array_merge( (array) ( $query['post__not_in'] ?? array() ), array( $post_id ) );
		$query['ignore_sticky_posts'] = true;
		$cats                         = wp_get_post_categories( $post_id );
		if ( $cats ) {
			$others = get_posts(
				array(
					'post_type'        => 'post',
					'post_status'      => 'publish',
					'category__in'     => $cats,
					'post__not_in'     => array( $post_id ),
					'fields'           => 'ids',
					'posts_per_page'   => 1,
					'no_found_rows'    => true,
					'suppress_filters' => false,
				)
			);
			if ( $others ) {
				$query['category__in'] = $cats;
			}
		}
		return $query;
	}
}
add_filter( 'query_loop_block_query_vars', 'arneiron_related_posts_query', 10, 2 );

if ( ! function_exists( 'arneiron_scroll_story_block_style' ) ) {
	/**
	 * "Scroll Story section" on core/group: an explicit section (its first image
	 * is the panel image while the section is read). Without any, every image in
	 * the content starts a section.
	 *
	 * @return void
	 */
	function arneiron_scroll_story_block_style() {
		register_block_style(
			'core/group',
			array(
				'name'  => 'scroll-section',
				'label' => __( 'Scroll Story section', 'arneiron-lite' ),
			)
		);
	}
}
add_action( 'init', 'arneiron_scroll_story_block_style' );

if ( ! function_exists( 'arneiron_subscribe_provider_html' ) ) {
	/**
	 * A real newsletter form from an active provider, or ''. The theme never
	 * renders an email field of its own: it would post nowhere.
	 *
	 * Order: Mailchimp for WordPress (the form vania-novikau.me uses), Jetpack
	 * Subscriptions, MailPoet, The Newsletter Plugin. Filterable.
	 *
	 * @return string
	 */
	function arneiron_subscribe_provider_html() {
		$html = '';
		if ( function_exists( 'mc4wp_show_form' ) ) {
			$html = (string) do_shortcode( '[mc4wp_form]' );
		} elseif ( WP_Block_Type_Registry::get_instance()->is_registered( 'jetpack/subscriptions' ) ) {
			$html = do_blocks( '<!-- wp:jetpack/subscriptions /-->' );
		} elseif ( WP_Block_Type_Registry::get_instance()->is_registered( 'mailpoet/subscription-form-block' ) ) {
			$html = do_blocks( '<!-- wp:mailpoet/subscription-form-block /-->' );
		} elseif ( shortcode_exists( 'newsletter_form' ) ) {
			$html = (string) do_shortcode( '[newsletter_form]' );
		}
		/**
		 * Filters the newsletter form shown in the "Post · Subscribe" part.
		 *
		 * @param string $html Provider form HTML, or '' for the link button.
		 */
		return (string) apply_filters( 'arneiron_subscribe_form_html', trim( $html ) );
	}
}

if ( ! function_exists( 'arneiron_subscribe_url' ) ) {
	/**
	 * Where the subscribe button leads when no newsletter plugin is active: a
	 * published page with the slug subscribe, newsletter or contact, else the
	 * site's RSS feed (a real way to subscribe). Filterable.
	 *
	 * @return string
	 */
	function arneiron_subscribe_url() {
		$url = '';
		foreach ( array( 'subscribe', 'newsletter', 'contact' ) as $slug ) {
			$page = get_page_by_path( $slug );
			if ( $page && 'publish' === $page->post_status ) {
				$url = (string) get_permalink( $page );
				break;
			}
		}
		if ( '' === $url ) {
			$url = (string) get_feed_link();
		}
		/**
		 * Filters the subscribe button URL of the "Post · Subscribe" part.
		 *
		 * @param string $url URL.
		 */
		return (string) apply_filters( 'arneiron_subscribe_url', $url );
	}
}

if ( ! function_exists( 'arneiron_subscribe_render' ) ) {
	/**
	 * The "Post · Subscribe" part's buttons (class arneiron-subscribe__actions):
	 * replaced by an active newsletter plugin's form; otherwise the button keeps
	 * its markup and, while its link is still the placeholder "#subscribe", is
	 * pointed at arneiron_subscribe_url(). A link the site owner set in the Site
	 * Editor is left alone.
	 *
	 * @param string $html  Rendered block.
	 * @param array  $block Parsed block.
	 * @return string
	 */
	function arneiron_subscribe_render( $html, $block ) {
		$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
		if ( ! preg_match( '/(^|\s)arneiron-subscribe__actions(\s|$)/', $class ) ) {
			return $html;
		}
		$form = arneiron_subscribe_provider_html();
		if ( '' !== $form ) {
			return '<div class="arneiron-subscribe__form">' . $form . '</div>';
		}
		$p = new WP_HTML_Tag_Processor( $html );
		while ( $p->next_tag( 'a' ) ) {
			if ( '#subscribe' === $p->get_attribute( 'href' ) ) {
				$p->set_attribute( 'href', esc_url( arneiron_subscribe_url() ) );
			}
		}
		return $p->get_updated_html();
	}
}
add_filter( 'render_block_core/buttons', 'arneiron_subscribe_render', 10, 2 );
