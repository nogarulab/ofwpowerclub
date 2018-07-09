<?php /* Template Name: OFW Power Club Template */ 

get_header(); ?>


<div class="poropor">
	<div class="container text-center">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-10">
				<section class="py-5">
					<img src="<?php echo get_template_directory_uri(); ?>/img/404.png" alt="404" class="img-fluid d-block mx-auto my-5">
					<h2 class="font-weight-bold text-uppercase">It looks like you’re lost</h2>
					<p class="mb-5">The page you’re looking for is no longer exist.</p>
					<a href="<?php echo home_url(); ?>" class="font-weight-bold text-uppercase black h-c-black py-3 px-5 mb-5 d-inline-block">Go to Homepage</a>
				</section>
			</div>
		</div>
	</div>
</div>
	
<?php get_footer(); ?>
