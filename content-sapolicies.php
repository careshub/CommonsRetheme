<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$custom_fields = get_post_custom($post->ID);
//Check target areas:
	for ($i = 1; $i <= 6; $i++) {
		${target.$i} = $custom_fields['at'.$i][0];
		//echo 'Target Area'. $i .': ' . ${target.$i} . '<br/>';
		if ( isset( ${target.$i} ) ) {
			switch ($i) {
		    case 1:
		        $icon_class = "school-food";
		        break;
		    case 2:
		        $icon_class = "food-neighborhood";
		        break;
		    case 3:
		        $icon_class = "active-play";
		        break;
			}
				echo '<div class="' . $icon_class . '"><span class="icon"></span></div>';
			}
	};
//print_r($post);
echo 'META:';
print_r($custom_fields); 
echo "<br />";


?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">
			<h1><?php the_title(); ?></h1>
			<?php //echo "<br />"; ?>
			<h4 class="location">Anytown, USA</h4>
			<?php echo $custom_fields['policytype'][0];?>
					<?php echo "<br />"; ?>
			<?php echo "<br />"; ?>

			<?php the_content(); ?>

			<?php
			//Progress meter
			$progress = $custom_fields['policystage'][0];
			switch ($progress) {
		    case "pre":
		        $percentage = 25;
		        $progress_label = "in pre-policy";
		        break;
		    case "develop":
				$percentage = 50;
		        $progress_label = 'in devlopment';
		        break;
		    case "enact":
				$percentage = 75;
		        $progress_label = 'enacted';
		       	break;
		    case "post":
				$percentage = 75;
		        $progress_label = 'in post-policy';
		       	break;
			}
			//echo $progress_label . " " . $percentage;
			?>
			<div class="clear"></div>
			<div class="meter-box">
				<h4>This policy is <?php echo $progress_label; ?>.</h4>
				<div class="meter">
					<span style="width: <?php echo $percentage; ?>%"><span></span></span>
				</div>
			</div>
			

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
                    
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
