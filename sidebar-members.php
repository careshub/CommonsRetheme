<?php
/**
 * The sidebar used on the members directory page.
 *
 *
 * @package WordPress
 * @subpackage Commons Retheme
 * @since 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
		   
		<?php if ( is_active_sidebar( 'members-sidebar' ) ) :
					dynamic_sidebar( 'members-sidebar' ); 
			endif;
		?>
		</div><!-- #secondary -->