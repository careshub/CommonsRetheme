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
				<h1 class="screamer spacious clear"><?php echo apply_filters( 'the_title', get_the_content(), get_the_ID() ); ?></h1>

				<?php //get_template_part( 'content', 'page' ); ?>
				
				<div class="content-row alignnone">
					<div class="half-block choose-tool">
						<h2><a href="http://maps.communitycommons.org"><span class="map"></span>Make a Map</a></h2>
						<ul>
							<?php /* ?>
							<li>
								<h4><a href="http://maps.communitycommons.org">Map Room</a></h4>
								<!-- <a href="http://maps.communitycommons.org" class="button">Try the new tool</a> -->
                                <p>Visit the newly redesigned maproom. Create a map. Save it. Share it!</p>
							</li>
							<li>
								<h4><a href="http://initiatives.communitycommons.org/tool/CC/Default.aspx?url=../maps/default.aspx">Map Room Classic</a></h4>
								<!-- <a href="http://initiatives.communitycommons.org/tool/CC/Default.aspx?url=../maps/default.aspx" class="button">Start a map</a> -->
								<p>Create a map in the original Commons mapping environment.</p>
							</li>
							<?php */ ?>
							<li>
								<h4><a href="http://maps.communitycommons.org/gallery.aspx">Map Gallery</a></h4>
								<!-- <a href="http://maps.communitycommons.org/gallery.aspx" class="button">Visit gallery</a> -->
								<p>Browse and open maps created by users of the Commons.</p>
							</li>
							<li>
								<h4><a href="http://maps.communitycommons.org/viewer/datalist.aspx" title="Link to a list of Community Commons' data sets">Data</a></h4>
								<p>Check out our <a href="http://maps.communitycommons.org/viewer/datalist.aspx">data list</a> or see <a href="http://maps.communitycommons.org/news.aspx">what's new</a>.</p>
							</li>
						</ul>
					</div>
					<div class="half-block choose-tool">
						<h2><a href="http://assessment.communitycommons.org/CHNA/SelectArea.aspx?reporttype=libraryCHNA"><span class="report"></span>Build a Report</a></h2>
						<ul>
							<li>
								<h4><a href="http://assessment.communitycommons.org/CHNA/">Community Health Needs Assessment</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/CHNA/" class="button">CHNA report</a> -->
								<p>Identify assets and potential disparities in your county/region related to community health and well-being.</p>
							</li>
							<li>
								<h4><a href="http://assessment.communitycommons.org/Footprint/">Vulnerable Populations Footprint</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/Footprint/" class="button">Start a report</a> -->
								<p>Find areas in your community with low educational attainment and high poverty.</p>
							</li>
							<?php /* ?>
							<li>
								<h4><a href="http://assessment.communitycommons.org/DataReport/">Topic-based Reports</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/DataReport/" class="button">Start a report</a> -->
								<p>Browse and create data reports covering health, education, economic and other factors.</p>
							</li>
							<li>
								<h4><a href="http://assessment.communitycommons.org/footprint/targetarea.aspx">Target Intervention Area Tool</a></h4>
								<!-- <a href="http://assessment.communitycommons.org/DataReport/" class="button">Start a report</a> -->
								<p>Generate a demographic report and prioritize areas for a community health improvement planning process. <br /><a href="/chi-planning">Learn more about using these tools to strengthen community health planning.</a></p>
							</li>
							<?php */ ?>

						</ul>
					</div>
                </div>

        <?php 
		$args = array(
			'taxonomy' => 'data_vis_tool_categories'
		);
		$categories = get_categories( $args );
		//Build a local-scroll-powered nav
		?>
		<ul id="jumplinks" class="clear">
			<h2>Choose a tool by channel</h2>
			<h3>Scroll to a channel:</h3>
			<?php
			foreach ( $categories as $cat ) : ?>
				<li>
					<a href="#<?php echo $cat->slug; ?>" title="Scroll to <?php echo $cat->name; ?> section" class="horizontal-list"><?php echo $cat->name; ?></a>
				</li>
			<?php
			endforeach;		
			?>
		</ul>
		<?php
		if ( function_exists( 'ccdvt_get_tools' ) ) {
			ccdvt_get_tools();
		} else {
			echo 'no function!';
		}
		
		?>
		<?php //comments_template(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

    <?php wp_reset_query(); ?>		

<?php //get_sidebar(); ?>
<?php get_footer(); ?>