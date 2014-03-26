<?php get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top');

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
//Which term is this page showing?
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
					
					//First section is used if this page is an advocacy target taxonomy page. Second section renders page if tax_term is set but not advocacy target, like a resource category. Standard archives are rendered using the else section (would also be the front page).
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
							<div class="clear">
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
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/SpanishActive-Spaces-Issue-Brief.pdf" class=" button  aligncenter">Download in Spanish</a></div>
                                                                </div>
                                                                <div class="column1of3 aligncenter">
                                                                    <img class="size-full no-box wp-image-18050 aligncenter" alt="AP_info_2" src="/wp-content/uploads/2013/08/AS_info.png" /><b>Infographic</b><br /><br />
                                                                    <div class="pad"><a href="/wp-content/uploads/2013/08/Active-Spaces-Infographic-875.jpg" class=" button  aligncenter">Download in English</a></div>
                                                                    <div class="pad"><a href="/wp-content/uploads/2014/02/Salud_ActiveSpaces_Infographic_SPN_sml.jpg" class=" button  aligncenter">Download in Spanish</a></div>
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
	               <h3 class="screamer <?php sa_the_topic_color( $tax_term->slug ); ?>">Resources in the <?php 
	               echo $tax_term->name; 
	               echo ( $tax_term->taxonomy == 'sa_policy_tags' ? ' tag' : ' topic' )
	               ?></h3>
						
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'saresources-short' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
					<?php twentytwelve_content_nav( 'nav-below' ); ?>
				</div>
				<?php
                //end check for taxonomy == sa_advocacy_targets 
				} elseif( isset( $tax_term->taxonomy ) ) {
				?>
					<div class="taxonomy-policies">
		                <h3 class="screamer <?php sa_the_topic_color( $tax_term->slug ); ?>">Resources in the <?php 
		                echo $tax_term->name; 
		                echo ( $tax_term->taxonomy == 'sa_policy_tags' ? ' tag' : ' topic' )
		                ?></h3>
							
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'saresources-short' ); ?>
							<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>
						<?php twentytwelve_content_nav( 'nav-below' ); ?>
					</div>
				<?php
				} else {
					//If no taxonomy term is set, then we want to treat this as the policy archive page. We only want to show the first few block on the first page.
					if ( $paged == 1 ) {
						?>
				        <h3 class="screamer sablue">Want to find resources to help make change in your area?</h3>
				        <?php
				         //Display the page content before making the custom loop
				          // while ( have_posts() ) : the_post();
				          // 	get_template_part( 'content', 'page-notitle' );
				          //   // comments_template( '', true );              
				          // endwhile; // end of the loop. 
				          ?>
				          <p>We’ve collected a wide variety of the latest ways to get involved and find tool-kits, webinars and training opportunities to learn more.</p>

		   				<div class="policy-search">
		  					<!--<form id="sa-policy-search" class="standard-form" method="post" action="/">-->
				                <?php if ( function_exists('sa_searchresources') ) { 
				                  sa_searchresources('/search-results'); 
				                } ?>
						</div>

						<h3 class="screamer sapurple">Browse Resources by Topic</h3>
						<div>
							
							<?php 
							$advocacy_targets = get_terms('sa_advocacy_targets');
							foreach ($advocacy_targets as $target) {
								?>
								<div class="sixth-block mini-text"><a href="<?php cc_the_cpt_tax_intersection_link( 'saresources', 'sa_advocacy_targets', $target->slug ) ?>"><span class="<?php echo $target->slug; ?>x90"></span><br /><?php echo $target->name; ?></a></div>						
							<?php } //end foreach ?>
							
						</div>

				        <?php

				        //Specify the saresourcecat slugs we want to show here 
				        // If specifying more than one category, make them a comma-separated list               
				        $resource_cats = array( 'report-2', 'toolkit','get-involved' );
				        ?>

				        <div class="row">
				          <h3 class="screamer sagreen">Browse Resources by Type</h3>
				          <?php saresources_get_featured_blocks($resource_cats);?>
				        </div>
			        <?php 
			    		} // end if $paged = 1 
			        ?>

			        <!-- Begin secondary loop for most recently added resources -->
			        <div class="row taxonomy-policies">
			          <h3 class="screamer sapink">Latest Resources Added</h3>
			          <?php 
			          // saresources_get_related_resources($resource_cats);
			          // Since this is an archive page, let's let WP do the heavy lifting.
			          while ( have_posts() ) : the_post(); 
				          get_template_part( 'content', 'saresources-short' );
			          endwhile; // end of the loop. 
			          twentytwelve_content_nav( 'nav-below' );
			          ?>

			        </div>
				<?php
				}
				?>
					
			</div> <!-- .entry-content -->
			</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>