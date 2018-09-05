<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'contact-us'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<div class="col-md-6">
	<div class="contact-details">
		<?php $theEmail = get_field('email'); ?>
		<div><strong>Email</strong> <span><?php echo antispambot( $theEmail ) ?></span></div>
		<div>
			<strong>Offices</strong>
			<br>
			<strong class="blue">Hong Kong</strong>
			<address>
				<?php the_field('location'); ?>
			</address>
			<strong>Phone</strong> <?php the_field('phone'); ?>
			<br>
			<strong class="blue">Philippines</strong>
			<address>
				<?php the_field('location_phil'); ?>
			</address>
			<strong>Phone</strong> <?php the_field('phone_phil'); ?>
		</div>
	</div>
</div>

<?php 
	endwhile; wp_reset_query(); 
?>