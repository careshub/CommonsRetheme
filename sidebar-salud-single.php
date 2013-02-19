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
			<p> Salud sidebar single </p>
		<!-- <div id="group-navigation">  
		    <div id="group_sidebar">
				<div id="item-header-avatar">
				<?php bp_group_avatar() ?>
				</div>
			</div> -->
		    <div id="item-buttons">

				<?php do_action( 'bp_group_header_actions' ); ?>

			</div><!-- #item-buttons -->
		<!-- </div>      -->
		<div class="sidebar-activity-tabs no-ajax" id="object-nav" role="navigation">
			<!-- <ul>
				<?php bp_get_options_nav(); ?>
				<?php do_action( 'bp_group_options_nav' ); ?>
			</ul> -->

			<?php //Add sidebar navigation menu 
				$args = array(
					'theme_location' => 'salud-nav',
					//'menu'            => '', 
					'container'       => '', 
					//'container_class' => 'salud-nav', 
					//'container_id'    => '',
					//'menu_class' 	=> 'footer-nav',
					//'menu_id'         => 'menu-{menu slug}[-{increment}]',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					//'items_wrap'      => '%3$s',
					'depth'           => 0,
					'walker'          => ''
					);
				wp_nav_menu( $args );
				?>
		</div>
		<?php //if ( is_active_sidebar( 'groups-single-sidebar' ) ) :
		// 			dynamic_sidebar( 'groups-single-sidebar' ); 
		// 	endif;
		?>
		<?php 
			// $Path=$_SERVER['REQUEST_URI'];
			// $data_url= home_url() . $Path;
		?>
		<!-- <div class="sharrre alignleft button" data-url="<?= $data_url ?>" data-text="<?php wp_title( '|', true, 'right' ); ?>" data-title="share"></div> -->
		</div><!-- #secondary -->