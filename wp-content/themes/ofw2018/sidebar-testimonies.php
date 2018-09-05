<section class="testimonials-container py-5 text-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-12">
				<h2 class="text-uppercase mb-3 mb-md-5">Member's Testimonials</h2>
				<div data-ride="carousel" class="carousel" id="testi-carousel">
		    		<div role="listbox" class="carousel-inner">
		    			<?php 
							$the_query = new WP_Query(array('post_type'=>'testimonials'));
							while ( $the_query->have_posts() ) : $the_query->the_post();
						?>
							<div class="carousel-item mb-5 ">
								<div class="carousel-testi">
									<?php the_post_thumbnail('testimonials', array('class' => 'rounded-circle img-fluid mx-auto d-block mb-2 mb-md-5')); ?>
									<?php the_content(); ?>
									<div class="break d-block mx-auto mt-4 mb-5"></div>
									<h3 class="white"><?php the_title(); ?></h3>
								</div>
							</div>
						<?php 
							endwhile; wp_reset_query(); 
						?>
					</div>
					<a class="carousel-control" href="#testi-carousel" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control" href="#testi-carousel" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>