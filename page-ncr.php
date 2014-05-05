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

			<!-- NCR Authors on the Commons -->
			<div id="tool-group-authors" class="tool-group accent-green">
				<header class="entry-header clear">
					<h1 class="entry-title">NCR Authors on the Commons</h1>
					<div id="tool-group-header-videos" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/02/NCR-Liberty-bell-600x200.jpg" class="attachment-full" alt="Photo of the Liberty Bell">
						<p class="tool-group-description">Connect with Movement Leaders</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block authors">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/2014/01/national-civic-review/" title="Welcome from Monte Roulier">Welcome by Monte Roulier</a></h3>
						</header>
						<div class="entry-content">
							<p>Read about the partnership between Community Commons and the National Civic League</p>
						</div>
					</div>
					<div class="tool-group-tool third-block guest-voices">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/ncr-guest-voices/" title="Guest Voices">Guest Voices</a></h3>
						</header>
						<div class="entry-content">
							<p>Engage with others on the ideas behind the Healthy Communities Movement</p>
						</div>
					</div>
					<div class="tool-group-tool third-block feature-stories">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/ncr-features-stories/" title="Featured Stories">Feature Stories</a></h3>
						</header>
						<div class="entry-content">
							<p>Discover what the Healthy Communities Movement looks like around the country</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->
		    <!-- NCR Special Issue Part 1 -->
			<div id="tool-group-ncr-special-issue" class="tool-group accent-red">
				<header class="entry-header clear">
					<h1 class="entry-title">NCR Special Issue Part 1</h1>
					<div id="tool-group-header-videos" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/02/NCR-tyler-600x200.jpg" class="attachment-full" alt="Photo of Tyler Norris">
						<p class="tool-group-description">Explore NCR’s Special Issue 1</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block authors">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://onlinelibrary.wiley.com/doi/10.1002/ncr.21142/full" title="Introduction by Tyler Norris">Introduction by Tyler Norris</a></h3>
						</header>
						<div class="entry-content">
							<p>Read Tyler’s framework of the themes presented in the articles</p>
						</div>
					</div>
					<div class="tool-group-tool third-block guest-voices">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/ncr-table-of-contents-with-synopses/" title="Table of Contents">Table of Contents <br class="rwd-break-1000" />with Synopses</a></h3>
						</header>
						<div class="entry-content">
							<p>Browse the titles and an overview of each article</p>
						</div>
					</div>
					<div class="tool-group-tool third-block feature-stories">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://onlinelibrary.wiley.com/doi/10.1002/ncr.v102.4/issuetoc" title="Link to the National Civic Review's site">National Civic Review <br class="rwd-break-1000" />Online Publication</a></h3>
						</header>
						<div class="entry-content">
							<p>Access individual abstracts, articles, and citations for Special Issue 1</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
			</div>
			<!-- NCR Special Issue Part 2 -->
			<div id="tool-group-spec-issue-2" class="tool-group accent-yellow">
				<header class="entry-header clear">
					<h1 class="entry-title">NCR Special Issue Part 2</h1>
					<div id="tool-group-header-aac" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/04/NCR-video-still-shot-b.jpg" class="attachment-full" alt="A still from a video produced by the National Civic Review">
						<p class="tool-group-description">Examine NCR's Special Issue 2</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.allamericacityaward.com/2014/04/28/25-years-of-healthy-communities-part-ii/" title="Introduction by Mike McGrath">Introduction by Mike McGrath</a></h3>
						</header>
						<div class="entry-content">
							<p>Read the editor’s comments about this second issue on healthy communities</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/table-of-contents-with-synopsis-part-2/" title="Table of Contents with Synopses">Table of Contents <br class="rwd-break-1000" />with Synopses</a></h3>
						</header>
						<div class="entry-content">
							<p>Browse the titles and an overview of each article</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://onlinelibrary.wiley.com/doi/10.1002/ncr.v103.1/issuetoc" title="National Civic Review Online Publication">National Civic Review <br class="rwd-break-1000" />Online Publication</a></h3>
						</header>
						<div class="entry-content">
							<p>Access individual abstracts, articles, and citations for Special Issue 2</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->

		    <?php /* ?><div id="tool-group-aac-award" class="tool-group accent-yellow">
				<header class="entry-header clear">
					<h1 class="entry-title">NCR: All-America City Award</h1>
					<div id="tool-group-header-aac" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/02/NCR-All-America-City-600x200.jpg" class="attachment-full" alt="National Civic Review All-America City logo">
						<p class="tool-group-description">Become an All-America City.</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block authors">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.ncl.org/index.php?option=com_content&view=article&id=102&Itemid=179" title="Background Information">Background Information</a></h3>
						</header>
						<div class="entry-content">
							<p>Learn about the deep and distinguished history of the awards</p>
						</div>
					</div>
					<div class="tool-group-tool third-block aac-2014">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.ncl.org/index.php?option=com_content&view=article&id=186&Itemid=226" title="All-America cities 2014">All-America Cities 2014</a></h3>
						</header>
						<div class="entry-content">
							<p>Explore what it takes to become an All-America City</p>
						</div>
					</div>
					<div class="tool-group-tool third-block aac-application">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.ncl.org/index.php?option=com_jforms&view=form&id=2&Itemid=196" title="All-America City Application">Application</a></h3>
						</header>
						<div class="entry-content">
							<p>Access the application materials and begin your journey</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->
		    <?php */ ?>
 		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>