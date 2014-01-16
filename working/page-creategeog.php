<?php
ini_set('max_execution_time', 53000); 

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 
                        
                        //add_geographies();         
                        sa_updatetaxons();
                        
                        
                        while ( have_posts() ) : the_post(); ?>
				<?php 
                             
                                
                                get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); 

function add_geographies() {
  
    $state_list = array(
                'AL'=>"Alabama",
                'AK'=>"Alaska",
                'AZ'=>"Arizona",
                'AR'=>"Arkansas", 
                'CA'=>"California", 
                'CO'=>"Colorado", 
                'CT'=>"Connecticut", 
                'DE'=>"Delaware", 
                'DC'=>"District Of Columbia", 
                'FL'=>"Florida", 
                'GA'=>"Georgia", 
                'HI'=>"Hawaii", 
                'ID'=>"Idaho", 
                'IL'=>"Illinois", 
                'IN'=>"Indiana", 
                'IA'=>"Iowa", 
                'KS'=>"Kansas", 
                'KY'=>"Kentucky", 
                'LA'=>"Louisiana", 
                'ME'=>"Maine", 
                'MD'=>"Maryland", 
                'MA'=>"Massachusetts",
                'MI'=>"Michigan", 
                'MN'=>"Minnesota", 
                'MS'=>"Mississippi", 
                'MO'=>"Missouri", 
                'MT'=>"Montana",
                'NE'=>"Nebraska",
                'NV'=>"Nevada",
                'NH'=>"New Hampshire",
                'NJ'=>"New Jersey",
                'NM'=>"New Mexico",
                'NY'=>"New York",
                'NC'=>"North Carolina",
                'ND'=>"North Dakota",
                'OH'=>"Ohio", 
                'OK'=>"Oklahoma", 
                'OR'=>"Oregon", 
                'PA'=>"Pennsylvania", 
                'RI'=>"Rhode Island", 
                'SC'=>"South Carolina", 
                'SD'=>"South Dakota",
                'TN'=>"Tennessee", 
                'TX'=>"Texas", 
                'UT'=>"Utah", 
                'VT'=>"Vermont", 
                'VA'=>"Virginia", 
                'WA'=>"Washington", 
                'WV'=>"West Virginia", 
                'WI'=>"Wisconsin", 
                'WY'=>"Wyoming");
    
    
    $xmlref = file_get_contents('http://localhost/wordpress/wp-content/themes/twentytwelve/includes/countyxml.xml');
    $xmlcnty =  new SimpleXMLElement($xmlref) ;
    file_put_contents(dirname(__FILE__)."/includes/countyoutput.xml", $xmlcnty->asXML());
   
//    $xmlref2 = file_get_contents('http://localhost/wordpress/wp-content/themes/twentytwelve/includes/cityxml.xml');
//    $xmlcity =  new SimpleXMLElement($xmlref2) ;
//    file_put_contents(dirname(__FILE__)."/includes/cityoutput.xml", $xmlcity->asXML());
//    
//    $xmlref3 = file_get_contents('http://localhost/wordpress/wp-content/themes/twentytwelve/includes/sdxml.xml');
//    $xmlsd =  new SimpleXMLElement($xmlref3) ;
//    file_put_contents(dirname(__FILE__)."/includes/sdoutput.xml", $xmlsd->asXML());    
//    
//    $xmlref4 = file_get_contents('http://localhost/wordpress/wp-content/themes/twentytwelve/includes/uscong.xml');
//    $xmluscong =  new SimpleXMLElement($xmlref4) ;
//    file_put_contents(dirname(__FILE__)."/includes/uscongoutput.xml", $xmluscong->asXML());  
//    
//    $xmlref5 = file_get_contents('http://localhost/wordpress/wp-content/themes/twentytwelve/includes/sthxml.xml');
//    $xmlsth =  new SimpleXMLElement($xmlref5) ;
//    file_put_contents(dirname(__FILE__)."/includes/sthoutput.xml", $xmlsth->asXML()); 
//    
//    $xmlref6 = file_get_contents('http://localhost/wordpress/wp-content/themes/twentytwelve/includes/stsxml.xml');
//    $xmlsts =  new SimpleXMLElement($xmlref6) ;
//    file_put_contents(dirname(__FILE__)."/includes/stsoutput.xml", $xmlsts->asXML());     
    
    //wp_insert_term('zxcvbn2', 'geographies');
    
    
    
    foreach ($state_list as $stname) {
        $term = get_term_by('slug', 'states', 'geographies'); 
        $parent_term_id = $term->term_id; // get numeric term id

        //add_states($stname, $parent_term_id);
                
        $st1 = strtolower($stname);
        $st2 = str_replace(' ','-',$st1);
        
        $stateterm = get_term_by('slug', $st2, 'geographies');
        $parent_stateterm_id = $stateterm->term_id;
        $pti = $parent_stateterm_id;
        
        //add_subcats($pti, $st2);   
        
        //add_counties($xmlcnty, $stname);
 
        //add_cities($xmlcity, $stname);
        
        //add_sd($xmlsd, $stname);
        
        //add_uscong($xmluscong, $stname);

        //add_sth($xmlsth, $stname);
    
        //add_sts($xmlsts, $stname);
    }   
    
}




function add_sts($xmlsts, $stname) {
 
   foreach($xmlsts->dataTable as $row){   

      if ($row->FirstStName == "{$stname}")
         {
              $varsts = str_replace(' ', '-', $row->FirstNAMELSAD) . '-' . $stname ;   
              $varnew = strtolower($varsts);              
             
              
              $coords = $row->MinY.",".$row->MinX.",".$row->MaxY.",".$row->MaxX;
              
              
             $stsslug="statesenatedistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $stsslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->FirstNAMELSAD, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $coords
            )
         );
        }
       }  
}

function add_sth($xmlsth, $stname) {
 
   foreach($xmlsth->dataTable as $row){   

      if ($row->FirstStName == "{$stname}")
         {
              $varsth = str_replace(' ', '-', $row->FirstNAMELSAD) . '-' . $stname ;   
              $varnew = strtolower($varsth);              
             
              
              $coords = $row->MinY.",".$row->MinX.",".$row->MaxY.",".$row->MaxX;
              
              
             $sthslug="statehousedistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $sthslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->FirstNAMELSAD, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $coords
            )
         );
        }
       }  
}

function add_uscong($xmluscong, $stname) {
 
   foreach($xmluscong->dataTable as $row){   

      if ($row->FirstStName == "{$stname}")
         {
              $varuscong = str_replace(' ', '-', $row->FirstNAMELSAD) . '-' . $stname ;   
              $varnew = strtolower($varuscong);              
             
              
              $coords = $row->MinY.",".$row->MinX.",".$row->MaxY.",".$row->MaxX;
              
              
             $uscongslug="uscongressionaldistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $uscongslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->FirstNAMELSAD, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $coords
            )
         );
        }
       }  
}

function add_sd($xmlsd, $stname) {
 
   foreach($xmlsd->dataTable as $row){   

      if ($row->FirstSTNAME == "{$stname}")
         {
              $varsd = str_replace(' ', '-', $row->FirstNAME) . '-' . $stname ;   
              $varnew = strtolower($varsd);              
             
              
              $coords = $row->MinY.",".$row->MinX.",".$row->MaxY.",".$row->MaxX;
              
              
             $sdslug="schooldistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $sdslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->FirstNAME, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $coords
            )
         );
        }
       }  
}

function add_cities($xmlcity, $stname) {
 
   foreach($xmlcity->Row as $row){   

      if ($row->STATENAME == "{$stname}")
         {
              $varcity = str_replace(' ', '-', $row->NAME) . '-' . $stname ;   
              $varnew = strtolower($varcity);              
             
              
              $coords = $row->MINLAT.",".$row->MINLON.",".$row->MAXLAT.",".$row->MAXLON;
              
              
             $cityslug="cities-" . strtolower($stname);
                           
             $term = get_term_by('slug', $cityslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
  
//             $termchildren = get_term_children($parent_term_id, 'geographies');
//            foreach ($termchildren as $child) {
//                   $cterm = get_term_by( 'id', $child, 'geographies' );
//                   wp_update_term(
//                   $cterm->term_id, 'geographies', 
//                   array(
//                       'description' => $coords
//
//                   )
//                   );   
//                   echo $cterm->slug . " updated<br>";
//                   
//           }            
             


             
             
            wp_insert_term(
            $row->NAME, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $coords
            )
         );
        }
       }  


  
}



function add_counties($xmlcnty, $stname) {  
    
   foreach($xmlcnty->Row as $row){   

      if ($row->STATENAME == "{$stname}")
         {
              $varcounty = str_replace(' ', '-', $row->NAME) . '-' . $stname ;   
              $varnew = strtolower($varcounty);              
              echo $varnew."<br>";
              
              $coords = $row->minLat.",".$row->minLon.",".$row->maxLat.",".$row->maxLon;
              
              
             $cntyslug="counties-" . strtolower($stname);
                           
             $term = get_term_by('slug', $cntyslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
  
            wp_insert_term(
            $row->NAME, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $coords
            )
         );
        }
       }  

    //******CODE TO REMOVE COUNTIES FROM TAXONOMY**************        
    //        $cslug="counties-" . strtolower($stname);
    //        $myterm = get_term_by('slug', $cslug, 'geographies'); 
    //       
    //        $cntychildren=get_term_children($myterm->term_id, 'geographies');
    //
    //        foreach ($cntychildren as $kiddo) {
    //            $term2 = get_term_by( 'id', $kiddo, 'geographies' );
    //            echo $term2->term_id."<br>";
    //            wp_delete_term($term2->term_id, 'geographies');
    //        }
    //**********************************************************
}

function add_states($stname, $parent_term_id) {

        wp_insert_term(
          $stname, // the term 
          'geographies', // the taxonomy
          array(        
            'slug' => $stname,
            'parent'=> $parent_term_id
          )
        );     
}


function add_subcats($pti, $st2) {


    
wp_insert_term(
  'Counties', // the term 
  'geographies', // the taxonomy
  array(

    'slug' => 'counties-' . $st2,
    'parent'=> $pti
  )
);
//
wp_insert_term(
  'Cities', // the term 
  'geographies', // the taxonomy
  array(

    'slug' => 'cities-' . $st2,
    'parent'=> $pti
  )
);

wp_insert_term(
  'School Districts', // the term 
  'geographies', // the taxonomy
  array(

    'slug' => 'schooldistricts-' . $st2,
    'parent'=> $pti
  )
);

wp_insert_term(
  'US Congressional Districts', // the term 
  'geographies', // the taxonomy
  array(

    'slug' => 'uscongressionaldistricts-' . $st2,
    'parent'=> $pti
  )
);
// State House Districts
wp_insert_term(
  'State House Districts', // the term 
  'geographies', // the taxonomy
  array(

    'slug' => 'statehousedistricts-' . $st2,
    'parent'=> $pti
  )
);
wp_insert_term(
  'State Senate Districts', // the term 
  'geographies', // the taxonomy
  array(

    'slug' => 'statesenatedistricts-' . $st2,
    'parent'=> $pti
  )
);

   
    
}

function sa_updatetaxons() {
	// $terms = get_terms( 'geographies', $args );
	// $args = array(
	// slug=>'wyoming'
	// );
    // foreach ( $terms as $term ) {
      // echo $term->name . " - " . $term->id;
        
    // }
	
	?>

	
	
<?php

}
?>