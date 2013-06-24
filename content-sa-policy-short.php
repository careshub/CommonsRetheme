<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
	$custom_fields = get_post_custom($post->ID);
	$terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
	foreach ( $terms as $term ) {
		$advocacy_targets[] = '<a href="' .get_term_link($term->slug, 'sa_advocacy_targets') .'">'.$term->name.'</a>';
		$target_icons[] = $term->slug;
		
	}
	$advocacy_targets = join( ', ', $advocacy_targets );
	// echo '<pre>';
	// print_r($post);
	// print_r($advocacy_targets);
	// echo $target_icon[0];
	// print_r($custom_fields);
	// echo '</pre>';

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
				<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
				<?php //echo "<br />"; ?>
				<?php if ( isset( $target_icons ) ) {
						foreach ($target_icons as $target_icon) {
							$replace1 = str_replace("sa-","",$target_icon);
							$replace2 = str_replace("-"," ",$replace1);
							$UCreplace2 = ucwords($replace2);
							echo '<span class="' . $target_icon . 'x30" title="' . $UCreplace2 . '"></span>';
						}
					}
				?>
				<p class="location"><?php //echo $location; 
						if (function_exists('salud_the_location')) {
							salud_the_location();
						}
					?></p>
				<div class="meter-box clear">
					<p>This change is <?php echo $progress_label; ?>.
					<!-- <div class="meter">
						<span style="width: <?php echo $percentage; ?>%"><span></span></span>
					</div> -->
				</div> <!-- end .meter-box -->
				
			</header>
			<p><?php 
			$excerpt = get_the_excerpt();

			if ( isset($excerpt) ) {
				echo $excerpt;
			} else {
				the_content();
			}
			?></p>
			<!-- <p class="policy-type">This policy is of the type: <a href="#"><?php echo $custom_fields['policytype'][0];?></a></p> -->

			<div class="clear"></div>			

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<!-- <footer class="entry-meta">
                    
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer> --><!-- .entry-meta -->
	</article><!-- #post -->
