<?php /* Template Name: Home */  ?>

<?php get_header();  ?>



<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'home'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
	<section class="banner d-flex align-items-center justify-content-center px-5">
		<div class="banner-text-container text-center">
			<h1 class="text-uppercase"><?php bloginfo('name'); ?></h1>
			<?php the_content(); ?>
			<div class="buttons d-flex justify-content-around">
				<a href="" class="h-c-black member-link bg-yellow black text-uppercase py-2 px-4">Be A Member</a>
				<a href="" class="partner-link bg-red white text-uppercase py-2 px-4">Be A Partner</a>
			</div>
		</div>
		<a href="#join-us" class="scroll white">
			<span></span>SCROLL
		</a>		
		<div data-ride="carousel" class="carousel carousel-fade" id="banner-carousel">
		    <div role="listbox" class="carousel-inner">
				<?php $images = get_field('banner_images'); ?>
				<?php if($images): ?>
					<?php foreach( $images as $image ): ?>
					    <div class="carousel-item" style="background-image: url('<?php echo $image['url']; ?>')">
					    </div>
					<?php endforeach; ?>
				<?php endif; ?>
		    </div>
		</div>
	</section>
<?php 
	endwhile; wp_reset_query(); 
?>
	<section id="join-us" class="member-partner">
		<?php 
			$the_query = new WP_Query(array('post_type'=>'blurbs', 'p'=>66));
			while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
		<div class="join-member pt-5">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<?php the_content(); ?>
						<a href="" class="h-c-white white rounded bg-blue py-3 px-5 d-inline-block">Learn More</a>
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
			$the_query = new WP_Query(array('post_type'=>'blurbs', 'p'=>68));
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
									    	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" class="img-fluid d-block mx-auto">
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
							<a href="" class="h-c-white white rounded bg-blue py-3 px-5 d-inline-block">Learn More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			endwhile; wp_reset_query(); 
		?>
	</section>


<?php get_footer();  ?>