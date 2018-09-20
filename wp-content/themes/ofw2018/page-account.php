<?php /* Template Name: Account */  ?>

<?php get_header();  ?>

<section class="py-5 test">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 text-center">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<?php echo file_get_contents(get_template_directory_uri().'/img/logo.svg'); ?>
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