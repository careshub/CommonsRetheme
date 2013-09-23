<?php
/*
Template Name: Salud America
*/
get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>

		<div id="content" role="main">
			<div class="padder">
			<?php if (is_page('salud-america')) { ?>

			<?php if ( function_exists('sa_slider') ) { 
						// sa_slider('main-page-slider'); 
					} ?>
			<div class="entry-content">

				<h2 class="screamer sagreen" style="font-size:1.4em">Want to make a healthy change in your area?</h2>

				<p><img src="http://dev.communitycommons.org/wp-content/uploads/2013/09/family-biking-cropped.jpg" class="alignright" width="373px"></p>

				<p class="intro-text" style="font-size:1.2em;">Welcome to Growing Healthy Change, where you can learn what's going on to make Latino communities healthier and how you can help.</p>
 
				<p>Here you will be able to find changes happening across the country (from opening playgrounds after school to helping corner stores offer fresh produce or marketing healthier products), learn about others’ success stories and our resources for change, and even share the work you’re doing in your community.</p>
				 
				<p>Let’s get started!</p>

				<div class="find-changes">
					<h3 class="screamer saorange">1. Find Changes</h3>

						<div style="margin-bottom:1.6em; margin-left:3%;">
							<h4 style="margin-top:0;">By Keyword</h4>
							<form name="sa_ps" enctype="multipart/form-data" method="POST" action="">
								<div class="row">
							        <input type="text" value="" placeholder="Enter search terms here" name="saps" id="saps" style="width:65%;">
									<input type="submit" value="Search" alt="Search" id="searchsubmit">
							    </div>
							</form>
						</div>

					<div class="row">

						<div class="half-block">
							<h4 style="margin-top:0;">By Topic</h4>
							<?php 
							$advocacy_targets = get_terms('sa_advocacy_targets');
							foreach ($advocacy_targets as $target) {
								?>
								<div class="column1of3 mini-text"><a href="<?php the_intersection_link( 'sapolicies', 'sa_advocacy_targets', $target->slug ) ?>"><span class="<?php echo $target->slug; ?>x90"></span><br /><?php echo $target->name; ?></a></div>						
							<?php } //end foreach ?>
							
						</div>

						<div class="half-block">
							<h4 style="margin-top:0;">By Location</h4>
							<a href="http://dev.communitycommons.org/salud-america/sapolicies/"><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Salud_Location_Map.png' alt='Map of Changes'class="no-box"></a>
			                <a href='http://dev.communitycommons.org/salud-america/sapolicies/'>Browse changes happening in your area</a>
						</div>
					</div>
					<h4 style="margin-left:3%;">Recent Changes</h4>
					<div class="row">
						<?php
						//Grab the 3 most recent success stories
							$args = array (
									'post_type' => 'sapolicies',
									'posts_per_page' => 3,
									// 'tax_query' => array(
									// 	array(
									// 		'taxonomy' => 'sa_resource_cat',
									// 		'field' => 'slug',
									// 		'terms' => array( 'success-stories' ),
									// 	)
									// )
								);
							//Grab the possible advocacy targets
							$advocacy_targets = get_terms('sa_advocacy_targets');
							foreach ($advocacy_targets as $target) {
								$possible_targets[] = $target->slug;
							}
							$ssquery = new WP_Query( $args );
							while ( $ssquery->have_posts() ) {
							// print_r($possible_targets);

								$ssquery->the_post();
								global $post;
								setup_postdata( $post );

								// echo '<li class="third-block"><h5>' . $target->name . '</h5>';
								echo '<div class="third-block">';
								?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

									<?php 
									if ( has_post_thumbnail()) { 
										//Use the post thumbnail if it exists
										the_post_thumbnail('feature-front-sub'); 
										echo '<br />';
									} else {
										//Otherwise, use some stand-in images by advocacy target
										$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
										if ( !empty ($terms) ) :
											//loop through the terms to find a usable (unique) image
											foreach ($terms as $term) {
												if ( in_array( $term->slug, $possible_targets ) ) {
													$advo_target = $term->slug;
													break;
												}
											}
											//If an advo_target didn't get set, we'll set one at random
											if ( !( $advo_target ) ) {
												$advo_target = current($possible_targets);
												// $advo_target = next_targe;
												// print_r(current($possible_targets));
											}

											// echo PHP_EOL . $advo_target;

											//Delete that value from the possible values
												$key_to_delete = array_search($advo_target, $possible_targets);
												if ( false !== $key_to_delete ) {
												    unset( $possible_targets[$key_to_delete] );
												}
											
										endif; //check for empty terms

										echo '<img src="' . get_stylesheet_directory_uri() . '/img/salud_america/advocacy_targets/' . $advo_target . 'x300.jpg" > ';
										unset($advo_target);
									}

									echo '<h5 class="entry-title">' . get_the_title() . '</h5></a>';
									the_excerpt();
									?>
								</div>
								 <?php
							}
							wp_reset_postdata();
							?>
					</div> <!-- .row -->
				</div> <!-- find-changes -->

				<!-- <h3 class="screamer sablue">2. Learn from Success Stories</h3> -->
				<!-- <div class="learn-from-success-stories">
					
				</div> -->

				<h3 class="screamer sapurple">2. Learn to Create Change</h3>
				<div class="row clear">
					<h4 style="margin-top:0;margin-left:3%;">Learn from Success Stories</h4>

					<?php
					//Grab the 3 most recent success stories
						$args = array (
								'post_type' => 'sa_success_story',
								'posts_per_page' => 3,
							);
						$ssquery = new WP_Query( $args );
						while ( $ssquery->have_posts() ) {
							
							$ssquery->the_post();
							global $post;
							setup_postdata( $post );
							// echo '<li class="third-block"><h5>' . $target->name . '</h5>';
							echo '<div class="third-block">';
							?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

								<?php 
								if ( has_post_thumbnail()) { 
									the_post_thumbnail('feature-front-sub'); 
									echo '<br />';
									} 

								the_title();
								?>
								</a>
							</div>
							 <?php
						}
						wp_reset_postdata();
						?>
					</div>  <!-- end .row -->

				<div class="row">
					<div class="half-block" style="margin-top:0;">
						<h4 style="margin-top:0;">What's Change?</h4>
	                    <img src='http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/WhatsChange_icon.png' alt='Active Play' class="no-box" style="width:30%; float:left; margin-right:5%;">
	                    <ul>
		                    <li><a href='http://dev.communitycommons.org/salud-america/what-is-change/'>Change at a glance</a></li>
		                    <li><a href='http://dev.communitycommons.org/salud-america/what-is-change/the-science-behind-change/'>The science behind change</a></li>
	                    </ul>
					</div>

					<div class="half-block" style="margin-top:0;">
						<h4 style="margin-top:0;">Learn to Make Changes</h4>
	                    <img src='http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Resoucesmakechange_icon.png' alt='Active Play' class="no-box" style="width:30%; float:left; margin-right:5%;">
	                    <p>Use research, toolkits, and other elements to<a href='http://dev.communitycommons.org/salud-america/saresourcespage/'> learn about healthy change</a></p>
					</div>
				</div>
				
				<h3 class="screamer sablue">3. Share Your Change</h3>

				<div class="row">
					<div class="half-block" style="margin-top:0;">
						<h4 style="margin-top:0;">Be a "Change" Star</h4>
	                    <img src='http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/BeaStar_icon.png' alt='Share Your Change' style="width:30%; float:left; margin-right:5%;" class="no-box">
	                    <p>Are you making a change? <br />Already made a successful change?<br /><a href='http://dev.communitycommons.org/salud-america/share-your-own-stories/'>Share your story with us</a> - we can write it up and upload it here!</p>
					</div>

					<div class="half-block" style="margin-top:0;">
			
	                    <iframe width="450" height="180" src="//www.youtube.com/embed/8I4T08MONBA?rel=0;showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>
	                         	</div>
				</div>
			</div>

			<?php }  elseif (is_page('salud-old')) { ?>

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
                        
                                            <div style="width:170px;" class="third-block">
                                                <table>    
                                                    <tr><td><h4 style='float:left; text-align: center;'> Find Changes!</h4></td>
                                                    <td><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Orange_arrow.png' style='width:50px; height:500px; float:right;' alt='Find Changes'> </td></tr>
                                                </table>
                                                <table>
                                                    <tr><td><h4 style='float:left; text-align: center;'> Learn to Make Changes!</h4></td>
                                                    <td><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Purple_arrow.png' style='width:50px; height:150px; float:right;' alt='Find Changes'> </td></tr>                                                
                                                </table>
                                                <table>    
                                                    <tr><td><h4 style='float:left; text-align: center;'> Share Your Changes!</h4></td>
                                                    <td><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Green_arrow.png' style='width:50px; height:150px; float:right;' alt='Find Changes'> </td></tr>
                                                </table>                                                     
                                                </table>
                                            </div>    
                                            <div style="padding-left:10px" class="third-block"><h4 style='text-align:center'>By Topic</h4>
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
                                                <hr>
                                                <table><h4 style="text-align: center; padding-top:0px;">What's Change?</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/WhatsChange_icon.png' style='width:60px; height: 60px; ' alt='Active Play'></td>
                                                    <td style='float:left;'><a href='http://dev.communitycommons.org/salud-america/what-is-change/'>Change at a glance</a></br></br></br><a href='http://dev.communitycommons.org/salud-america/what-is-change/the-science-behind-change/'>The science behind change</a></td>    
                                                </table>
                                                <hr>
                                                <table><h4 style="text-align: center; padding-top: 0px;">Add a Change</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/AddChange_icon.png' style='width:60px; height: 60px; ' alt='Active Play'></td>
                                                    <td style='float:left;'>Making a change?</br>We missed a change?</br></br><a href='http://dev.communitycommons.org/salud-america/share-your-own-stories/'>Add the details here</a></td>    
                                                </table>
                                            </div>
                                            <div style="float:right;" class="third-block"><h4 style='text-align:center'>By Location</h4>
                                               <table>
                                                    <tr align='center'><a href="http://dev.communitycommons.org/salud-america/sapolicies/"><img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Salud_Location_Map.png' style='width:100%; height: 100%; padding-left:20px;' alt='Map of Changes'></a></tr> 
                                                    <tr><td style="text-align: center; padding-left:20px; padding-top:20px;"><a href='http://dev.communitycommons.org/salud-america/sapolicies/'>Browse changes happening in your area right now</a></td></tr>
                                                    <tr><td style="text-align: center; padding-left:20px; padding-top:20px;"><a href='http://dev.communitycommons.org/salud-america/sapolicies/'>Discover change across the country</a></td></tr>

                                                    <tr><td style="text-align: center; padding-left:20px;"><h4>By Keyword</h4></td></tr>
                                                    <tr><td style=" padding-left:20px;"><?php sa_searchpolicies_single(); ?></td></tr>
                                               </table>
                                                <hr>
                                               <table><h4 style="text-align: center; padding-top:0px;">Learn to Make Changes</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/Resoucesmakechange_icon.png' style='width:60px; height: 60px; ' alt='Active Play'></td>
                                                    <td style='float:left;'>Use research, toolkits, and other elements to<a href='http://dev.communitycommons.org/salud-america/saresourcespage/'> learn about healthy change</a></td>
                                               </table> 
                                                <hr>
                                               <table><h4 style="text-align: center; padding-top: 0px; ">Be a Star!</h4>
                                                    <tr><td><img align='center' src='/wp-content/themes/CommonsRetheme/img/salud_america/Salud_Platform_WebReady_files/BeaStar_icon.png' style='width:60px; height: 60px; ' alt='Active Play'></td>
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

                             if ( function_exists('sa_location_search') ) {sa_location_search();} ?>
                                        
                                <div class="policy-search">
  					<!--<form id="sa-policy-search" class="standard-form" method="get" action="/search-results">-->
  					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Changes by Keyword</h3>
                                        <?php if ( function_exists('sa_searchpolicies') ) { sa_searchpolicies('search-results'); } ?>
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
							<a href="<?php the_intersection_link( 'sapolicies', 'sa_advocacy_targets', $cat_slug ) ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<p><?php echo $section_description; ?></p>
						</div>

						<?php } // End advocacy target loop ?>

				</div><?php
			}  elseif (is_page('sa-policy-map-search')) {
				sa_location_search();
			
			}  elseif (is_child(150)) {

				//This section is being replaced by the taxonomy pages. See archive-sapolicies-sa_advocacy_targets.php.
                           
				//The number above is the id of the parent page, is 11911 on the dev server.
				//It's 150 on DC's local install
				 
                            if ( function_exists('SA_topics') ) {
                            	SA_topics();} 
                            	?>
                                        	-                            
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

                                global $post;
                                $page_slug = get_post( $post )->post_name;

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
                                <div style="background-color:rgb(240,240,240);border-width: 3px; border-style: solid;border-color: lightgrey;">
                                <h3 style='text-align:center; padding-top:0px'>Start a Change</h3>
                                <div style="padding-left:15px"><a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/">Add a change</a> in your area!<br/><br/><a href="http://dev.communitycommons.org/salud-america/share-your-own-stories/"></div>
                                    <img class=" wp-image-12449 aligncenter" alt="Health" src="http://dev.communitycommons.org/wp-content/uploads/2013/08/images.jpg" width="120" height="120" /></a>
                                <br/>
                                </div> 
                                  <br/>    
                                <div style="background-color:rgb(240,240,240);border-width: 3px; border-style: solid;border-color: lightgrey;">
                                <h3 style='text-align:center; padding-top:0px'>Success Story</h3>
                                <div style="padding-left:15px;padding-right:5px">
                                    <?php
                                        $cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');    
                                    
                                        $success = array(
					'post_type' => 'saresources', 
					'sa_resource_cat' => 'success-stories',
                                        'paged' => $paged,
                                        'showposts' => '1',
					'sa_advocacy_targets' => $page_slug,
                                         );
                                        
                                        
                                     $feat_success = new WP_Query( $success );
                                     while ( $feat_success->have_posts() ): $feat_success->the_post();
                                     $success[] = $post->ID;
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
                                </div>
                                    <br/>
                                <div style="background-color:rgb(240,240,240);border-width: 3px; border-style: solid;border-color: lightgrey;">
                                 <h3 style='text-align:center; padding-top:0px'>Resources</h3>
                                 <div style="padding-left:15px;padding-right:5px">
                                    <?php
                                        $cat_object = get_term_by('slug', $cat_slug, 'sa_advocacy_targets');    
                                    
                                        $resources = array(
					'post_type' => 'saresources', 
                                        'post__not_in' => $success,
                                        'paged' => $paged,
                                        'showposts' => '1',
					'sa_advocacy_targets' => $page_slug,
                                    );
                                     $feat_resource = new WP_Query( $resources );
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