<?php
namespace EduMatchup\ElementorAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Plugin {
	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		require_once EMEA_PATH . 'includes/class-emea-updater.php';
		new Updater();
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );
	}

	public function register_category( $elements_manager ) {
		$elements_manager->add_category( 'edumatchup', array(
			'title' => __( 'EduMatchup', 'edumatchup-elementor-addons' ),
			'icon'  => 'fa fa-plug',
		) );
	}

	public function register_styles() {
		wp_register_style( 'emea-home-widgets', EMEA_URL . 'assets/css/home-widgets.css', array(), EMEA_VERSION );
	}

	public function register_widgets( $widgets_manager ) {
		require_once EMEA_PATH . 'includes/widgets/class-emea-base-widget.php';
		$files = array(
			'class-emea-hero-widget.php',
			'class-emea-destinations-widget.php',
			'class-emea-services-widget.php',
			'class-emea-arrival-widget.php',
			'class-emea-process-widget.php',
			'class-emea-tools-widget.php',
			'class-emea-cta-widget.php',
		);
		foreach ( $files as $file ) {
			require_once EMEA_PATH . 'includes/widgets/' . $file;
		}
		$classes = array(
			'Hero_Widget',
			'Destinations_Widget',
			'Services_Widget',
			'Arrival_Widget',
			'Process_Widget',
			'Tools_Widget',
			'Cta_Widget',
		);
		foreach ( $classes as $class ) {
			$qualified = __NAMESPACE__ . '\\Widgets\\' . $class;
			$widgets_manager->register( new $qualified() );
		}
	}
}
