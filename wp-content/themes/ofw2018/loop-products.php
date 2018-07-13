<div class="row align-items-stretch">

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="col-sm-4 mb-4">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="transition">
				<?php the_post_thumbnail('home-prods', array('class' => 'img-fluid mx-auto d-block')); ?>
				<p class="mb-0"><?php the_title(); ?></p>
			</div>
		</a>
		<b class="font-weight-bold yellow"><?php the_field('price') ?></b>
	</div>

<?php endwhile; ?>

<?php else: ?>

	<div class="col-lg-12">
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</div>

<?php endif; ?>

</div>


		



