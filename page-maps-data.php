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
				<ul class="quicklinks">
					<li>
						<a href="#" class="button">Start a new map</a>
					</li>
					<li>
						<a href="#" class="button">Start a new report</a>
					</li>
				</ul>
                
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
		//Build a local scroll-powered nav
		?>

		<ul id="jumplinks">
			<h3>Scroll to a topic:</h3>
			<?php
			foreach ($all_cats as $cat_slug) {
				$cat_object = get_term_by('slug', $cat_slug, 'data_vis_tool_categories');
				// print_r($cat_object);
				$section_title = $cat_object->name;
				?>
				<li>
					<a href="#data-vis-tool-group-<?php echo $cat_slug; ?>" title="Scroll to <?php echo $section_title; ?> section" class="button chunky horizontal-list"><?php echo $section_title; ?></a>
				</li>
				<?php
			}		
			?>
		</ul>
		<?php
		foreach ($all_cats as $cat_slug) {
			if ( function_exists('ccdvt_get_tools') )
				ccdvt_get_tools($cat_slug);
		}
		
		?>
		<?php //comments_template(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>