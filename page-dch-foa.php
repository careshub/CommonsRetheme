<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

			<div class="content-row" style="margin-bottom:3em;">
				<div class="quarter-block table-cell screamer ccblue aligncenter vertical-centered">Why Map <br class="rwd-break-1000" />Your Community</div>
				<div class="quarter-block table-cell screamer ccred aligncenter vertical-centered">Step-by-step Guide</div>
				<div class="quarter-block table-cell screamer ccyellow aligncenter vertical-centered">Model Map &amp; <br class="rwd-break-1000" />Report Example</div>
				<div class="quarter-block table-cell screamer ccgreen aligncenter vertical-centered"><a href="<?php echo site_url( bp_get_signup_slug() ) ?>">Register for <br class="rwd-break-1000" />the Commons</a></div>

			</div>

			<!-- Achieving Greater Health Equity -->
			<div id="increase-health-equity" class="tool-group accent-blue">
				<header class="entry-header clear">
					<h1 class="entry-title">Achieving Greater Health Equity</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/KC-map-health-equity.jpg" class="attachment-full" alt="Map of health equity for the Kansas City area">
						<p class="tool-group-description">Vulnerable Populations Map Tools</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="How the Tool Can Help">How the Tool <br class="rwd-break-1000" />Can Help</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://staging.maps.communitycommons.org/Footprint/CAR.aspx" title="Vulnerable Populations Tools">Vulnerable Populations Tools</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/vulnerable-populations-tool-tutorials/" title="Tutorial Videos">Tutorial Videos</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Step-by-step Guides">Step-by-step Guides</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>	
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->

		    <!-- Defining Your Target Geography for Intervention -->
			<div id="target-geography" class="tool-group accent-green">
				<header class="entry-header clear">
					<h1 class="entry-title">Defining Your Target Geography for Intervention</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/kc-map-target-geography.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Custom Area Selection Tools</p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="How the Tool Can Help">How the Tool <br class="rwd-break-1000" />Can Help</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://staging.maps.communitycommons.org/Footprint/CAR.aspx" title="Vulnerable Populations Tools">Custom Area <br class="rwd-break-1000" />Selection Tools</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/target-intervention-areas/" title="Tutorial Videos">Tutorials</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Step-by-step Guides">Step-by-step Guides</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>	
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->

		    <!-- Contextual Maps and Community Health Needs Assessment -->
			<div id="contextual-maps" class="tool-group accent-yellow">
				<header class="entry-header clear">
					<h1 class="entry-title">Contextual Maps and Community Health Needs Assessment</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/chattanooga-map-chna.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Data Visualization of Community Context</p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="How the Tool Can Help">Overview</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://maps.communitycommons.org/viewer/" title="Vulnerable Populations Tools">Map My <br class="rwd-break-1000" />Community Context</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://assessment.communitycommons.org/CHNA/" title="Tutorial Videos">Community Indicator Reports</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/mapping-and-reporting-community-context/" title="Step-by-step Guides">Tutorials</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>	
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->

			<!-- Community Stories and Case Examples -->
			<div id="community-stories" class="tool-group accent-red">
				<header class="entry-header clear">
					<h1 class="entry-title">Community Stories and Case Examples</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/walking-on-a-one-way.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Features and Guest Voices</p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="How the Tool Can Help">Healthy Eating</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Vulnerable Populations Tools">Physical Activity</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Tutorial Videos">Built Environment</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Step-by-step Guides">Tobacco</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>	
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->

		    <!-- National Funding Opportunity and Resources -->
			<div id="funding-opportunities" class="tool-group accent-blue">
				<header class="entry-header clear">
					<h1 class="entry-title">National Funding Opportunity and Resources</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/meeting-notes.jpg" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Resource Links</p>
					</div>
				</header>
				<div class="content-row clear">
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="How the Tool Can Help">Call for Proposals</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Vulnerable Populations Tools">Proposal FAQs</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.countyhealthrankings.org/policies" title="Tutorial Videos">RWJF What Works <br class="rwd-break-1000" />for Health</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>
					<div class="tool-group-tool no-description quarter-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="#" title="Step-by-step Guides">Past and Upcoming Webinars</a></h3>
						</header>
						<!-- <div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div> -->
					</div>	
				</div><!-- End .content-row clear -->
		  	    
		    </div> <!-- .tool-group -->


		    
		    
 		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>