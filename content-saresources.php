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

$custom_fields = get_post_custom($post->ID);
$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
	foreach ( $terms as $term ) {
		$advocacy_targets[] = '<a href="' .get_term_link($term->slug, 'sa_advocacy_targets') .'">'.$term->name.'</a>';
		$target_icons[] = $term->slug;
	}
	$advocacy_targets = join( ', ', $advocacy_targets );

$tags = get_the_terms( $post->ID, 'sa_resourcecat' );
	foreach ( $tags as $tag ) {
		$resource_tags[] = '<a href="' . get_term_link($tag->slug, 'sa_resourcecat') .'">'.$tag->name.'</a>';
	}
	$resource_tags = join( ', ', $policy_tags );
// print_r($tags);
// echo $policy_tags;

// echo '<pre>';
// print_r($custom_fields); 
// echo '</pre>';

// echo "<br />";

//Location
	// $location = $custom_fields['sa_finalgeog'][0];
	//

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<header class="entry-header clear">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php //echo "<br />"; ?>
				<?php if ( isset( $target_icons ) ) {
						foreach ($target_icons as $target_icon) {
							echo '<span class="' . $target_icon . 'x30"></span>';
						}
					}
				?>
				<!-- <p class="location">
					<?php 
					// if ($custom_fields['sa_finalgeog'][0]) {
					// 	echo $custom_fields['sa_finalgeog'][0];	
					// } else {
					// 	echo 'Location unknown';
					// }
					?>
				</p> -->
				 <!-- end .meter-box -->
			</header>


			<?php the_content(); ?>
			<?php if ( isset($advocacy_targets) ) { ?>
			<p class="sa-policy-meta">Advocacy targets:
				<?php echo $advocacy_targets; ?>
			</a></p>
			<?php } ?>

			<?php if ( isset($resource_tags) ) { ?>
				<p class="sa-policy-meta">Tags :
					<?php echo $resource_tags; ?>
				</a></p>
			<?php } ?>
			<!-- <p class="sa-policy-meta">This policy is of the type: <a href="#">
				<?php //echo $custom_fields['sa_policytype'][0];
				// echo $advocacy_targets;
				?>
			</a></p> -->

			<?php 
				if ( function_exists('bp_share_post_button') ) { 
					bp_share_post_button(); 
				} 
			?>

			<div class="clear"></div>			
			<!-- Finding and listing related resources. -->

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
