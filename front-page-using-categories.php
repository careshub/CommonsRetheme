 <?php
/**
 * The template for the magazine-style front page.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div id="screamer">
				<h1><?php echo get_bloginfo ( 'description' );  ?></h1>
			</div>

<?php
//Set up an array to contain the id of posts we've already used.
$do_not_duplicate = array();

 //First, get the post set to be supersticky
	$top_query = new WP_Query( 
	 	array(
	 	//'post__not_in' => $do_not_duplicate,
	 	'category_name' => 'top-story',
	 	'posts_per_page' => 1
	 	)
 	);
	if ( $top_query ) : 
		while ( $top_query->have_posts() ) : $top_query->the_post();
			$layout_location = 'primary';
			?>
		<div id="top-story" class="clear">
			<?php
			get_template_part( 'content', 'stories-brief' );
			
			// Find out which categories this post belongs to, for making the related query
			 $postcats = get_the_category();
			 $postcategories = array();
				foreach ($postcats as $postcat) {
					//We don't want to find related posts from the "top" catogory, so we'll just get the other category ids.
					if ( $postcat->name !== 'top-story' ) {
						$postcategories[]=$postcat->term_id;
					}
				}
			
			// Add the id of the post we're displaying to an array to exclude from all subsequent queries
		    $do_not_duplicate[] = $post->ID;
			// echo "<br /> Don't Duplicate:";
			// print_r($do_not_duplicate);
			// echo '<br />';
			// echo 'category id: ';
			// print_r( $postcategories );
			// echo '<br />';

		    //$related_tag = $post->tag ?>
		</div> <!-- end #top-story -->

		<?php endwhile; 
		wp_reset_postdata(); ?>
		<?php endif; //ends if ( $top_query ) ?>

<?php
// Now, we're going to iterate through a few loops to find recent and related content

//First, get a list of sticky posts, we'll use this several times, so we'll keep it outside the for loop
	$sticky = get_option( 'sticky_posts' );
	// echo "<br /> Sticky array: ";
	// print_r($sticky);

for ($i = 1; $i <= 4; $i++) {
	// echo "<br /> Do-not-duplicate array: ";
	// print_r($do_not_duplicate);
	// Remove any posts in our "do_not_duplicate" array from the array of sticky posts
	$sticky_no_dupes = array_diff($sticky, $do_not_duplicate);
	// Sort the stickies with the newest ones at the top
	rsort( $sticky_no_dupes );
	// echo "<br /> Sticky-no-dupes array: ";
	// print_r($sticky_no_dupes);
	//Grab only the most recent post in the array
	$sticky_single = array_slice( $sticky_no_dupes, 0, 1 );
	// echo "<br /> Sticky-single array: ";
	// print_r($sticky_single);

	$main_query = new WP_Query( 
	 	array(
	 	'post__in' => $sticky_single,
	 	// 'post__not_in' => $do_not_duplicate,
	 	//'category_name' => 'top',
	 	'ignore_sticky_posts' => 1,
	 	'posts_per_page' => 1
	 	)
 	);
	if ( $main_query ) : 
		while ( $main_query->have_posts() ) : $main_query->the_post();
			$layout_location = 'secondary';
			if ( $i%2 !== 0 ) {
				echo '<div class="content-row">';
			}
			?>
		<div id="story-block-<?= $i; ?>" class="quarter-block" class="clear">
			<?php
			get_template_part( 'content', 'stories-brief' );
			
			// Find out which categories this post belongs to, for making the related query
			 $postcats = get_the_category();
			 $postcategories = array();
				foreach ($postcats as $postcat) {
					//We don't want to find related posts from the "top" catogory, so we'll just get the other category ids.
					if ( $postcat->name !== 'top-story' ) {
						$postcategories[]=$postcat->term_id;
					}
				}
			
			// Testing:


			// Add the id of the post we're displaying to an array to exclude from all subsequent queries
		    $do_not_duplicate[] = $post->ID;
			// echo "<br /> Don't Duplicate:";
			// print_r($do_not_duplicate);
			// echo '<br />';
			// echo 'category id: ';
			// print_r( $postcategories );
			// echo '<br />';

		    //$related_tag = $post->tag ?>
		<?php endwhile; 
		// echo '<br/>$postcategories: ';
		// print_r($postcategories) ;
		wp_reset_postdata(); ?>
	
<?php
// Then, get posts related to the main story
	global $post; // required
	$args = array(
	 	'post__not_in' => $do_not_duplicate,
	 	'category__in' => $postcategories,
	 	// 'category_name' => 'istanbul-stuff',
	 	'ignore_sticky_posts' => 1,
	 	'posts_per_page' => 2
	 	);
	$related_query = get_posts($args);
?>
			<h3>Related posts</h3>
			<ul class="related-posts">
				<?php
				foreach($related_query as $post) : setup_postdata($post);
					$layout_location = 'related';

					get_template_part( 'content', 'stories-brief' );
					
					$do_not_duplicate[] = $post->ID;

				endforeach; //ends top-related posts loop
				?>
			</ul> <!-- End .related_posts -->
		</div> <!-- End .quarter-block -->

  <?php 
  if ( $i%2 == 0 ) {
				echo '</div> <!-- End .content-row -->';
			}
	endif; //ends if ( main_query )

} //ends for loop iteration


  ?>

  		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>