<?php
define('WP_USE_THEMES', false);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');

$finalgeog = $_POST['finalgeog'];
$geog = $_POST['geog'];
$st = $_POST['state'];

if ($geog == "City"){
    $myterm = get_term_by('slug', $finalgeog . "-" . $st, 'geographies');
} else {
    $myterm = get_term_by('name', $finalgeog, 'geographies');
}

$termdesc = term_description( $myterm->term_id, 'geographies' );

			if (strlen($termdesc)>5){
				$pos = strpos($termdesc, ",");
				if ($pos === false){
					
				} else {
					$parts = explode(",", $termdesc);                               
					$lat1 = (float) trim(str_replace("<p>", "", $parts[0]));
					$long1 = (float) trim($parts[1]);
					$lat2 = (float) trim($parts[2]);
					$long2 = (float) trim(str_replace("</p>", "", $parts[3]));
                                        $avglat=($lat1+$lat2)/2;
                                        $avglong=($long1+$long2)/2;
                                        printf('<input type="hidden" id="sa_latitude" name="sa_latitude" value="' . $avglat . '" /><input type="hidden" id="sa_longitude" name="sa_longitude" value="' . $avglong . '" />');
					
				}
			} 

//        if(strlen($finalgeog)>3) {      
//                $loc = $finalgeog;  
//                $loc2 = str_replace(" ","%20",$loc);
//                $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $loc2 . '&sensor=false');
//                $output = json_decode($geocode);
//                $lat = $output->results[0]->geometry->location->lat;
//                $long = $output->results[0]->geometry->location->lng; 
//                printf('<input type="hidden" id="sa_latitude" name="sa_latitude" value="' . $lat . '" /><input type="hidden" id="sa_longitude" name="sa_longitude" value="' . $long . '" />');
//
//                
//            }