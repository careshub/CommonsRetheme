<?php
/**
 * The sidebar used on the groups directory page.
 *
 *
 * @package WordPress
 * @subpackage Commons Retheme
 * @since 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
		
		 <?php 
			if ( is_active_sidebar( 'groups-sidebar' ) ) :
					dynamic_sidebar( 'groups-sidebar' ); 
			endif;
		?>
		</div><!-- #secondary -->