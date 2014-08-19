<?php
/**
 * The sidebar used on a single member page.
 *
 *
 * @package WordPress
 * @subpackage Commons Retheme
 * @since 1.0
 */
?>
		<div id="tertiary" class="widget-area" role="complementary">
		   	
		<?php if ( is_active_sidebar( 'members-single-sidebar' ) ) :
					dynamic_sidebar( 'members-single-sidebar' ); 
			endif;
		?>
		</div><!-- #tertiary -->