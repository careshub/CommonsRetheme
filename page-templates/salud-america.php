<?php
/*
Template Name: Salud America
*/
get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
			<?php if (is_page('salud-america')) { ?>
			<?php if ( function_exists('sa_slider') ) { sa_slider('main-page-slider'); } ?>
				<!-- <div class="salud-banner">
					<img src="/wp-content/themes/CommonsRetheme/img/salud_america/salud-hand.jpg" class="no-box">
					<h2>Plant Your <br /><span>Ideas for Change</span><br /> Today!</h2>
					<div class="policy-search-home">
						<h4>Search for Changes in Progress</h4> -->
						<?php //sa_searchpolicies(); ?>
						<!--<form id="sa-policy-search" class="standard-form" method="get" action="/">
						<h4>Search for Changes in Progress</h4>
						<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="70" value="" placeholder="Enter search terms here" name="sa-policy">
						<input class="sa-policy-search-button" type="submit" value="Search">
						</form>-->
					<!-- </div>
				</div> -->
                        
                                            <div class="third-block">
                                                <table>    
                                                    <tr><td><h3 style='float:left; text-align: center;'> Find Changes!</h3></td>
                                                    <td><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Orange_arrow.png' style='width:50px; height:500px; float:right;' alt='Find Changes'> </td></tr>
                                                </table>
                                                <table>
                                                    <tr><td><h3 style='float:left; text-align: center;'> Learn to Make Changes!</h3></td>
                                                    <td><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Purple_arrow.png' style='width:50px; height:150px; float:right;' alt='Find Changes'> </td></tr>                                                
                                                </table>
                                                <table>    
                                                    <tr><td><h3 style='float:left; text-align: center;'> Share Your Change!</h3></td>
                                                    <td><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Green_arrow.png' style='width:50px; height:150px; float:right;' alt='Find Changes'> </td></tr>
                                                </table>                                                     
                                                </table>
                                            </div>    
                                            <div class="third-block"><h4 style='text-align:center'>By Topic</h4>
                                                <table>
                                                    <tr><td><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-active-play/"><img align='center' src='http://dev.communitycommons.org/wp-content/uploads/2013/08/more-active-play-time_x90.jpg' style='width:100px; height: 100px; ' alt='Active Play'></a></td>
                                                    <td><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-active-spaces/"><img align='center' src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Places-for-activity_x90.jpg' style='width:100px; height: 100px;' alt='Active Spaces'></a></td>
                                                    <tr><td style="text-align: center;"><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-active-play/">Active Play</td></a><td style="text-align: center;"><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-active-spaces/">Active Spaces</td></a>
                                                </table>
                                                <table>
                                                    <tr><td align='center'><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-better-food-in-neighborhoods/"><img align='center' src='http://dev.communitycommons.org/wp-content/uploads/2013/08/better-food-in-neighborhoods_x90.jpg' style='width:100px; height: 100px;' alt='Better Food in Neighborhoods'></a></td>
                                                    <td><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-healthier-marketing/"><img align='center' src='http://dev.communitycommons.org/wp-content/uploads/2013/08/stop-unhealthy-advertising_happy_x90.jpg' style='width:100px; height: 100px;' alt='Healthier Marketing'></a></td>
                                                    <tr><td style="text-align: center;"><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-better-food-in-neighborhoods/">Better Food in Neighborhoods</td></a><td style="text-align: center;"><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-healthier-marketing/">Healthier Marketing</td></a>
                                                </table>
                                                <table>
                                                    <tr><td><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-healthier-school-snacks/"><img align='center' src='http://dev.communitycommons.org/wp-content/uploads/2013/08/better-food-in-schools_x90.jpg' style='width:100px; height: 100px; ' alt='Healthier School Snacks'></a></td>
                                                    <td><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-sugary-drinks/"><img align='center' src='http://dev.communitycommons.org/wp-content/uploads/2013/08/price-of-sugar_x90.jpg' style='width:100px; height: 100px;' alt='sugary Drinks'></a></td>
                                                    <tr><td style="text-align: center; "><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-healthier-school-snacks/">Healthier School Snacks</td></a><td style="text-align: center;"><a href="http://dev.communitycommons.org/salud-america/sapolicies/sa-sugary-drinks/">Sugary Drinks</td></a>
                                                </table>
                                                <table><h4 style="text-align: center; padding-top:27px;">What's Change?</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/WhatsChange_icon.png' style='width:50px; height: 50px; ' alt='Active Play'></td>
                                                    <td style='float:left;'><a href='http://dev.communitycommons.org/salud-america/what-is-change/'>Change at a glance</a></br></br></br><a href='http://dev.communitycommons.org/salud-america/what-is-change/the-science-behind-change/'>The science behind change</a></td>    
                                                </table>
                                                <table><h4 style="text-align: center; padding-top: 30px;">Add a Change</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/AddChange_icon.png' style='width:50px; height: 50px; ' alt='Active Play'></td>
                                                    <td style='float:left;'>Making a change?</br>We missed a change?</br></br><a href='http://dev.communitycommons.org/salud-america/share-your-own-stories/'>Add the details here</a></td>    
                                                </table>
                                            </div>    
                                            <div class="third-block"><h4 style='text-align:center'>By Location</h4>
                                               <table>
                                                    <tr align='center'><a href="http://dev.communitycommons.org/salud-america/sapolicies/"><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Salud_Location_Map.png' style='width:100%; height: 100%; padding-left:20px;' alt='Map of Changes'></a></tr> 
                                                    <tr><td style="text-align: center; padding-left:20px; padding-top:20px;"><a href='http://dev.communitycommons.org/salud-america/sapolicies/'>Browse changes happening in your area right now</a></td></tr>
                                                    <tr><td style="text-align: center; padding-left:20px; padding-top:20px;"><a href='http://dev.communitycommons.org/salud-america/sapolicies/'>Discover change across the country</a></td></tr>

                                                    <tr><td style="text-align: center; padding-left:20px;"><h4>By Keyword</h4></td></tr>
                                                    <tr><td style=" padding-left:20px;"><?php sa_searchpolicies_single(); ?></td></tr>
                                               </table>
                                               <table><h4 style="text-align: center; padding-top:45px;">Learn to Make Changes</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Resoucesmakechange_icon.png' style='width:50px; height: 50px; ' alt='Active Play'></td>
                                                    <td style='float:left;'>Use research, toolkits, and other elements to<a href='http://dev.communitycommons.org/salud-america/saresourcespage/'> learn about healthy change</a></td>    
                                               </table> 
                                               <table><h4 style="text-align: center; padding-top: 30px; ">Be a Star!</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/BeaStar_icon.png' style='width:50px; height: 50px; ' alt='Active Play'></td>
                                                    <td style='float:left;'><a href='http://dev.communitycommons.org/salud-america/share-your-own-stories/'>Share your story</a> of successful change -- we can write it up and upload it here!</td>    
                                               </table>   
                                            </div>
                       
                                                <?php                 
    			}  elseif (is_page('search-results')) {
				$filter_args = array(
					 'post_type' => 'sapolicies',
					 's' => $_POST['saps_single'],
					 'post__in' => $post_ids3,					 
					 'meta_query' => array(
										array(
											'key' => 'sa_policystage',
											'value' => $chk2
											 )
					 					 )
					 
					 );
                                //var_dump($filter_args);
                                $query2 = new WP_Query($filter_args);
                                    if($query2->have_posts()) : 
                                        while($query2->have_posts()) : 
                                            $query2->the_post();
                                            get_template_part( 'content', 'sa-policy-short' ); 

                                        endwhile;
                                    
                                        else: 
                                            echo "No Results - Search criteria too specific";	
                                    endif;
			                                  

			} elseif (is_page('sapolicies')) {
         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>    
                                <?php if ( function_exists('sa_location_search') ) {sa_location_search();} ?>
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

				</div><?php
			}  elseif (is_page('sa-policy-map-search')) {
				sa_location_search();
			
			}  elseif (is_child(11911)) {
                           
				//The number above is the id of the parent page, is 11911 on the dev server.
				//It's 150 on DC's local install
				 
                            if ( function_exists('SA_topics') ) {SA_topics();} ?>
                            
                                        <div class="policy-search-home">
						<h3>Search for Changes in Progress on This Topic</h3>
						<?php sa_searchpolicies(); ?>
						<!--<form id="sa-policy-search" class="standard-form" method="get" action="/">
						<h4>Search for Changes in Progress</h4>
						<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="70" value="" placeholder="Enter search terms here" name="sa-policy">
						<input class="sa-policy-search-button" type="submit" value="Search">
						</form>-->
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
                                        'showposts' => '5',
					'sa_advocacy_targets' => $page_slug,
				);

				$list_of_policies = new WP_Query( $args ); ?>
                                        
                                <!-- NEED FIX TO PULL THE RIGHT CONTENT-->        
                                
                                <div>        
				<div style="width:60%" class="half-block"><h3>Latest Changes: </h3>

				<?php
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'sa-policy-short' );
					// comments_template( '', true );
				endwhile; // end of the loop.
				
				// Add comment form to these subpages.
				wp_reset_query();
				
                                ?>
                                </div>
                                <div style="width:25%" class="half-block">
                                <div style="background-color:rgb(240,240,240);">
                                <h3>Start a Change</h3>
                                <a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">Add a change</a> in your area!<br/><br/><a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">
                                    <img class=" wp-image-12449 aligncenter" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/images.jpg" width="120" height="120" /></a>
                                <br/>
                                </div> 
                                  <br/>    
                                <div style="background-color:rgb(240,240,240);">
                                <h3>Success Story</h3>
                                
                                    <?php
                                        $cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');    
                                    
                                        $success = array(
					'post_type' => 'saresources', 
					'sa_resource_cat' => 'success-stories',
                                        'paged' => $paged,
                                        'showposts' => '1',
					'sa_advocacy_targets' => $page_slug,
                                    );
                                     $feat_resource = new WP_Query( $success );
                                     while ( $feat_resource->have_posts() ): $feat_resource->the_post();
                                     //Use the template with the featured image thumbnail.
                                     ?><h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></h2>
                                     <?php 
                                            if ( has_post_thumbnail() ) {
						the_post_thumbnail('feature-front-sub'); 
						}?></a><?php
                                     endwhile
                                         ?><br/><br/>
                                                        <a href="/salud-america/success-stories-topics/?topic=<?php echo $page_slug; ?>" class="<?php echo $page_slug; ?>  clear">See more</a>
                                   <br/>
                                </div>
                                    <br/>
                                <div style="background-color:rgb(240,240,240);">
                                 <h3>Resources</h3>
                                    <?php
                                        $cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');    
                                    
                                        $success = array(
					'post_type' => 'saresources', 
                                        'paged' => $paged,
                                        'showposts' => '1',
					'sa_advocacy_targets' => $page_slug,
                                    );
                                     $feat_resource = new WP_Query( $success );
                                     while ( $feat_resource->have_posts() ): $feat_resource->the_post();
                                     //Use the template with the featured image thumbnail.
                                     ?><h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></h2>
                                     <?php 
                                            if ( has_post_thumbnail() ) {
						the_post_thumbnail('feature-front-sub'); 
						}?></a><?php
                                     endwhile
                                         ?><br/><br/>
                                                        <a href="http://dev.communitycommons.org/salud-america/saresourcespage/">See more</a>
                                   <br/><br/>
                                </div>
                                
                                </div>
                                </div>    
                                <?php
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