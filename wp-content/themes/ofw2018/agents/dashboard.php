<?php
if ( is_user_logged_in() && current_user_can('agent') ) :
	$current_user = wp_get_current_user();
?>
	<div class="user-dashboard-home">
		<header>
			<h3>Hello <?php echo get_user_meta( $current_user->ID, 'first_name', true );  ?>!</h3>
			<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione</p>
		</header>
		<div class="row tools">
			<div class="col-lg-6"></div>
			<div class="col-lg-6"></div>
		</div>
		<?php get_template_part( 'agents/stats', get_post_format() ); ?>
	</div>
<?php
endif;
?>