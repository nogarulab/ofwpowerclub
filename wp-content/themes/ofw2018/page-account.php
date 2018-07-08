<?php /* Template Name: Account */  ?>

<?php get_header();  ?>

<section class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 text-center">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php else: ?>	
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				<?php endif; ?>
			</div>	
		</div>
	</div>
</section>

<?php get_footer();  ?>