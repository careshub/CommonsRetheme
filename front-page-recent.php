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
			<h1 class="screamer spacious clear"><?php echo get_bloginfo( 'description', 'display' );  ?></h1>

<?php
//Set up an array to contain the id of posts we've already used.
$do_not_duplicate = array();

 //First, get the post set to be supersticky
	$top_query = new WP_Query( 
	 	array(
	 	//'post__not_in' => $do_not_duplicate,
	 	'tag' => 'top-feature',
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
			
			// Find out which tags this post has, for making the related query
			 $tags = get_the_tags();
			 $post_tags = array();
				foreach ($tags as $tag) {
					//We don't want to find related posts from the "top" catogory, so we'll just get the other category ids.
					if ( $tag->name !== 'top-feature' ) {
						$post_tags[]=$tag->term_id;
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
		    <h4 class="clear-none"><a href="/blog/" title="Article archive" class="button">Browse all Commons articles.</a></h4>
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

//We'll also need a list of all posts with the guest-blog or data tag, so we don't include them in block 1 or 2 
	// NOTE: 'fields' => 'ids' means WP_Query only returns the post ids, for efficiency.
	$guest_blog_posts = new WP_Query( array( 'tag' => 'guest-blog', 'fields' => 'ids' ) );
	$guest_blog_array = $guest_blog_posts->posts;
	$third_block_posts = new WP_Query( array( 'tag' => 'data', 'fields' => 'ids' ) );
	$third_block_array = $third_block_posts->posts;

for ($i = 1; $i <= 4; $i++) {
	// echo 'iteration number: ' . $i ;
	// echo "<br /> Do-not-duplicate array: ";
	// print_r($do_not_duplicate);
	
	// Modify the array of sticky posts, depending on which loop we're in.
	switch ($i) {
		case 1:
		case 2:			
			//Remove guest blog and data posts from the first two blocks.
			$sticky_no_dupes = array_diff($sticky, $do_not_duplicate, $guest_blog_array, $third_block_array);			
		break;
		case 3:
			// Probably don't want guest blog articles to show up in column three, even if they're tagged data
			$sticky_no_dupes = array_diff($sticky, $do_not_duplicate, $guest_blog_array);			
			break;
		case 4:
			// Remove duplicates from the guest blog block
			$sticky_no_dupes = array_diff($sticky, $do_not_duplicate);			
			break;
		default:
			//Remove guest blog and data posts from the first two blocks.
			$sticky_no_dupes = array_diff($sticky, $do_not_duplicate, $guest_blog_array, $third_block_array);			
		 	break;
	}
	
	// Sort the stickies with the newest ones at the top
	rsort( $sticky_no_dupes );
	// echo "<br /> Sticky-no-dupes array: ";
	// print_r($sticky_no_dupes);
	
	//Grab only the most recent post in the array
	$sticky_single = array_slice( $sticky_no_dupes, 0, 1 );
	// echo "<br /> Sticky-single array: ";
	// print_r($sticky_single);
	
	// Set query, 1st & 2nd loops should be headed by recent sticky posts, but not from the guest blog or data groups, also only from the category 'features'.
	// Third block should be the data group
	// Fourth block should be guest blogs
	switch ($i) {
		case 1:
		case 2:			
			$args = array(
			 	'post__in' => $sticky_no_dupes,
			 	// 'category_name' => 'features',
				'ignore_sticky_posts' => 1,
			 	'posts_per_page' => 1
			 	);			
		break;
		case 3:
			$args = array(
			 	'post__in' => $sticky_no_dupes,
			 	'tag' => 'data',
				'ignore_sticky_posts' => 1,
			 	'posts_per_page' => 1
			 	);			
			break;
		case 4:
			$args = array(
			 	'post__in' => $sticky_no_dupes,
			 	'tag' => 'guest-blog',
				'ignore_sticky_posts' => 1,
			 	'posts_per_page' => 1
			 	);			
			break;
		default:
			$args = array(
			 	'post__in' => $sticky_single,
				'ignore_sticky_posts' => 1,
			 	'posts_per_page' => 1
			 	);			
		 	break;
	}
	// echo "<br />args: ";
	// print_r($args);
	$main_query = new WP_Query( $args );	
	
	if ( $main_query ) : 
		while ( $main_query->have_posts() ) : $main_query->the_post();
			$layout_location = 'secondary';
			if ( $i%4 == 1 ) {
				echo '<div class="content-row">';
			}
			?>
		<div id="story-block-<?php echo $i; ?>" class="quarter-block" class="clear">
			<?php
			get_template_part( 'content', 'stories-brief' );
			
			// Find out which tags this post has, for making the related query
			 $tags = get_the_tags();
			 if (!is_array($tags)) {
			 	$tags = array($tags);
			 }
			 $post_tags = array();
				foreach ($tags as $tag) {
					//We don't want to find related posts from the "top" catogory, so we'll just get the other category ids.
					if ( $tag->name !== 'top-feature' ) {
						$post_tags[]=$tag->term_id;
					}
				}
			
			// Testing:


			// Add the id of the post we're displaying to an array to exclude from all subsequent queries
		    $do_not_duplicate[] = $post->ID;
			// echo "<br /> Don't Duplicate:";
			// print_r($do_not_duplicate);
			// echo '<br />';
			// echo 'tag ids: ';
			// print_r( $post_tags );
			// echo '<br />';

		    //$related_tag = $post->tag ?>
		<?php endwhile; 
		// echo '<br/>$postcategories: ';
		// print_r($postcategories) ;
		wp_reset_postdata(); ?>
	
<?php
// Then, get posts related to the main story
	global $post; // required
	// Set query, 1st & 2nd loops should be headed by recent sticky posts and exclude guest-blogs and data, so we'll need to add those posts to the post__not_in array.
	// $exclude_dupes_guests_data = array_merge($do_not_duplicate, $third_block_array, $guest_blog_array);
	// echo '<br>$do_not_duplicate: ';
	// print_r($do_not_duplicate);
	// echo '<br>$third_block_array: ';
	// print_r($third_block_array);
	// echo '<br>$guest_blog_array: ';
	// print_r($guest_blog_array);
	// echo '<br>Merged exclude array: ';
	// print_r($exclude_dupes_guests_data);
	
	// Third block should be the data group
	// Fourth block should be guest blogs
	switch ($i) {
		case 1:
		case 2:
			$exclude_dupes_guests_data = array_merge($do_not_duplicate, $third_block_array, $guest_blog_array);
			$args = array(
				 	'post__not_in' => $exclude_dupes_guests_data,
				 	'tag__in' => $post_tags,
				 	// 'category_name' => 'features',
				 	'ignore_sticky_posts' => 1,
				 	'posts_per_page' => 2
				 	);		 	
			break;
		case 3:
			$args = array(
				 	'post__not_in' => $do_not_duplicate,
				 	'tag' => 'data',
				 	'ignore_sticky_posts' => 1,
				 	'posts_per_page' => 2
				 	);		 	
			break;
		case 4:
			$args = array(
				 	'post__not_in' => $do_not_duplicate,
					'tag' => 'guest-blog',
				 	'ignore_sticky_posts' => 1,
				 	'posts_per_page' => 2
				 	);
			break;
		default:
			$args = array(
				 	'post__not_in' => $do_not_duplicate,
				 	'tag__in' => $post_tags,
				 	'ignore_sticky_posts' => 1,
				 	'posts_per_page' => 2
				 	);		 	
			break;
	}
		
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
  if ( $i%4 == 0 ) {
		echo '</div> <!-- End .content-row -->';
	}
	endif; //ends if ( main_query )

} //ends for loop iteration


  ?>

  		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>