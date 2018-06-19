<?php 

get_header(); 

if ( is_page('account') ) {
  
  if ( current_user_can('agent') ) :
    
    //Earl uni na ang magiging dashboard kan agents after sya mag login
    echo 'agent here';
    echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';
  
  elseif ( current_user_can('partner') ) :
  
    get_template_part( 'partners/form', get_post_format() );
    echo '<a href="'. wp_logout_url( home_url() ) .'">Logout</a>';
  
  else :
  
    echo do_shortcode('[ms-membership-account]');
    echo '<hr>';
    echo do_shortcode('[ms-membership-logout]');
  
  endif;
  
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
