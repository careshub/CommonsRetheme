<?php
/**
 * The template used for displaying posts on the salud heroes videos page
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$video_url = get_post_meta( $post->ID, 'sa_success_story_video_url', 'true' );
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

$video_meta = cc_get_youtube_video_metadata( $video_url );
$description = apply_filters( 'the_content', $video_meta['description'] );
$video_title = apply_filters( 'the_title', $video_meta['title'] );

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'salud-hero-video-summary' ); ?>>
		<div class="entry-content">
			<header class="entry-header clear">
				<span class="<?php echo $first_advo_target; ?>x60"></span><h3 class="entry-title icon-friendly"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			</header>
			<h5 class="video-title">
				<?php echo $video_title; ?>
			</h5>
			<?php if ( isset($video_embed_code) ) { ?>
			<figure> 
				<?php echo $video_embed_code; ?>
			</figure>
			<?php } ?>
			<?php echo $description; ?>
			

			<?php if ( isset($advocacy_targets) ) { ?>
			<p class="sa-policy-meta">Advocacy targets:
				<?php echo $advocacy_targets; ?>
			</a></p>
			<?php } ?>

			<?php if ( isset($resource_categories) ) { ?>
				<!-- <p class="sa-policy-meta">Categories :
					<?php echo $resource_categories; ?>
				</a></p> -->
			<?php } ?>
			<!-- <p class="sa-policy-meta">This policy is of the type: <a href="#">
				<?php //echo $custom_fields['sa_policytype'][0];
				// echo $advocacy_targets;
				?>
			</a></p> -->
			<?php 
				// if ( function_exists('cc_add_comment_button') ) { 
				// 	cc_add_comment_button(); 
				// } 
			?>
			<?php 
				// if ( function_exists('bp_share_post_button') ) { 
				// 	bp_share_post_button(); 
				// } 
			?>

			<div class="clear"></div>			
			<!-- Finding and listing related resources. -->

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post -->
