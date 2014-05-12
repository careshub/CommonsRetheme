<?php
/**
 * Template Name: Grant Writing Page Template
 *
 * Description: Used for the Funding Opportunities Announcement
 *
 *
 * @package WordPress
 * @subpackage CommonsRetheme
 * @since 2.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'compact' ); ?>>

					<header class="entry-header">
						<h1 class="screamer spacious entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php the_content( __( 'Read more', 'twentytwelve' ) ); ?>
					</div><!-- .entry-content -->

					<?php //get_template_part( 'content', 'page' ); ?>
					<?php //comments_template( '', true ); ?>
				</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>

			<!-- <div class="content-row" style="margin-bottom:3em;">
				<div class="third-block table-cell screamer ccblue aligncenter vertical-centered">Why Map <br class="rwd-break-1000" />Your Community</div>
				<div class="third-block table-cell screamer ccred aligncenter vertical-centered">Step-by-step Guide</div>
				<div class="third-block table-cell screamer ccyellow aligncenter vertical-centered">Model Map &amp; <br class="rwd-break-1000" />Report Example</div> 

			</div> -->

		    <!-- Defining Your Target Geography for Intervention -->
			<div id="target-geography" class="tool-group accent-green">
				<header class="entry-header clear">
					<h1 class="entry-title">Step 1: Select Your Target Intervention Area</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/kc-map-target-geography.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Target Intervention Area Tool</p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/target-area-intervention-tool-planning-guide/" title="Why Use This Tool" target="_blank" class="why-use-this-tool">Why Use This Tool</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/target-area-intervention-tool-planning-guide/" title="How the Tool Can Help" target="_blank" class="why-use-this-tool">Review</a> and print the Target Area Tool overview</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/how-to-exercise/" title="How to Use This Tool" target="_blank" class="how-to-use-this-tool">How to Use This Tool</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/how-to-exercise/" title="Step-by-step Guides" target="_blank" class="how-to-use-this-tool">Find</a> step-by-step guides on how to use the Target Intervention Area Tool</p>
						</div>
					</div>	
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://assessment.communitycommons.org/footprint/targetarea.aspx" title="Vulnerable Populations Tools" target="_blank" class="access-target-intervention-area-tool">Access Target Intervention Area Tool</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://assessment.communitycommons.org/footprint/targetarea.aspx" title="Vulnerable Populations Tools" target="_blank" class="access-target-intervention-area-tool">Define</a> your community</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/target-intervention-areas/" title="Tutorial Videos" target="_blank" class="target-intervention-area-tutorial">Tutorial Videos</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/target-intervention-areas/" title="Tutorial Videos" target="_blank" class="target-intervention-area-tutorial">Access</a> training videos on selecting target intervention areas</p>
						</div>
					</div>
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->

			<!-- Community Stories and Case Examples -->
			<div id="explore-target-community" class="tool-group accent-red">
				<header class="entry-header clear">
					<h1 class="entry-title">Step 2: Explore Your Target Community More Broadly</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/walking-on-a-one-way.jpg" class="attachment-full" alt="Image of person walking on the shoulder of a road">
						<p class="tool-group-description">Visualize the conditions impacting health </p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/planning-guide/" title="Why and How to Use Starter Maps" target="_blank">How to Use Provided Map Layers</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/planning-guide/" title="How the Tool Can Help" target="_blank">Review</a> and print an overview and step-by-step guide for mapping community conditions</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/health-equity-starter-maps/" title="How the Tool Can Help" target="_blank">Social Determinants</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/health-equity-starter-maps/" title="How the Tool Can Help" target="_blank">Map</a>  housing and transportation data for your target community</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/active-living-starter-maps/" title="Active Living Starter Maps" target="_blank">Active Living</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/active-living-starter-maps/" title="Active Living Starter Maps" target="_blank">Map</a> parks and walkability data for your target community</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/healthy-eating-starter-maps/" title="Tutorial Videos" target="_blank">Healthy Eating</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/healthy-eating-starter-maps/" title="Tutorial Videos" target="_blank">Map</a> food access data for your target community</p>
						</div>
					</div>
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->

		    <!-- Contextual Maps and Community Health Needs Assessment -->
			<div id="contextual-maps" class="tool-group accent-yellow">
				<header class="entry-header clear">
					<h1 class="entry-title">Community Health Needs Reports and Additional Resources</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/chattanooga-map-chna.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Reporting community needs </p>
					</div>
				</header>
				<div class="content-row clear">
					<!-- <div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="How the Tool Can Help">Overview</a></h3>
						</header>
						<div class="entry-content">
							<p>Access a brief overview of how to use Community Commons maps and data to enhance grant writing.</p>
						</div>
					</div> -->
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://assessment.communitycommons.org/CHNA/SelectArea.aspx?reporttype=libraryCHNA" title="Community Health Needs Assessment" target="_blank">Community Health Needs Reports</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://assessment.communitycommons.org/CHNA/SelectArea.aspx?reporttype=libraryCHNA" title="Community Health Needs Assessment" target="_blank">Create</a> a data report for your target intervention area</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/effective-intervention-strategies/" title="Intervention Strategies" target="_blank">Effective Intervention Strategies</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/effective-intervention-strategies/" title="Intervention Strategies" target="_blank">Explore</a> intervention strategies</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://maps.communitycommons.org/viewer/" title="Community Commons Map Room" target="_blank">Map My <br class="rwd-break-1000" />Community Context</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://maps.communitycommons.org/viewer/" title="Community Commons Map Room" target="_blank">Map</a> your target intervention area with additional community data.</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/mapping-and-reporting-community-context/" title="Step-by-step Guides" target="_blank">Tutorials</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/mapping-and-reporting-community-context/" title="Step-by-step Guides" target="_blank">Access</a> training videos and step-by-step guides on using Community Commons mapping and reporting tools</p>
						</div>
					</div>	
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->

		    <!-- National Funding Opportunity and Resources -->
			<div id="funding-opportunities" class="tool-group accent-blue">
				<header class="entry-header clear">
					<h1 class="entry-title">Resources for Funding Opportunities</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/meeting-notes.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Resource Links</p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/open-proposals/" title="View open proposals" target="_blank">Open Proposals</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/open-proposals/" title="View open proposals" target="_blank">View</a> open calls for proposals</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/grant-support/" title="Frequently Asked Questions" target="_blank">FAQs</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/grant-support/" title="Frequently Asked Questions" target="_blank">Access</a> frequently asked questions about the grant support tools and process</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/archived-webinars/" title="Archived Webinars" target="_blank">Archived Webinars</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/archived-webinars/" title="Archived Webinars" target="_blank">View</a> recordings of past webinars</p>
						</div>
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/upcoming-webinars/" title="Upcoming Webinars" target="_blank">Upcoming Webinars</a></h3>
						</header>
						<div class="entry-content">
							<p><a href="http://www.communitycommons.org/upcoming-webinars/" title="Upcoming Webinars" target="_blank">Enroll</a> in upcoming training opportunities</p>
						</div>
					</div>	
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->


		    
		    
 		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>