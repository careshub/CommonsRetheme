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
$video_url = get_post_meta( $post->ID, 'sa_success_story_video_url', true );
if ( !empty( $video_url ) ) { 
	$video_embed_code = wp_oembed_get( $video_url );
}

$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
	if ( !empty($terms) ) { 
		foreach ( $terms as $term ) {
		$advocacy_targets[] = '<a href="' . cc_get_the_cpt_tax_intersection_link( 'sa_success_story', 'sa_advocacy_targets', $term->slug ) .'">'.$term->name.'</a>';
		}
		$advocacy_targets = join( ', ', $advocacy_targets );
		$plain_index = reset($terms);
		$first_advo_target = $plain_index->slug;

	}

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'main-article' ); ?>>
		<div class="entry-content">
			<header class="entry-header clear">
				<span class="<?php echo $first_advo_target; ?>x90"></span><h1 class="entry-title icon-friendly"><?php the_title(); ?></h1>
				<?php //if (function_exists('salud_the_target_icons')) {
				// 		salud_the_target_icons();
				// 		}
				?>
			</header>
			<?php if ( $video_embed_code ) { ?>
			<figure class="video-container"> 
				<?php echo $video_embed_code; ?>
			</figure>
			<?php } ?>

			<?php the_content(); ?>

			<?php if ( isset($advocacy_targets) ) { ?>
			<p class="sa-policy-meta">Advocacy targets:
				<?php echo $advocacy_targets; ?>
			</a></p>
			<?php } ?>

			<?php if ( isset($resource_categories) ) { ?>
				<p class="sa-policy-meta">Categories :
					<?php echo $resource_categories; ?>
				</a></p>
			<?php } ?>
			<!-- <p class="sa-policy-meta">This policy is of the type: <a href="#">
				<?php //echo $custom_fields['sa_policytype'][0];
				// echo $advocacy_targets;
				?>
			</a></p> -->
			<?php 
				if ( function_exists('cc_add_comment_button') ) { 
					cc_add_comment_button(); 
				} 
			?>
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
