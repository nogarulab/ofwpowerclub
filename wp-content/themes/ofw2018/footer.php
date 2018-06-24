
			<footer class="footer py-5  text-center" role="contentinfo">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10 col-12">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo-white.png" alt="Logo" class="img-fluid d-block mx-auto mb-4">
							<?php wp_nav_menu(array('menu' => 'Main Menu'))?>
							<h6 class="mt-5">FOLLOW US</h6>
							<ul class="social-footer">
								<?php 
									$the_query = new WP_Query(array('post_type'=>'page', 'pagename'=> 'contact-us'));
									while ( $the_query->have_posts() ) : $the_query->the_post();
								?>
								<li>
									<a href="<?php the_field('facebook'); ?>" target="_blank"><i class="fab fa-facebook-square"></i></a>
								</li>
								<li>
									<a href="<?php the_field('twitter'); ?>" target="_blank"><i class="fab fa-twitter-square"></i></a>
								</li>
								<li>
									<a href="<?php the_field('google_plus'); ?>" target="_blank"><i class="fab fa-google-plus-square"></i></a>
								</li>
								<li>
									<a href="<?php the_field('youtube'); ?>" target="_blank"><i class="fab fa-youtube-square"></i></a>
								</li>
								<?php 
									endwhile; wp_reset_query(); 
								?>
							</ul>
							<hr>
							<p>Copyright <?php bloginfo('name'); ?><br>All Rights Reserved</p>
						</div>
					</div>
				</div>

			</footer>

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
