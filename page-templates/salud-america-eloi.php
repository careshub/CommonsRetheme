<?php
/*
Template Name: Salud America Eloi
*/

get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>


		<div id="content" role="main">
			<div class="padder">
<?php 
if (is_page('salud-americaresearch')) { 
				?>
   				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Research</h3>
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
         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop. 
          ?>
   				<div class="policy-search">
  					<form id="sa-policy-search" class="standard-form" method="get" action="/">
  					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Resources</h3>
                                        <?php if ( function_exists('sa_searchpolicies') ) { sa_searchpolicies(); } ?>
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

        <h3>Browse Resources by Type</h3>
        <?php saresources_get_featured_blocks($resource_cats);

        //Begin secondary loop for most recently added resources ?>
        <h3>Latest Resources Added</h3>
        <?php saresources_get_related_resources($resource_cats);
			
} elseif (is_page('getting-started')) {

            if ( function_exists('SA_getting_started') ) { SA_getting_started(); }        
} 

elseif ( is_page('whats-new') ) {

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
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for News</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>        
                          
        <?php  
        //4 BLOCKS FOR WHAT'S GOING ON NOW
        // Specify the saresourcecat slugs we want to show here
        // If specifying more than one category, make them a comma-separated list                       
            $resource_cats = array(
              'news, press-release',
              'op-ed',
              'research, report, policy-brief' 
            );
            ?>

      <h3>Browse News by Type</h3>
      <?php saresources_get_featured_blocks($resource_cats); ?>

      <h3>Latest Resources Added</h3>
      <?php saresources_get_related_resources($resource_cats);		

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

                
} elseif ( is_page('success-stories') ) {                
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
                                                        $list_of_policies = new WP_Query( $resource );
							?>
						<div class="half-block salud-topic <?php echo $cat_slug; ?>">
							<a href="/salud-america/success-stories-topics/?topic=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">
								<span class="<?php echo $cat_slug; ?>x60"></span>
								<h4><?php echo $section_title; ?></h4>
							</a>
							<?php while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
                                                        //Use the template with the featured image thumbnail.
                                                        get_template_part( 'content', 'saresources-mini'); ?>
                                                        <br />
                                                        <a href="/salud-america/success-stories-topics/?topic=<?php echo $cat_slug; ?>" class="<?php echo $cat_slug; ?>  clear">See more</a>
                                                    <?php
                                                        //comments_template( '', true );
                                                        endwhile; // end of the loop. 
                                                        ?>
						</div>

						<?php } // End advocacy target loop ?>

				</div>                
                
<?php                

} elseif ( is_page('what-is-change') ) {   

         //Display the page content before making the custom loop
          while ( have_posts() ) : the_post();
            get_template_part( 'content', 'page-notitle' );
            // comments_template( '', true );              
          endwhile; // end of the loop.     
?>
				<div class="half-block"><h3>Examples of change</h3>
					  
                                                    <div>
							<table>
                                                        <tr><td style="vertical-align:top;"><a href="/salud-america/sapolicies/sa-active-play" >
								<img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/more-active-play-time_x90.jpg' width="70" height="70" alt='Active Play'></span></a></td>
							    <td><table><p style="color: #fdb813;"><strong> Active Play</strong></p>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=recess">Recess</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=pe">P.E.</td></a>
                                                        </tr>                                                            
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=after-school-program">After School Programs</td></a>
                                                        </tr>                                                       
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=safe-routes-to-school">Safe Routes to Schools</td></a>
                                                        </tr>                                                                                                                     
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=brain-breaks">Brain Breaks</td></a>
                                                        </tr>   </td>                                                                
                                                                                                    
                                                       </table>
                                                       <tr><td></tr></td>
                                                        <tr><td style="vertical-align:top;"><a href="/salud-america/sapolicies/sa-active-spaces" >
								<img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/Places-for-activity_x90.jpg' width="70" height="70" alt='Active Spaces'></span></a></td>
							    <td><table><p style="color: #0088d0;"><strong> Active Spaces</strong></a></p>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=parks">Parks</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=shared-use">Shared Use</td></a>
                                                        </tr>                                                            
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=joint-use">Joint Use</td></a>
                                                        </tr>                                                       
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=playgrounds">Playgrounds</td></a>
                                                        </tr>                                                                                                                     
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=complete-streets">Complete Streets</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=sidewalks">Sidewalks</td></a>
                                                        </tr>    </td>                                                                                                       
                                                       
                                                        </table>
                                                       <tr><td></tr></td>
                                                        <tr><td style="vertical-align:top;"><a href="/salud-america/sapolicies/sa-better-food-in-neighborhoods" >
								<img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/better-food-in-neighborhoods_x90.jpg' width="70" height="70" alt='Better Food in Neighborhoods'></span></a></td>
							    <td><table><p style="color: #f6801e;"><strong>Better Food in Neighborhoods</strong></a></p>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=corner-stores">Corner Stores</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=farmers-market">Farmer's Markets</td></a>
                                                        </tr>                                                            
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=community-gardens-3">Community Gardens</td></a>
                                                        </tr>                                                       
                                                        </td>                                                                                                       
                                                       </table>
                                                       <tr><td></tr></td> 
                                                       <tr><td style="vertical-align:top;"<a href="/salud-america/sapolicies/sa-healthier-marketing" >
								<img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/stop-unhealthy-advertising_happy_x90.jpg' width="70" height="70" alt='Healthier Marketing'></span></a></td>
							    <td><table><p style="color: #eb008b;"><strong>Healthier Marketing</strong></a></p>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=healthy-ad-campaign">Healthy Ad Campaigns</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=unhealthy-ad-campaign">Unhealthy Ad Campaigns</td></a>
                                                        </tr>                                                            
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=digital-advertising">Digital Advertising</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=tv-advertising">TV Advertising</td></a>
                                                        </tr> 
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=neighborhood-advertising">Neighborhood Advertising</td></a>
                                                        </tr> 
                                                        </td>                                                                                                       
                                                       </table>   
                                                       <tr><td></tr></td>         
                                                       <tr><td style="vertical-align:top;"><a href="/salud-america/sapolicies/sa-healthier-school-snacks" >
								<img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/better-food-in-schools_x90.jpg' width="70" height="70" alt='Healthier School Snacks'></span></a></td>
							    <td><table><p style="color: #73bf45;"><strong>Healthier School Snacks</strong></a></p>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=healthy-lunches">Healthy Lunches</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=fundraising">Fundraising</td></a>
                                                        </tr>                                                            
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=school-wellness-policies">School Wellness Policies</td></a>
                                                        </tr>
                                                        </td>                                                                                                       
                                                       </table>           
                                                       <tr><td></tr></td>
                                                       <tr><td style="vertical-align:top;"><a href="/salud-america/sapolicies/sa-sugary-drinks" >
								<img src='http://dev.communitycommons.org/wp-content/uploads/2013/08/price-of-sugar_x90.jpg' width="70" height="70" alt='Sugary Drinks'></span></a></td>
							    <td><table><p style="color: #92278f;"><strong>Sugary Drinks</strong></a></p>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=sugar-sweetened-beverages">Sugar-Sweetened Beverages</td></a>
                                                        </tr>
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=soda-tax">Soda Tax</td></a>
                                                        </tr>                                                            
                                                        <tr>
                                                           <td><a href="/salud-america/what-is-change/browse-change?tag=water">Water</td></a>
                                                        </tr>
                                                        </td>                                                                                                       
                                                       </table>   
                                                                
                                                                
                                                        </table>
                                                    </div>

				</div>
                                <div class="half-block"><h3>The science behind change</h3>
                                    <img class="aligncenter" src="/wp-content/uploads/2013/08/time-for-change.jpg" width="350" height="150" />
                                    <p><br>How far along is change in a community?</br></br></br> Where might you step in to make a contribution?<br><br><br>
                                        The answers can be found in the Salud America! Policy Contribution        Spectra.
                                        <br><br>
                                          <a href="/salud-america/what-is-change/the-science-behind-change/" clear">View more</a>
                                    </p>    
                                    </div>

              
<?php 
} elseif ( is_page('browse-change') ) {
$tag = $_GET['tag'];

$term = get_term_by ('slug', $tag, 'sa_policy_tags');

$policies =  get_objects_in_term ($term ->term_id, 'sa_policy_tags');


		$filter_args = array(
					 'post_type' => 'sapolicies',
					 'post__in' => $policies,
);
                    $query2 = new WP_Query($filter_args);
		    if($query2->have_posts()) : 
			  while($query2->have_posts()) : 
					$query2->the_post();
					get_template_part( 'content', 'sa-policy-short' ); 

			  endwhile;
		   else: 
			  echo "No Results - Search criteria too specific";	
		   endif;					
                    



          
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

        


        


