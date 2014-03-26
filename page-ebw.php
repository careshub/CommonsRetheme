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

			<!-- EBW! on the Commons -->
			<div id="tool-group-authors" class="tool-group accent-red">
				<header class="entry-header clear">
					<h1 class="entry-title">EBW! on the Commons</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/02/walkability-map.png" class="attachment-full" alt="Map of walkability for the Chicago area">
						<p class="tool-group-description">Explore best practices, innovations, and actions you can take!</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/ebw-feature-stories/" title="Feature Stories about Every Body Walks">Feature Stories</a></h3>
						</header>
						<div class="entry-content">
							<p>Discover how communities are making walking more visible and accessible</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/ebw-guest-voices/" title="Guest Voices">Guest Voices</a></h3>
						</header>
						<div class="entry-content">
							<p>Uncover thought leaders’ perspectives, strategies, and tools</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.communitycommons.org/ebw-case-making-with-maps/" title="Case Making with Maps">Case Making with Maps</a></h3>
						</header>
						<div class="entry-content">
							<p>Map your community assets and opportunities to make your case for change</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->

		    <!-- Every Body Walk!.org -->
			<div id="ebw-website" class="tool-group accent-blue">
				<header class="entry-header clear">
					<h1 class="entry-title">The Campaign To Get America Walking</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear border-ccblue">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/02/ebw_logo.png" class="attachment-full" alt="Logo for Every Body Walk! initiative">
						<p class="tool-group-description">Join the Every Body Walk! Campaign.</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://everybodywalk.org" title="EBW! Home">EBW! Home</a></h3>
						</header>
						<div class="entry-content">
							<p>Access the latest walking news and resources</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="https://www.signup4.net/public/ap.aspx?EID=20133783E&OID=176" title="Walking Summit Archive">Walking Summit Archive</a></h3>
						</header>
						<div class="entry-content">
							<p>Slides and materials from the 2013 Walking Summit</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://www.youtube.com/playlist?list=PLCJ6VvxtwMAy2Sc8S0pAZolzdDqRnZPVT" title="Walking Summit Videos">Walking Summit Videos</a></h3>
						</header>
						<div class="entry-content">
							<p>Watch inspiring presentations from the 2013 Walking Summit</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->

		    <!-- Walking Revolution Documentary -->
			<div id="ebw-website" class="tool-group accent-green">
				<header class="entry-header clear">
					<h1 class="entry-title">Walking Revolution Documentary</h1>
					<div id="tool-group-header-ebw" class="tool-group-header clear">
						<img src="http://www.communitycommons.org/wp-content/uploads/2014/02/walking-revolution-title.png" class="attachment-full" alt="Screen capture of the title screen of &ldquo;The Walking Revolution&rdquo; documentary">
						<p class="tool-group-description">Inspire your community to join the revolution.</p>
					</div>
				</header>
		  	    <div class="content-row clear">
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://everybodywalk.org/documentary.html" title="Trailer and Film">Trailer and Film</a></h3>
						</header>
						<div class="entry-content">
							<p>Watch the documentary film that is guaranteed to get you walking</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://everybodywalk.org/media_assets/ABOUT_THE_WALKING_REVOLUTION_2.pdf" title="About The Walking Revolution">About The Walking Revolution</a></h3>
						</header>
						<div class="entry-content">
							<p>Read a synopsis of what is covered in the documentary film</p>
						</div>
					</div>
					<div class="tool-group-tool third-block">
						<header class="entry-header clear">
							<h3 class="entry-title"><a href="http://everybodywalk.org/media_assets/the_walking_revolution_dialogue_guide.pdf" title="Dialogue Guide">Dialogue Guide</a></h3>
						</header>
						<div class="entry-content">
							<p>Host a screening of the film and spark dialogue around the revolution</p>
						</div>
					</div>			
				</div><!-- End .content-row clear -->
		    </div> <!-- .tool-group -->
		    
 		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>