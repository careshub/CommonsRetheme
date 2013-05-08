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
		$target_icon[] = $term->slug;
	}
	$advocacy_targets = join( ', ', $advocacy_targets );

$tags = get_the_terms( $post->ID, 'sa_policy_tags' );
	foreach ( $tags as $tag ) {
		$policy_tags[] = '<a href="' . get_term_link($tag->slug, 'sa_policy_tags') .'">'.$tag->name.'</a>';
	}
	$policy_tags = join( ', ', $policy_tags );
// print_r($tags);
// echo $policy_tags;

// echo '<pre>';
// print_r($custom_fields); 
// echo '</pre>';

// echo "<br />";

//Location
	$location = $custom_fields['sa_finalgeog'][0];
	//

//Progress meter
	$progress = $custom_fields['sa_policystage'][0];
		switch ($progress) {
	    case "Pre Policy":
	        $percentage = 25;
	        $progress_label = "in pre-policy";
	        break;
	    case "Develop Policy":
			$percentage = 50;
	        $progress_label = 'in development';
	        break;
	    case "Enact Policy":
			$percentage = 75;
	        $progress_label = 'enacted';
	       	break;
	    case "Post Policy":
			$percentage = 75;
	        $progress_label = 'in post-policy';
	       	break;
		}
	//echo $progress_label . " " . $percentage;

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<header class="entry-header clear">
				<?php if ( isset( $target_icon ) )
						echo '<span class="' . $target_icon[0] . 'x60"></span>';
				?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php //echo "<br />"; ?>
				<p class="location">
					<?php 
					if ($custom_fields['sa_finalgeog'][0]) {
						echo $custom_fields['sa_finalgeog'][0];	
					} else {
						echo 'Location unknown';
					}
					?>
				</p>
				<div class="meter-box clear">
					<p>This policy is <?php echo $progress_label; ?>.
					<div class="meter nostripes">
						<span style="width: <?php echo $percentage; ?>%"><span></span></span>
					</div>
				</div> <!-- end .meter-box -->
				
			</header>

			<?php the_content(); ?>
			<p class="policy-type">Advocacy targets:
				<?php //echo $custom_fields['sa_policytype'][0];
				echo $advocacy_targets;
				?>
			</a></p>
			<p class="policy-type">Tags:
				<?php //echo $custom_fields['sa_policytype'][0];
				echo $policy_tags;
				?>
			</a></p>
			<p class="policy-type">This policy is of the type: <a href="#">
				<?php echo $custom_fields['sa_policytype'][0];
				// echo $advocacy_targets;
				?>
			</a></p>

			<div class="clear"></div>			

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
                    
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
