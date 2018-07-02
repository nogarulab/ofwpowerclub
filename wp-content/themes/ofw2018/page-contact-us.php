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
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:440px;width:700px;'><div id='gmap_canvas' style='height:440px;width:700px;'></div><div><small><a href="embedgooglemaps.com/">https://embedgooglemaps.com/</a></small></div><div><small><a href="https://mrpromocode.com.au/sephora/">promocode au</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(51.5073509,-0.12775829999998223),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(<?php echo $office_lat; ?>,<?php echo $office_lng; ?>)});infowindow = new google.maps.InfoWindow({content:'<strong>Title</strong><br>London, United Kingdom<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
</div>
<?php 
	endwhile;
endif;
get_footer();  ?>