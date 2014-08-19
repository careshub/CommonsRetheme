<?php
/**
 * The sidebar used on a single group page.
 *
 *
 * @package WordPress
 * @subpackage Commons Retheme
 * @since 1.0
 */
?>
		<div id="tertiary" class="widget-area" role="complementary">

		<?php 
			if ( is_active_sidebar( 'groups-single-sidebar' ) ) {
				dynamic_sidebar( 'groups-single-sidebar' ); 
			}
		?>

		</div><!-- #tertiary -->