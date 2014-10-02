<?php
/**
* Template Name: Salud America Eloi
*/

get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>


		<div id="content" role="main">
			<div class="padder entry-content">
<?php 
if (is_page('salud-americaresearch')) { 
				?>
   				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3>Search for Research</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Search for Research." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>     
                
				<?php //Display the page content before making the custom loop
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );              
				endwhile; // end of the loop. 
				?>
          <h3>Latest Research Added</h3>
          <?php
          wp_reset_postdata();

			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          
          $args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'saresources',
          'sa_resource_cat'=> 'research',
        	'showposts' => '4',
					'paged' => $paged
				);
                                
				$list_of_policies = new WP_Query( $args );
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content', 'saresources-short');

					//comments_template( '', true );
        endwhile; // end of the loop.              
                        
} elseif (is_page('saresourcespage')) {
	//Moved this functionality to resources archive page
  /****** 
  echo '<div class="entry-content">
        <h3 class="screamer sablue">Want to find resources to help make change in your area?</h2>';

         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
   				<div class="policy-search">
  					<!--<form id="sa-policy-search" class="standard-form" method="post" action="/">-->
<h3 class="screamer sayellow">Search for Resources by Keyword</h3>
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
        $resource_cats = array(
                            'report',
                            'toolkit',
                            'webinar-2'
                          );
        ?>

        <div class="row">
          <h3 class="screamer sagreen">Browse Resources by Type</h3>
          <?php saresources_get_featured_blocks($resource_cats);?>
        </div>

        <!-- Begin secondary loop for most recently added resources -->
        <div class="row taxonomy-policies">
          <h3 class="screamer sapink">Latest Resources Added</h3>
          <?php saresources_get_related_resources($resource_cats);?>
        </div>
      </div> <!-- end .entry-content -->
			<?php
			*/
} elseif (is_page('getting-started')) {

            if ( function_exists('SA_getting_started') ) { SA_getting_started(); }    


} elseif (is_page('tweetchat')) {
?>

          <div>
				<h3 class="screamer sablue">Join new weekly #SaludTues Tweetchats!</h2>
	
				<h4>What is the #SaludTues Tweetchat?</h4>
				 
                <img width="425" height="352" class="alignright" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/saludtues2.jpg" alt="Photo of a clock showing the words Time for Change"/>
                <p>#SaludTues is a weekly Tweetchat about Latino health at 12p CST/1p EDT every Tuesday. The chat is directed and co-hosted by @SaludToday, the Latino health social media campaign and Twitter handle for the team at the Institute for Health Promotion Research (IHPR) at The UT Health Science Center at San Antonio, which directs Salud America!. Each chat has two co-hosts from partner organizations to ask and answer topical questions.</p>

                <h4 style="clear:left;">#SaludTues Tweetchat Schedule</h4>
                <ul class="no-bullets">
	                <li><strong>10/7/14</strong>&emsp;#SaludTues "Latinas and Breast Cancer: Surviving and Thriving"</li>

	                <li><strong>10/14/14</strong>&emsp;#SaludTues "Latinos and HIV/AIDS: Problems + Solutions"</li>

	                <li><strong>10/21/14</strong>&emsp;#SaludTues "Healthier Recipes for Latino Foods"</li>
                </ul>


                <p><strong>How do I participate in a #SaludTues Tweetchat?</strong><br />
				Anyone with a Twitter handle is welcome to join the chat. Just tag your Tweets with the hashtag #SaludTues to join and follow the conversation on Twitter.</p>

                <p><strong>How do I serve as a #SaludTues co-host?</strong><br />
				Email us at <a href="mailto:saludamerica@uthscsa.edu" title="saludamerica@uthscsa.edu">saludamerica@uthscsa.edu</a> and share an idea for a chat.</p>

                <p><strong>What are topics for #SaludTues Tweetchats?</strong><br />
				Any Latino health issue can be a topic for the SaludTues chat, from heart health, childhood obesity, nutrition and physical activity, access to health care, trending demographics, education, culture of health, etc.</p>

                <h4 style="clear:left;">#SaludTues Past Tweetchats</h4>
                <ul class="no-bullets">
	                <li><strong>9/16/14</strong>&emsp;#SaludTues "How to Create a Culture of Health for Latino Families", <a href="https://twitter.com/SaludToday" title="@SaludToday">@SaludToday</a>, <a href="https://twitter.com/AHA_Vida" title="@AHA_Vida">@AHA_Vida</a> and <a href="https://twitter.com/RWJF_Live" title="@RWJF_Live">@RWJF_Live</a></li>
	                <li><strong>9/23/14</strong>&emsp;#SaludTues "School's In: How to Promote Healthy Food for Latino Kids"</li>
	                <li><strong>9/30/14</strong>&emsp;#SaludTues "Why and How to Start a Garden in a Latino School/Community"</li>
		        </ul>    

            </div>
 <?php   
} elseif (is_page('take-action-list')) {
?>

          <div>
				<h3 class="screamer sablue">Join new weekly #SaludTues Tweetchats!</h2>
	

                                    <img width="425" height="352" class="alignright" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/saludtues2.jpg" alt="Photo of a clock showing the words Time for Change"/>

                                    
				<p><strong>What is the #SaludTues Tweetchat?</strong></p>
				 
				<p>#SaludTues is a weekly Tweetchat about Latino health at 12p CST/1p EDT every Tuesday. The chat is directed and co-hosted by @SaludToday, the Latino health social media 
                                campaign and Twitter handle for the team at the Institute for Health Promotion Research (IHPR) at The UT Health Science Center at San Antonio, which directs Salud America!. 
                                Each chat has two co-hosts from partner organizations to ask and answer topical questions.</p>
                                <a href="<?php echo home_url( 'salud-america/tweetchat' ); ?>" class="button">Learn more</a>

          </div>

          <div>
				<h3 class="screamer sagreen">We Need Your Help to Get Sugary Drinks Out of Summer Camps!</h2>
	
				
                                    <img width="425" height="352" class="alignright" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/KidsExploringWeb.jpg" alt="Photo of a clock showing the words Time for Change"/>
                                
                                    
				<p>Summer is here, and that means camp for kids to make new friends and try new things -but it also potentially means being exposed to unhealthy sugary drinks.</p>
				 
				<p>Will your child's camp give them healthy drinks, or sugary drinks, like "bug juice"?</p>
                                
                                <p>The American Camp Association (ACA), the country's leading camp resource and accreditation group, requires camps to take many steps to ensure the safety and well-being of young people. They also offer suggestions on how camps can help kids be active and eat healthy foods.</p>
                
                                <p>But ACA does NOT require camps to have a healthy beverage policy to gain accreditation.</p>
                                
                                <p>That means, for the more than 2,400 ACA-accredited camps nationwide, none are required to refrain from serving campers sugary sodas, juices, or flavored milk.</p>
                                
                                <p>Research shows Latino kids already consume more sugary drinks on average than their peers, so they have more to lose when camps recruit Latino families and then provide unhealthy sugary drinks during this critical out-of-school season. </p>

                                <p>Tell the ACA they should take our children's health seriously and add a "no sugary drinks" rule to their camp accreditation standards.</p>
                                
                                <p>We don't want kids guzzling sugar this summer -we want them to be healthy and happy!</p>

                                <a href="http://www.thepetitionsite.com/takeaction/702/787/135/?z00m=21258369" class="button" target="_blank" title="Take Action Now!">Take Action Now!</a>
            </div>


<?php       
} 




 

// elseif (is_page('saresources-report')) {
// 		echo "<h3 class='screamer sayellow'>Report Resources</h3>";
// 		if ( function_exists('saresources_by_cat') ) { saresources_by_cat('report');	
// 				} {
//                                 get_template_part( 'content', 'saresources-short' );
//                                 comments_template( '', true );}

//                 }
// elseif (is_page('saresources-toolkit')) {
// 		echo "<h3 class='screamer sagreen'>Toolkit Resources</h3>";
// 		if ( function_exists('saresources_by_cat') ) { saresources_by_cat('toolkit'); } 


// }
// elseif (is_page('saresources-webinar')) {
// 		echo "<h3 class='screamer sapurple'>Webinar Resources</h3>";
// 		if ( function_exists('saresources_by_cat') ) { saresources_by_cat('webinar-2'); } 


// }
elseif ( is_page('whats-new') ) {
  
    
    ?>
      <p class="intro-text" style="font-size:1.2em;padding-top:10px">More than 39 percent of Latino children ages 2-19 are overweight or obese.</p> 
                                    
      <p class="intro-text" style="font-size:1.2em; padding-bottom:10px">Here are the latest trends on the obesity epidemic—and the efforts going on across the nation to reduce and prevent obesity among Latino children.</p>
      
<div>
<h3 class="screamer sagreen">Latest Success Stories</h3>
<div class="row clear">
					

					<?php
					//Grab the 3 most recent success stories
						$args = array (
								'post_type' => 'sa_success_story',
								'posts_per_page' => 6,
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

									echo '<h5 class="entry-title">' . get_the_title() . '</h5></a>';
									the_excerpt();
									?>
								</a>
							</div>
							 <?php
						}
						wp_reset_postdata();
						?>
</div>        
      
<h3 class="screamer sapurple">Recent Changes</h3>

					<div class="row">
						<?php
						//Grab the 3 most recent success stories
							$args = array (
									'post_type' => 'sapolicies',
									'posts_per_page' => 6,
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
									?></div><?php
                                                                            							}
							wp_reset_postdata();
							?>
								
                                                              
	<?php
                                                       
} elseif (is_page('learn-to-make-change')) {

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
				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Learning Tools</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>
        <?php

    //3 BLOCKS FOR LEARNING RESOURCES ####################################################                          
        $resource_cats = array(
          'report, research, journal-article',
          'how-to-resource, toolkit, training, webinar-2, learning-resource, recommendations',
          'get-involved',
        );
        ?>

    <h3>Browse Learning Tools by Type</h3>
    <?php saresources_get_featured_blocks($resource_cats) ?>
 
    <h3>Latest Resources Added</h3>                      
		<?php saresources_get_related_resources($resource_cats);

                
} elseif ( is_page('success-stories-intro') ) {                
	//Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
    <div class="browse-topics">

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
							$resource = array(
                                                            // Change these category SLUGS to suit your use.
                                                             'post_type' => 'saresources',
                                                             'sa_resource_cat'=> 'success-stories',
                                                             'showposts' => '1',
                                                             'sa_advocacy_targets' => $cat_slug,
                                                             'paged' => $paged
                                                );
                                                        $list_of_stories = new WP_Query( $resource );
							?>
						<div class="half-block salud-topic <?php echo $cat_slug; ?>">
							<a href="/salud-america/success-stories/success-stories-topics?tag=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<?php while ( $list_of_stories->have_posts() ): $list_of_stories->the_post();
                                                        //Use the template with the featured image thumbnail.
                                                        get_template_part( 'content', 'saresources-mini'); ?>
                                                        <br />
                                                        <a href="/salud-america/success-stories/success-stories-topics?tag=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">See more</a>
                                                    <?php
                                                        //comments_template( '', true );
                                                        endwhile; // end of the loop. 
                                                        ?>
						</div>

						<?php } // End advocacy target loop ?>

				</div>                
                
<?php
} elseif ( is_page('success-stories-topics') ) {

$tag = $_GET['tag'];

$term = get_term_by ('slug', $tag, 'sa_advocacy_targets');

$stories =  get_objects_in_term ($term ->term_id, 'sa_advocacy_targets');


		$filter_args = array(
					 'post_type' => 'saresources',
                                         'sa_resource_cat'=> 'success-stories',
					 'post__in' => $stories,
);
                    $query2 = new WP_Query($filter_args);
		    if($query2->have_posts()) : 
			  while($query2->have_posts()) : 
					$query2->the_post();
					get_template_part( 'content', 'saresources-short' ); 

			  endwhile;
		   else: 
			  echo "No Results - Search criteria too specific";	
		   endif;					
                    




} elseif ( is_page('what-is-change') ) {   
        echo '<div class="entry-content">
        <h3 class="screamer sablue">What is Change?</h2>';

         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('no-border'); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post -->            
			<?php // comments_template( '', true );              
          endwhile; // end of the loop.     
?>      
    
        <div class="science-of-change">
          <h3 class="screamer sagreen">Why Change?</h3>
           <p>More than 39% of Latino kids are overweight or obese, a higher rate than all kids (32%).<br /></p>
            <p>There are many reasons, including that Latino kids lack of afterschool physical activity options, have less access to local play facilities, have less access to healthy foods in schools and neighborhoods, are exposed to unhealthy marketing, and consume more sugary drinks than their non-Latino peers.<br /></p>
            <p>This situation puts Latino kids at higher risk of developing obesity-related diseases, such as diabetes.<br /></p>
            <p>Change is greatly needed because Latino children comprise 22 percent of all U.S. youth and represent the largest, fastest-growing minority group in the nation.<br /></p>
           
         </div>   
       </div>
    
      <div class="examples-of-change">
		<h3 class="screamer sapurple">Examples of change</h3>
        <p>Here are a few examples of how people are changing their communities.</p>					  
        
        <?php 
	  	$tag_list = array(
	  		'Active Play' => array( 'Recess', 'PE', 'After School Programs', 'Safe Routes to School', 'Brain Breaks'  ),
	  		'Active Spaces' => array( 'Parks','Shared Use','Playgrounds', 'Complete Streets', 'Sidewalks' ),
	  		'Better Food in Neighborhoods' => array( 'Corner Stores', 'Farmers\' Markets', 'Community Gardens' ),
	  		'Healthier Marketing' => array( 'Healthy Ad Campaigns', 'Unhealthy Ad Campaigns', 'Digital Advertising', 'TV Advertising', 'Neighborhood Advertising' ),
	  		'Healthier School Snacks' => array( 'Healthy Lunches', 'Fundraising', 'School Wellness Policies' ),
	  		'Sugary Drinks' => array( 'Sugar-Sweetened Beverages', 'Soda Tax', 'Water' )
	  		);

		$i = 1;

	  	foreach ($tag_list as $advo_target => $tags) {
	  		
	  		//Start the row on i=1 and i=4
	  		if ( $i%3 == 1 )
	  			echo '<div class="row clear">';

	  		$advo_clean = sanitize_title( $advo_target );
	  		?>

	  		<div class="third-block">
              <h4 class="clear"><span class="sa-<?php echo $advo_clean; ?>x60"></span><?php echo $advo_target; ?></h4>
              <ul class="no-bullets clear">
              	<?php //Loop through the tags.
              	foreach ($tags as $tag_candidate) {
              		//Need to search for the correct term
			  		$tag = get_term_by( 'name', $tag_candidate, 'sa_policy_tags' );
			  		if ( $tag ) {
              		?>
	              		<li><a href="<?php cc_the_cpt_tax_intersection_link( 'sapolicies', 'sa_policy_tags', $tag->slug ); ?>" title="Link to <?php echo $tag->name; ?> topic archive"><?php echo $tag->name; ?></a></li>
              		<?php
	              	} // End check for $tag match
              	}
              	?>
              </ul>
            </div>

	  		<?php
	  		//End the row on i=3 and i=6
	  		if ( $i%3 == 0 )
	  			echo '</div> <!-- end .row -->';

	  		$i++;

	  	} // END foreach ($tag_list as $advo_target => $tags)

	  	?>
	  	</div> <!-- end .examples-of-change -->
                       
        <div class="science-of-change">
          <h3 class="screamer saorange">The Science Behind Change</h3>
           <img class="alignleft" src="<?php echo get_stylesheet_directory_uri(); ?>/img/salud_america/time-for-change.jpg" alt="Photo of a clock showing the words Time for Change"/>
           <p>How far along is change in a community?<br />
            Where might you step in to make a contribution?<br />
            The answers can be found in the Salud America! <a href="/salud-america/what-is-change/the-science-behind-change/" clear="">Policy Contribution Spectra</a>.
           </p> 
         </div>                              

<?php 
} elseif ( is_page('browse-change') ) {
// Moved this functionality to the policies archive page - DC

// $tag = $_GET['tag'];

// $term = get_term_by ('slug', $tag, 'sa_policy_tags');

// $policies =  get_objects_in_term ($term ->term_id, 'sa_policy_tags');


// 		$filter_args = array(
// 					 'post_type' => 'sapolicies',
// 					 'post__in' => $policies,
// );
//                     $query2 = new WP_Query($filter_args);
// 		    if($query2->have_posts()) : 
// 			  while($query2->have_posts()) : 
// 					$query2->the_post();
// 					get_template_part( 'content', 'sa-policy-short' ); 

// 			  endwhile;
// 		   else: 
// 			  echo "No Results - Search criteria too specific";	
// 		   endif;					
                    



          
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

        


        


