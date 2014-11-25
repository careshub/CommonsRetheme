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
			if ( is_active_sidebar( 'category_sidebar' ) ) :
					dynamic_sidebar( 'category_sidebar' ); 
			endif;
		?>
		</div><!-- #secondary -->