<?php
/**
 * Add dashboard widget.
 *
 * @package umms\includes
 */

namespace umms\includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Widget {

	public function __construct() {
		$this->plugin_dir = trailingslashit( dirname( plugin_dir_path( __FILE__ ) ) );
		$this->plugin_url = trailingslashit( dirname( plugin_dir_url( __FILE__ ) ) );

		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue' ) );
		add_action( 'wp_dashboard_setup', array( &$this, 'dashboard_widgets' ) );
	}

	public function enqueue() {
		global $current_screen;
		if ( isset( $current_screen ) && 'dashboard' === $current_screen->id ) {
			wp_enqueue_style(
				'umms-widget',
				$this->plugin_url . 'assets/css/umms-widget.css',
				array(),
				'1.0.0'
			);
		}
	}

	public function dashboard_widgets() {
		global $current_screen;
		if ( isset( $current_screen ) && 'dashboard' === $current_screen->id ) {
			wp_add_dashboard_widget( 'um-activity-dummy', __( 'Multisite transfer users', 'um-multisite' ), array( &$this, 'dashboard_widget_content' ) );
		}
	}

	public function dashboard_widget_content() {
		$template = wp_normalize_path( $this->plugin_dir . 'templates/widget.php' );
		if ( file_exists( $template ) ) {
			require_once $template;
		}
	}
}
