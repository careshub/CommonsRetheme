<?php
ini_set('max_execution_time', 53000); 
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
                <?php
                         sa_updatelatlong();
                
			 while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); 

function sa_updatelatlong() {
    $type = 'sapolicies';
    $args=array(
      'post_type' => $type,
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'caller_get_posts'=> 1
        );


        $my_query = new WP_Query($args);
        if( $my_query->have_posts() ) {
          while ($my_query->have_posts()) : $my_query->the_post(); 
            
            $finalgeog = get_post_meta(get_the_ID(), 'sa_finalgeog', true);  
            $st = get_post_meta(get_the_ID(), 'sa_state', true);
            $geog = get_post_meta(get_the_ID(), 'sa_geog', true);
            
			if (isset($finalgeog)) {
				if ($geog != "National") {
				$geogstr = $finalgeog . " " . $st;
				} 
				else
				{
				$geogstr = $finalgeog;
				}

				if(strlen($geogstr)>3) {   
				   $loc = $geogstr;  
				   $loc2 = str_replace(" ","%20",$loc);
				   $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $loc2 . '&sensor=false');
				   $output = json_decode($geocode);
				   $lt = $output->results[0]->geometry->location->lat;
				   $lg = $output->results[0]->geometry->location->lng; 

					add_post_meta(get_the_ID(), 'sa_latitude', $lt);
					add_post_meta(get_the_ID(), 'sa_longitude', $lg);    
					
					echo $lt . "/" . $lg . "<br>";
											
				} else {
					echo "n/a<br>";
				}
			}
            
            //echo "finished with " . the_ID() . "<br>";
          endwhile;
        }
        wp_reset_query();  // Restore global post data stomped by the_post().

	
}