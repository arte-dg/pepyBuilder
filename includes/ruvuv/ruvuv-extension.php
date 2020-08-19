<?php
/**
 * Plugin Name: Ruvuv Extension For Elementor
 * Description: Extended Visual Functionality Add-on for Elementor Page Builder.
 * Plugin URI:  https://elementorextension.ruvuv.com/
 * Version:     1.0.0
 * Author:      Ruvuv
 * Author URI:  https://ruvuv.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ruvuv-extension
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'RUVUV_EXPAND_VERSION', '1.0.0' );
define( 'RUVUV_MINIMUM_PHP_VERSION', '7.0' );
define( 'RUVUV_EXPAND_BASE', plugin_basename( __FILE__ ) );
define( 'RUVUV_EXPAND_PATH', plugin_dir_path( __FILE__ ) );
define( 'RUVUV_EXPAND_URL', plugins_url( '/', __FILE__ ) );
define( 'RUVUV_EXPAND_INCLUDE_DIR', RUVUV_EXPAND_PATH . 'includes/' );
define( 'RUVUV_EXPAND_ASSETS_PATH', RUVUV_EXPAND_PATH . 'assets/' );
define( 'RUVUV_EXPAND_ASSETS_URL', RUVUV_EXPAND_URL . 'assets/' );

if(! function_exists('ruvuv_expand_load_plugin')) {
    add_action( 'plugins_loaded', 'ruvuv_expand_load_plugin' );
	function ruvuv_expand_load_plugin(){
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'ruvuv_expand_admin_notice_missing_main_plugin' );
			return;
		}

		// Check for required Elementor version
		$elementor_version_required = '2.1.0';
		if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
			add_action( 'admin_notices', 'ruvuv_expand_admin_notice_minimum_elementor_version' );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, RUVUV_MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', 'ruvuv_expand_admin_notice_minimum_php_version' );
			return;
		}

		require_once RUVUV_EXPAND_PATH . 'includes/plugin.php';
	}
}

