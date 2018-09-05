<div class="row align-items-stretch">

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="col-sm-4 mb-4">
		<?php $logo = the_post_thumbnail(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="logo-cont transition d-flex">
					<?php if (!empty($logo)) { ?>
						<?php the_post_thumbnail('full', array('class' => 'img-fluid transition mx-auto d-block align-self-center')); ?>
					<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/no-logo.png" alt="<?php the_title(); ?>" class="img-fluid transition mx-auto d-block align-self-center"/>
					<?php } ?>
				</div>
				<p><?php the_title(); ?></p>
			</a>
	</div>

<?php endwhile; ?>

<?php else: ?>

	<div class="col-lg-12">
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</div>

<?php endif; ?>

</div>
