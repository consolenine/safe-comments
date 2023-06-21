<?php
/**
 * Plugin Name:       Safe Comments
 * Description:       Blacklist Users With Emails From Commenting
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Shashank Deep
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
**/

function safe_comments_admin_menu() {
	add_menu_page( 'Dashboard - Safe Comments', 'Safe Comments', 'moderate_comments', 'safe-comments-dashboard', 'safe_comments_admin_page', (plugin_dir_url('safe-comments').'safe-comments/assets/icons/menu-icon-main.svg'), 200 );
}

function safe_comments_admin_page() {
	include( 'dashboard.php' );
} 

function init_safe_comments() {
	include( 'dbHandler.php' );

	add_action( 'admin_menu', 'safe_comments_admin_menu' );
	add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );

}

add_action('init','init_safe_comments');

function enqueue_custom_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'safe_comments_js', plugins_url( '/js/custom-script.js', __FILE__ ) );
}


// Initialize DB Tables
function init_db_safe_comments() {

	// WP Globals
	global $table_prefix, $wpdb;

	// Customer Table
	$blocklist = $table_prefix . 'safe_comments_blocklist';

	// Create Customer Table if not exist
	if( $wpdb->get_var( "show tables like '$blocklist'" ) != $blocklist ) {

		// Query - Create Table
		$sql = "CREATE TABLE `$blocklist` (";
		$sql .= " `id` int(11) NOT NULL auto_increment, ";
		$sql .= " `email` varchar(500) NOT NULL, ";
		$sql .= " `message` varchar(500) NOT NULL, ";
		$sql .= " PRIMARY KEY `customer_id` (`id`) ";
		$sql .= ") AUTO_INCREMENT=1;";

		// Include Upgrade Script
		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	
		// Create Table
		dbDelta( $sql );
	}

}

// Activate Plugin
function activate_safe_comments() {

	// Execute tasks on Plugin activation

	// Insert DB Tables
	init_db_safe_comments();
}

// De-activate Plugin
function deactivate_safe_comments() {
	global $table_prefix, $wpdb;

	$wpdb->query( "DROP TABLE IF EXISTS ".$table_prefix."safe_comments_blocklist" );
	// Execute tasks on Plugin de-activation
}
// Act on plugin activation
register_activation_hook( __FILE__, "activate_safe_comments" );

// Act on plugin de-activation
register_deactivation_hook( __FILE__, "deactivate_safe_comments" );

?>