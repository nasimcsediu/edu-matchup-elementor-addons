<?php
/**
 * Plugin Name: EduMatchup Elementor Addons
 * Description: Editable Elementor widgets inspired by the EduMatchup Modern theme.
 * Version: 1.1.0
 * Author: PlayWithPPC
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: edumatchup-elementor-addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EMEA_VERSION', '1.1.0' );
define( 'EMEA_FILE', __FILE__ );
define( 'EMEA_PATH', plugin_dir_path( __FILE__ ) );
define( 'EMEA_URL', plugin_dir_url( __FILE__ ) );

add_action( 'plugins_loaded', 'emea_bootstrap' );

function emea_bootstrap() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'emea_elementor_missing_notice' );
		return;
	}

	require_once EMEA_PATH . 'includes/class-emea-plugin.php';
	\EduMatchup\ElementorAddons\Plugin::instance();
}

function emea_elementor_missing_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	?>
	<div class="notice notice-warning is-dismissible"><p><?php esc_html_e( 'EduMatchup Elementor Addons needs Elementor to be installed and active.', 'edumatchup-elementor-addons' ); ?></p></div>
	<?php
}
