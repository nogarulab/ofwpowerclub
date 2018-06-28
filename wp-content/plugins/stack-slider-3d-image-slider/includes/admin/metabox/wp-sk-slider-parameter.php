<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package stack-slider-a-3d-imageslider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WP_SK_META_PREFIX; // Metabox prefix

// Carousel Variables
$slide_to_show_carousel 	= get_post_meta( $post->ID, $prefix.'slide_to_show_carousel', true );
$slide_to_column_carousel 	= get_post_meta( $post->ID, $prefix.'slide_to_column_carousel', true );
$arrow_carousel 			= get_post_meta( $post->ID, $prefix.'arrow_carousel', true );
$pagination_carousel 		= get_post_meta( $post->ID, $prefix.'pagination_carousel', true );
$speed_carousel 			= get_post_meta( $post->ID, $prefix.'speed_carousel', true );
$autoplay_carousel 			= get_post_meta( $post->ID, $prefix.'autoplay_carousel', true );
$autoplay_speed_carousel	= get_post_meta( $post->ID, $prefix.'autoplay_speed_carousel', true );
$auto_stop_carousel 		= get_post_meta( $post->ID, $prefix.'auto_stop_carousel', true );
$pagination_type_carousel 	= get_post_meta( $post->ID, $prefix.'pagination_type_carousel', true );
$space_between_carousel 	= get_post_meta( $post->ID, $prefix.'space_between_carousel', true );
$centermode_carousel 		= get_post_meta( $post->ID, $prefix.'centermode_carousel', true );
$loop_carousel 				= get_post_meta( $post->ID, $prefix.'loop_carousel', true );
$depth 						= get_post_meta( $post->ID, $prefix.'depth', true );
$modifier 					= get_post_meta( $post->ID, $prefix.'modifier', true );
?>

<div class="wp-sk-mb-tabs-wrp">
	<div id="wp-sk-sdetails" class="wp-sk-sdetails wpsk-carousel">
		<table class="form-table wp-sk-sdetails-tbl">
		<h3><?php _e('Choose your Settings for Carousel', 'stack-slider-a-3d-imageslider') ?></h3>
		<hr>	
			<tbody>
				<tr valign="top">					
					<td scope="row">
						<label><?php _e('Slide To Show', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
					<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_show_carousel" value="<?php echo wp_sk_esc_attr($slide_to_show_carousel); ?>"><br/>
					<em style="font-size:11px;"><?php _e('Number of slides per view (slides visible at the same time on slider container).','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>

				<tr valign="top">
					<td scope="row">
						<label><?php _e('Slide To Scroll', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_column_carousel" value="<?php echo wp_sk_esc_attr($slide_to_column_carousel); ?>"><br/>
						<em style="font-size:11px;"><?php _e('Set numbers of slides to define and enable group sliding. Useful to use with slidesPerView > 1','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>

				<tr valign="top">
					<td scope="row">
						<label><?php _e('Centermode', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>centermode_carousel" value="true" <?php checked( 'true', $centermode_carousel ); ?>>True
						<input type="radio" name="<?php echo $prefix; ?>centermode_carousel" value="false" <?php checked( 'false', $centermode_carousel ); ?>>False<br/>
						<em style="font-size:11px;"><?php _e('If true, then active slide will be centered, not always on the left side.','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>

				<tr valign="top">
					<td scope="row">
						<label><?php _e('Space Between Slides', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>space_between_carousel" value="<?php echo wp_sk_esc_attr($space_between_carousel); ?>"><br/>
						<em style="font-size:11px;"><?php _e('Distance between slides in px.','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="form-table wp-sk-sdetails-tbl">
			<tbody>
				<tr valign="top">
					<h4><?php _e('Navigation & Pagination Settings', 'stack-slider-a-3d-imageslider') ?></h4>
					<hr>
					<td scope="row">
						<label><?php _e('Arrow', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>arrow_carousel" value="true" <?php checked( 'true', $arrow_carousel ); ?>>True
						<input type="radio" name="<?php echo $prefix; ?>arrow_carousel" value="false" <?php checked( 'false', $arrow_carousel ); ?>>False<br/>
						<em style="font-size:11px;"><?php _e('Enable Arrows for slider','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>

				<tr valign="top">
					<td scope="row">
						<label><?php _e('Pagination', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>pagination_carousel" value="true" <?php checked( 'true', $pagination_carousel ); ?>>True
						<input type="radio" name="<?php echo $prefix; ?>pagination_carousel" value="false" <?php checked( 'false', $pagination_carousel ); ?>>False<br/>
						<em style="font-size:11px;"><?php _e('String with CSS selector or HTML element of the container with pagination','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Pagination Type', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<select name="<?php echo $prefix; ?>pagination_type_carousel">
							<option value="bullets" <?php selected( $pagination_type_carousel, 'bullets'); ?>>Bullets</option>
							<option value="fraction" <?php selected( $pagination_type_carousel, 'fraction'); ?>>Fraction</option>
						</select><br/>
						<em style="font-size:11px;"><?php _e('String with type of pagination. Can be "bullets", "fraction"','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
			</tbody>
		</table>	
		
		<table class="form-table wp-sk-sdetails-tbl">
			<tbody>
				<tr valign="top">
					<h4><?php _e('3D Effect Settings', 'stack-slider-a-3d-imageslider') ?></h4>
					<hr>
					<td scope="row">
						<label><?php _e('Depth (Left - Right images scale value )', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>depth" value="<?php echo wp_sk_esc_attr($depth); ?>"><br/>
						<em style="font-size:11px;"><?php _e('Enter the depth value to scale the left and right images','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>				
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Image overlap position', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>modifier" value="<?php echo wp_sk_esc_attr($modifier); ?>"><br/>
						<em style="font-size:11px;"><?php _e('Enter the number value to overlap the image position','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>			
				
			</tbody>
		</table><!-- end .wtwp-tstmnl-table -->	
		
		<table class="form-table wp-sk-sdetails-tbl">
			<tbody>
				<tr valign="top">
					<h4><?php _e('Genaral Settings', 'stack-slider-a-3d-imageslider') ?></h4>
					<hr>
					<td scope="row">
						<label><?php _e('Autoplay', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>autoplay_carousel" value="true" <?php checked( 'true', $autoplay_carousel ); ?>>True
						<input type="radio" name="<?php echo $prefix; ?>autoplay_carousel"  value="false" <?php checked( 'false', $autoplay_carousel ); ?>>False<br/>
						<em style="font-size:11px;"><?php _e('Enable Autoplay for Slider','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>

				<tr valign="top">
					<td scope="row">
						<label><?php _e('Autoplay Speed', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>autoplay_speed_carousel" value="<?php echo wp_sk_esc_attr($autoplay_speed_carousel); ?>"><br/>
						<em style="font-size:11px;"><?php _e('Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Speed', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>speed_carousel" value="<?php echo wp_sk_esc_attr($speed_carousel); ?>"><br/>
						<em style="font-size:11px;"><?php _e('Duration of transition between slides (in ms)','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Loop', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>loop_carousel" value="true" <?php checked( 'true', $loop_carousel ); ?>>True
						<input type="radio" name="<?php echo $prefix; ?>loop_carousel" value="false" <?php checked( 'false', $loop_carousel ); ?>>False<br/>
						<em style="font-size:11px;"><?php _e('Set to true to enable continuous loop mode','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Autoplay Stop On Last', 'stack-slider-a-3d-imageslider'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>auto_stop_carousel" value="true" <?php checked( 'true', $auto_stop_carousel ); ?>>True
						<input type="radio" name="<?php echo $prefix; ?>auto_stop_carousel" value="false" <?php checked( 'false', $auto_stop_carousel ); ?>>False<br/>
						<em style="font-size:11px;"><?php _e('Enable this parameter and autoplay will be stopped when it reaches last slide','stack-slider-a-3d-imageslider'); ?></em><br/>
						<em style="font-size:11px;color:#ff0808;"><?php _e('This will work when loop is false.','stack-slider-a-3d-imageslider'); ?></em>
					</td>
				</tr>
			</tbody>
		</table><!-- end .wtwp-tstmnl-table -->
	</div>
</div>