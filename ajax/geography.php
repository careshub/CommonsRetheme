<?php

define('WP_USE_THEMES', false);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$selstate = $_POST['selstate'];
$geog = $_POST['geog'];
$geogstr = "";

 if ($geog === 'County') {     
     $geogstr="counties-";
 }
 
if ($geog === 'City') {     
     $geogstr="cities-";
 }
 
if ($geog === 'School District') {     
    $geogstr="schooldistricts-";
}
 
if ($geog === 'US Congressional District') {     
    $geogstr="uscongressionaldistricts-";
 }
 
if ($geog === 'State House District') {     
    $geogstr="statehousedistricts-";
 }
 
if ($geog === 'State Senate District') {     
    $geogstr="statesenatedistricts-";
 }



if($selstate)
{
    if ($geog) {     
        $thisid = $geogstr . $selstate;
        $geoterm = get_term_by('slug', $thisid, 'geographies'); 
        $tid = $geoterm->term_id;
            $args = array(
                    'parent' => $tid,
                    'hide_empty' => 0,
            );
            $terms = get_terms( 'geographies', $args );
            if ( $terms ) {                    
                    foreach ( $terms as $term ) {
                            printf( '<option value="' . $term->name . '">' . $term->name . '</option>' );
                    }
            }
    }
}











?>
