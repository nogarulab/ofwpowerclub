<?php get_header();
$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
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
$map_coordinates = get_field('our_office_map');
echo $map_coordinates['lat'];
echo $map_coordinates['lng'];
?>
<div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1388.7881621846902!2d114.17474205945706!3d22.308680799898188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403e2eda332980f%3A0xf08ab3badbeac97c!2sHong+Kong!5e0!3m2!1sen!2sph!4v1530518337607" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<?php get_footer();  ?>