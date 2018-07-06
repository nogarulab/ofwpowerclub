<?php get_header();  ?>



<div class="single-product-page">
	<?php 
		$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'store'));
		while ( $the_query->have_posts() ) : $the_query->the_post();
		$featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
	?>

	<section class="page-banner py-5 white text-uppercase" style="background-image:url(<?php echo $featuredImage; ?>);">
		<div class="container py-5">
			<div class="row">
				<div class="col text-center">
					<h2 class="font-weight-bold "><?php wp_title(''); ?></h2>
					<span class="bread-crumbs">Home // <a href="<?php the_permalink() ?>" class="yellow transition"><?php the_title(); ?></a></span>
				</div>
			</div>
		</div>
	</section>

	<?php 
		endwhile; wp_reset_query(); 
	?>

	<section class="product-details py-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 order-lg-last">
					<h3><?php the_title(); ?></h3>
					<b class="font-weight-bold d-block"><?php the_field('price'); ?></b>
					<br>
					<?php the_content(); ?>
				</div>
				<div class="col-lg-6 order-lg-first">
					<div class="d-flex">
						<div class="thumb-prods mr-3">
							<?php $images = get_field('product_images'); ?>
							<?php if($images): ?>
							<?php foreach( $images as $image ): ?>	
								
								<div class="mb-2">
									<img src="<?php echo $image['sizes']['small']; ?>" alt="" class="img-fluid d-block mx-auto">
								</div>
								
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="main-img">
							<?php $images = get_field('product_images'); ?>
							<?php if($images): ?>
							<?php foreach( $images as $image ): ?>	
								
								<div class="mb-2">
									<img src="<?php echo $image['url']; ?>" alt="" class="img-fluid d-block mx-auto">
								</div>
								
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
</div>


<?php get_footer();  ?>