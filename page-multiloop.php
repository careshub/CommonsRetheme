 <?php
/**
 * The template for the newspaper-style front page.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

<?php
 //First, get the post set to be supersticky
 $top_query = new WP_Query( 
	 	array(
	 	//'post__not_in' => $do_not_duplicate,
	 	'category_name' => 'top',
	 	'posts_per_page' => 1
	 	)
 	);

  while ($top_query->have_posts()) : $top_query->the_post();
	$postcat = get_the_category();
	echo 'category id: ';
	print_r( $postcat[0]->term_id );
	echo '<br />';


  // print_r( $top_query );
	echo 'post: ' . $post->ID;
		echo '<br />';

  the_excerpt();
  the_tags();
  ?>




<?php
//Add the id of the post we're displaying to an array to exclude from all subsequent queries
  $do_not_duplicate[] = $post->ID;

  echo "<br /> Don't Duplicate:";
  print_r($do_not_duplicate);
  	echo '<br />';

  //$related_tag = $post->tag ?>
    <!-- Do stuff... -->
  <?php endwhile; ?>

  <?php $second_query = new WP_Query( 
	 	array(
	 	'post__not_in' => $do_not_duplicate,
	 	//'category_name' => 'istanbul-stuff',
	 	'posts_per_page' => 10
	 	)
 	);
?>
    <!-- Do other stuff... -->
  <?php 
  while ($second_query->have_posts()) : $second_query->the_post();
// if (in_array($post->ID, $do_not_duplicate)) 
// 	continue;?> 
<!-- Do stuff... -->
<?php 
$postcat = get_the_category();
echo 'category id: ';
	  print_r( $postcat[0]->term_id );
	  	echo '<br />';
	echo 'post: ' . $post->ID;
	echo '<br />';

  //print_r( $top_query );
  the_excerpt();
  the_tags();
  	echo '<br />';

  endwhile;  ?>


  		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>