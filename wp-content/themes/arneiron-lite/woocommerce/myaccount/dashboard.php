<?php
/**
 * My Account Dashboard — ArneIron override.
 *
 * Overrides woocommerce/templates/myaccount/dashboard.php (core @version 4.4.0).
 *
 * WHY THIS FILE EXISTS
 *   WooCommerce's dashboard opens with two paragraphs of boilerplate:
 *     "Hello <name> (not <name>? Log out)"
 *     "From your account dashboard you can view your recent orders, manage your
 *      shipping and billing addresses, and edit your password and account details."
 *   Both are dead weight here. The name and the log-out link are already in the
 *   site header and in the sidebar's own LOGOUT item, and the three links it
 *   advertises do not describe this account: there is no shipping (billing only,
 *   see inc/account-menu.php), Orders and Payment methods live inside Billing &
 *   Usage, and the sidebar links the rest. The text is hardcoded in the core
 *   template with no filter, so a template override is the only way to drop it.
 *
 * WHAT IS DELIBERATELY KEPT
 *   All three do_action() calls, unchanged and in core's order. The theme's own
 *   dashboard body — connected sites plus the connect form — is hooked onto
 *   `woocommerce_account_dashboard` at priority 20 by
 *   arneiron_account_dashboard_sites() in inc/account-menu.php, so removing any
 *   of them would blank the page.
 *
 * @package ArneIron
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce's own template hook, which an override must keep.

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce's own template hook, which an override must keep.

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- WooCommerce's own template hook, which an override must keep.
