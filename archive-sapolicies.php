<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
				<div class="entry-content">
				<?php
					//Which term is this page showing?
					$tax_term = get_term_by( 'slug', $wp_query->query_vars['term'], $wp_query->query_vars['taxonomy'] );
					// print_r($tax_term);

					if ( $tax_term->taxonomy == 'sa_advocacy_targets' ) {

						//Get the page intro content, which is stored as a page with the same slug as the target area.
						$args = array (
							'pagename' => 'salud-america/sapolicies/' . $tax_term->slug,
							'post_type' => 'page'
							);
						// print_r($wp_query->query_vars);
						$page_intro = new WP_Query( $args );
						// print_r($page_intro);
						while ( $page_intro->have_posts() ) : $page_intro->the_post(); ?>
							<article  id="post-<?php the_ID(); ?>" <?php post_class('advocacy_target_introduction'); ?>>

							<?php 
								//Get the page header image ?>
								<header>
									 <img class="size-full wp-image-16768 no-box" alt="Topic header for <?php echo $tax_term->name ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/topic_headers/<?php echo $tax_term->slug ?>.jpg" />
								 </header>
							 <?php
								
								the_content(); 

						//Get the related dings

						?>
						<div class="clear">
							<!-- TODO: Need to figure out what the pattern is here, or generalize it somehow! -->
							<?php if ( $tax_term->slug == 'sa-active-play' ) { ?>

								<a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Active-Play-Research-Review.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" /><br />Research Review</a>
			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Active-Play-Issue-Brief.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/AP_brief.png" /><br />Issue Brief</a>
			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Active-Play-Infographic-875.jpg" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/AP_info.png" /><br />Infographic</a>

		                    <?php } else if ( $tax_term->slug == 'sa-active-spaces' ) { ?>

			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Active-Spaces-Research-Review.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" /><br />Research Review</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Active-Spaces-Issue-Brief.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/AS_brief2.png" />Issue Brief</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Active-Spaces-Infographic-875.jpg" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/AS_info.png" /><br />Infographic</a>

							<?php } else if ( $tax_term->slug == 'sa-better-food-in-neighborhoods' ) { ?>

							    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/BetterFoodintheNeighborhood-ResearchReview.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" /><br />Research Review</a>
			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Better-Food-in-the-Neighborhood-Issue-Brief.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/FN_brief2.png" /><br />Issue Brief</a>
			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Better-Food-in-the-Neighborhood-Infographic-875.jpg" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/FN_info.png" /><br />Infographic</a>

			                <?php } else if ( $tax_term->slug == 'sa-healthier-marketing' ) { ?>

				                <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Healthier-Marketing-Research-Review.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" /><br />Research Review</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Healthier-Marketing-Issue-Brief.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/HM_brief2.png" /><br />Issue Brief</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Healthier-Marketing-Infographic-875.jpg" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/HM_info2.png" /><br />Infographic</a>
		                    
		                    <?php } else if ( $tax_term->slug == 'sa-healthier-school-snacks' ) { ?>

			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Healthier-School-Snacks-Research-Review.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18047 alignnone" alt="research-review-icon_again2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" /><br />Research Review</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Healthier-School-Snacks-Issue-Brief.pdf" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18049 alignnone" alt="AP_brief_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/SS_brief2.png" /><br />Issue Brief</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Healthier-School-Snacks-Infographic-875.jpg" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18050 alignnone" alt="AP_info_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/SS_info.png" /><br />Infographic</a>
		                    
		                    <?php } else if ( $tax_term->slug == 'sa-sugary-drinks' ) { ?>

			                    <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/Research_review.png" /><br />Research Review</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/AP_brief.png" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/AP_brief.png" /><br />Issue Brief</a>
		                        <a href="http://dev.communitycommons.org/wp-content/uploads/2013/08/AP_info.png" class="column1of3 aligncenter"><img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/AP_info.png"  /><br />Infographic</a>

		                    <?php } ?>
		               </div>

		               </article>
		               <?php 					
		               endwhile; // end of the loop.
					} //end check for taxonomy == sa_advocacy_targets 
				?>
			    <div class="taxonomy-policies">
	               <h3 class="screamer <?php sa_the_topic_color( $tax_term->slug ); ?>">Changes in the <?php 
	               echo $tax_term->name; 
	               echo ( $tax_term->taxonomy == 'sa_policy_tags' ? ' tag' : ' topic' )
	               ?></h3>
						
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'sa-policy-short' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
					<?php twentytwelve_content_nav( 'nav-below' ); ?>
				</div>
					
			</div> <!-- .entry-content -->
			</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>