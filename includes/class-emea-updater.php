<?php
namespace EduMatchup\ElementorAddons;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Checks the public GitHub Releases feed and connects its ZIP asset to WordPress updates. */
final class Updater {
	const REPOSITORY = 'nasimcsediu/edu-matchup-elementor-addons';
	const CACHE_KEY = 'emea_latest_github_release';

	public function __construct() {
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'inject_update' ) );
		add_filter( 'plugins_api', array( $this, 'plugin_information' ), 20, 3 );
	}

	private function get_latest_release() {
		$release = get_transient( self::CACHE_KEY );
		if ( false !== $release ) {
			return $release;
		}

		$response = wp_remote_get( 'https://api.github.com/repos/' . self::REPOSITORY . '/releases/latest', array(
			'timeout' => 8,
			'headers' => array(
				'Accept'     => 'application/vnd.github+json',
				'User-Agent' => 'EduMatchup-Elementor-Addons/' . EMEA_VERSION,
			),
		) );
		if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
			set_transient( self::CACHE_KEY, array(), 15 * MINUTE_IN_SECONDS );
			return array();
		}

		$release = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( ! is_array( $release ) || empty( $release['tag_name'] ) || empty( $release['assets'] ) || ! is_array( $release['assets'] ) ) {
			set_transient( self::CACHE_KEY, array(), 15 * MINUTE_IN_SECONDS );
			return array();
		}

		set_transient( self::CACHE_KEY, $release, 6 * HOUR_IN_SECONDS );
		return $release;
	}

	private function get_release_asset( $release ) {
		foreach ( $release['assets'] as $asset ) {
			if ( ! empty( $asset['name'] ) && 'edu-matchup-elementor-addons.zip' === $asset['name'] && ! empty( $asset['browser_download_url'] ) ) {
				return $asset['browser_download_url'];
			}
		}
		return '';
	}

	public function inject_update( $transient ) {
		if ( ! is_object( $transient ) || empty( $transient->checked ) ) {
			return $transient;
		}
		$release = $this->get_latest_release();
		$version = ! empty( $release['tag_name'] ) ? ltrim( $release['tag_name'], 'vV' ) : '';
		$package = $this->get_release_asset( $release );
		if ( ! $version || ! $package || ! version_compare( $version, EMEA_VERSION, '>' ) ) {
			return $transient;
		}

		$plugin_file = plugin_basename( EMEA_FILE );
		$update = new \stdClass();
		$update->slug = 'edu-matchup-elementor-addons';
		$update->plugin = $plugin_file;
		$update->new_version = $version;
		$update->url = 'https://github.com/' . self::REPOSITORY;
		$update->package = $package;
		$update->requires = '6.0';
		$update->requires_php = '7.4';
		$transient->response[ $plugin_file ] = $update;
		return $transient;
	}

	public function plugin_information( $result, $action, $args ) {
		if ( 'plugin_information' !== $action || empty( $args->slug ) || 'edu-matchup-elementor-addons' !== $args->slug ) {
			return $result;
		}
		$release = $this->get_latest_release();
		$version = ! empty( $release['tag_name'] ) ? ltrim( $release['tag_name'], 'vV' ) : '';
		$package = $this->get_release_asset( $release );
		if ( ! $version || ! $package ) {
			return $result;
		}

		$info = new \stdClass();
		$info->name = 'EduMatchup Elementor Addons';
		$info->slug = 'edu-matchup-elementor-addons';
		$info->version = $version;
		$info->author = '<a href="https://github.com/' . esc_attr( self::REPOSITORY ) . '">PlayWithPPC</a>';
		$info->homepage = 'https://github.com/' . self::REPOSITORY;
		$info->download_link = $package;
		$info->requires = '6.0';
		$info->requires_php = '7.4';
		$info->sections = array(
			'description' => __( 'Editable Elementor widgets for the EduMatchup homepage.', 'edumatchup-elementor-addons' ),
			'changelog'   => ! empty( $release['body'] ) ? wp_kses_post( nl2br( $release['body'] ) ) : __( 'See the GitHub release notes.', 'edumatchup-elementor-addons' ),
		);
		return $info;
	}
}
