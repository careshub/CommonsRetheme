<?php

define('WP_USE_THEMES', false);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$selstate = $_POST['selstate'];
$geog = $_POST['geog'];

$geog_str_prefix = sa_get_geography_prefix($geog);

if( $selstate )
{
    if ($geog) {     
        $thisid = $geog_str_prefix . $selstate;
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
