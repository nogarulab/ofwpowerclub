<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'contact-us'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<div class="col-md-6">
	<div class="contact-details">
		<div>
			<strong class="blue">Offices</strong>
			<strong>Hong Kong</strong>
			<address>
				<?php the_field('location'); ?>
			</address>
			P: <?php the_field('phone'); ?>
			<br><br>
			<strong>Philippines</strong>
			<address>
				<?php the_field('location_phil'); ?>
			</address>
			P: <?php the_field('phone_phil'); ?>
		</div>
		<?php $theEmail = get_field('email'); ?>
		<div><strong class="blue">Email</strong> <span><?php echo antispambot( $theEmail ) ?></span></div>
	</div>
</div>

<?php 
	endwhile; wp_reset_query(); 
?>