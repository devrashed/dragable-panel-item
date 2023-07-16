<?php

/**
 * Plugin Name:       Dragable Panel Item
 * Description:       Easily drag and drop admin panel item.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Rashed khan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dragable-panel-item
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DRAGABLE_PANEL_ITEM_VERSION', '1.0.0' );

function dpi_load_textdomain() {
	load_plugin_textdomain( 'dragable-panel-item', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", "dpi_load_textdomain" );

// Enqueue Front-end scripts
add_action( 'admin_enqueue_scripts', 'dpi_enqueue_scripts', 99 );
function dpi_enqueue_scripts() {
	// Load CSS
	wp_enqueue_style( 'dpi-jquery-ui-styles', plugins_url( 'assets/css/jquery-ui.css', __FILE__ ), array(), '1.13.2' );
	wp_enqueue_style( 'dpi-styles', plugins_url( 'assets/css/styles.css', __FILE__ ), '', time() );
	
	// Load JS
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'dpi-script', plugins_url( 'assets/js/custom.js', __FILE__ ), array( 'jquery-ui-sortable' ), false, true );
	wp_localize_script(
		'dpi-script', 
		'dpi_datas', 
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		) 
	);
}


/**
 * Including plugin files
 */
require plugin_dir_path( __FILE__ ) . 'includes/admin/menu-page.php';
require plugin_dir_path( __FILE__ ) . 'includes/admin/ajax-handler.php';

// Default datas
function dpi_set_default_datas(){
	$dpi_data_array				 = [];
	$dpi_data_array['sortable1'] = [
		'Item 1',
		'Item 2',
		'Item 3',
	];
	$dpi_data_array['sortable2'] = [
		'Item 4',
		'Item 5',
	];
	
	// Updating default settings
	update_option( 'dpi_datas', $dpi_data_array );
}

/**
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, 'dpi_plugin_activation_func' );
if ( ! function_exists( 'dpi_plugin_activation_func' ) ) {
	function dpi_plugin_activation_func() {
		// Saving our plugin current version
		add_option( "dragable_panel_item_version", DRAGABLE_PANEL_ITEM_VERSION );

		// Saving plugin default options
		dpi_set_default_datas();
	}
}

?>