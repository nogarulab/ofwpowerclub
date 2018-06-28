<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package  stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wp_sk_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package  stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WP_SK_POST_TYPE, __('How it works, our plugins and offers', 'stack-slider-a-3d-imageslider'), __('How It Works', 'stack-slider-a-3d-imageslider'), 'manage_options', 'sk-designs', 'wp_sk_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package  stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_designs_page() {

	$wpos_feed_tabs = wp_sk_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap sk-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WP_SK_POST_TYPE, 'page' => 'sk-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="sk-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wp_sk_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wp_sk_get_plugin_design( 'plugins-feed' );
			} else {
				echo wp_sk_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .pap-tab-cnt-wrp -->

	</div><!-- end .pap-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wp_sk_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'sk_' . $active_tab;
	$url 			= isset($wpos_feed_tabs[$active_tab]['url']) 			? $wpos_feed_tabs[$active_tab]['url'] 				: '';
	$transient_time = isset($wpos_feed_tabs[$active_tab]['transient_time']) ? $wpos_feed_tabs[$active_tab]['transient_time'] 	: 172800;
	$cache 			= get_transient( $transient_key );
	
	if ( false === $cache ) {
		
		$feed 			= wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( $transient_key, $cache, $transient_time );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'stack-slider-a-3d-imageslider' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'stack-slider-a-3d-imageslider'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'stack-slider-a-3d-imageslider'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'stack-slider-a-3d-imageslider'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/wpos-offers.php',
													'transient_key'		=> 'wpos_offers_feed',
													'transient_time'	=> 86400,
												)
					);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */
function wp_sk_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.sk-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.sk-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
			
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and shortcode', 'stack-slider-a-3d-imageslider' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Stack Slider', 'stack-slider-a-3d-imageslider'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin create a Gallery mata box under your Stack Slider tab in WordPress menu section', 'stack-slider-a-3d-imageslider'); ?></li>
														<li><?php _e('Step-2: Go to Stack Slider and add gallery images', 'stack-slider-a-3d-imageslider'); ?></li>
														<li><?php _e('Step-3: Now, paste below shortcode in any post or page.', 'stack-slider-a-3d-imageslider'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'stack-slider-a-3d-imageslider'); ?>:</label>
												</th>
												<td>
													<span class="sk-shortcode-preview">[stack_slider id="XX"]</span> – <?php _e('Gallery Slider', 'stack-slider-a-3d-imageslider'); ?> <br />
												</td>
											</tr>						
												
											<tr>
												<th>
													<label><?php _e('Need Support?', 'stack-slider-a-3d-imageslider'); ?></label>
												</th>
												<td>
													<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'stack-slider-a-3d-imageslider'); ?></p> <br/>
													<a class="button button-primary" href="#" target="_blank"><?php _e('Documentation', 'stack-slider-a-3d-imageslider'); ?></a>									
													<a class="button button-primary" href="http://demo.wponlinesupport.com/stack-slider-3d-image-slider-demo/" target="_blank"><?php _e('Demo for Designs', 'stack-slider-a-3d-imageslider'); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
				
				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox" style="">
									
								<h3 class="hndle">
									<span><?php _e( 'Upgrade to Pro', 'stack-slider-a-3d-imageslider' ); ?></span>
								</h3>
								<div class="inside">
									<ul>
										<li>1) Option to add link for image</li>
										<li>2) Option to show title</li>
										<li>3) Option to show caption</li>
										<li>4) Option to link target</li>
										<li>5) Rotate image</li>
										<li>6) Stretch image</li>
									</ul>									
										
									<p><a class="button button-primary wpos-button-full" href="#" target="_blank"><?php _e('Demo for Designs ', 'stack-slider-a-3d-imageslider'); ?></a>			</p>								
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'stack-slider-a-3d-imageslider' ); ?></span>
									</h3>									
									<div class="inside">										
										<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/stack-slider-3d-image-slider/reviews/?filter=5" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->
				
				

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }