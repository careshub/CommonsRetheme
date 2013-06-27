<?php

define('WP_USE_THEMES', false);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$finalgeog = $_POST['finalgeog'];
$geog = $_POST['geog'];
$st = $_POST['state'];

if ($geog != "National") {
$geogstr = $finalgeog . " " . $st;
} 
else
{
$geogstr = $finalgeog;
}


// if ($geog == "City") {
    // $myterm = get_term_by('slug', $finalgeog . "-" . $st, 'geographies');
// } else {
    // $myterm = get_term_by('name', $finalgeog, 'geographies');
// }

//$termdesc = term_description( $myterm->term_id, 'geographies' );

			// if (strlen($termdesc)>5){
				// $pos = strpos($termdesc, ",");
				// if ($pos === false){
					
				// } else {
					// $parts = explode(",", $termdesc);                               
					// $lat1 = (float) trim(str_replace("<p>", "", $parts[0]));
					// $long1 = (float) trim($parts[1]);
					// $lat2 = (float) trim($parts[2]);
					// $long2 = (float) trim(str_replace("</p>", "", $parts[3]));
                    // $avglat=($lat1+$lat2)/2;
                    // $avglong=($long1+$long2)/2;
                    //printf('<input id="sa_latitude" name="sa_latitude" value="' . $avglat . '" /><input id="sa_longitude" name="sa_longitude" value="' . $avglong . '" />');
					// $coordinates = array( 
						// 'latitude' => $avglat,
						// 'longitude' => $avglong
						// );
					// printf( json_encode($coordinates) );
				// }
			// } 

       if(strlen($geogstr)>3) {      
               $loc = $geogstr;  
               $loc2 = rawurlencode($loc);
               $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $loc2 . '&sensor=false');
               $output = json_decode($geocode);
               $lt = $output->results[0]->geometry->location->lat;
               $lg = $output->results[0]->geometry->location->lng;
				$nelat = $output->results[0]->geometry->viewport->northeast->lat;
				$nelng = $output->results[0]->geometry->viewport->northeast->lng;
				$swlat = $output->results[0]->geometry->viewport->southwest->lat;
				$swlng = $output->results[0]->geometry->viewport->southwest->lng;
					$coordinates = array( 
						'latitude' => $lt,
						'longitude' => $lg,
						'nelat' => $nelat,
						'nelng' => $nelng,
						'swlat' => $swlat,
						'swlng' => $swlng
						);
					printf( json_encode($coordinates) );			   
               //printf('<input type="hidden" id="sa_latitude" name="sa_latitude" value="' . $lt . '" /><input type="hidden" id="sa_longitude" name="sa_longitude" value="' . $lg . '" />');

               
           }