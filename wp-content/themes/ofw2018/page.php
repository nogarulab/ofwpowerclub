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


        /* SUBMIT do action Add Members*/
        if(isset($_POST['submit']))
        {
            do_action('add_members');
        }else{
            ?>
            <!-- SIMPLE FORM -->
            <form name="adding_members" method="POST" >
                <label for="">Username</label>
                <div class="form-group">
                    <input type="text" name="user_login" class="form-control"/>
                </div>

                <label for="">Password</label>
                <div class="form-group">
                    <input type="text" name="user_pass" class="form-control"/>
                </div>

                <label for="">Email</label>
                <div class="form-group">
                    <input type="text" name="lname" class="form-control"/>
                </div>

                <label for="">First Name</label>
                <div class="form-group">
                    <input type="text" name="first_name" class="form-control"/>
                </div>

                <label for="">Last Name</label>
                <div class="form-group">
                    <input type="text" name="last_name" class="form-control"/>
                </div>

                <button type="submit" name="submit">Submit</button>
            </form>
        <?php
        }

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