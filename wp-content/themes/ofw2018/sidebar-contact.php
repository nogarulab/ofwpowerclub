<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'contact-us'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<div class="col-md-6">
	<div class="contact-details">
		<div><strong>Phone</strong> <?php the_field('phone'); ?></div>
		<div><strong>Email</strong> <span class="backward"><?php the_field('email'); ?></div></span>
		<div>
			<strong>Location</strong>
			<address>
				<?php the_field('location'); ?>
			</address>
		</div>
	</div>
</div>

<?php 
	endwhile; wp_reset_query(); 
?>