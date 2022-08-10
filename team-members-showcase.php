<?php

/**
 * Plugin Name:       Team Members Showcase
 * Plugin URI:        https://github.com/hasanfardous/team-members-showcase
 * Description:       Show team members anywhere by the shortcode with 3 differents attributes.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Hasanfardous
 * Author URI:        https://github.com/hasanfardous/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       team-members-showcase
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
define( 'TEAM_MEMBERS_SHOWCASE_VERSION', '1.0.0' );

function tms_load_textdomain() {
	load_plugin_textdomain( 'team-members-showcase', false, dirname( __FILE__ ) . "/languages" );
}

add_action( "plugins_loaded", "tms_load_textdomain" );

// Enqueue Front-end scripts
add_action( 'wp_enqueue_scripts', 'tms_enqueue_scripts', 99 );
function tms_enqueue_scripts() {
	// Load CSS
	wp_enqueue_style( 'tms-styles', plugins_url( 'assets/css/styles.css', __FILE__ ), '', time() );
}


/**
 * Including plugin files
 */
require plugin_dir_path( __FILE__ ) . 'includes/register-post-and-taxonomies.php';
require plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
require plugin_dir_path( __FILE__ ) . 'includes/admin/submenu-page.php';

// Default plugin options
function tms_set_default_options(){
	$tms_settings_array 					  = [];
	$tms_settings_array['tms_post_type_name'] = 'Team Members';
	$tms_settings_array['tms_post_type_slug'] = 'team_members';
	
	// Updating default settings
	update_option( 'tms_setting_datas', $tms_settings_array );
}

/**
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, 'tms_plugin_activation_func' );
if ( ! function_exists( 'tms_plugin_activation_func' ) ) {
	function tms_plugin_activation_func() {
		// Saving our plugin current version
		add_option( "team_members_showcase_version", TEAM_MEMBERS_SHOWCASE_VERSION );

		// Saving plugin default options
		tms_set_default_options();
	}
}

?>