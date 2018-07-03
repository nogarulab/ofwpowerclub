<div class="row align-items-stretch">

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="col-md-4 col-6 mb-4">

		<?php if ( has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="logo-cont transition d-flex">
					<?php the_post_thumbnail('full', array('class' => 'img-fluid transition mx-auto d-block align-self-center')); ?>
				</div>
			</a>
		<?php endif; ?>

	</div>

<?php endwhile; ?>

<?php else: ?>

	<div class="col-lg-12">
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</div>

<?php endif; ?>

</div>
