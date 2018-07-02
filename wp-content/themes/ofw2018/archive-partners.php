<?php get_header();  ?>

<div class="partners-container">
<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'partners'));
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

<section class="our-partners py-5">
	<div class="container">
		<div class="row">
			<div class="col-xl-3">
				
			</div>
			<div class="col-xl-9">
				<?php get_template_part('loop'); ?>
				<?php get_template_part('pagination'); ?>
			</div>
		</div>
	</div>
</section>

<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'partners'));
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<section class="partner-bottom bg-yellow py-4">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-5 col-md-7">
				<?php the_content(); ?>
			</div>
			<div class="col-xl-7 col-md-5 text-center">
				<a href="" class="white transition h-c-white rounded bg-blue py-3 px-5 d-inline-block">Be a Partner</a>
			</div>
		</div>
	</div>
</section>
<?php 
	endwhile; wp_reset_query(); 
?>

</div>

<?php get_footer();  ?>