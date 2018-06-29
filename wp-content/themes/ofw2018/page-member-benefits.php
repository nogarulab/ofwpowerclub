<?php /* Template Name: Benefits */  ?>

<?php get_header();  ?>

<div class="benefits-container">

<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'member-benefits'));
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

<section class="benefits py-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 px-lg-4">
				<?php the_content(); ?>
				<br>
				<a href="" class="black rounded bg-yellow py-3 px-5 d-inline-block mb-3">Apply Now</a>
			</div>
			<div class="col-lg-6">
				<img class="img-fluid mx-auto d-block" src="<?php the_field('featured_image_for_benefits'); ?>" />
			</div>
		</div>
	</div>
</section>

<?php 
	endwhile; wp_reset_query(); 
?>

<?php get_sidebar('testimonies'); ?>

<section class="send-testimonials py-5">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h3 class="my-5"><span class="share">SHARE</span><br><span class="experience blue">YOUR EXPERIENCE</span></h3>
				<a href="" class="white transition h-c-white rounded bg-blue py-3 px-5 d-inline-block mb-5">Submit Testimonial</a>
			</div>
		</div>
	</div>
</section>
</div>
<?php get_footer();  ?>