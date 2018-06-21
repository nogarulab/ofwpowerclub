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
				<a href="" class="member-link bg-yellow black text-uppercase py-2 px-4">Be A Member</a>
				<a href="" class="partner-link bg-red white text-uppercase py-2 px-4">Be A Partner</a>
			</div>
		</div>
					
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



<?php get_footer();  ?>