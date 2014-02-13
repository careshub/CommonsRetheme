<?php
ini_set('max_execution_time', 53000); 

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 
      echo '<pre>';

				// add_root_term_first();
        // add_states();
        // add_states_subcats();
        
        // Then go through each of these
        // add_geo_terms( 'counties', 1, false );
        // add_geo_terms( 'cities', 1, false );
        // add_geo_terms( 'cities', 2, true );
        // add_geo_terms( 'cities', 3, true );
        // add_geo_terms( 'cities', 4, true );
        // add_geo_terms( 'schooldistricts', 1, true );
        // add_geo_terms( 'schooldistricts', 2, true );
        // add_geo_terms( 'uscongressionaldistricts', 1, false );
        // add_geo_terms( 'statehousedistricts', 1, false );
        // add_geo_terms( 'statesenatedistricts', 1, false );

        // Then, stop and import the policies and whatnot.

        // Finally, link the policies to the correct term
        // link_policies_to_geographies( true, 1 );


      echo '</pre>';

            while ( have_posts() ) : the_post(); ?>
				<?php 
              
          // get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); 

function link_policies_to_geographies( $run_for_real = false, $page = 1 ){
  global $wpdb;

  $args = array(
          'post_type' => 'sapolicies',
          'post_status' => 'any',
          'showposts' => '100',
          'paged' => $page
        );
  $policies = get_posts( $args );

  foreach($policies as $post) : setup_postdata($post);
                    
    echo PHP_EOL . 'post ID: ';
    print_r ($post->ID);

    //Get the geoid postmeta associated with this post
    $geoids = get_post_meta( $post->ID, 'geoid_temp');
    
    if ( !empty($geoids) ) {

      foreach ($geoids as $geoid) {
        echo PHP_EOL;
        print_r($geoid);
        $term_id = $wpdb->get_var( $wpdb->prepare( "SELECT term_id from $wpdb->term_taxonomy WHERE description = %s AND taxonomy = 'geographies'", $geoid ) );
        $term_id = (int) $term_id;

        echo PHP_EOL . 'Term ID:' . $term_id . PHP_EOL;
        // var_dump($term_id);

        if ( $run_for_real ) {
          // Set the term
          $set_terms = wp_set_object_terms( $post->ID, $term_id, 'geographies', true );
          print_r($set_terms);
        }
        
        // $geo_term = get_term_by('id', $term_id, 'geographies');
        // if ($geo_term) {

        //   print_r($geo_term->description);
        // } else {
        //   echo "No matching taxonomy term found." . PHP_EOL;
        // }
      }

    } //END if empty Geoid

    // $terms = get_the_terms( $post->ID, 'geographies' );
    // if ( $terms ) {
    //   print_r($terms);
    // }
    // foreach ($terms as $term) {
    //   echo PHP_EOL;

    //   $descrip = $term->description;
    //   if ( in_array($descrip, $geoids)  ) {
    //     echo 'already got it ';
    //     print_r($descrip);
    //   } else {
    //     echo 'adding the geoid ';
    //     print_r($descrip);

    //     add_post_meta( $post->ID, 'geoid_temp', $descrip, true );

    //   }
      
    // }
    echo PHP_EOL;

  endforeach;

}

function add_root_term_first() {
	wp_insert_term( 'United States', 'geographies', array( 'description' => '01000US' ) );
	echo "States created in geographies!";
}

function add_states() {
    //This is state by state
    $state_list = build_state_list();

    // Set state's parent id for creating states terms.
    $root_term = get_term_by('slug', 'united-states', 'geographies'); 
    print_r($root_term);
    // var_dump($state_list);
    
    foreach ( $state_list as $state_name => $geoid ) {
      //FIRST add the states
      $state_slug = $state_name . '-state';
      $args = array(
          'slug' => $state_slug,
          'parent'=> $root_term->term_id,
          'description' => $geoid
        );

      // print_r($args);

      $new_term = wp_insert_term(
          $state_name, // the term 
          'geographies', // the taxonomy
          $args
        );     
      
      echo "Added " . $state_name . PHP_EOL;
      print_r( $new_term );
      echo PHP_EOL;
       
    }   
    
}

function add_states_subcats() {
    //This is state by state
    $state_list = build_state_list();
       
    foreach ( $state_list as $state_name => $geoid ) {

      echo "Adding sub-categories for: " . $state_name . PHP_EOL;
      
      //SECOND Add the sub cat containers for counties, etc, under each state
      $stateterm = get_term_by( 'name', $state_name, 'geographies' );
      print_r($stateterm);
      echo PHP_EOL;
  
      // WP cleans up the slug to remove spaces and capitalization
      $subcats = array(
          'Counties' => 'counties-',
          'Cities' => 'cities-',
          'School Districts' => 'schooldistricts-',
          'US Congressional Districts' => 'uscongressionaldistricts-',
          'State House Districts' => 'statehousedistricts-',
          'State Senate Districts' => 'statesenatedistricts-',
        ); 

      foreach ( $subcats as $geo_range => $slug_prefix ) {

        $new_term = wp_insert_term(
          $geo_range, // the term 
          'geographies', // the taxonomy
          array(
            'slug' => $slug_prefix . $state_name,
            'parent'=> $stateterm->term_id,
            'description' => $slug_prefix . $state_name
          )
        );

        // echo $geo_range . ': ' . $slug_prefix . $state_name;
        print_r( $new_term );
        echo PHP_EOL;

      }
        
    }   
    
}

function add_geo_terms( $type, $iteration, $run_for_real = false ) {  
    //This whole thing is type-based!
    //Select XML file based on type of geography and iteration
    switch ($type) {
          case 'counties':
            $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/cnties.xml' );
            break;
          case 'cities':
            switch ($iteration) {
              case 1:
                $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/places_1.xml');
                break;
              case 2:
                $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/places_2.xml');
                break;
              case 3:
                $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/places_3.xml');
                break;
              case 4:
                $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/places_4.xml');
                break;
            }
            break;
          case 'schooldistricts':
            if ( $iteration == 1 ) {
              $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/sd-1.xml');
            } else if ( $iteration == 2 ) {
              $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/sd-2.xml');
            }
            break;
          case 'uscongressionaldistricts':
            $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/cd.xml');
            break;
          case 'statehousedistricts':
            $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/sth.xml');
            break;
          case 'statesenatedistricts':
            $xmlref = file_get_contents( get_stylesheet_directory_uri() . '/includes/create-geogs/sts.xml');
            break;
          default:
            # code...
            break;
        }
        $xmlfile = new SimpleXMLElement($xmlref);

    $parent_slug_prefix = $type . "-";
    $last_time_around = null;
      
    foreach( $xmlfile->Row as $row ){
      //Only reset the parent term info if necessary
      if ( (string) $row->State != $last_time_around ) {
        $parent_slug = $parent_slug_prefix . $row->State;
        $parent_term = get_term_by('slug', $parent_slug, 'geographies');
        echo "NEW PARENT!" . PHP_EOL;
        print_r($parent_term);
      }
      $last_time_around = $row->State;

      // Don't set a term if we can't find a parent
      if ( $parent_term ) {
        $new_term_slug = $row->Name . '-' . $row->State ;   
        echo PHP_EOL . $new_term_slug . PHP_EOL;         
       
         if ( $run_for_real ) {
            $new_term = wp_insert_term(
              $row->Name, // the term 
              'geographies', // the taxonomy
              array(
                      'slug' => $new_term_slug,
                      'parent'=> $parent_term->term_id,
                      'description' => $row->GeoID
              )
           );
          print_r($new_term);
          }
      } else {
        echo 'no parent for this term:' . $row->Name . ' ' . $row->State;
      }
      echo PHP_EOL;
    }  
}

function build_state_list() {
  $state_list = array(
      'Alabama' =>  '04000US01',
      'Alaska'  =>  '04000US02',
      'American Samoa'  =>  '04000US60',
      'Arizona' =>  '04000US04',
      'Arkansas'  =>  '04000US05',
      'California'  =>  '04000US06',
      'Colorado'  =>  '04000US08',
      'Commonwealth of the Northern Mariana Islands'  =>  '04000US69',
      'Connecticut' =>  '04000US09',
      'Delaware'  =>  '04000US10',
      'District of Columbia'  =>  '04000US11',
      'Florida' =>  '04000US12',
      'Georgia' =>  '04000US13',
      'Guam'  =>  '04000US66',
      'Hawaii'  =>  '04000US15',
      'Idaho' =>  '04000US16',
      'Illinois'  =>  '04000US17',
      'Indiana' =>  '04000US18',
      'Iowa'  =>  '04000US19',
      'Kansas'  =>  '04000US20',
      'Kentucky'  =>  '04000US21',
      'Louisiana' =>  '04000US22',
      'Maine' =>  '04000US23',
      'Maryland'  =>  '04000US24',
      'Massachusetts' =>  '04000US25',
      'Michigan'  =>  '04000US26',
      'Minnesota' =>  '04000US27',
      'Mississippi' =>  '04000US28',
      'Missouri'  =>  '04000US29',
      'Montana' =>  '04000US30',
      'Nebraska'  =>  '04000US31',
      'Nevada'  =>  '04000US32',
      'New Hampshire' =>  '04000US33',
      'New Jersey'  =>  '04000US34',
      'New Mexico'  =>  '04000US35',
      'New York'  =>  '04000US36',
      'North Carolina'  =>  '04000US37',
      'North Dakota'  =>  '04000US38',
      'Ohio'  =>  '04000US39',
      'Oklahoma'  =>  '04000US40',
      'Oregon'  =>  '04000US41',
      'Pennsylvania'  =>  '04000US42',
      'Puerto Rico' =>  '04000PR72',
      'Rhode Island'  =>  '04000US44',
      'South Carolina'  =>  '04000US45',
      'South Dakota'  =>  '04000US46',
      'Tennessee' =>  '04000US47',
      'Texas' =>  '04000US48',
      'United States Virgin Islands'  =>  '04000US78',
      'Utah'  =>  '04000US49',
      'Vermont' =>  '04000US50',
      'Virginia'  =>  '04000US51',
      'Washington'  =>  '04000US53',
      'West Virginia' =>  '04000US54',
      'Wisconsin' =>  '04000US55',
      'Wyoming' =>  '04000US56'
    );
 return $state_list;
}
