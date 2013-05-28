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
	if (!empty($terms)) {
		foreach ( $terms as $term ) {
			$advocacy_targets[] = '<a href="' .get_term_link($term->slug, 'sa_advocacy_targets') .'">'.$term->name.'</a>';
			$target_icon[] = $term->slug;
		}
		$advocacy_targets = join( ', ', $advocacy_targets );
	}

$tags = get_the_terms( $post->ID, 'sa_resourcecat' );
	if (!empty($tags)) { 
            
		foreach ( $tags as $tag ) {
			$resource_tags[] = '<a href="' . get_term_link($tag->slug, 'sa_resourcecat') .'">'.$tag->name.'</a>';
		}
		$resource_tags = join( ', ', $resource_tags );
	}
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
				<?php if ( isset( $target_icon ) )
						echo '<span class="' . $target_icon[0] . 'x60"></span>';
				?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php //echo "<br />"; ?>
				<!-- <p class="location">
					<?php 
					// if ($custom_fields['sa_finalgeog'][0]) {
					// 	echo $custom_fields['sa_finalgeog'][0];	
					// } else {
					// 	echo 'Location unknown';
					// }
					?>
				</p> -->
			<p><?php 
			$excerpt = get_the_excerpt();

			if ( isset($excerpt) ) {
				echo $excerpt;
			} else {
				the_content();
			}
			?></p>

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

			<div class="clear"></div>			
			<!-- Finding and listing related resources. -->

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
