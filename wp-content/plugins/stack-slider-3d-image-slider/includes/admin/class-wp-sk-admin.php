<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Sk_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_sk_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wp_sk_save_metabox_value') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'wp_sk_register_settings') );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.WP_SK_POST_TYPE.'_posts_columns', array($this, 'wp_sk_posts_columns') );

		// Action to add custom column data to Gallery listing
		add_action('manage_'.WP_SK_POST_TYPE.'_posts_custom_column', array($this, 'wp_sk_post_columns_data'), 10, 2);

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_sk_add_post_row_data'), 10, 2 );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this,'wp_sk_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_sk_get_attachment_edit_form', array($this, 'wp_sk_get_attachment_edit_form'));
		add_action( 'wp_ajax_nopriv_wp_sk_get_attachment_edit_form',array( $this, 'wp_sk_get_attachment_edit_form'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_wp_sk_save_attachment_data', array($this, 'wp_sk_save_attachment_data'));
		add_action( 'wp_ajax_nopriv_wp_sk_save_attachment_data',array( $this, 'wp_sk_save_attachment_data'));
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_post_sett_metabox() {
		
		// Getting all post types
		$all_post_types = array(WP_SK_POST_TYPE);
	
		add_meta_box( 'wp-sk-post-sett', __( 'Stack Slider- Settings', 'stack-slider-a-3d-imageslider' ), array($this, 'wp_sk_post_sett_mb_content'), $all_post_types, 'normal', 'high' );
		
		add_meta_box( 'wp-sk-post-slider-sett', __( 'Stack Slider Parameter', 'stack-slider-a-3d-imageslider' ), array($this, 'wp_sk_post_slider_sett_mb_content'), $all_post_types, 'normal', 'default' );	
		
	}
	
	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_post_sett_mb_content() {
		include_once( WP_SK_DIR .'/includes/admin/metabox/wp-sk-sett-metabox.php');
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_post_slider_sett_mb_content() {
		include_once( WP_SK_DIR .'/includes/admin/metabox/wp-sk-slider-parameter.php');
	}
	
	/**
	 * Function to save metabox values
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_save_metabox_value( $post_id ) {

		global $post_type;

		$registered_posts = array(WP_SK_POST_TYPE); // Getting registered post types

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( !in_array($post_type, $registered_posts) ) )             			// Check if user can edit the post.
		{
		  return $post_id;
		}

		$prefix = WP_SK_META_PREFIX; // Taking metabox prefix
		
		

		// Taking variables
		$gallery_imgs 				= isset($_POST['wp_sk_img']) 						? wp_sk_slashes_deep($_POST['wp_sk_img']) : '';		

		// Getting Carousel Variables
		$slide_to_show_carousel 	= isset($_POST[$prefix.'slide_to_show_carousel']) 		? wp_sk_slashes_deep($_POST[$prefix.'slide_to_show_carousel']) 		: '';
		$slide_to_column_carousel 	= isset($_POST[$prefix.'slide_to_column_carousel']) 	? wp_sk_slashes_deep($_POST[$prefix.'slide_to_column_carousel']) 	: '';
		$slide_per_column_carousel 	= isset($_POST[$prefix.'slide_per_column_carousel']) 	? wp_sk_slashes_deep($_POST[$prefix.'slide_per_column_carousel']) 	: '';
		$arrow_carousel 			= isset($_POST[$prefix.'arrow_carousel']) 				? wp_sk_slashes_deep($_POST[$prefix.'arrow_carousel']) 				: 'true';
		$pagination_carousel 		= isset($_POST[$prefix.'pagination_carousel']) 			? wp_sk_slashes_deep($_POST[$prefix.'pagination_carousel']) 		: 'true';
		$speed_carousel 			= isset($_POST[$prefix.'speed_carousel']) 				? wp_sk_slashes_deep($_POST[$prefix.'speed_carousel']) 				: '';
		$autoplay_carousel 			= isset($_POST[$prefix.'autoplay_carousel']) 			? wp_sk_slashes_deep($_POST[$prefix.'autoplay_carousel']) 			: 'true';
		$autoplay_speed_carousel	= isset($_POST[$prefix.'autoplay_speed_carousel']) 		? wp_sk_slashes_deep($_POST[$prefix.'autoplay_speed_carousel']) 	: '';
		$auto_stop_carousel 	  	= isset($_POST[$prefix.'auto_stop_carousel']) 			? wp_sk_slashes_deep($_POST[$prefix.'auto_stop_carousel']) 			: 'false';
		$pagination_type_carousel 	= isset($_POST[$prefix.'pagination_type_carousel']) 	? wp_sk_slashes_deep($_POST[$prefix.'pagination_type_carousel']) 	: '';
		$centermode_carousel 		= isset($_POST[$prefix.'centermode_carousel']) 			? wp_sk_slashes_deep($_POST[$prefix.'centermode_carousel']) 		: 'false';
		$space_between_carousel 	= isset($_POST[$prefix.'space_between_carousel']) 		? wp_sk_slashes_deep($_POST[$prefix.'space_between_carousel']) 		: '';
		$loop_carousel 				= isset($_POST[$prefix.'loop_carousel']) 				? wp_sk_slashes_deep($_POST[$prefix.'loop_carousel']) 				: 'true';
		$lazy_load_carousel 		= isset($_POST[$prefix.'lazy_load_carousel']) 			? wp_sk_slashes_deep($_POST[$prefix.'lazy_load_carousel']) 			: 'false';
		$grab_cursor_carousel 		= isset($_POST[$prefix.'grab_cursor_carousel']) 		? wp_sk_slashes_deep($_POST[$prefix.'grab_cursor_carousel']) 		: 'false';
		$nav_type_carousel 			= isset($_POST[$prefix.'nav_type_carousel']) 			? wp_sk_slashes_deep($_POST[$prefix.'nav_type_carousel']) 			: '';
		$depth 						= isset($_POST[$prefix.'depth']) 						? wp_sk_slashes_deep($_POST[$prefix.'depth']) 						: '';
		$modifier 					= isset($_POST[$prefix.'modifier']) 					? wp_sk_slashes_deep($_POST[$prefix.'modifier']) 					: '';	
		
		
		// Style option update		
		
		update_post_meta($post_id, $prefix.'gallery_id', $gallery_imgs);		

		// Updating Carousel settings 
		update_post_meta($post_id, $prefix.'slide_to_show_carousel', $slide_to_show_carousel);
		update_post_meta($post_id, $prefix.'slide_to_column_carousel', $slide_to_column_carousel);
		update_post_meta($post_id, $prefix.'slide_per_column_carousel', $slide_per_column_carousel);
		update_post_meta($post_id, $prefix.'arrow_carousel', $arrow_carousel);
		update_post_meta($post_id, $prefix.'pagination_carousel', $pagination_carousel);
		update_post_meta($post_id, $prefix.'speed_carousel', $speed_carousel);
		update_post_meta($post_id, $prefix.'autoplay_carousel', $autoplay_carousel);
		update_post_meta($post_id, $prefix.'autoplay_speed_carousel', $autoplay_speed_carousel);
		update_post_meta($post_id, $prefix.'auto_stop_carousel', $auto_stop_carousel);
		update_post_meta($post_id, $prefix.'pagination_type_carousel', $pagination_type_carousel);
		update_post_meta($post_id, $prefix.'centermode_carousel', $centermode_carousel);
		update_post_meta($post_id, $prefix.'space_between_carousel', $space_between_carousel);
		update_post_meta($post_id, $prefix.'loop_carousel', $loop_carousel);
		update_post_meta($post_id, $prefix.'lazy_load_carousel', $lazy_load_carousel);
		update_post_meta($post_id, $prefix.'grab_cursor_carousel', $grab_cursor_carousel);
		update_post_meta($post_id, $prefix.'nav_type_carousel', $nav_type_carousel);
		update_post_meta($post_id, $prefix.'depth', $depth);
		update_post_meta($post_id, $prefix.'modifier', $modifier);		
		
	}

	/**
	 * Function register setings
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_register_settings() {
		register_setting( 'wp_sk_plugin_options', 'wp_sk_options', array($this, 'wp_sk_validate_options') );
	}
	
	/**
	 * Validate Settings Options
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_validate_options( $input ) {
		
		$input['default_img'] 	= isset($input['default_img']) 	? wp_sk_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 	= isset($input['custom_css']) 	? wp_sk_slashes_deep($input['custom_css'], true) 	: '';
		
		return $input;
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_posts_columns( $columns ) {

	    $new_columns['wp_sk_shortcode'] 	= __('Shortcode', 'stack-slider-a-3d-imageslider');
	    $new_columns['wp_sk_photos'] 		= __('Number of Photos', 'stack-slider-a-3d-imageslider');

	    $columns = wp_sk_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_post_columns_data( $column, $post_id ) {

		global $post;
		// Taking some variables
		$prefix = WP_SK_META_PREFIX;		
		
	    switch ($column) {
	    	case 'wp_sk_shortcode':	    		
					echo '<div class="wp-sk-shortcode-preview">[stack_slider id="'.$post_id.'"]</div>';				
	    		break;

	    	case 'wp_sk_photos':
	    		$total_photos = get_post_meta($post_id, $prefix.'gallery_id', true);
	    		echo !empty($total_photos) ? count($total_photos) : '--';
	    		break;
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_SK_POST_TYPE ) {
			return array_merge( array( 'wp_sk_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Image data popup HTML
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_image_update_popup_html() {

		global $post_type;

		$registered_posts = array(WP_SK_POST_TYPE); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {
			include_once( WP_SK_DIR .'/includes/admin/settings/wp-sk-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_get_attachment_edit_form() {
		
		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'stack-slider-a-3d-imageslider');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
	
		if( !empty($attachment_id) ) {
			
			$attachment_post = get_post( $_POST['attachment_id'] );
			
			if( !empty($attachment_post) ) {
				
				ob_start();

				// Popup Data File
				include( WP_SK_DIR . '/includes/admin/settings/wp-sk-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'stack-slider-a-3d-imageslider');
				$result['data']		= $attachment_data;
			}
		}
	
		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package stack-slider-a-3d-imageslider
	 * @since 1.0.0
	 */
	function wp_sk_save_attachment_data() {

		$prefix 			= WP_SK_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'stack-slider-a-3d-imageslider');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
		$form_data 			= parse_str($_POST['form_data'], $form_data_arr);

		if( !empty($attachment_id) && !empty($form_data_arr) ) {

			// Getting attachment post
			$wp_sk_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset($wp_sk_attachment_post->post_type) && $wp_sk_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> !empty($form_data_arr['wp_sk_attachment_title']) ? $form_data_arr['wp_sk_attachment_title'] : $wp_sk_attachment_post->post_name,									
									'post_excerpt'	=> $form_data_arr['wp_sk_attachment_caption'],
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {

					update_post_meta( $attachment_id, '_wp_attachment_image_alt', wp_sk_slashes_deep($form_data_arr['wp_sk_attachment_alt']) );
					update_post_meta( $attachment_id, $prefix.'attachment_link', wp_sk_slashes_deep($form_data_arr['wp_sk_attachment_link']) );

					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'stack-slider-a-3d-imageslider');
				}
			}
		}
		echo json_encode($result);
		exit;
	}
}

$wp_sk_admin = new Wp_Sk_Admin();