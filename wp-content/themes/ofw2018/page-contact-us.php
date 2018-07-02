<?php get_header();  ?>
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
				<h4>Drop us a line and we will be in touch soon</h4>
				<?php echo do_shortcode("[contact-form-7 id='155' title='Contact Us']"); ?>
			</div>
			<div class="col-md-6">
				<div class="contact-details">
					<p><strong>Phone</strong> +63.917.456.1234</p>
					<p><strong>Email</strong> info@ofwpowerclub.com</p>
					<p>
						<strong>Location</strong>
						<address>
							<span>88 Connaught Road West</span>
							<span>Central and Western District</span>
							<span>Hong Kong</span>
						</address>
					</p>
				</div>
			</div>

		</div>
	</div>

</div>
<?php get_sidebar('connect'); ?>
<div class="map"></div>
<?php get_footer();  ?>