<?php
/**
 * The sidebar containing the group sub nav and widget area.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		<div id="tertiary" class="widget-area" role="complementary">
		<?php 
			// $Path=$_SERVER['REQUEST_URI'];
			// $data_url= home_url() . $Path;
		?>

		<?php if ( is_active_sidebar( 'groups-single-sidebar' ) ) :
					dynamic_sidebar( 'groups-single-sidebar' ); 
			endif;
		?>

		</div><!-- #tertiary -->