<?php 

get_header(); 

if ( is_page('partner-dashboard') ) {

	echo 'This is the partner dashboard';
	echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';
  
} elseif ( is_page('agent-dashboard') ) {

	get_template_part( 'partners/form', get_post_format() );
	echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';
  
} else {

?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php 
        
}

get_footer();

?>
