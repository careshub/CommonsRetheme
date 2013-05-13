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
				<div id="screamer" class="clear">
					<h1><?php echo get_the_content(); ?></h1>
				</div>

				<?php //get_template_part( 'content', 'page' ); ?>
				<!-- <ul class="quicklinks content-row">
					<li class="third-block">
						<a href="http://maps.communitycommons.org" class="button"><span class="map"></span>Make a map</a>
					</li>
					<li class="third-block">
						<a href="http://assessment.communitycommons.org" class="button"><span class="report"></span>Start a CHNA report</a>
					</li>
					<li class="third-block">
						<a href="http://maps.communitycommons.org/MOM/" class="button"><span class="collaboration"></span>Collaborate</a>
					</li>
				</ul> -->
				<div class="half-block choose-tool">
					<h2><span class="map"></span><a href="http://maps.communitycommons.org">Make a map</a></h2>
					<ul>
						<li>
							<h5>Classic Map Room</h5>
							<a href="http://maps.communitycommons.org" class="button">Start a map</a>
							<p>This is a brief description of this tool. But not nearly brief enough.</p>
						</li>
						<li>
							<h5>Beta Map Room</h5>
							<a href="http://maps.communitycommons.org" class="button">Try the new tool</a>
							<p>This is a brief description of this tool.</p>
						</li>
						<li>
							<h5>Map Gallery</h5>
							<a href="http://maps.communitycommons.org" class="button">Visit gallery</a>
							<p>See what other users have created.</p>
						</li>
						<li>
							<h5>Map of the Movement</h5>
							<a href="http://maps.communitycommons.org" class="button">Visit the map</a>
							<p>Find partners in your area.</p>
						</li>
					</ul>
				</div>
				<div class="half-block choose-tool">
					<h2><span class="report"></span><a href="http://assessment.communitycommons.org">Build a report</a></h2>
					<ul>
						<li>
							<h5>Community Health Needs Assessment (CHNA)</h5>
							<a href="http://assessment.communitycommons.org" class="button">Start a report</a>
							<p>This is a brief description of this tool.</p>
						</li>
						<li>
							<h5>Other reports</h5>
							<a href="http://assessment.communitycommons.org" class="button">Start a report</a>
							<p>This is a brief description of this tool.</p>
						</li>
					</ul>
				</div>
                
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

		<ul id="jumplinks" class="clear">
			<h2>Choose a tool by topic</h2>
			<h3>Scroll to a topic:</h3>
			<?php
			foreach ($all_cats as $cat_slug) {
				$cat_object = get_term_by('slug', $cat_slug, 'data_vis_tool_categories');
				// print_r($cat_object);
				$section_title = $cat_object->name;
				?>
				<li>
					<a href="#data-vis-tool-group-<?php echo $cat_slug; ?>" title="Scroll to <?php echo $section_title; ?> section" class="horizontal-list"><?php echo $section_title; ?></a>
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