<?php
/**
 * Chrome integrations — how the theme's core-block chrome presents data from
 * WooCommerce, TeraWallet and Polylang when (and only when) they are active.
 *
 * WHY (theme 0.9.2)
 * -----------------
 * 0.9.1 rebuilt the header, mobile bar and drawer from core blocks so the theme
 * needs no plugin. Verified on dev.arneiron.net (WooCommerce + Polylang +
 * TeraWallet + a logo), the drawer then LOST things customers use:
 *   - the WooCommerce account links (Dashboard, Billing & Usage, ... Log out) —
 *     the customer-account block is a single "My Account" link;
 *   - the TeraWallet balance chip;
 *   - the language grid (EN DE RU ...), replaced by Polylang's name list;
 *   - the drawer menu followed core's navigation fallback instead of the menu
 *     the header uses;
 *   - a site's own social channels (dev replaces the theme's placeholder icons).
 *
 * Each is restored HERE as a presentational filter on a core block the theme
 * ships, and each falls back to that core block when its plugin is absent —
 * so the theme still renders complete with no plugin at all. Nothing here
 * registers a block, shortcode, post type or role (Theme Check plugin
 * territory); it only shapes how the theme's own parts render.
 *
 * Markup and class names are those of the 0.8.x shortcodes, so ds.css and
 * theme.js keep styling and binding them unchanged.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Chrome icons, from the theme's icon pack (inc/icons.php, hub#5318) so the
 * header, drawer and blocks share one grid and one stroke. Size comes from
 * ds.css (the wrappers size their <svg>).
 *
 * @param string $name Icon slug (wallet, globe, ...).
 * @return string Decorative <svg>, or '' when the pack is not loaded.
 */
function arneiron_chrome_icon( $name ) {
	return function_exists( 'arneiron_icon' ) ? arneiron_icon( $name ) : '';
}

/**
 * Whether a rendered block carries one of the theme's chrome class names.
 *
 * @param array  $block Parsed block.
 * @param string $class Class name.
 * @return bool
 */
function arneiron_chrome_has_class( $block, $class ) {
	$names = isset( $block['attrs']['className'] ) ? preg_split( '/\s+/', (string) $block['attrs']['className'] ) : array();
	return in_array( $class, $names, true );
}

/* -------------------------------------------------------------------------
 * 1. The drawer menu is the HEADER's menu.
 *    core/navigation without a `ref` renders core's fallback (the newest
 *    wp_navigation post). The drawer must show what the header shows, so its
 *    navigation block borrows the header part's `ref`.
 * ---------------------------------------------------------------------- */

/**
 * The `ref` of the first navigation block in the active header part.
 *
 * @return int
 */
function arneiron_chrome_header_navigation_ref() {
	static $ref = null;
	if ( null !== $ref ) {
		return $ref;
	}
	$ref  = 0;
	$part = get_block_template( get_stylesheet() . '//header', 'wp_template_part' );
	if ( $part && ! empty( $part->content ) ) {
		$stack = parse_blocks( $part->content );
		while ( $stack ) {
			$b = array_shift( $stack );
			if ( 'core/navigation' === $b['blockName'] && ! empty( $b['attrs']['ref'] ) ) {
				$ref = (int) $b['attrs']['ref'];
				break;
			}
			if ( ! empty( $b['innerBlocks'] ) ) {
				$stack = array_merge( $b['innerBlocks'], $stack );
			}
		}
	}
	return $ref;
}

/**
 * Give the drawer's navigation the header navigation's ref.
 *
 * @param array $parsed Parsed block.
 * @return array
 */
function arneiron_chrome_drawer_navigation_ref( $parsed ) {
	if ( 'core/navigation' === ( $parsed['blockName'] ?? '' ) && empty( $parsed['attrs']['ref'] ) && arneiron_chrome_has_class( $parsed, 'arneiron-drawer-nav' ) ) {
		$ref = arneiron_chrome_header_navigation_ref();
		if ( $ref ) {
			$parsed['attrs']['ref'] = $ref;
		}
	}
	return $parsed;
}
add_filter( 'render_block_data', 'arneiron_chrome_drawer_navigation_ref' );

/* -------------------------------------------------------------------------
 * 2. Drawer account: WooCommerce's account menu as a list (logged in), or a
 *    single "Log in" link to My Account (logged out). Without WooCommerce the
 *    group's core/loginout block renders as authored.
 * ---------------------------------------------------------------------- */

/**
 * WooCommerce account links for the drawer.
 *
 * @return string '' when WooCommerce is not active.
 */
function arneiron_chrome_account_links() {
	if ( ! function_exists( 'wc_get_account_menu_items' ) || ! function_exists( 'wc_get_account_endpoint_url' ) ) {
		return '';
	}
	$items = '';
	if ( ! get_current_user_id() ) {
		$items = sprintf(
			'<li class="arneiron-account-menu__item"><a href="%1$s" class="arneiron-account-menu__link">%2$s</a></li>',
			esc_url( wc_get_account_endpoint_url( 'dashboard' ) ? wc_get_account_endpoint_url( 'dashboard' ) : wp_login_url() ),
			esc_html__( 'Log in', 'arneiron-lite' )
		);
	} else {
		foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
			if ( 'customer-logout' === $endpoint ) {
				continue;
			}
			$items .= sprintf(
				'<li class="arneiron-account-menu__item"><a href="%1$s" class="arneiron-account-menu__link">%2$s</a></li>',
				esc_url( wc_get_account_endpoint_url( $endpoint ) ),
				esc_html( $label )
			);
		}
		$items .= sprintf(
			'<li class="arneiron-account-menu__item arneiron-account-menu__item--logout"><a href="%1$s" class="arneiron-account-menu__link">%2$s</a></li>',
			esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ),
			esc_html__( 'Log out', 'arneiron-lite' )
		);
	}
	return '<ul class="arneiron-account-menu arneiron-account-menu--drawer">' . $items . '</ul>';
}

/* -------------------------------------------------------------------------
 * 3. Drawer wallet: the TeraWallet balance chip for a logged-in customer.
 * ---------------------------------------------------------------------- */

/**
 * TeraWallet balance chip.
 *
 * Context 'edit' is load-bearing (hub#4241): 'view' returns formatted price
 * HTML, which wc_price() casts to 0.0 — the chip then shows the store's zero
 * for every customer.
 *
 * @return string '' without TeraWallet, without a customer, or on an unreadable wallet.
 */
function arneiron_chrome_wallet_chip() {
	if ( ! function_exists( 'woo_wallet' ) || ! function_exists( 'wc_price' ) || ! get_current_user_id() ) {
		return '';
	}
	$balance = woo_wallet()->wallet->get_wallet_balance( get_current_user_id(), 'edit' );
	if ( ! is_numeric( $balance ) ) {
		return '';
	}
	$balance = (float) $balance;
	$href    = wc_get_account_endpoint_url( 'wallet' );
	return sprintf(
		'<a href="%1$s" class="arneiron-mobile-bar__wallet arneiron-wallet-chip" data-wallet-balance="%2$s" aria-label="%3$s"><span class="arneiron-wallet-chip__icon" aria-hidden="true">%4$s</span><span class="arneiron-wallet-chip__value">%5$s</span></a>',
		esc_url( $href ? $href : home_url( '/my-account/' ) ),
		esc_attr( wc_format_decimal( $balance, wc_get_price_decimals() ) ),
		esc_attr__( 'Wallet', 'arneiron-lite' ),
		arneiron_chrome_icon( 'wallet' ),
		wp_kses( wc_price( $balance ), array( 'span' => array( 'class' => array() ) ) )
	);
}

/* -------------------------------------------------------------------------
 * 4. Language switcher: the 0.8.x shapes (header dropdown of codes, drawer
 *    grid of codes) from Polylang's own data. Without Polylang the
 *    polylang/language-switcher block is unregistered and renders nothing.
 * ---------------------------------------------------------------------- */

/**
 * Language switcher markup.
 *
 * @param string $style dropdown|list.
 * @return string '' without Polylang or with fewer than two languages.
 */
function arneiron_chrome_language_switcher( $style ) {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return '';
	}
	$languages = pll_the_languages(
		array(
			'raw'                    => 1,
			'hide_if_empty'          => 1,
			'hide_if_no_translation' => 0,
		)
	);
	if ( ! is_array( $languages ) || count( $languages ) < 2 ) {
		return '';
	}
	$current = null;
	foreach ( $languages as $language ) {
		if ( ! empty( $language['current_lang'] ) ) {
			$current = $language;
			break;
		}
	}
	if ( null === $current ) {
		$current = reset( $languages );
	}
	$label = esc_attr__( 'Change language', 'arneiron-lite' );
	$items = '';
	foreach ( $languages as $language ) {
		$is_current = ! empty( $language['current_lang'] );
		if ( 'list' === $style ) {
			$items .= sprintf(
				'<li class="arneiron-lang-list__item%1$s"><a href="%2$s" class="arneiron-lang-list__link" lang="%3$s" hreflang="%3$s"%4$s>%5$s</a></li>',
				$is_current ? ' is-current' : '',
				esc_url( $language['url'] ),
				esc_attr( $language['slug'] ),
				$is_current ? ' aria-current="true"' : '',
				esc_html( strtoupper( $language['slug'] ) )
			);
		} else {
			$items .= sprintf(
				'<li class="arneiron-lang-menu__item%1$s"><a href="%2$s" class="arneiron-lang-menu__link" lang="%3$s" hreflang="%3$s"%4$s><span class="arneiron-lang-menu__code">%5$s</span><span class="arneiron-lang-menu__name">%6$s</span></a></li>',
				$is_current ? ' is-current' : '',
				esc_url( $language['url'] ),
				esc_attr( $language['slug'] ),
				$is_current ? ' aria-current="true"' : '',
				esc_html( strtoupper( $language['slug'] ) ),
				esc_html( $language['name'] )
			);
		}
	}
	if ( 'list' === $style ) {
		return '<div class="arneiron-lang arneiron-lang--list"><span class="arneiron-lang__icon" aria-hidden="true">' . arneiron_chrome_icon( 'globe' ) . '</span><ul class="arneiron-lang-list" aria-label="' . $label . '">' . $items . '</ul></div>';
	}
	$trigger = sprintf(
		'<button type="button" class="arneiron-lang-toggle" aria-expanded="false" aria-haspopup="true" aria-label="%1$s"><span class="arneiron-lang-toggle__icon" aria-hidden="true">%2$s</span><span class="arneiron-lang-toggle__code">%3$s</span></button>',
		$label,
		arneiron_chrome_icon( 'globe' ),
		esc_html( strtoupper( $current['slug'] ) )
	);
	return '<div class="arneiron-lang arneiron-lang--dropdown">' . $trigger . '<ul class="arneiron-lang-menu" aria-hidden="true" hidden>' . $items . '</ul></div>';
}

/* -------------------------------------------------------------------------
 * 5. Socials: a site that replaced the 0.8.x [arneiron_social_icons]
 *    placeholder with its own channels (dev.arneiron.net does, per language)
 *    keeps them in the drawer. The theme's core/social-links placeholder is
 *    used otherwise — including when only ArneIron Blocks' own default
 *    registration of that tag exists, so the drawer looks the same with the
 *    plugin on or off.
 * ---------------------------------------------------------------------- */

/**
 * The site's own social markup, if a site-level override of the legacy tag exists.
 *
 * @return string|null null = keep the theme's core block.
 */
function arneiron_chrome_site_socials() {
	global $shortcode_tags;
	if ( empty( $shortcode_tags['arneiron_social_icons'] ) || 'arneiron_social_icons_shortcode' === $shortcode_tags['arneiron_social_icons'] ) {
		return null;
	}
	$html = do_shortcode( '[arneiron_social_icons]' );
	return is_string( $html ) ? $html : null;
}

/* -------------------------------------------------------------------------
 * 6. Log in / Log out as an icon in the header (Pro 0.10.3 / Lite 1.1.2).
 * ---------------------------------------------------------------------- */

/**
 * The header's core/loginout (class `arneiron-account-icon`) as an icon
 * button: the link keeps its text (CSS hides it visually and draws a person
 * glyph, with an exit arrow when logged in) and gains a matching aria-label and
 * a `title` tooltip, "Log in" / "Log out".
 *
 * @param string $html Rendered core/loginout.
 * @return string
 */
function arneiron_chrome_loginout_icon( $html ) {
	if ( ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
		return $html;
	}
	$label = is_user_logged_in() ? __( 'Log out', 'arneiron-lite' ) : __( 'Log in', 'arneiron-lite' );
	$p     = new WP_HTML_Tag_Processor( $html );
	if ( $p->next_tag( 'a' ) ) {
		$p->set_attribute( 'aria-label', $label );
		$p->set_attribute( 'title', $label );
	}
	return $p->get_updated_html();
}

/* -------------------------------------------------------------------------
 * The one render filter that applies 2-5 to the theme's own blocks.
 * ---------------------------------------------------------------------- */

/**
 * Shape the theme's chrome blocks (see sections 2-6).
 *
 * @param string $html  Rendered block.
 * @param array  $block Parsed block.
 * @return string
 */
function arneiron_chrome_render( $html, $block ) {
	$name = $block['blockName'] ?? '';

	if ( 'polylang/language-switcher' === $name ) {
		$list = ! empty( $block['attrs']['className'] ) && false !== strpos( (string) $block['attrs']['className'], 'arneiron-lang--list' );
		$ours = arneiron_chrome_language_switcher( $list ? 'list' : 'dropdown' );
		return '' !== $ours ? $ours : $html;
	}

	if ( 'core/loginout' === $name && arneiron_chrome_has_class( $block, 'arneiron-account-icon' ) ) {
		return arneiron_chrome_loginout_icon( $html );
	}

	if ( 'core/group' !== $name ) {
		if ( 'core/social-links' === $name && arneiron_chrome_has_class( $block, 'arneiron-social' ) ) {
			$site = arneiron_chrome_site_socials();
			return null !== $site ? $site : $html;
		}
		return $html;
	}

	if ( arneiron_chrome_has_class( $block, 'mobile-menu-account' ) ) {
		$links = arneiron_chrome_account_links();
		if ( '' !== $links ) {
			return preg_replace( '#^(<div\b[^>]*>).*(</div>)\s*$#s', '$1' . str_replace( array( '\\', '$' ), array( '\\\\', '\\$' ), $links ) . '$2', trim( $html ) );
		}
		return $html;
	}

	if ( arneiron_chrome_has_class( $block, 'arneiron-balance-seam' ) ) {
		$chip = arneiron_chrome_wallet_chip();
		return preg_replace( '#^(<div\b[^>]*>).*(</div>)\s*$#s', '$1' . str_replace( array( '\\', '$' ), array( '\\\\', '\\$' ), $chip ) . '$2', trim( $html ) );
	}

	return $html;
}
add_filter( 'render_block', 'arneiron_chrome_render', 10, 2 );
