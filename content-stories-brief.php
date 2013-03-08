<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

//print_r($post);
// echo 'META:';
// print_r($custom_fields); 
// echo "<br />";

$postcat = get_the_category();
echo 'category id: ';
	  print_r( $postcat[0]->term_id );
	  	echo '<br />';
	  	echo 'tags: ';
	echo '<br />post: ' . $post->ID;
	echo '<br />';

  //print_r( $top_query );
  the_excerpt();
  the_tags();
  	// echo '<br />';
  	//Add the id of the post we're displaying to an array to exclude from all subsequent queries
  $do_not_duplicate[] = $post->ID;

  echo "<br />Don't Duplicate:";
  print_r($do_not_duplicate);
  	echo '<br /> <br/>';

	
