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

       if(strlen($geogstr)>3) {      
               $loc = $geogstr;  
               $loc2 = str_replace(" ","%20",$loc);
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
               
               
           }