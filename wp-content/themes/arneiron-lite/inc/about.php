<?php
/**
 * ArneIron Lite — Appearance > ArneIron Lite: a short getting-started page with
 * the recommended (WordPress.org) plugin, found and installed through core's
 * Plugins > Add New, and the one link to ArneIron Pro, plus
 * a one-time, dismissible notice after activation that points to it.
 *
 * Within the Theme Review requirements: a sub-page under Appearance in core UI;
 * the notice uses admin_notices, shows once and is dismissible; no popup, no
 * redirect on activation, no external calls, no tracking or affiliate links,
 * nothing on the front end.
 *
 * @package ArneIron_Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the page.
 *
 * @return void
 */
function arneiron_about_menu() {
	add_theme_page(
		__( 'ArneIron Lite', 'arneiron-lite' ),
		__( 'ArneIron Lite', 'arneiron-lite' ),
		'edit_theme_options',
		'arneiron-lite',
		'arneiron_about_render'
	);
}
add_action( 'admin_menu', 'arneiron_about_menu' );

/**
 * Render the page.
 *
 * @return void
 */
function arneiron_about_render() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$basename      = 'arneiron-blocks/arneiron-blocks.php';
	$blocks_active = defined( 'ARNEIRON_BLOCKS_LOADED' );
	$installed     = file_exists( WP_PLUGIN_DIR . '/' . $basename );
	$install_url   = '';
	$action_label  = '';
	if ( ! $blocks_active && $installed && current_user_can( 'activate_plugins' ) ) {
		$install_url  = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $basename ) ), 'activate-plugin_' . $basename );
		$action_label = __( 'Activate ArneIron Blocks', 'arneiron-lite' );
	} elseif ( ! $installed && current_user_can( 'install_plugins' ) ) {
		// Core's own Plugins > Add New search, not a direct install URL: the user
		// installs from there (core UI, explicit action), and if the plugin is not
		// in the WordPress.org directory, core simply finds nothing; the theme
		// itself makes no request to WordPress.org.
		$install_url  = self_admin_url( 'plugin-install.php?tab=search&type=term&s=' . rawurlencode( 'ArneIron Blocks' ) );
		$action_label = __( 'Find ArneIron Blocks in Plugins > Add New', 'arneiron-lite' );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'ArneIron Lite', 'arneiron-lite' ); ?></h1>
		<p><?php esc_html_e( 'Header, footer, menu drawer, templates and patterns are ready to use. Edit them in Appearance > Editor.', 'arneiron-lite' ); ?></p>

		<h2><?php esc_html_e( 'Your front page', 'arneiron-lite' ); ?></h2>
		<p><?php esc_html_e( 'While Settings > Reading shows your latest posts, the front page is a starter layout: a hero, three feature cards and your latest posts. Its text is placeholder copy; replace it with your own in the Site Editor. To show one of your pages instead, choose "A static page" in Settings > Reading.', 'arneiron-lite' ); ?></p>
		<p>
			<a class="button" href="<?php echo esc_url( admin_url( 'site-editor.php?postType=wp_template&postId=' . rawurlencode( get_stylesheet() . '//front-page-landing' ) . '&canvas=edit' ) ); ?>"><?php esc_html_e( 'Edit the front page', 'arneiron-lite' ); ?></a>
			<a class="button" href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>"><?php esc_html_e( 'Reading settings', 'arneiron-lite' ); ?></a>
		</p>
		<p><?php esc_html_e( 'When you add a new page, WordPress offers the theme\'s page layouts (About, Landing, Pricing) to start from.', 'arneiron-lite' ); ?></p>

		<h2><?php esc_html_e( 'Recommended plugin: ArneIron Blocks', 'arneiron-lite' ); ?></h2>
		<p><?php esc_html_e( 'Eighteen free design blocks styled for this theme: hero, feature cards, FAQ, price table, carousel, posts grid, WooCommerce showcase and more.', 'arneiron-lite' ); ?></p>
		<p><?php esc_html_e( 'It also has the demo content: in one click it adds the pages, posts, photos and menu of the theme demo, ready to edit, and removes them again in one click.', 'arneiron-lite' ); ?></p>
		<p>
			<?php if ( $blocks_active ) : ?>
				<?php esc_html_e( 'ArneIron Blocks is active.', 'arneiron-lite' ); ?>
				<?php if ( function_exists( 'arneiron_blocks_demo_url' ) && current_user_can( 'manage_options' ) ) : ?>
					<a class="button button-primary" href="<?php echo esc_url( arneiron_blocks_demo_url() ); ?>"><?php esc_html_e( 'Import demo content', 'arneiron-lite' ); ?></a>
				<?php endif; ?>
			<?php elseif ( $install_url ) : ?>
				<a class="button button-primary" href="<?php echo esc_url( $install_url ); ?>"><?php echo esc_html( $action_label ); ?></a>
			<?php endif; ?>
		</p>

		<h2><?php esc_html_e( 'ArneIron Pro', 'arneiron-lite' ); ?></h2>
		<p><?php esc_html_e( 'The commercial edition adds AI editing of your site through ArneIron, an auto-installed child theme, a site icon made from your logo, and WooCommerce account and wallet chrome.', 'arneiron-lite' ); ?></p>
		<p><a class="button" href="<?php echo esc_url( 'https://arneiron.net/pro/' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Learn about ArneIron Pro', 'arneiron-lite' ); ?><span class="screen-reader-text"> <?php esc_html_e( '(opens in a new tab)', 'arneiron-lite' ); ?></span></a></p>
	</div>
	<?php
}

/**
 * Arm the one-time notice when the theme is activated.
 *
 * @return void
 */
function arneiron_about_arm_notice() {
	$opt = get_option( 'arneiron_lite', array() );
	$opt = is_array( $opt ) ? $opt : array();
	if ( empty( $opt['notice_dismissed'] ) ) {
		$opt['notice_pending'] = 1;
		update_option( 'arneiron_lite', $opt );
	}
}
add_action( 'after_switch_theme', 'arneiron_about_arm_notice' );

/**
 * The notice: once, dismissible, only for users who can edit theme options.
 *
 * @return void
 */
function arneiron_about_notice() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	$opt = get_option( 'arneiron_lite', array() );
	if ( ! is_array( $opt ) || empty( $opt['notice_pending'] ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( $screen && 'appearance_page_arneiron-lite' === $screen->id ) {
		return;
	}
	$opt['notice_pending']   = 0;
	$opt['notice_dismissed'] = 1;
	update_option( 'arneiron_lite', $opt );
	printf(
		'<div class="notice notice-info is-dismissible"><p>%1$s <a href="%2$s">%3$s</a></p></div>',
		esc_html__( 'Thanks for choosing ArneIron Lite.', 'arneiron-lite' ),
		esc_url( admin_url( 'themes.php?page=arneiron-lite' ) ),
		esc_html__( 'Getting started', 'arneiron-lite' )
	);
}
add_action( 'admin_notices', 'arneiron_about_notice' );
