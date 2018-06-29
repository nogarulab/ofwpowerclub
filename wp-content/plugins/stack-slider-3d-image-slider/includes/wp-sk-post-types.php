<?php
/**
 * Register Post type functionality
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_register_post_type() {
	
	$wp_sk_post_lbls = apply_filters( 'wp_sk_post_labels', array(
								'name'                 	=> __('Stack slider', 'stack-slider-a-3d-imageslider'),
								'singular_name'        	=> __('Stack slider', 'stack-slider-a-3d-imageslider'),
								'add_new'              	=> __('Add Stack slider', 'stack-slider-a-3d-imageslider'),
								'add_new_item'         	=> __('Add New Stack slider', 'stack-slider-a-3d-imageslider'),
								'edit_item'            	=> __('Edit Stack slider', 'stack-slider-a-3d-imageslider'),
								'new_item'             	=> __('New Stack slider', 'stack-slider-a-3d-imageslider'),
								'view_item'            	=> __('View Stack slider', 'stack-slider-a-3d-imageslider'),
								'search_items'         	=> __('Search Stack slider', 'stack-slider-a-3d-imageslider'),
								'not_found'            	=> __('No Stack slider', 'stack-slider-a-3d-imageslider'),
								'not_found_in_trash'   	=> __('No Stack slider found in Trash', 'stack-slider-a-3d-imageslider'),								
								'menu_name'           	=> __('Stack slider', 'stack-slider-a-3d-imageslider')
							));

	$wp_sk_slider_args = array(
		'labels'				=> $wp_sk_post_lbls,
		'public'              	=> true,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> true,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-format-gallery',
		 'supports'            => array('title')
	);

	// Register slick slider post type
	register_post_type( WP_SK_POST_TYPE, apply_filters( 'wp_sk_registered_post_type_args', $wp_sk_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wp_sk_register_post_type');

/**
 * Function to update post message for portfolio
 * 
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WP_SK_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Image Gallery updated.', 'stack-slider-a-3d-imageslider' ) ),
		2 => __( 'Custom field updated.', 'stack-slider-a-3d-imageslider' ),
		3 => __( 'Custom field deleted.', 'stack-slider-a-3d-imageslider' ),
		4 => __( 'Image Gallery updated.', 'stack-slider-a-3d-imageslider' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Image Gallery restored to revision from %s', 'stack-slider-a-3d-imageslider' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Image Gallery published.', 'stack-slider-a-3d-imageslider' ) ),
		7 => __( 'Image Gallery saved.', 'stack-slider-a-3d-imageslider' ),
		8 => sprintf( __( 'Image Gallery submitted.', 'stack-slider-a-3d-imageslider' ) ),
		9 => sprintf( __( 'Image Gallery scheduled for: <strong>%1$s</strong>.', 'stack-slider-a-3d-imageslider' ),
		  date_i18n( __( 'M j, Y @ G:i', 'stack-slider-a-3d-imageslider' ), strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Image Gallery draft updated.', 'stack-slider-a-3d-imageslider' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_sk_post_updated_messages' );