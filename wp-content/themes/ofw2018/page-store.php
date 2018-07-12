<?php /* Template Name: Store */  ?>


<?php get_header();  ?>

<div class="store-container">
<?php 
	$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=>'store'));
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

<section class="our-products py-5">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-9 prod-list order-lg-last">

				<div class="row">

				<?php 
					$paged = get_query_var('paged') ? get_query_var('paged') : 1;
					$the_query = new WP_Query(array('post_type'=>'products', 'posts_per_page'=>1, 'paged'=>$paged));
					while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
					<div class="col-sm-4 mb-4">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<div class="transition">
								<?php the_post_thumbnail('home-prods', array('class' => 'img-fluid mx-auto d-block')); ?>
								<p class="mb-0"><?php the_title(); ?></p>
							</div>
						</a>
						<b class="font-weight-bold yellow"><?php the_field('price') ?></b>
					</div>
					<div class="col-12">
						<?php wp_pagenavi( array( 'query' => $the_query ) ); wp_reset_postdata(); ?>
					</div>
				</div>

			</div>
			<div class="col-lg-3 order-lg-first">
				
					<ul class="categories col-12"> 
						<?php wp_list_categories( array(
					        'taxonomy' => 'prod_cat',
					        'title_li' => ''
					    ) ); ?> 
				    </ul>
			    
			</div>
		</div>
	</div>
</section>



</div>

<?php get_footer();  ?>