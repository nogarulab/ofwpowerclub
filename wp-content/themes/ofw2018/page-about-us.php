<?php /* Template Name: About Us */  ?>

<?php get_header();  ?>

<div class="about-us-container">

<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'about'));
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

<section class="about-ofw py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="px-md-4">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col-md-6 pt-5">
				<ul class="nav nav-tabs border-bottom-0 align-items-baseline" id="mvv" role="tablist">
					<li class="nav-item">
					    <a class="border-0 nav-link active transition font-weight-bold" id="mission-tab" data-toggle="tab" href="#mission" role="tab" aria-controls="mission" aria-selected="true">01</a>
					</li>
					<li class="nav-item">
					    <a class="nav-link transition border-0 font-weight-bold" id="vision-tab" data-toggle="tab" href="#vision" role="tab" aria-controls="vision" aria-selected="false">02</a>
					</li>
					<li class="nav-item">
					    <a class="nav-link transition border-0 font-weight-bold" id="values-tab" data-toggle="tab" href="#values" role="tab" aria-controls="values" aria-selected="false">03</a>
					</li>
				</ul>
				<div class="tab-content" id="mvvContent">
					<div class="tab-pane fade show active py-4" id="mission" role="tabpanel" aria-labelledby="mission-tab">
						<h4 class="blue text-uppercase font-weight-bold">Mission</h4> 
						<p><?php the_field('mission') ?></p>
					</div>
					<div class="tab-pane fade py-4" id="vision" role="tabpanel" aria-labelledby="vision-tab">
						<h4 class="blue text-uppercase font-weight-bold">Vision</h4> 
						<p><?php the_field('vision') ?></p>
					</div>
					<div class="tab-pane fade py-4" id="values" role="tabpanel" aria-labelledby="values-tab">
						<h4 class="blue text-uppercase font-weight-bold">Values</h4> 
						<p><?php the_field('values') ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	

<section class="what-we-do py-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="px-lg-4">
					<?php the_field('what_we_do'); ?>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-12 col-xl-10 mt-3">
				<?php echo do_shortcode('[stack_slider id="119"]'); ?>
			</div>
		</div>
	</div>
</section>	


<?php 
	endwhile; wp_reset_query(); 
?>

</div>
<?php get_sidebar('connect'); ?>
<?php get_footer();  ?>