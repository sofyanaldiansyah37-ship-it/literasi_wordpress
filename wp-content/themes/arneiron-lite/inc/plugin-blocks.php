<?php
/**
 * Plugin blocks in the header and the menu drawer, only while their plugin is active.
 *
 * The header, mobile bar and drawer can carry WooCommerce's account link and
 * mini-cart, the TeraWallet balance and Polylang's language switcher. Those are
 * NOT in the template part files: a part that names a block of an inactive plugin
 * shows a "this block is not supported" placeholder in the Site Editor. They are
 * added with core Block Hooks (WordPress 6.5+) instead, and only when the plugin
 * is active, so:
 *  - without the plugin nothing is added, on the site or in the editor;
 *  - with it, the block appears in its place on the site AND in the Site Editor,
 *    where the user can move or remove it (core then remembers the removal in
 *    the anchor's `metadata.ignoredHookedBlocks`).
 *
 * Anchors are the parts' own core blocks, told apart by their class names:
 *   core/loginout `arneiron-account-icon`   header: language switcher group and
 *                                           account link before it, mini-cart after
 *   core/loginout `arneiron-account-fallback` (drawer): account link before it
 *   core/html with the mobile-bar toggle     mobile bar: mini-cart group before it
 *   core/group `mobile-menu-account`         drawer: wallet balance group after it
 *   core/group `arneiron-mobile-drawer__panel` drawer: language switcher group last
 * A part, template or pattern that already contains the block (one customised
 * before this existed) gets no second copy.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Which integrations are active.
 *
 * @return array{woo:bool,wallet:bool,pll:bool}
 */
function arneiron_plugin_blocks_active() {
	return array(
		'woo'    => class_exists( 'WooCommerce' ),
		'wallet' => class_exists( 'WooCommerce' ) && function_exists( 'woo_wallet' ),
		'pll'    => function_exists( 'pll_the_languages' ),
	);
}

/**
 * Markup of the template, part or pattern the anchor belongs to.
 *
 * @param WP_Block_Template|WP_Post|array $context Block hooks context.
 * @return string
 */
function arneiron_plugin_blocks_context_content( $context ) {
	if ( $context instanceof WP_Block_Template ) {
		return (string) $context->content;
	}
	if ( $context instanceof WP_Post ) {
		return (string) $context->post_content;
	}
	return is_array( $context ) && isset( $context['content'] ) ? (string) $context['content'] : '';
}

/**
 * Whether a parsed block carries a class.
 *
 * @param array  $block Parsed block.
 * @param string $class Class name.
 * @return bool
 */
function arneiron_plugin_blocks_has_class( $block, $class ) {
	$classes = isset( $block['attrs']['className'] ) ? preg_split( '/\s+/', (string) $block['attrs']['className'] ) : array();
	return in_array( $class, $classes, true );
}

/**
 * A static core/group wrapping one dynamic block, in parsed form.
 *
 * @param string $class Group class.
 * @param array  $inner Parsed inner block.
 * @return array
 */
function arneiron_plugin_blocks_group( $class, $inner ) {
	$open = '<div class="wp-block-group ' . esc_attr( $class ) . '">';
	return array(
		'blockName'    => 'core/group',
		'attrs'        => array(
			'className' => $class,
			'layout'    => array( 'type' => 'default' ),
		),
		'innerBlocks'  => array( $inner ),
		'innerHTML'    => $open . '</div>',
		'innerContent' => array( $open, null, '</div>' ),
	);
}

/**
 * A dynamic block with no inner content, in parsed form.
 *
 * @param string $name  Block name.
 * @param array  $attrs Attributes.
 * @return array
 */
function arneiron_plugin_blocks_leaf( $name, $attrs = array() ) {
	return array(
		'blockName'    => $name,
		'attrs'        => $attrs,
		'innerBlocks'  => array(),
		'innerHTML'    => '',
		'innerContent' => array(),
	);
}

/**
 * Whether a template, part or pattern is one of this theme's header/drawer parts
 * (it carries one of the anchor classes above).
 *
 * @param WP_Block_Template|WP_Post|array $context Block hooks context.
 * @return bool
 */
function arneiron_plugin_blocks_is_ours( $context ) {
	$c = arneiron_plugin_blocks_context_content( $context );
	return false !== strpos( $c, 'arneiron-account-icon' ) || false !== strpos( $c, 'arneiron-mobile-bar__toggle' ) || false !== strpos( $c, 'arneiron-mobile-drawer__panel' );
}

/**
 * Hook the block types at their anchors while their plugins are active, and
 * only in this theme's own parts (and patterns made from them).
 *
 * @param string[]                        $types    Hooked block types.
 * @param string                          $position before|after|first_child|last_child.
 * @param string                          $anchor   Anchor block type.
 * @param WP_Block_Template|WP_Post|array $context  Where the anchor is.
 * @return string[]
 */
function arneiron_plugin_blocks_hook( $types, $position, $anchor, $context ) {
	if ( ! arneiron_plugin_blocks_is_ours( $context ) ) {
		return $types;
	}
	$on = arneiron_plugin_blocks_active();
	if ( 'core/navigation' === $anchor && 'after' === $position ) {
		// WooCommerce hooks its account link and mini-cart after the navigation of
		// any header part; in these parts they have their own places (below).
		return array_values( array_diff( $types, array( 'woocommerce/customer-account', 'woocommerce/mini-cart' ) ) );
	}
	if ( 'core/loginout' === $anchor && 'before' === $position ) {
		if ( $on['pll'] ) {
			$types[] = 'core/group';
		}
		if ( $on['woo'] ) {
			$types[] = 'woocommerce/customer-account';
		}
	} elseif ( 'core/loginout' === $anchor && 'after' === $position && $on['woo'] ) {
		$types[] = 'woocommerce/mini-cart';
	} elseif ( 'core/html' === $anchor && 'before' === $position && $on['woo'] ) {
		$types[] = 'core/group';
	} elseif ( 'core/group' === $anchor && 'after' === $position && $on['wallet'] ) {
		$types[] = 'core/group';
	} elseif ( 'core/group' === $anchor && 'last_child' === $position && $on['pll'] ) {
		$types[] = 'core/group';
	}
	return $types;
}
// After WooCommerce's own registrations (priority 9).
add_filter( 'hooked_block_types', 'arneiron_plugin_blocks_hook', 20, 4 );

/*
 * The per-block filters below run at priority 20, AFTER WooCommerce's own
 * `hooked_block_woocommerce/*` filters (priority 10). Those write attributes into
 * whatever they get, so a null handed to them came back as a block array with no
 * blockName: PHP warnings in wp-includes/blocks.php and a header that lost the
 * rest of its hooked blocks (measured with WooCommerce 11.2.1). They never see
 * a null from here; a null from here is final.
 */

/**
 * WooCommerce account link: an icon in the header, words in the drawer.
 *
 * @param array|null                      $block    Hooked block.
 * @param string                          $type     Hooked type.
 * @param string                          $position Relative position.
 * @param array                           $anchor   Anchor block.
 * @param WP_Block_Template|WP_Post|array $context  Where the anchor is.
 * @return array|null
 */
function arneiron_plugin_blocks_account( $block, $type, $position, $anchor, $context ) {
	if ( null === $block || 'core/loginout' !== ( $anchor['blockName'] ?? '' ) ) {
		return $block; // Not a placement of this theme.
	}
	if ( false !== strpos( arneiron_plugin_blocks_context_content( $context ), '<!-- wp:woocommerce/customer-account' ) ) {
		return null;
	}
	if ( arneiron_plugin_blocks_has_class( $anchor, 'arneiron-account-icon' ) ) {
		return arneiron_plugin_blocks_leaf( 'woocommerce/customer-account', array( 'displayStyle' => 'icon_only' ) );
	}
	if ( arneiron_plugin_blocks_has_class( $anchor, 'arneiron-account-fallback' ) ) {
		return arneiron_plugin_blocks_leaf( 'woocommerce/customer-account', array( 'displayStyle' => 'text_only' ) );
	}
	return null;
}
add_filter( 'hooked_block_woocommerce/customer-account', 'arneiron_plugin_blocks_account', 20, 5 );

/**
 * WooCommerce mini-cart after the header's account icon.
 *
 * @param array|null                      $block    Hooked block.
 * @param string                          $type     Hooked type.
 * @param string                          $position Relative position.
 * @param array                           $anchor   Anchor block.
 * @param WP_Block_Template|WP_Post|array $context  Where the anchor is.
 * @return array|null
 */
function arneiron_plugin_blocks_mini_cart( $block, $type, $position, $anchor, $context ) {
	if ( null === $block || 'core/loginout' !== ( $anchor['blockName'] ?? '' ) ) {
		return $block; // Not a placement of this theme.
	}
	if ( ! arneiron_plugin_blocks_has_class( $anchor, 'arneiron-account-icon' )
		|| false !== strpos( arneiron_plugin_blocks_context_content( $context ), '<!-- wp:woocommerce/mini-cart' ) ) {
		return null;
	}
	return $block; // WooCommerce has already set its attributes on it.
}
add_filter( 'hooked_block_woocommerce/mini-cart', 'arneiron_plugin_blocks_mini_cart', 20, 5 );

/**
 * The wrapped ones: language switcher (header, drawer), mobile-bar mini-cart,
 * drawer wallet balance.
 *
 * @param array|null                      $block    Hooked block.
 * @param string                          $type     Hooked type.
 * @param string                          $position Relative position.
 * @param array                           $anchor   Anchor block.
 * @param WP_Block_Template|WP_Post|array $context  Where the anchor is.
 * @return array|null
 */
function arneiron_plugin_blocks_groups( $block, $type, $position, $anchor, $context ) {
	if ( null === $block ) {
		return null;
	}
	$content = arneiron_plugin_blocks_context_content( $context );
	$name    = isset( $anchor['blockName'] ) ? $anchor['blockName'] : '';
	if ( 'core/loginout' === $name && 'before' === $position && arneiron_plugin_blocks_has_class( $anchor, 'arneiron-account-icon' ) ) {
		return false !== strpos( $content, 'arneiron-lang-seam' ) ? null
			: arneiron_plugin_blocks_group( 'arneiron-lang-seam', arneiron_plugin_blocks_leaf( 'polylang/language-switcher', array( 'dropdown' => true ) ) );
	}
	if ( 'core/group' === $name && 'last_child' === $position && arneiron_plugin_blocks_has_class( $anchor, 'arneiron-mobile-drawer__panel' ) ) {
		return false !== strpos( $content, 'arneiron-lang-seam--drawer' ) ? null
			: arneiron_plugin_blocks_group( 'arneiron-lang-seam arneiron-lang-seam--drawer', arneiron_plugin_blocks_leaf( 'polylang/language-switcher', array( 'className' => 'arneiron-lang--list' ) ) );
	}
	if ( 'core/html' === $name && 'before' === $position && false !== strpos( (string) ( $anchor['innerHTML'] ?? '' ), 'arneiron-mobile-bar__toggle' ) ) {
		return false !== strpos( $content, '<!-- wp:woocommerce/mini-cart' ) ? null
			: arneiron_plugin_blocks_group( 'arneiron-mobile-bar__icons-inner', arneiron_plugin_blocks_leaf( 'woocommerce/mini-cart' ) );
	}
	if ( 'core/group' === $name && 'after' === $position && arneiron_plugin_blocks_has_class( $anchor, 'mobile-menu-account' ) ) {
		if ( false !== strpos( $content, 'arneiron-balance-seam' ) ) {
			return null;
		}
		$open = '<div class="wp-block-group arneiron-balance-seam"></div>';
		return array(
			'blockName'    => 'core/group',
			'attrs'        => array(
				'className' => 'arneiron-balance-seam',
				'layout'    => array( 'type' => 'default' ),
			),
			'innerBlocks'  => array(),
			'innerHTML'    => $open,
			'innerContent' => array( $open ),
		);
	}
	return null;
}
add_filter( 'hooked_block_core/group', 'arneiron_plugin_blocks_groups', 20, 5 );
