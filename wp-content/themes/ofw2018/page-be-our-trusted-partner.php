<?php /* Template Name: Be A Partner */ 

get_header();


	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'be-our-trusted-partner'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
?>
	<div class="default-template">

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
		

	<div class="container">
		<div class="row">
			<div class="col-12">
				<section class="py-5">
					<?php the_content(); ?>
					<?php if ( ! is_user_logged_in() ) { ?>
						<a href="<?php echo home_url(); ?>/request-for-partnership" class="h-c-white rounded partner-link bg-blue white text-uppercase py-3 px-5">Be A Partner</a>
					<?php } ?>
				</section>
			</div>
		</div>
	</div>
<?php 
	endwhile; wp_reset_query(); 
?>
	

<?php get_sidebar('testimonies') ?>


</div>
<?php get_footer(); ?>
