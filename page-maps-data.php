 <?php
/**
 * The template for the topically-oriented maps and data tool overview.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
                
                <?php wp_reset_query(); ?>		

        <?php 
		$args = array(
			'taxonomy' => 'data_vis_tool_categories'
		);
		$categories = get_categories($args);
		$all_cats = array();
		foreach ($categories as $cat) {
			$all_cats[] = $cat->slug;
		}
		foreach ($all_cats as $cat_slug) {
			if ( function_exists('ccdvt_get_tools') )
				ccdvt_get_tools($cat_slug);
		}
		
		?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>