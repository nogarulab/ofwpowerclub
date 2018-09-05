<?php

get_header(); ?>

<div class="page-container">

<?php if ( is_page('partner-dashboard') ) {

    get_template_part( 'partners/dashboard', get_post_format() );

} elseif ( is_page('agent-dashboard') ) {

    echo '<div class="container">';

    if ( is_user_logged_in() && current_user_can('agent') ) :

        get_template_part( 'agents/dashboard', get_post_format() );

    else :

        echo '<div class="no-permission">You do not have permission to view this page. Please login as an agent to view this page</div>';

    endif;

    echo '</div>';

} else {

    ?>

    <main role="main">
        <!-- section -->
        <section>

            <div class="container">

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

            if ( is_page('contact-administrator') ) {
                get_template_part( 'partners/contact', get_post_format() );
            }

            if ( is_page('member-search') ) {
                get_template_part( 'partners/member-search', get_post_format() );
            }

            if ( is_page('edit-my-personal-details') ) {
                get_template_part( 'members/edit-profile', get_post_format() );
            }

            if ( is_page('add-a-member') ) {
                get_template_part( 'agents/addmember', get_post_format() );
            }


            ?>
            <br><br>

            </div>

        </section>
        <!-- /section -->
    </main>

    <?php

} ?>

</div>
<?php
get_footer();

?>