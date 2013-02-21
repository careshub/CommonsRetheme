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
// print_r($custom_fields); 
// echo "<br />";

$custom_fields = get_post_custom($post->ID);
	//Check target areas, add the correct icon:
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
		    case 4:
		        $icon_class = "places-activity";
		        break;
		    case 5:
		        $icon_class = "cost-soda";
		        break;
		    case 6:
		        $icon_class = "advertising";
		        break;
			}
			}
	};

//Progress meter
	$progress = $custom_fields['policystage'][0];
		switch ($progress) {
	    case "pre":
	        $percentage = 25;
	        $progress_label = "in pre-policy";
	        break;
	    case "develop":
			$percentage = 50;
	        $progress_label = 'in development';
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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<header class="entry-header clear">
				<?php if ( isset( $icon_class ) )
						echo '<div class="' . $icon_class . '"><span class="icon"></span></div>';
				?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php //echo "<br />"; ?>
				<p class="location">Anytown, USA</p>
				<div class="meter-box clear">
					<p>This policy is <?php echo $progress_label; ?>.
					<div class="meter">
						<span style="width: <?php echo $percentage; ?>%"><span></span></span>
					</div>
				</div> <!-- end .meter-box -->
				
			</header>

			<?php the_content(); ?>
			<p class="policy-type">This policy is of the type: <a href="#"><?php echo $custom_fields['policytype'][0];?></a></p>

			<div class="clear"></div>			

			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
                    
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
