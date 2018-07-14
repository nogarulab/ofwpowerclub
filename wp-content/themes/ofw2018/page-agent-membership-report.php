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
                    <?php
//                    $start_week = date("Y-m-d",strtotime( 'last Sunday' ));
//                    $end_week = date("Y-m-d",strtotime( 'this Saturday' ));
//
//                    $start_month = date("Y-m-d",strtotime( 'first day of this month' ));
//                    $end_month = date("Y-m-d",strtotime( 'last day of this month' ));
//
//                    $start_year = date("Y-01-01");
//                    $end_year = date("Y-12-31");

                    ?>
                    <style>
                        .membership_report{
                            width: 100%;
                            font-size: 10px;
                        }
                        .membership_report thead th:not(:first-child),
                        .membership_report tbody td:not(:first-child){
                            text-align: center;
                        }
                    </style>

                    <table class="table table-bordered membership_report" width="100%">
                        <colgroup>
                            <col width="20%"/>
                        </colgroup>
                        <thead>
                        <tr>
                            <th rowspan="2">Agent</th>
                            <th colspan="3">Current Week</th>
                            <th colspan="3">Current Month</th>
                            <th colspan="3">Overall Total</th>
                        </tr>
                        <tr>
                            <th>No. of Applicants Registered</th>
                            <th>No. of Applicants with Membership </th>
                            <th>Points</th>
                            <th>No. of Applicants Registered</th>
                            <th>No. of Applicants with Membership </th>
                            <th>Points</th>
                            <th>No. of Applicants Registered</th>
                            <th>No. of Applicants with Membership </th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody>

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
