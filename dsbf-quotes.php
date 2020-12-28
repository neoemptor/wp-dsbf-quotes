<?php
/**
 * Plugin Name: DSBF Quotes
 * Plugin URI: https://dsbf-quotes.dsbaileyfreelancer.com.au
 * Description: A simplified, easy to use custom quoting system
 * Version: 0.1.0
 * Requires at least: 5.5
 * Requires PHP: 7.3.^
 * Author: D S Bailey Freelancer (Darren Bailey)
 * Author URI: dsbaileyfreelancer.com.au
 * License: Commercial
 * Text Domain: dsbf-quotes
 *
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
define( 'PLUGIN_NAME_VERSION', '0.1.0' );

global $wpdb;
$dsbf_debug = false;
define( 'STYLE_URI', plugin_dir_url( 'dsbf-quotes' ) );
define( 'THE_PATH', STYLE_URI . 'dsbf-quotes/dsbf-assets/dsbf-style.css' );
require_once 'firebase-helper-lib.php';
include_once "dsbf-user-form.php";

// ============= Scripts and Styles ===========================================
function register_dsbf_scripts() {
	wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array( 'jquery' ), '1.12.1', false );
	wp_register_script( 'dsbf-scripts', STYLE_URI . 'dsbf-quotes/dsbf-assets/main.js', array( 'jquery' ), '1.0.5', false );
	wp_register_script( 'jquery-validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js', array( 'jquery' ), '1.19.0', true );
	wp_register_script( 'jquery-datatables', 'https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js', array( 'jquery' ), '1.10.11', true );
	wp_register_script( 'fancybox-script', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js', '2.1.5', true );
	wp_register_script( 'sweet-alert-script', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js', '1.1.3', true );
}

function register_dsbf_styles() {
	wp_register_style( 'child-style', THE_PATH, array( 'parent-style' ), '1.0.1', 'all' );
	wp_register_style( 'custom-style', THE_PATH, '1.0.0', 'all' );
	wp_register_style( 'Font_Awesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', '5.7.2', 'all' );
////	wp_register_style( 'Visual_Composer', COMPOSER_PATH . 'css/js_composer.css', 'all' );
	wp_register_style( 'jquery-ui-style', 'https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css', '1.12.0', 'all' );
	wp_register_style( 'jquery-datatables-style', 'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', '1.10.19', 'all' );
	wp_register_style( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css', '2.1.5', 'all' );
	wp_register_style( 'sweet-alert', 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css', '1.1.3', 'all' );
	wp_register_style( 'bootstrap-style', 'https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', '3.3.6', 'all' );
}

function enqueue_dsbf_styles() {

	register_dsbf_styles();

	wp_enqueue_style( 'child-style' );
	wp_enqueue_style( 'custom-style' );
	wp_enqueue_style( 'Font_Awesome' );
//	wp_enqueue_style( 'Visual_Composer' );
	wp_enqueue_style( 'jquery-ui-style' );
	wp_enqueue_style( 'jquery-datatables-style' );
	wp_enqueue_style( 'fancybox' );
	wp_enqueue_style( 'sweet-alert' );
	wp_enqueue_style( 'bootstrap-style' );
}

function enqueue_dsbf_scripts() {
//
	register_dsbf_scripts();
//
	wp_enqueue_script( 'dsbf-scripts' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'jquery-validate-script' );
	wp_enqueue_script( 'fancybox-script' );
	wp_enqueue_script( 'sweet-alert-script' );
}

function dsbf_shortcodes_init() {
	add_shortcode( 'dsbf-form', 'dsbf_show_form_shortcode' );
}

//include_once "dsbf-admin-form.php";

//add_menu_page(
//	'DSBF Forms'
//	, 'DSBF Forms'
//	, null, 'dsbf-quotes'
//	, ''
//	, ''
//	, null );

//add_action( 'admin_menu', 'dsbf_forms_page' );
//
//function dsbf_forms_page() {
//	add_menu_page(
//		'DSBF Forms',
//		'DSBF Forms',
//		'manage_options',
//		'dsbf',
//		'dsbf_forms_page_html',
//		plugin_dir_url( __FILE__ ) . 'images/icon_wporg.png',
//		20
//	);
//}

function activate_dsbf_quotes() {

//	add_action( "dsbf_add_test", "add_data", 10 );
}

function deactivate_dsbf_quotes() {
	remove_action( 'wp_enqueue_scripts', 'enqueue_dsbf_styles' );
	remove_action( 'wp_footer', 'enqueue_dsbf_scripts' );
	remove_action('wp_ajax_nopriv_process_form_response', 'process_form_response');
	remove_action( 'init', 'dsbf_shortcodes_init' );
}

register_activation_hook( __FILE__, 'activate_dsbf_quotes' );
register_deactivation_hook( __FILE__, 'deactivate_dsbf_quotes' );
add_action( 'wp_enqueue_scripts', 'enqueue_dsbf_styles' );
add_action( 'wp_footer', 'enqueue_dsbf_scripts' );
add_action('wp_ajax_nopriv_process_form_response', 'process_form_response');
add_action( 'init', 'dsbf_shortcodes_init' );
