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
		<div id="secondary" class="widget-area" role="complementary">
		
		 <?php 
			if ( is_active_sidebar( 'groups-sidebar' ) ) :
					dynamic_sidebar( 'groups-sidebar' ); 
			endif;
		?>
		</div><!-- #secondary -->