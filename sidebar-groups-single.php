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
			$Path=$_SERVER['REQUEST_URI'];
			$data_url= home_url() . $Path;
		?>
		<div class="sharrre alignleft button" data-url="<?= $data_url ?>" data-text="<?php wp_title( '|', true, 'right' ); ?>" data-title="share"></div>


		<?php if ( is_active_sidebar( 'groups-single-sidebar' ) ) :
					dynamic_sidebar( 'groups-single-sidebar' ); 
			endif;
		?>

		</div><!-- #tertiary -->