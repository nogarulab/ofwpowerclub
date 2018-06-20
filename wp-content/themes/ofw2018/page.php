<?php 

get_header(); 

if ( is_page('partner-dashboard') ) {

	if ( is_user_logged_in() && current_user_can('partner') ) :

		echo 'This is the partner dashboard';
		echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';

	else :

		echo 'You do not have permission to view this page. Please login as a partner or wait until your account has been activated.';

	endif;
  
} elseif ( is_page('agent-dashboard') ) {

	if ( is_user_logged_in() && current_user_can('agent') ) :

		echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';

	else :

		echo 'You do not have permission to view this page. Please login as an agent to view this page';

	endif;
  
} else {

?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

		<?php 

			if (have_posts()): 
				while (have_posts()) : 
					the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php 
				endwhile;
			else:

		?>

			<!-- article -->
			<article>
				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
			</article>
			<!-- /article -->

		<?php 

			endif;

			if ( is_page('request-for-partnership') ) {
				get_template_part( 'partners/form', get_post_format() );
			}


		?>

		</section>
		<!-- /section -->
	</main>

<?php 

	get_sidebar();
        
}

get_footer();

?>