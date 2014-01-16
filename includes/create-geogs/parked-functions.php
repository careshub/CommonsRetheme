<?php 
function add_sts($xmlsts, $stname) {
 
   foreach($xmlsts->Row as $row){   

      if ($row->State == $stname)
         {
              $varsts = str_replace(' ', '-', $row->Name) . '-' . $stname ;   
              $varnew = strtolower($varsts);              
             
              
              $geoid = $row->GeoID;
              
              
             $stsslug="statesenatedistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $stsslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->Name, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $geoid
            )
         );
		 echo "Added " . $row->Name . ", " . $stname . "<br />";
		 
        }
       }  
}
function add_sth($xmlsth, $stname) {
 
   foreach($xmlsth->Row as $row){   

      if ($row->State == $stname)
         {
              $varsth = str_replace(' ', '-', $row->Name) . '-' . $stname ;   
              $varnew = strtolower($varsth);              
             
              
              $geoid = $row->GeoID;
              
              
             $sthslug="statehousedistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $sthslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->Name, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $geoid
            )
         );
		 echo "Added " . $row->Name . ", " . $stname . "<br />";
		 
        }
       }  
}
function add_uscong($xmluscong, $stname) {
 
   foreach($xmluscong->Row as $row){   

      if ($row->State == $stname)
         {
              $varuscong = str_replace(' ', '-', $row->Name) . '-' . $stname ;   
              $varnew = strtolower($varuscong);              
             
              
              $geoid = $row->GeoID;
              
              
             $uscongslug="uscongressionaldistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $uscongslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->Name, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $geoid
            )
         );
		 echo "Added " . $row->Name . ", " . $stname . "<br />";
		 
        }
       }  
}
function add_sd($xmlsd, $stname) {
 
   foreach($xmlsd->Row as $row){   


        $thisST = $row->State;

       
       
      if ($thisST == $stname)
         {
              $varsd = str_replace(' ', '-', $row->Name) . '-' . $stname ;   
              $varnew = strtolower($varsd);              
             
              
              $geoid = $row->GeoID;
              
              
             $sdslug="schooldistricts-" . strtolower($stname);
                           
             $term = get_term_by('slug', $sdslug, 'geographies'); 
             $parent_term_id = $term->term_id; // get numeric term id
       
            wp_insert_term(
            $row->Name, // the term 
            'geographies', // the taxonomy
            array(
                    'slug' =>$varnew,
                    'parent'=> $parent_term_id,
                    'description' => $geoid
            )
         );
		 
		 echo "Added " . $row->Name . ", " . $stname . "<br />";
		 
        }
       }  
}

// function add_cities($xmlcity, $stname) {
 
//    foreach($xmlcity->Row as $row){   

//       if ($row->State == $stname)
//          {
//               $varcity = $row->Name . '-' . $stname ;   
//               echo $varcity;

//              $cityslug="cities-" . $stname;
                           
//              $term = get_term_by('slug', $cityslug, 'geographies'); 
//              $parent_term_id = $term->term_id; // get numeric term id
//              print_r($term);
  
// //             $termchildren = get_term_children($parent_term_id, 'geographies');
// //            foreach ($termchildren as $child) {
// //                   $cterm = get_term_by( 'id', $child, 'geographies' );
// //                   wp_update_term(
// //                   $cterm->term_id, 'geographies', 
// //                   array(
// //                       'description' => $coords
// //
// //                   )
// //                   );   
// //                   echo $cterm->slug . " updated<br>";
// //                   
// //           }            
             
//          //    $new_term = wp_insert_term(
//          //    $row->Name, // the term 
//          //    'geographies', // the taxonomy
//          //    array(
//          //            'slug' =>$varcity,
//          //            'parent'=> $parent_term_id,
//          //            'description' => $row->GeoID
//          //    )
//          // );

//              print_r($new_term);
//             echo PHP_EOL;
		 
// 		 // echo "Added " . $row->Name . ", " . $stname . "<br />";
//         }
//        }  


  
// }



// function add_counties($xmlcnty, $stname) {  
    
//    foreach($xmlcnty->Row as $row){   
// //echo $row->State . " - " . $stname . "<br />";
//       if ($row->State == $stname)
//          {
//               $varcounty = $row->Name . '-' . $stname ;   
//               echo $varcounty . PHP_EOL;         
              
//              $cntyslug="counties-" . $stname;
                           
//              $term = get_term_by('slug', $cntyslug, 'geographies'); 
//              $parent_term_id = $term->term_id; // get numeric term id
//              // print_r($term);
  
//               $new_term = wp_insert_term(
//                 $row->Name, // the term 
//                 'geographies', // the taxonomy
//                 array(
//                         'slug' =>$varcounty,
//                         'parent'=> $parent_term_id,
//                         'description' => $row->GeoID
//                 )
//              );
//     		    print_r($new_term);
//             echo PHP_EOL;
// 		 // echo "Added " . $row->Name . ", " . $stname . "<br />";
//         }
//         }  

//     //******CODE TO REMOVE COUNTIES FROM TAXONOMY**************        
//     //        $cslug="counties-" . strtolower($stname);
//     //        $myterm = get_term_by('slug', $cslug, 'geographies'); 
//     //       
//     //        $cntychildren=get_term_children($myterm->term_id, 'geographies');
//     //
//     //        foreach ($cntychildren as $kiddo) {
//     //            $term2 = get_term_by( 'id', $kiddo, 'geographies' );
//     //            echo $term2->term_id."<br>";
//     //            wp_delete_term($term2->term_id, 'geographies');
//     //        }
//     //**********************************************************
// }