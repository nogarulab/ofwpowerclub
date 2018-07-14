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
                    <style>
                        .membership_report{
                            width: 100%;
                            font-size: 11px;
                        }
                        .membership_report thead th:not(:first-child),
                        .membership_report tbody td:not(:first-child){
                            text-align: center;
                        }
                        #print_report{
                            margin-bottom: 10px;
                            float: right;
                        }
                        @media print{
                            .header,.footer,.page-banner,.no-print{
                                display: none;
                            }
                            .membership_report{
                                display: block;
                            }
                        }
                    </style>
                    <?php
                    
                    function get_agent_report($current_user){
                        $total_ma_args = array(
                            'role' 			=> 'Subscriber',
                            'meta_query'    => array(
                                'relation'  => 'AND',
                                array(
                                    'meta_key' => 'ms_is_member',
                                    'value'     => 1
                                ),
                                array(
                                    'meta_key' => 'agent_id',
                                    'value'     => $current_user
                                )
                            ),
                            'number'        => -1
                        );
                        $total_ma_query = new WP_User_Query( $total_ma_args );

                        $total_aa_args = array(
                            'role'          => 'Subscriber',
                            'meta_key'      => 'agent_id',
                            'meta_value'    => $current_user,
                            'number'        => -1
                        );
                        $total_aa_query = new WP_User_Query( $total_aa_args );
//                            echo '<pre>';
//                            print_r($total_aa_query);
//                            echo '</pre>';
                        $total_np_query = abs($total_aa_query->get_total() - $total_ma_query->get_total());


                        $aa_IDS = [];
                        $ma_IDS = [];
                        foreach ( $total_ma_query->get_results() as $user ) {
                            $ma_IDS[] = $user->ID;
                        }
                        foreach ( $total_aa_query->get_results() as $user ) {
                            $aa_IDS[] = $user->ID;
                        }
//                            echo '<pre>';
//                            print_r($ma_IDS);
//                            echo '</pre>';

                        if(count($aa_IDS)>0){

                            $week_aa_args = array(
                                'post_type' => 'ms_invoice',
                                'post_status' => 'private',
                                'author'    => implode(',',$aa_IDS),
                                'number'    => -1,
                                'date_query' => array(
                                    array(
                                        'year' => date( 'Y' ),
                                        'week' => date( 'W' ),
                                    ),
                                ),
                            );
                            $week_aa_query = new WP_Query( $week_aa_args );
                            $week_aa_count = count($week_aa_query->get_posts());

                            $month_aa_args = array(
                                'post_type' => 'ms_invoice',
                                'post_status' => 'private',
                                'author'    => implode(',',$aa_IDS),
                                'number'    => -1,
                                'date_query' => array(
                                    array(
                                        'year' => date( 'Y' ),
                                        'month' => date( 'M' ),
                                    ),
                                ),
                            );
                            $month_aa_query = new WP_Query( $month_aa_args );
                            $month_aa_count = count($month_aa_query->get_posts());

                            $year_aa_args = array(
                                'post_type' => 'ms_invoice',
                                'post_status' => 'private',
                                'author'    => implode(',',$aa_IDS),
                                'number'    => -1,
                                'date_query' => array(
                                    array(
                                        'year' => date( 'Y' ),
                                    ),
                                ),
                            );
                            $year_aa_query = new WP_Query( $year_aa_args );
                            $year_aa_count = count($year_aa_query->get_posts());

                            $overall_aa_args = array(
                                'post_type' => 'ms_invoice',
                                'post_status' => 'private',
                                'author'    => implode(',',$aa_IDS),
                                'number'    => -1,
                            );
                            $overall_aa_query = new WP_Query( $overall_aa_args );
                            $overall_aa_count = count($overall_aa_query->get_posts());

                        }else{
                            $week_aa_count = 0;
                            $month_aa_count = 0;
                            $year_aa_count = 0;
                            $overall_aa_count=0;
                        }
                        $s = 'registered'; //LIVE
                        //    $s = 'user-membership-ofw-power-club-membership-type-paid'; //LIVE
                        //    $s = 'cancel'; //local

                        if(count($ma_IDS)>0){


                            $week_ma_args = array(
                                'post_type' => 'ms_event',
                                'post_status' => 'private',
                                's' => $s,
                                'author'    => implode(',',$ma_IDS),
                                'number'    => -1,
                                'date_query' => array(
                                    array(
                                        'year' => date( 'Y' ),
                                        'week' => date( 'W' ),
                                    ),
                                ),
                            );
                            $week_ma_query = new WP_Query( $week_ma_args );


                            $week_ma_count = count($week_ma_query->get_posts());
                            $month_ma_args = array(
                                'post_type' => 'ms_event',
                                'post_status' => 'private',
                                's' => $s,
                                'author'    => implode(',',$ma_IDS),
                                'number'    => -1,
                                'date_query' => array(
                                    array(
                                        'year' => date( 'Y' ),
                                        'week' => date( 'W' ),
                                    ),
                                ),
                            );
                            $month_ma_query = new WP_Query( $month_ma_args );

                            $month_ma_count = count($month_ma_query->get_posts());
                            $year_ma_args = array(
                                'post_type' => 'ms_event',
                                'post_status' => 'private',
                                's' => $s,
                                'author'    => implode(',',$ma_IDS),
                                'number'    => -1,
                                'date_query' => array(
                                    array(
                                        'year' => date( 'Y' ),
                                        'week' => date( 'W' ),
                                    ),
                                ),
                            );
                            $year_ma_query = new WP_Query( $year_ma_args );
                            $year_ma_count = count($year_ma_query->get_posts());

                            $overall_ma_args = array(
                                'post_type' => 'ms_event',
                                'post_status' => 'private',
                                's' => 'registered',
                                'author'    => implode(',',$ma_IDS),
                                'number'    => -1,
                            );
                            $overall_ma_query = new WP_Query( $overall_ma_args );

//        echo '<pre>';
//        print_r($overall_ma_query);
//        echo '</pre>';
//        if ( $overall_ma_query->have_posts() ) {
//            // The 2nd Loop
//            while ( $overall_ma_query->have_posts() ) {
//                 $overall_ma_query->the_post();
//                the_content();
//            }
//
//            // Restore original Post Data
//            wp_reset_postdata();
//        }
                            $overall_ma_count = count($overall_ma_query->get_posts());

                        }else{

                            $week_ma_count = 0;
                            $month_ma_count = 0;
                            $year_ma_count = 0;
                            $overall_ma_count=0;
                        }
                        $week_point_count = $week_ma_count * 5;
                        $month_point_count = $month_ma_count * 5;
                        $year_point_count = $year_ma_count * 5;
                        $overall_point_count = $overall_ma_count * 5;
                        return array(
                            $week_aa_count,$week_ma_count,$week_point_count,
                            $month_aa_count,$month_ma_count,$month_point_count,
                            $year_aa_count,$year_ma_count,$year_point_count,
                            $overall_aa_count,$overall_ma_count,$overall_point_count);
                    }


                    $get_agents_args = array(
                        'role' 			=> 'Agent',
                        'number'        => -1
                    );
                    $get_agents_query = new WP_User_Query( $get_agents_args );


//                        echo '<pre>';
//                        print_r($get_agents_query->get_results());
//                        echo '</pre>';

                    ?>
                    <button class="btn btn-info btn-sm no-print" id="print_report" onclick="window.print()"><i class="fa fa-print"></i>&nbsp;Print</button>
                    <table class="table table-bordered membership_report" width="100%">
                        <colgroup>
                            <col width="20%"/>
                        </colgroup>
                        <thead>
                        <tr>
                            <th rowspan="2">Agent</th>
                            <th colspan="3">Current Week</th>
                            <th colspan="3">Current Month</th>
                            <th colspan="3">Current Year</th>
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
                            <th>No. of Applicants Registered</th>
                            <th>No. of Applicants with Membership </th>
                            <th>Points</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (  $get_agents_query->get_results() ) {
                                foreach ( $get_agents_query->get_results() as $agent ) {

                                    echo '<tr>';
                                    echo '<td>'.$agent->display_name.'</td>';
                                    $member_count =get_agent_report($agent->ID);
                                    foreach($member_count as $mc){
                                        echo '<td>'.$mc.'</td>';
                                    }

                                    echo '</tr>';
                                }
                            } else {

                                echo '<tr><td colspan="99">No Agents</td></tr>';
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
