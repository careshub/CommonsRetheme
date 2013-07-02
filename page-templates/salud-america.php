<?php
/*
Template Name: Salud America
*/
get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
			<?php if (is_page('salud-america')) { ?>
				<div class="salud-banner">
					<img src="/wp-content/themes/CommonsRetheme/img/salud_america/salud-hand.jpg" class="no-box">
					<h2>Plant Your <br /><span>Ideas for Change</span><br /> Today!</h2>
					<div class="policy-search-home">
						<h4>Search for Changes in Progress</h4>
						<?php sa_searchpolicies(); ?>
						<!--<form id="sa-policy-search" class="standard-form" method="get" action="/">
						<h4>Search for Changes in Progress</h4>
						<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="70" value="" placeholder="Enter search terms here" name="sa-policy">
						<input class="sa-policy-search-button" type="submit" value="Search">
						</form>-->
					</div>
				</div>
				<div class="row clear">
					<div class="half-block">
						<h4>Change-Maker of the Week</h4>
                             <?php
                            wp_reset_postdata();

			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          
                                $args = array(
					// Change these category SLUGS to suit your use.
				       'post_type' => 'saresources',
                                       'sa_resource_cat'=> 'changemaker',
				       'paged' => $paged
				);
                                
				$list_of_policies = new WP_Query( $args );
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'page-notitle');

					//comments_template( '', true );
                                endwhile; // end of the loop. 
                                ?>
					</div>
					<div class="half-block">
						<a href="http://dev.communitycommons.org/sa-policy-map-search/" style="text-decoration:none;"><h4>Where is Change Happening?</h4>
						<img class="alignnone size-full wp-image-17422" alt="Link to Policy Map Search" src="http://dev.communitycommons.org/wp-content/uploads/2013/06/samap2.jpg" width="274" height="206" /></a>
					</div>
				</div>
				<div class="browse-topics">
					<h3>Browse Changes by Topic</h3>
					<?php 
						$args = array(
							'taxonomy' => 'sa_advocacy_targets'
						);
						$categories = get_categories($args);
						$all_cats = array();
						foreach ($categories as $cat) {
							$all_cats[] = $cat->slug;
						} 

						foreach ($all_cats as $cat_slug) { 
							//Loop through each advocacy target
							$cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');
							// print_r($cat_object);
							$section_title = $cat_object->name;
							$section_description = $cat_object->description;
							?>
						<div class="half-block salud-topic <?php echo $cat_slug; ?>">
							<a href="/salud-america/sapolicies/<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<p><?php echo $section_description; ?></p>
						</div>

						<?php } // End advocacy target loop ?>

				</div>

			<?php
			} elseif (is_page('sapolicies')) {
				//First, display the content of the page before making the custom loop.
				while ( have_posts() ) : the_post();
				$page_intro = get_the_content();
				if ( !empty($page_intro) ) {
					$page_intro = apply_filters('the_content', $page_intro); 
					?>
					<div class="sa-page-intro">
						<?php echo $page_intro; ?>
					</div>	
	                <?php } //End if empty check
                endwhile; // end of the main page loop. 
   				?>
                            
                                        <div class="policy-search-home">
						<h4>Search for Changes in Progress on This Topic</h4>
						<?php sa_searchpolicies(); ?>
						<!--<form id="sa-policy-search" class="standard-form" method="get" action="/">
						<h4>Search for Changes in Progress</h4>
						<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="70" value="" placeholder="Enter search terms here" name="sa-policy">
						<input class="sa-policy-search-button" type="submit" value="Search">
						</form>-->
					</div>

                            
   				<div class="row">
					<div class="policy-search half-block">
						<form id="sa-policy-search" class="standard-form" method="get" action="commonsdev.local/salud-america/sapolicies/">
						<h4>Search for Changes in Progress</h4>
						<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
						<input class="sa-policy-search-button" type="submit" value="Search">
						</form>
					</div>
					<div class="half-block">
						<h4>Change-Maker of the Week</h4>
						<img src="/wp-content/themes/CommonsRetheme/img/salud_america/Video_thumbnail_300x400.jpg">
					</div>
				</div>
				<?php 
				// echo isset($_GET['sa-policy']) ? $_GET['sa-policy'] : 'nope' ;
				?>
				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'sapolicies', 
					'paged' => $paged
				);

				$list_of_policies = new WP_Query( $args ); 

				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'sa-policy-short' );
					//comments_template( '', true );
				endwhile; // end of the loop.
				
				// Custom widget Area Start
				 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sa_geosearch_widget') ) : 
				 endif;
				// Custom widget Area End

			}  elseif (is_child(11911)) {
				//The number above is the id of the parent page, is 11911 on the dev server.
				while ( have_posts() ) : the_post();
				?>

				<?php get_template_part( 'content', 'page-notitle' ); ?>

                
                <?php 
                $page_slug = $post->post_name;

                endwhile; // end of the main page loop. 

                // $parent = $post->post_parent;
                // wp_reset_query(); 
                //echo '$page_slug ' . $page_slug; 
				//echo '$parent ' . $parent;
				?>

                            	<div class="row clear">

    					<div class="half-block">

                                            <h4>Active Play Change-Makers</h4>
                                             <?php
                                             //Need to adapt it to query resourcecat and resource topic area
                                            wp_reset_postdata();

                                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          
                                            $args = array(
                                                // Change these category SLUGS to suit your use.
                                                'post_type' => 'saresources',
                                                'sa_resource_cat'=> 'changemaker',
                                                'paged' => $paged
                                                );
                                
                                                $list_of_policies = new WP_Query( $args );
                                        while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'page-notitle');

					//comments_template( '', true );
                                        endwhile; // end of the loop. 
                                              ?>
					</div>
                                    
                                    
                                        <div class="half-block">
					<!-- <div class="active-play"><span class="icon"></span></div> -->
					<h4>How Are You Targeting Active Play?</h4>
					<div style="width:100%;height:200px;background-color:#CCC;margin-bottom:24px;">form/charts go here</div>
                                        </div>
				</div>
                            
                            
                            
                            
                            
                            
                            

				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			  	// switch ($page_slug) { //TODO: move to custom taxonomy, not these deals.
			  	// 	case 'sa-better-food-in-neighborhoods':
			  	// 		$sa_target_area = 'sa-better-food-in-neighborhoods';
			  	// 		break;
			  	// 	case 'sa-active-spaces':
			  	// 		$sa_target_area = 'sa-active-spaces';
			  	// 		break;
			  	// 	case 'sa-healthier-school-snacks':
			  	// 		$sa_target_area = 'sa-healthier-school-snacks';
			  	// 		break;
			  	// 	case 'sa-sugary-drinks':
			  	// 		$sa_target_area = 'sa-sugary-drinks';
			  	// 		break;
			  	// 	case 'sa-healthier-marketing':
			  	// 		$sa_target_area = 'sa-healthier-marketing';
			  	// 		break;
			  	// 	case 'sa-active-play':
			  	// 		$sa_target_area = 'sa-active-play';
			  	// 		break;
			  	// 	default:
			  	// 		$sa_target_area = 'sa-better-food-in-neighborhoods';
			  	// 		break;
			  	// }

				$args = array(
					'post_type' => 'sapolicies', 
					'paged' => $paged,
					'sa_advocacy_targets' => $page_slug,
				);

				$list_of_policies = new WP_Query( $args ); ?>

				<h2>Policies that address this target area: </h2>

				<?php
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'sa-policy-short' );
					// comments_template( '', true );
				endwhile; // end of the loop.
				
				// Add comment form to these subpages.
				wp_reset_query();
				comments_template( '', true );

			} else {

				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );
				endwhile; // end of the loop. 

			}
			
			?>


		</div><!-- .padder -->
		</div><!-- #content -->

<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>