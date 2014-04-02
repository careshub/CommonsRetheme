<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); 

//Which term is this page showing? Is it showing a term?
if ( isset( $wp_query->query_vars['term'] ) ) {
	$tax_term = get_term_by( 'slug', $wp_query->query_vars['term'], $wp_query->query_vars['taxonomy'] );
}
?>
<style>
	.pad {margin-bottom:10px;}
</style>
		<div id="content" role="main">
			<div class="padder">
				<div class="entry-content">
				<?php
					
					//First section is used if this page is an advocacy target taxonomy page. Standard archives are rendered using the else section. 
					if ( !empty( $tax_term ) && $tax_term->taxonomy == 'sa_advocacy_targets' ) {

						//Get the page intro content, which is stored as a page with the same slug as the target area.
						$args = array (
							'pagename' => 'salud-america/sa-advocacy-targets-intros/' . $tax_term->slug,
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
								<div class="clear clear-both">
								<!-- TODO: Need to figure out what the pattern is here, or generalize it somehow! -->
								<?php if ( $tax_term->slug == 'sa-active-play' ) { ?>
                                                                
                                                                <div class="column1of3 aligncenter">
                                                                   <img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="/wp-content/uploads/2013/08/Research_review.png" /><b>Research Review</b><br /><br />
                                                                    <a href="/wp-content/uploads/2013/08/Active-Play-Research-Review.pdf" class=" button  aligncenter">Download</a></p>
                                                                </div>    
                                                                <div class="column1of3 aligncenter">
                				                    <img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="/wp-content/uploads/2013/08/AP_brief.png" /><b>Issue Brief</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Active-Play-Issue-Brief.pdf" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/SpanishActive-Play-Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2013/08/AP_info.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Active-Play-Infographic-875.jpg" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="wp-content/uploads/2014/02/ActivePlay_Infographic_SPN_sml.jpg" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>  

			                    <?php } else if ( $tax_term->slug == 'sa-active-spaces' ) { ?>
                                                                                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="/wp-content/uploads/2013/08/Research_review.png" /></a><b>Research Review</b><br /><br />
                                                                    <a href="/wp-content/uploads/2013/08/Active-Spaces-Research-Review.pdf" class=" button  aligncenter">Download</a></p>
                                                                </div>    
                                                                <div class="column1of3 aligncenter">
                				                    <img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="/wp-content/uploads/2013/08/AS_brief2.png" /><b>Issue Brief</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Active-Spaces-Issue-Brief.pdf" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/04/SpanishActive-Spaces_Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2013/08/AS_info.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Active-Spaces-Infographic-875.jpg" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/04/Salud_ActiveSpaces_Infographic_SPN_hirez.jpg" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div> 
                                                                
                                            <?php } else if ( $tax_term->slug == 'sa-better-food-in-neighborhoods' ) { ?>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="/wp-content/uploads/2013/08/Research_review.png" /></a><b>Research Review</b><br /><br />
                                                                    <a href="/wp-content/uploads/2013/08/BetterFoodintheNeighborhood-ResearchReview.pdf" class=" button  aligncenter">Download</a></p>
                                                                </div>    
                                                                <div class="column1of3 aligncenter">
                				                    <img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="/wp-content/uploads/2013/08/FN_brief2.png" /><b>Issue Brief</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Better-Food-in-the-Neighborhood-Issue-Brief.pdf" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/SpanishBetter-Food-in-Neighborhoods-Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2013/08/FN_info.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Better-Food-in-the-Neighborhood-Infographic-875.jpg" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Salud_BetterFoods_Infographic_SPN_sml_0.jpg" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div> 

				                <?php } else if ( $tax_term->slug == 'sa-healthier-marketing' ) { ?>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="/wp-content/uploads/2013/08/Research_review.png" /></a><b>Research Review</b><br /><br />
                                                                    <a href="/wp-content/uploads/2013/08/Healthier-Marketing-Research-Review.pdf" class=" button  aligncenter">Download</a></p>
                                                                </div>    
                                                                <div class="column1of3 aligncenter">
                				                    <img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="/wp-content/uploads/2013/08/HM_brief2.png" /><b>Issue Brief</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Healthier-Marketing-Issue-Brief.pdf" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/SpanishHealthier-Marketing-Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2013/08/HM_info2.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Healthier-Marketing-Infographic-875.jpg" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Salud_HealthierMarketing_Infographic_SPN_sml.jpg" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div> 

			                    <?php } else if ( $tax_term->slug == 'sa-healthier-school-snacks' ) { ?>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="/wp-content/uploads/2013/08/Research_review.png" /></a><b>Research Review</b><br /><br />
                                                                    <a href="/wp-content/uploads/2013/08/Healthier-School-Snacks-Research-Review.pdf" class=" button  aligncenter">Download</a></p>
                                                                </div>    
                                                                <div class="column1of3 aligncenter">
                				                    <img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="/wp-content/uploads/2013/08/SS_brief2.png" /><b>Issue Brief</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Healthier-School-Snacks-Issue-Brief.pdf" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/SpanishHealthier-School-Snacks-Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2013/08/SS_info.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Healthier-School-Snacks-Infographic-875.jpg" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Healthy-school-sancks-spn-875.jpg" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div> 

			                    <?php } else if ( $tax_term->slug == 'sa-sugary-drinks' ) { ?>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18047 aligncenter" alt="research-review-icon_again2" src="/wp-content/uploads/2013/08/Research_review.png" /></a><b>Research Review</b><br /><br />
                                                                    <a href="wp-content/uploads/2014/02/Sugary-Drinks-research-review.pdf" class=" button  aligncenter">Download</a></p>
                                                                </div>    
                                                                <div class="column1of3 aligncenter">
                				                    <img class="size-full no-box wp-image-18049 aligncenter" alt="AP_brief_2" src="/wp-content/uploads/2014/02/SD_brief2.png" /><b>Issue Brief</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Sugary-Drinks-issue-brief.pdf" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/SpanishSugary-Drinks-Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2014/02/SD_info.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Sugary-Drinks-Infographic-875.png" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Salud_SugaryDrinks_Infographic_SPN_sml.jpg" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div> 

			                    <?php } ?>
			               </div>

			               </article>
		               <?php 					
		               endwhile; // end of the loop.

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

					<?php } elseif( isset( $tax_term->taxonomy ) ) { //Taxonomy term is set, but not an advocacy target  ?>

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

					<?php } else { //No taxonomy term is set ?>

	                    <div class="policy-search">
	  					<!--<form id="sa-policy-search" class="standard-form" method="get" action="/search-results">-->
		  					<h3 class="screamer sagreen">Search for Changes by Keyword</h3>
                                <?php if ( function_exists('sa_searchpolicies') ) { 
                                        sa_searchpolicies('/search-results'); 
                                        } ?>
		  				</div>
		  				<?php if ( function_exists('sa_location_search') ) {
				                 	sa_location_search();
				                } ?>
                                        
						<div class="browse-topics">
							<h3 class="screamer sablue">Browse Changes by Topic</h3>
							<?php 
								$args = array(
									'taxonomy' => 'sa_advocacy_targets'
								);
								$categories = get_categories($args);
								$all_cats = array();
								foreach ($categories as $cat) {
									$all_cats[] = $cat->slug;
								}
								
								$i = 1;
								foreach ($all_cats as $cat_slug) {
									if ( $i%2 == 1 ) {
										// Begin the row
										echo '<div class="row clear">';
									}
									//Loop through each advocacy target
									$cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');
									// print_r($cat_object);
									$section_title = $cat_object->name;
									$section_description = $cat_object->description;
									?>
									<div class="half-block salud-topic <?php echo $cat_slug; ?>">
										<a href="<?php cc_the_cpt_tax_intersection_link( 'sapolicies', 'sa_advocacy_targets', $cat_slug ) ?>" class="<?php echo $cat_slug; ?>  clear">
											<span class="<?php echo $cat_slug; ?>x90 alignleft"></span>
											<h3><?php echo $section_title; ?></h3>
										</a>
										<p><?php echo $section_description; ?></p>
									</div>
									<?php 
									if ( $i%2 == 0 ) {
										// Close the row
										echo '</div>';
									}
									$i++;

								} // End advocacy target loop 
								 ?>
						</div>
						<!-- Primary loop for most recently added policies -->
				        <div class="row">
							<h3 class="screamer sapink">Newest Changes</h3>
							<?php 
							// Since this is an archive page, let's let WP do the heavy lifting.
							while ( have_posts() ) : the_post(); 
							  get_template_part( 'content', 'sa-policy-short' );
							endwhile; // end of the loop. 
							twentytwelve_content_nav( 'nav-below' );
							?>
				        </div>
						
				<?php } // END !empty( $tax_term ) && $tax_term->taxonomy == 'sa_advocacy_targets' ?>

			</div> <!-- .entry-content -->
			</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>