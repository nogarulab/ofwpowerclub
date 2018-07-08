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
					<h3 class="mb-0"><?php the_title(); ?></h3>
					<div>
						<?php echo wpdocs_custom_taxonomies_terms_links(); ?>        
					</div>
					<b class="single-price font-weight-bold d-block"><?php the_field('price'); ?></b>
					<br>
					<?php the_content(); ?>
					
				</div>
				<div class="col-lg-6 order-lg-first">
					<div class="first-col d-inline-block">
						<div id="thumb-prods" class="thumb-prods mr-3 mx-auto">
							<?php $images = get_field('product_images'); ?>
							<?php if($images): ?>
							<?php foreach( $images as $image ): ?>	
								
								<div class="mb-2">
									<img src="<?php echo $image['sizes']['small']; ?>" alt="" class="img-fluid">
								</div>
								
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="sec-col d-inline-block">
						<div id="main-img" class="main-img">
							<?php $images = get_field('product_images'); ?>
							<?php if($images): ?>
							<?php foreach( $images as $image ): ?>	
								
								<div class="mb-2">
									<img src="<?php echo $image['url']; ?>" alt="" class="img-fluid">
								</div>
								
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<br>
			<hr>
		</div>
	</section>


	<section class="related pb-5">
		<div class="container">
			<h3 class="blue font-weight-bold mb-3">Related Products</h3>
			<div class="row">
				<?php 
					$custom_taxterms = wp_get_object_terms( $post->ID, 'prod_cat', array('fields' => 'ids') );
					$args = array(
					'post_type' => 'products',
					'post_status' => 'publish',
					'posts_per_page' => 4,
					'orderby' => 'rand',
					'tax_query' => array(
					    array(
					        'taxonomy' => 'prod_cat',
					        'field' => 'id',
					        'terms' => $custom_taxterms
					    )
					),
					'post__not_in' => array ($post->ID),
					);
					$related_items = new WP_Query( $args );

					if ($related_items->have_posts()) :
					while ( $related_items->have_posts() ) : $related_items->the_post();
					?>
					    <div class="col-md-3 col-sm-6 mb-3">
					    	<a class="black" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<div class="transition">
									<?php the_post_thumbnail('home-prods', array('class' => 'img-fluid mx-auto d-block')); ?>
									<p class="mb-0"><?php the_title(); ?></p>
								</div>
							</a>
							<b class="font-weight-bold yellow"><?php the_field('price') ?></b>
					    </div>
					<?php
					endwhile;
					endif;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
</div>


<?php get_footer();  ?>