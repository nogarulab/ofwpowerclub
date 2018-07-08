<?php /* Template Name: OFW Power Club Template */ 

get_header();

if (have_posts()):
    while (have_posts()) :
        the_post();

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
				
			</section>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="col-12 py-5">
				<h3>Sorry, nothing to display.</h3>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php get_sidebar('testimonies') ?>


</div>
<?php get_footer(); ?>
