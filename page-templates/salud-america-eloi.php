<?php
/*
Template Name: Salud America Eloi
*/

get_header(); ?>
<?php get_template_part('page-templates/wrapper-salud-top'); ?>


		<div id="content" role="main">
			<div class="padder">
			<?php if (is_page('sapolicies')) {

				//Do the custom query here, I think
				//echo 'this is that page';
				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				if ( !empty( $page_content ) ) {
					echo '<p class="page-intro">';
					echo $page_content;
					echo '</p>';
				} ?>
				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Policies</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>        
                            
                                
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
                            


                      } elseif (is_page('salud-americaresearch')) { 
				//Start addition Eloi
				//Do the custom query here, I think
				//echo 'this is that page';
				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				
				?>
   				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Research</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Search for Research." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>     
                
				<?php //Now we make our loop
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );              
				endwhile; // end of the loop. 
				?>

                            
                            &nbsp;
                            <h3 style="color: #ef4036;font-size: 1.6rem;">Latest Research Added</h3>

                            <?php
                            wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                                
				$args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'saresources',
                                        'sa_resourcecat'=> 'research',
                                    	'showposts' => '4',
					'paged' => $paged
					
				);
                                
  
				$list_of_policies = new WP_Query( $args );
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content');

					//comments_template( '', true );

                                        endwhile; // end of the loop.
                       
                            
                        
			} elseif (is_page('saresourcespage')) {
				//Do the custom query here, I think
				//echo 'this is that page';
				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				
                        ?>
   				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Resources</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Search for Resources." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>     




<?php
//4 BLOCKS FOR RESOURCES ####################################################                          
    $resource_cats = array(
      'report',
      'toolkit',
      'webinar-2',
      'case-study'
    );
    ?>

    <h3 style="color: #ef4036;font-size: 1.6rem;">Browse Resources by Type</h3>

    <?php
    //We'll loop through the entries of the array to build the queries and display the content
    foreach ($resource_cats as $resource_cat) {

      // The Query

          $args = array(
          // Change these category SLUGS to suit your use.
          'post_type' => 'saresources',
          'sa_resourcecat' => $resource_cat,
          'showposts' => '3',

          );
          
          $resources_results = new WP_Query( $args );

          // The Loop
          if ( $resources_results->have_posts() ) : ?>

          <div class="quarter-block"> 
          <?php $counter = 0;
             while ( $resources_results->have_posts() ) : $resources_results->the_post();
                $counter=$counter+1;
          if( $counter == 1 ) {
?>
                    

          <header class="entry-header">
            <?php //temporary hack! We'll show the images as taxonomy images
              switch ($resource_cat) {
                case 'report':
                  ?>
                  <a href="#" title="Permalink to Calls to Action" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Reports.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'toolkit':
                  ?>
                  <a href="#" title="Permalink to Journal Articles" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Tools.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'webinar-2':
                  ?>
                  <a href="#" title="Permalink to News" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Webinars.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'case-study':
                  ?>
                  <a href="#" title="Permalink to Press releases" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Case_studies.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                default:
                  # code...
                  break;
              }
            ?>                   
          <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
         </header>

                                    
        <div class="entry-content"><?php the_excerpt();?></div> <!-- End .entry-content -->

        <h3>Other Resources</h3>
            <ul class="related-posts">       
          <?php } 
          if ($counter == 2 || $counter == 3) { // output the related posts' titles ?>
            <li>
              <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </li>   
          <?php } ?>
          <?php // Reset Query
           wp_reset_query();
           //$counter++;      
           endwhile; ?>
           </ul>
          </div> <!-- End .quarter-block -->
          <?php  endif; ?>                             
                               
                                   
<?php } // Ends foreach for four top blocks?>


				<?php //Now we make our loop
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					//comments_template( '', true );
				endwhile; // end of the loop. 
				                                
                                ?>
                               
                            &nbsp;
                            <h3 style="color: #ef4036;font-size: 1.6rem;">Latest Resources Added</h3>
				
                               <?php
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					// Change these category SLUGS to suit your use.
					'post_type' => 'saresources',
					'showposts' => '4',
                                        'paged' => $paged
					
				);

				$list_of_policies = new WP_Query( $args ); 
                              
				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content' );
					//comments_template( '', true );
				endwhile; // end of the loop.
			
			}
			
     elseif (is_page('whats-going-on-now')) {

				//Do the custom query here, I think
				//echo 'this is that page';
				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				if ( !empty( $page_content ) ) {
					echo '<p class="page-intro">';
					echo $page_content;
					echo '</p>';
				} ?>
				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for News</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>        
                          
<?php  
//4 BLOCKS FOR WHAT'S GOING ON NOW ####################################################                          
    $resource_cats = array(
      'call-to-action',
      'journal-article',
      'news',
      'press-release'
    );
    ?>

    <h3 style="color: #ef4036;font-size: 1.6rem;">Browse News by Type</h3>

    <?php
    //We'll loop through the entries of the array to build the queries and display the content
    foreach ($resource_cats as $resource_cat) {

      // The Query

          $args = array(
          // Change these category SLUGS to suit your use.
          'post_type' => 'saresources',
          'sa_resourcecat' => $resource_cat,
          'showposts' => '3',

          );
          
          $resources_results = new WP_Query( $args );

          // The Loop
          if ( $resources_results->have_posts() ) : ?>

          <div class="quarter-block"> 
          <?php $counter = 0;
             while ( $resources_results->have_posts() ) : $resources_results->the_post();
                $counter=$counter+1;
          if( $counter == 1 ) {
?>
                    

          <header class="entry-header">
            <?php //temporary hack! We'll show the images as taxonomy images
              switch ($resource_cat) {
                case 'call-to-action':
                  ?>
                  <a href="#" title="Permalink to Calls to Action" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Calls_Action.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'journal-article':
                  ?>
                  <a href="#" title="Permalink to Journal Articles" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Journal_articles.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'news':
                  ?>
                  <a href="#" title="Permalink to News" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/News.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'press-release':
                  ?>
                  <a href="#" title="Permalink to Press releases" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Press_release.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                default:
                  # code...
                  break;
              }
            ?>                   
          <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
         </header>

                                    
        <div class="entry-content"><?php the_excerpt();?></div> <!-- End .entry-content -->

        <h3>Other Resources</h3>
            <ul class="related-posts">       
          <?php } 
          if ($counter == 2 || $counter == 3) { // output the related posts' titles ?>
            <li>
              <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </li>   
          <?php } ?>
          <?php // Reset Query
           wp_reset_query();
           //$counter++;      
           endwhile; ?>
           </ul>
          </div> <!-- End .quarter-block -->
                
          <?php  endif; ?>                             
                               
                                   
<?php } // Ends foreach for four top blocks?>
<h3 style="color: #ef4036;font-size: 1.6rem;">Latest Resources Added</h3>
<?php //Now we make our loop for recent resources
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					// Change these category SLUGS to suit your use.
	                                'post_type' => 'saresources',
                                    	'showposts' => '4',   
	                                'tax_query' => array(
		                                 'relation' => 'OR',
		                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'news' )
		                                  ),
		                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'call-to-action' )
		                                  ),
                                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'journal-article' )
		                                  ),
                                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'press-release' )
		                                  )
	                                 )
				);

				$list_of_policies = new WP_Query( $args ); 
				
				

				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content');
					//comments_template( '', true );
				endwhile; // end of the loop.

			} elseif (is_page('learn-how-to-create-change')) {

				//Do the custom query here, I think
				//echo 'this is that page';
				//First, display the content of the page before making the custom loop.
				$page_content = get_the_content();
				if ( !empty( $page_content ) ) {
					echo '<p class="page-intro">';
					echo $page_content;
					echo '</p>';
				} ?>
				<div class="policy-search">
					<form id="sa-policy-search" class="standard-form" method="get" action="/">
					<h3 style="color: #ef4036;font-size: 1.6rem;">Search for Training</h3>
					<input id="sa-policy-search-text" class="sa-policy-input" type="text" maxlength="150" value="" placeholder="Not a functional search yet." name="sa-policy">
					<input class="sa-policy-search-button" type="submit" value="Search">
					</form>
				</div>        
                            





<?php

//3 BLOCKS FOR LEARNING RESOURCES ####################################################                          
    $resource_cats = array(
      'learning-resource',
      'training',
      'role-model-story',

    );
    ?>

    <h3 style="color: #ef4036;font-size: 1.6rem;">Browse Learning Resources by Type</h3>

    <?php
    //We'll loop through the entries of the array to build the queries and display the content
    foreach ($resource_cats as $resource_cat) {

      // The Query

          $args = array(
          // Change these category SLUGS to suit your use.
          'post_type' => 'saresources',
          'sa_resourcecat' => $resource_cat,
          'showposts' => '3',

          );
          
          $resources_results = new WP_Query( $args );

          // The Loop
          if ( $resources_results->have_posts() ) : ?>

          <div class="third-block"> 
          <?php $counter = 0;
             while ( $resources_results->have_posts() ) : $resources_results->the_post();
                $counter=$counter+1;
          if( $counter == 1 ) {
?>
                    

          <header class="entry-header">
            <?php //temporary hack! We'll show the images as taxonomy images
              switch ($resource_cat) {
                case 'learning-resource':
                  ?>
                  <a href="#" title="Permalink to Calls to Action" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Learning_resources.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'training':
                  ?>
                  <a href="#" title="Permalink to Journal Articles" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Training.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                case 'role-model-story':
                  ?>
                  <a href="#" title="Permalink to News" rel="bookmark" class="frontsecondary"><img width="300" height="200" src="http://dev.communitycommons.org/wp-content/uploads/2013/05/Role_model.jpg" class="attachment-feature-front-sub wp-post-image" alt="Screen Shot 2013-04-09 at 9.54.49 AM"></a>
                  <?php
                  break;
                default:
                  # code...
                  break;
              }
            ?>                   
          <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
         </header>

                                    
        <div class="entry-content"><?php the_excerpt();?></div> <!-- End .entry-content -->

        <h3>Other Resources</h3>
            <ul class="related-posts">       
          <?php } 
          if ($counter == 2 || $counter == 3) { // output the related posts' titles ?>
            <li>
              <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </li>   
          <?php } ?>
          <?php // Reset Query
           wp_reset_query();
           //$counter++;      
           endwhile; ?>
           </ul>
          </div> <!-- End .third-block -->
          <?php  endif; ?>                             
                               
                                   
<?php } // Ends foreach for three top blocks?>
<h3 style="color: #ef4036;font-size: 1.6rem;">Latest Resources Added</h3>







                                
				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$args = array(
					// Change these category SLUGS to suit your use.
	                                'post_type' => 'saresources',
	                                'showposts' => '4',    
                                        'tax_query' => array(
		                                 'relation' => 'OR',
		                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'learning-resource' )
		                                  ),
		                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'role-model-story' )
		                                  ),
                                                  array(
			                                 'taxonomy' => 'sa_resourcecat',
			                                 'field' => 'slug',
			                                 'terms' => array( 'training' )
		                                  )
	                                 )
				);

				$list_of_policies = new WP_Query( $args ); 
				
				

				while ( $list_of_policies->have_posts() ): $list_of_policies->the_post();
					//This template should be the short result
					get_template_part( 'content');
					//comments_template( '', true );
				endwhile; // end of the loop.

                        } elseif (is_child(11911)) {
				//The number above is the id of the parent page, is 11911 on the dev server.
				while ( have_posts() ) : the_post();
				?>

				<?php get_template_part( 'content', 'page' ); ?>

                
                <?php 
                  $page_slug = $post->post_name;

                endwhile; // end of the main page loop. 

                // $parent = $post->post_parent;
                // wp_reset_query(); 
                //echo '$page_slug ' . $page_slug; 
				//echo '$parent ' . $parent;
				?>
				<div>
					<!-- <div class="active-play"><span class="icon"></span></div> -->
					<h2>How is your community doing with respect to this topic area?</h2>
					<div style="width:100%;height:200px;background-color:#CCC;margin-bottom:24px;">form/charts go here</div>
				</div>
				<?php //Now we make our loop
				wp_reset_postdata();
			  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			  	switch ($page_slug) { //TODO: move to custom taxonomy, not these deals.
			  		case 'sa-better-food-in-neighborhoods':
			  			$sa_target_area = 'sa-better-food-in-neighborhoods';
			  			break;
			  		case 'sa-active-spaces':
			  			$sa_target_area = 'sa-active-spaces';
			  			break;
			  		case 'sa-healthier-school-snacks':
			  			$sa_target_area = 'sa-healthier-school-snacks';
			  			break;
			  		case 'sa-sugary-drinks':
			  			$sa_target_area = 'sa-sugary-drinks';
			  			break;
			  		case 'sa-healthier-marketing':
			  			$sa_target_area = 'sa-healthier-marketing';
			  			break;
			  		case 'sa-active-play':
			  			$sa_target_area = 'sa-active-play';
			  			break;
			  		default:
			  			$sa_target_area = 'sa_at1';
			  			break;
			  	}

				$args = array(
					'post_type' => 'sapolicies', 
					'paged' => $paged,
					'sa_advocacy_targets' => $sa_target_area,
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

			}                       
                        else {

				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page-notitle' );
					comments_template( '', true );
				endwhile; // end of the loop. 

			}?>



            
<!--End addition Eloi-->  


		</div><!-- .padder -->

		</div><!-- #content -->
    
<?php get_template_part('page-templates/wrapper-salud-bottom'); ?>
<?php get_footer(); ?>

        


        


