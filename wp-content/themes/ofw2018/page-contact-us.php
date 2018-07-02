<?php get_header();
if (have_posts()):
    while (have_posts()) :
        the_post();

        $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 

        $office_lat = get_field('latitude');
        $office_lng = get_field('longitude');
?>
<div class="contact-us">

	<section class="page-banner py-5 white text-uppercase" style="background-image:url(<?php echo $featuredImage; ?>);">
		<div class="container py-5">
			<div class="row">
				<div class="col text-center">
					<h2 class="font-weight-bold "><?php the_title(); ?></h2>
					<span class="bread-crumbs">Home // <a href="<?php the_permalink() ?>" class="yellow transition"><?php the_title(); ?></a></span>
				</div>
			</div>
		</div>
	</section>
	
	<div class="container">
		<div class="row">
			
			<div class="col-md-6">
				<?php echo do_shortcode("[contact-form-7 id='155' title='Contact Us']"); ?>
			</div>
			<div class="col-md-6">
				<div class="contact-details">
					<div><strong>Phone</strong> +63.917.456.1234</div>
					<div><strong>Email</strong> info@ofwpowerclub.com</div>
					<div>
						<strong>Location</strong>
						<address>
							<span>88 Connaught Road West</span>
							<span>Central and Western District</span>
							<span>Hong Kong</span>
						</address>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>
<?php 
get_sidebar('connect');
?>
<div class="map">
	<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
</div>
<?php 
	endwhile;
endif;
get_footer();  ?>