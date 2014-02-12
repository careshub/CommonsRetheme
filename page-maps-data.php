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
				<h1 class="screamer spacious clear"><?php echo apply_filters( 'the_title', get_the_content() ); ?></h1>

				<?php //get_template_part( 'content', 'page' ); ?>
				
				<div class="content-row alignnone">
					<div class="half-block choose-tool">
						<h2><a href="http://maps.communitycommons.org"><span class="map"></span>Make a Map</a></h2>
						<ul>
							<li>
								<h4><a href="http://maps.communitycommons.org">Map Room Beta</a></h4>
								<!-- <a href="http://maps.communitycommons.org" class="button">Try the new tool</a> -->
                                <p>Visit the newly redesigned maproom currently in Beta. 
                                    Check out our <a href="http://maps.communitycommons.org/viewer/datalist.aspx">data list</a> or see <a href="http://maps.communitycommons.org/news.aspx">what's new</a>. 
                                    Create a map. Save it. Share it!</p>
							</li>
							<li>
								<h4><a href="http://initiatives.communitycommons.org/tool/CC/Default.aspx?url=../maps/default.aspx">Map Room Classic</a></h4>
								<!-- <a href="http://initiatives.communitycommons.org/tool/CC/Default.aspx?url=../maps/default.aspx" class="button">Start a map</a> -->
								<p>Create a map in the original Commons mapping environment.</p>
							</li>
							<li>
								<h4><a href="http://maps.communitycommons.org/gallery.aspx">Map Gallery</a></h4>
								<!-- <a href="http://maps.communitycommons.org/gallery.aspx" class="button">Visit gallery</a> -->
								<p>Browse and open maps created by users of the Commons.</p>
							</li>
							<li>
								<h4><a href="http://maps.communitycommons.org/MOM/">Map of the Movement</a></h4>
								<!-- <a href="http://maps.communitycommons.org/MOM/" class="button">Visit the map</a> -->
								<p>Search for initiatives.</p>
							</li>
						</ul>
					</div>
					<div class="half-block choose-tool">
						<h2><a href="http://assessment.communitycommons.org/CHNA/"><span class="report"></span>Build a Report</a></h2>
						<ul>
							<li>
								<h4><a href="http://assessment.communitycommons.org/CHNA/">Community Health Needs Assessment</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/CHNA/" class="button">CHNA report</a> -->
								<p>Identify assets and potential disparities in your county/region related to community health and well-being.</p>
							</li>
							<li>
								<h4><a href="http://assessment.communitycommons.org/Footprint/">Vulnerable Population Footprint</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/Footprint/" class="button">Start a report</a> -->
								<p>Find areas in your community with low educational attainment and high poverty.</p>
							</li>
							<li>
								<h4><a href="http://assessment.communitycommons.org/DataReport/">Topic-based Reports</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/DataReport/" class="button">Start a report</a> -->
								<p>Browse and create data reports covering health, education, economic and other factors.</p>
							</li>
							<!-- <li>
								<h5>Other reports</h5>
								<a href="http://assessment.communitycommons.org" class="button">Start a report</a>
								<p>Browse other data reports.</p>
							</li> -->
						</ul>
					</div>
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