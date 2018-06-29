<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=> 'contact-us'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<section class="connect py-5 text-center">
	<div class="container pt-5">
		<div class="row justify-content-center">
			<div class="col-12 pt-5">
				<h3 class="pt-5">GET IN TOUCH</h3>
				<h2 class="font-weight-bold">
					<span class="red">C</span>
					<span class="yellow">O</span>
					<span class="blue">N</span>
					<span class="red">N</span>
					<span class="yellow">E</span>
					<span class="blue">C</span>
					<span class="red">T</span>
				</h2>
				<p class="mb-5">WITH US!</p>
				<div class="row">
					<div class="col-6 col-sm-3">
						<a href="<?php the_field('facebook'); ?>" target="_blank" class="fb social-cont d-block mx-auto my-3"></a>
						<span class="">FACEBOOK</span>
					</div>
					<div class="col-6 col-sm-3">
						<a href="<?php the_field('twitter'); ?>" target="_blank" class="tw social-cont d-block mx-auto my-3"></a>
						<span class="">TWITTER</span>
					</div>
					<div class="col-6 col-sm-3">
						<a href="<?php the_field('google_plus'); ?>" target="_blank" class="gp social-cont d-block mx-auto my-3"></a>
						<span class="">GOOGLE PLUS</span>
					</div>
					<div class="col-6 col-sm-3">
						<a href="<?php the_field('youtube'); ?>" target="_blank" class="yt social-cont d-block mx-auto my-3"></a>
						<span class="">YOUTUBE</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
	endwhile; wp_reset_query(); 
?>