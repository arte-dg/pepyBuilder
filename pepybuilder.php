<?php 
/**
 * Plugin Name: pepyBuilder
 * Description: Crie temas do zero com o Elementor
 * Plugin URI:  https://pepy.link/
 * Author:      Douglas Gaspar
 * Author URI:  https://pepy.link/
 * Version:     0.5
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pepybuilder
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'HTBUILDER_VERSION', '0.2.5' );
define( 'HTBUILDER_PL_ROOT', __FILE__ );
define( 'HTBUILDER_PL_URL', plugins_url( '/', HTBUILDER_PL_ROOT ) );
define( 'HTBUILDER_PL_PATH', plugin_dir_path( HTBUILDER_PL_ROOT ) );
define( 'HTBUILDER_PLUGIN_BASE', plugin_basename( HTBUILDER_PL_ROOT ) );

// Required File
require( HTBUILDER_PL_PATH.'includes/base.php' );

//Plugins de ouro 
include_once( HTBUILDER_PL_PATH . 'includes/plugins/class-tgm-plugin-activation.php' );
include_once( HTBUILDER_PL_PATH . 'includes/plugins/tgm-plugin-activation.php' );
include_once( HTBUILDER_PL_PATH . 'make-column-clickable-elementor.php' );
//Updates 
require_once('wp-updates-plugin.php');
new WPUpdatesPluginUpdater_2175( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));