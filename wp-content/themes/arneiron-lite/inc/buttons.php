<?php
/**
 * Buttons: the two-class system (hub#5402).
 *
 * Every button the theme prints carries one of two classes, so one rule can
 * own the hover/focus colours of all of them:
 *
 *   arneiron-btn arneiron-btn--filled   painted with the accent colour
 *   arneiron-btn arneiron-btn--ghost    transparent at rest (outline / ghost / link)
 *
 * The rule (assets/css/buttons.css): on :hover and :focus-visible a filled
 * button darkens to the variation's settings.custom.button.hoverBg and a ghost
 * button fills with it; the label turns settings.custom.button.hoverInk, which
 * is white (#fff, >= 4.5:1) in every variation whose hover colour is dark.
 *
 * The classes are added at RENDER time, never saved into post content: the
 * core/button markup an editor saves is untouched, so no existing post can show
 * "This block contains unexpected content". Which class a core/button gets
 * follows the block style the editor picked in the sidebar:
 *
 *   Fill (default), Pill, Full width, Icon, ArneIron Shadow(-Lift) -> filled
 *   Outline, Ghost, Link                                            -> ghost
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'arneiron_button_kind' ) ) {
	/**
	 * Which of the two classes a core/button block gets, from its block style.
	 *
	 * @param string $class_name The block's className attribute.
	 * @return string 'filled' or 'ghost'.
	 */
	function arneiron_button_kind( $class_name ) {
		$ghost_styles = array( 'is-style-outline', 'is-style-ghost', 'is-style-link' );
		$classes      = preg_split( '/\s+/', (string) $class_name );
		return array_intersect( $ghost_styles, $classes ) ? 'ghost' : 'filled';
	}
}

if ( ! function_exists( 'arneiron_add_button_classes' ) ) {
	/**
	 * Add `arneiron-btn arneiron-btn--{kind}` to the first tag that matches.
	 *
	 * @param string $html      Rendered block HTML.
	 * @param string $tag_class Class that identifies the clickable element.
	 * @param string $kind      'filled' or 'ghost'.
	 * @return string
	 */
	function arneiron_add_button_classes( $html, $tag_class, $kind ) {
		if ( ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $html;
		}
		$p = new WP_HTML_Tag_Processor( $html );
		while ( $p->next_tag() ) {
			if ( $p->has_class( $tag_class ) ) {
				$p->add_class( 'arneiron-btn' );
				$p->add_class( 'arneiron-btn--' . $kind );
				return $p->get_updated_html();
			}
		}
		return $html;
	}
}

if ( ! function_exists( 'arneiron_button_render_classes' ) ) {
	/**
	 * Render filter: core/button, core/search's submit, the comment form submit.
	 *
	 * @param string $html  Rendered block HTML.
	 * @param array  $block Parsed block.
	 * @return string
	 */
	function arneiron_button_render_classes( $html, $block ) {
		if ( '' === $html || empty( $block['blockName'] ) ) {
			return $html;
		}
		$attrs = isset( $block['attrs'] ) && is_array( $block['attrs'] ) ? $block['attrs'] : array();
		$class = isset( $attrs['className'] ) ? (string) $attrs['className'] : '';

		switch ( $block['blockName'] ) {
			case 'core/button':
				return arneiron_add_button_classes( $html, 'wp-block-button__link', arneiron_button_kind( $class ) );

			case 'core/search':
				// The header's search is an icon toggle on the bar, not a
				// painted button: it stays out of the system.
				if ( false !== strpos( $class, 'app-header-search' ) ) {
					return $html;
				}
				return arneiron_add_button_classes( $html, 'wp-block-search__button', 'filled' );

			case 'core/post-comments-form':
				return arneiron_add_button_classes( $html, 'wp-block-button__link', 'filled' );

			case 'arneiron/token-calculator':
				// The "Top up" / Buy call to action (connector or Pro bridge render).
				return arneiron_add_button_classes( $html, 'btn', 'filled' );
		}
		return $html;
	}
}
add_filter( 'render_block', 'arneiron_button_render_classes', 10, 2 );

if ( ! function_exists( 'arneiron_button_comment_form' ) ) {
	/**
	 * Classic comment form (comments.php / comment_form()) submit button.
	 *
	 * @param array $defaults comment_form() defaults.
	 * @return array
	 */
	function arneiron_button_comment_form( $defaults ) {
		$defaults['class_submit'] = trim( ( isset( $defaults['class_submit'] ) ? $defaults['class_submit'] : 'submit' ) . ' arneiron-btn arneiron-btn--filled' );
		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'arneiron_button_comment_form' );

if ( ! function_exists( 'arneiron_button_woo_loop_args' ) ) {
	/**
	 * WooCommerce loop "Add to cart" buttons.
	 *
	 * @param array $args Loop add-to-cart args.
	 * @return array
	 */
	function arneiron_button_woo_loop_args( $args ) {
		$args['class'] = trim( ( isset( $args['class'] ) ? $args['class'] : '' ) . ' arneiron-btn arneiron-btn--filled' );
		return $args;
	}
}
add_filter( 'woocommerce_loop_add_to_cart_args', 'arneiron_button_woo_loop_args' );

if ( ! function_exists( 'arneiron_button_enqueue' ) ) {
	/**
	 * Load assets/css/buttons.css after every other parent layer.
	 *
	 * @return void
	 */
	function arneiron_button_enqueue() {
		wp_enqueue_style(
			'arneiron-buttons',
			get_template_directory_uri() . '/assets/css/buttons.css',
			array( 'arneiron-ds' ),
			function_exists( 'arneiron_asset_ver' ) ? arneiron_asset_ver( 'assets/css/buttons.css' ) : wp_get_theme( get_template() )->get( 'Version' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'arneiron_button_enqueue', 11 );

if ( ! function_exists( 'arneiron_button_editor_style' ) ) {
	/**
	 * Same rules in the editor canvas (the classes are not there, the
	 * is-style-* selectors in buttons.css cover it).
	 *
	 * @return void
	 */
	function arneiron_button_editor_style() {
		add_editor_style( 'assets/css/buttons.css' );
	}
}
add_action( 'after_setup_theme', 'arneiron_button_editor_style', 11 );
