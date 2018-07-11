<?php /* Template Name: Report */  ?>

<?php get_header();  ?>

<div class="benefits-container">

	<?php 
		$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'agent-membership-report'));
		while ( $the_query->have_posts() ) : $the_query->the_post();
		$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
	?>


	<section class="page-banner py-5 white text-uppercase" style="background-image:url(<?php echo $featuredImage; ?>);">
		<div class="container py-5">
			<div class="row">
				<div class="col text-center">
					<h2 class="font-weight-bold "><?php the_title(); ?></h2>
					<span class="bread-crumbs">Home // <a href="<?php the_permalink() ?>" class="yellow transition"><?php the_title(); ?></a></span>
				</div>
			</div>
		</div>
	</section>

	<?php 
		endwhile; wp_reset_query(); 
	?>


	<section class="report-page py-5">
		<div class="container">
			<div class="row">
				<div class="col-12">
                    Earl
                    <?php
                    global $wpdb;
                    $posts = $wpdb->prefix."posts";
                    $wp_users = $wpdb->prefix.'users';
                    $wp_usermeta = $wpdb->prefix.'usermeta';
                    $agents = $wpdb->get_results( "SELECT * FROM $wp_usermeta JOIN $wp_users on $wp_usermeta.user_id =$wp_users.ID  WHERE meta_value LIKE '%\"agent\"%' AND meta_key = '{$wpdb->prefix}capabilities' ");
                    ?>

                    <table width="100%">
                        <thead>
                        <tr>
                            <th>Agent</th>
                            <th>Members</th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                    if(!empty($agents))
                    {
                        foreach($agents as $result ){
                            echo "<tr>";
                            echo "<td>".$result->display_name."</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                        </tbody>
                    </table>

                    <!-- EARL DGD K MGCODE  -->

                    <!-- K -->

				</div>
			</div>
		</div>
	</section>

</div>


<?php get_footer(); ?>
