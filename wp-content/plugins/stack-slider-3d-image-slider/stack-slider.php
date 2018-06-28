<?php
/**
 * Plugin Name: Stack Slider 3d Image slider
 * Plugin URI: https://www.wponlinesupport.com/plugins/
 * Description: Stack Slider 3d Image Slider/Carousel - for WordPress. 
 * Author: WP Online Support 
 * Text Domain:stack-slider-a-3d-imageslider
 * Domain Path: /languages/
 * Version: 1.1.1
 * Author URI: https://www.wponlinesupport.com
 *
 * @package WordPress
 * @author SP Technolab
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_SK_VERSION' ) ) {
	define( 'WP_SK_VERSION', '1.1.1' ); // Version of plugin
}
if( !defined( 'WP_SK_DIR' ) ) {
    define( 'WP_SK_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_SK_URL' ) ) {
    define( 'WP_SK_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_SK_POST_TYPE' ) ) {
    define( 'WP_SK_POST_TYPE', 'wpos_stack_slider' ); // Plugin post type
}
if( !defined( 'WP_SK_META_PREFIX' ) ) {
    define( 'WP_SK_META_PREFIX', '_wp_sk_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Stack Slider 3d Image slider
 * @since 1.0
 */
function wp_sk_load_textdomain() {
	load_plugin_textdomain( 'stack-slider-a-3d-imageslider', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'wp_sk_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_sk_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_sk_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_install() {
    
    // Register post type function
    wp_sk_register_post_type();  
   
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

// Functions File
require_once( WP_SK_DIR . '/includes/wp-sk-functions.php' );

// Plugin Post Type File
require_once( WP_SK_DIR . '/includes/wp-sk-post-types.php' );

// Script File
require_once( WP_SK_DIR . '/includes/class-wp-sk-script.php' );

// Admin Class File
require_once( WP_SK_DIR . '/includes/admin/class-wp-sk-admin.php' );

// Shortcode File
require_once( WP_SK_DIR . '/includes/shortcode/wp-sk-gallery-slider.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WP_SK_DIR . '/includes/admin/sk-how-it-work.php' );
}