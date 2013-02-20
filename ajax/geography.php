<?php
//$mysql_hostname = "localhost";
//$mysql_user = "root";
//$mysql_password = "mrt7777!";
//$mysql_database = "cim2data";
//$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
//or die("Oops some thing went wrong");
//mysql_select_db($mysql_database, $bd) or die("Oops some thing went wrong");
//
//if($_POST['id'])
//{
//    $thisid=$_POST['id'];
//
//    $sql = mysql_query("SELECT STFID,CNTYNAME FROM cim2data.counties WHERE StateName = '" . $thisid . "' Order By CntyName", $bd);
//
//    while($row=mysql_fetch_array($sql))
//    {
//        $id=$row['STFID'];
//        $data=$row['CNTYNAME'];
//        echo '<option value="'.$id.'">'.$data.'</option>';
//    }
//}
//if($_POST['id2'])
//{
//    $thisid2=$_POST['id2'];
//
//    $sql2 = mysql_query("SELECT FIPS,STATENAME,CITYNAME FROM cim2data.cities WHERE StateName = '" . $thisid2 . "' Order By CityName", $bd);
//
//    while($row2=mysql_fetch_array($sql2))
//    {
//        $id2=$row2['FIPS'];
//        $data2=$row2['CITYNAME'];
//        echo '<option value="'.$id2.'">'.$data2.'</option>';
//    }
//}

define('WP_USE_THEMES', false);
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-blog-header.php');

if($_POST['id'])
{
    $thisid = 'counties-' . $_POST['id'];
    
    $cntyterm = get_term_by('slug', $thisid, 'geographies'); 
    $tid = $cntyterm->term_id;
    
	$args = array(
		'parent' => $tid,
		'hide_empty' => 0,

	);
	$terms = get_terms( 'geographies', $args );
	
	if ( $terms ) {

		foreach ( $terms as $term ) {
			printf( '<option value="%s">%s</option>', $term->slug, $term->name );
		}

	}
}

if($_POST['id2'])
{
    $thisid2 = 'cities-' . $_POST['id2'];
    
    $cntyterm = get_term_by('slug', $thisid2, 'geographies'); 
    $tid = $cntyterm->term_id;
    
	$args = array(
		'parent' => $tid,
		'hide_empty' => 0,

	);
	$terms = get_terms( 'geographies', $args );
	
	if ( $terms ) {

		foreach ( $terms as $term ) {
			printf( '<option value="%s">%s</option>', $term->slug, $term->name );
		}

	}
}

















?>
