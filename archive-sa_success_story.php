<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
				<div class="entry-content">
				<?php
					//Get the page intro content.
					$args = array (
						'pagename' => 'salud-america/success-stories-intro/',
						'post_type' => 'page'
						);
					// print_r($wp_query->query_vars);
					$page_intro = new WP_Query( $args );
					// print_r($page_intro);
					while ( $page_intro->have_posts() ) : $page_intro->the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('sa_archive_introduction'); ?>>
							<?php 
							//Get the page header image ?>
							<!-- <header>
								 <img class="size-full wp-image-16768 no-box" alt="Topic header for <?php echo $tax_term->name ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/topic_headers/<?php echo $tax_term->slug ?>.jpg" />
							 </header> -->
						 <?php
							
							the_content(); 
					endwhile; // end of the loop.

					//Get the related dings

				?>

		               </article>
			
			<h3 class="screamer">Success Stories</h3>
				<?php 
				//Loop to display the most recent changemaker featured image for eah target area.
				$advocacy_targets = get_terms('sa_advocacy_targets');
				// echo '<pre>';
				// print_r($advocacy_targets);
				// echo '</pre>';
				$do_not_duplicate = array();
				foreach ($advocacy_targets as $target) {
					//Build the query
					$args = array (
						'post_type' => 'sa_success_story',
						// 'sa_advocacy_targets' => $target->slug,
						// 'sa_resource_cat' => 'success-stories',
						'posts_per_page' => 1,
						'post__not_in' => $do_not_duplicate,
						'tax_query' => array(
							array(
								'taxonomy' => 'sa_advocacy_targets',
								'field' => 'slug',
								'terms' => array( $target->slug )
							),
						)
						);
					$ssquery = new WP_Query( $args );
					while ( $ssquery->have_posts() ) {
						$ssquery->the_post();
						global $post;
						setup_postdata( $post );
						?>
						<div class="half-block salud-topic <?php echo $target->slug; ?>">
							<a href="<?php echo get_the_intersection_link( 'sa_success_story', 'sa_advocacy_targets', $target->slug );?>" title="Link to taxonomy page.">
								<span class="<?php echo $target->slug; ?>x60"></span>
								<h4 class="icon-friendly" style="width:65%; margin-top:0; line-height:1.2;"><?php echo $target->name ?></h4>
							</a>
						<?php
						// echo '<div class="half-block"><span class="'. $target->slug . 'x30"></span><h5 class="screamer">' . $target->name . '</h5>';
						// if ( has_post_thumbnail()) : ?>
						   	<!-- <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						   	<?php the_post_thumbnail('feature-front-sub'); ?>
						   	<br /> -->
						<?php
						// endif;
						// echo get_the_title() . '</a></div>';
						//Use the template with the featured image thumbnail.
                        get_template_part( 'content', 'saresources-mini');
                        echo "</div> <!-- .half-block -->";

						// print_r($do_not_duplicate);
						$do_not_duplicate[] = get_the_ID();
					}
					wp_reset_postdata();


				} //End foreach
		?>					
			</div> <!-- .entry-content -->
			</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>