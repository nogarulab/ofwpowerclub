<?php /* Template Name: Home */  ?>

<?php get_header();  ?>



	<section class="banner d-flex align-items-center justify-content-center px-5">
		<a href="#join-us" class="scroll white d-none d-lg-block">
			<span></span>SCROLL
		</a>		
		<div data-ride="carousel" class="carousel carousel-fade" id="banner-carousel">
		    <div role="listbox" class="carousel-inner">
		    	<?php 
					$the_query = new WP_Query(array('post_type'=>'slider'));
					while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
				<?php 
					$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
					$posts = get_field('partner');
				?>
					    <div class="carousel-item" style="background-image:url(<?php echo $featuredImage; ?>);">
					    	<div class="banner-text-container text-center carousel-caption">
								<h1 class="text-uppercase"><?php the_title(); ?></h1>
								<div class="caption-content">
									<?php the_content(); ?>
								</div>
								<?php if( $posts ): ?>
								<?php foreach( $posts as $post): 
									setup_postdata($post); ?>
									<a href="<?php the_permalink(); ?>" class="h-c-black member-link bg-yellow black text-uppercase py-2 px-4">Learn More</a>
								<?php endforeach; wp_reset_postdata(); ?>
								<?php endif; ?>
							</div>
					    </div>
				<?php 
					endwhile; wp_reset_query(); 
				?>
		    </div>
		</div>
	</section>

<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'home'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
	<section class="ofw-power-club-cont py-5 text-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<h1 class="text-uppercase font-weight-bold"><?php bloginfo('name'); ?></h1>
					<?php the_content(); ?>
					<div class="buttons d-flex justify-content-around">
						<a href="<?php echo home_url(); ?>/register" class="h-c-black member-link bg-yellow black text-uppercase py-2 px-4">Be A Member</a>
						<a href="<?php echo home_url(); ?>/request-for-partnership" class="h-c-white partner-link bg-blue white text-uppercase py-2 px-4">Be A Partner</a>
					</div>
				</div>
			</div>
		</div>
		
	</section>
<?php 
	endwhile; wp_reset_query(); 
?>
	
	<section id="join-us" class="member-partner">
		<?php 
			$the_query = new WP_Query(array('post_type'=>'blurbs', 'p'=>88));
			while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
		<div class="join-member pt-5">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<?php the_content(); ?>
						<a href="<?php echo home_url(); ?>/how-to-become-a-member" class="h-c-white white rounded bg-blue py-3 px-5 d-inline-block">Learn More</a>
					</div>
					<div class="col-md-6">
						<?php the_post_thumbnail('full', array('class' => 'img-fluid mx-auto d-block mt-5 mt-md-0')); ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
			endwhile; wp_reset_query(); 
		?>
		<?php 
			$the_query = new WP_Query(array('post_type'=>'blurbs', 'p'=>90));
			while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
		<div class="join-partner">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div data-ride="carousel" class="carousel" id="partners-carousel">
		    				<div role="listbox" class="carousel-inner">

		    					<?php $counter = 0; ?>
								<?php $images = get_field('logos'); ?>
								<?php if($images): ?>
									<?php foreach( $images as $image ): ?>
									    <div class="carousel-item">
									    	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" >
									    </div>
									    <?php $counter++; ?>
									<?php endforeach; ?>
								<?php endif; ?>
								
								<?php $olcounter = 0; ?>
								<ol class="carousel-indicators">
									<?php while ( $olcounter < $counter ) { ?>
								    	<li data-target="#partners-carousel" data-slide-to="<?php echo $olcounter; ?>"></li>
									<?php 
										$olcounter++;
										} 
									?>
								</ol>

							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="partner-cont bg-yellow py-5 px-sm-5 px-3">
							<?php the_content(); ?>
							<a href="<?php echo home_url(); ?>/be-our-trusted-partner" class="h-c-white white rounded bg-blue py-3 px-5 d-inline-block">Learn More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			endwhile; wp_reset_query(); 
		?>
	</section>

	<section class="home-prods py-5">
		<div class="container">
			<div class="row align-items-center">
				<?php 
					$the_query = new WP_Query(array('post_type'=>'blurbs', 'p'=>94));
					while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
				<div class="col-lg-6 col-md-5">
					<?php the_content(); ?>
					<a href="<?php echo home_url();?>/store" class="h-c-white white rounded bg-blue py-3 px-5 d-inline-block mb-3">Show Now</a>
				</div>
				<?php 
					endwhile; wp_reset_query(); 
				?>
				<div class="col-lg-6 col-md-7">
					<div class="grid" id="feat-prod-list">
						<div class="grid-sizer"></div>
						<?php 
							$the_query = new WP_Query(array('post_type'=>'products', 'posts_per_page'=>6));
							while ( $the_query->have_posts() ) : $the_query->the_post();
						?>
							<div class="grid-item">
								<a href="<?php the_permalink(); ?>">
									<?php
									 the_post_thumbnail('home-prods', array('class' => 'img-fluid mx-auto d-block ')); 
									?>
								</a>
							</div>
						<?php 
							endwhile; wp_reset_query(); 
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php get_sidebar('testimonies'); ?>
	<?php get_sidebar('connect'); ?>
<?php get_footer();  ?>