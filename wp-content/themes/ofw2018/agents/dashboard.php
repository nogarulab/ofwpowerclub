<?php
if ( is_user_logged_in() && current_user_can('agent') ) :
	$current_user = wp_get_current_user();
?>
	<div class="user-dashboard-home">
		<header>
			<h3>Hello <?php echo get_user_meta( $current_user->ID, 'first_name', true );  ?>!</h3>
			<?php 
				$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'about'));
				while ( $the_query->have_posts() ) : $the_query->the_post();
				the_content();
				endwhile; wp_reset_query(); 
			?>

		</header>
		<?php get_template_part( 'agents/stats', get_post_format() ); ?>
		<?php get_template_part( 'agents/change-password', get_post_format() ); ?>
	</div>
<?php
endif;
?>