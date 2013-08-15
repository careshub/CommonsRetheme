<?php

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
	<!-- Quicklinks -->
	<div class="quicklinks clear">
	<a href="http://www.communitycommons.org/wp-content/uploads/2013/07/WOTN-Quickstart-Guide.pdf" class="quarter-block button open-quickstart-modal">Download the Original Series Quickstart Guide</a>
	<a href="http://www.communitycommons.org/wp-content/uploads/2013/08/WOTN-Kids.pdf" class="quarter-block button open-quickstart-kids-modal">Download the Kids' Series Quickstart Guide</a>
	<a href="http://www.communitycommons.org/wotn_sak_form/" class="quarter-block button open-event-submission-modal">Share a Story From Your Event</a>
	<a href="http://www.communitycommons.org/groups/weight-of-the-nation/" class="quarter-block button">Join the Weight of the Nation Group</a>
	</div>
	<!-- VIDEOS -->
	<div id="tool-group-videos" class="tool-group accent-blue">
		<header class="entry-header clear">
			<h1 class="entry-title">Film Resources</h1>
			<div id="tool-group-header-videos" class="tool-group-header clear">
				<img width="600" height="200" src="http://www.communitycommons.org/wp-content/uploads/2013/07/WOTN-film-resources.jpg" class="attachment-full" alt="film resources">
				<p class="tool-group-description">Familiarize yourself with the films.</p>
			</div>
		</header>
  	    <div class="content-row">
			<div class="tool-group-tool quarter-block videos">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://theweightofthenation.hbo.com/films" title="Link to the map tool" rel="bookmark">Download the films</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block videos">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-video-index/" title="Link to the map tool" rel="bookmark"><em>The Weight of the Nation</em>&trade; Film Index and Strategy Guide</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block videos">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-bonus-shorts/" title="Link to the map tool" rel="bookmark"><em>The Weight of the Nation</em>&trade; Bonus Shorts: Themes and Recommendations</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block videos">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-overview-strategies/" title="Link to the map tool" rel="bookmark"><em>The Weight of the Nation for Kids</em> Film Overviews and Strategies</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
		</div><!-- End .content-row -->

  </div>
  <!-- PLANNING -->
  <div id="tool-group-planning" class="tool-group  accent-yellow">
		<header class="entry-header clear">
			<h1 class="entry-title">Event Resources</h1>
			<div id="tool-group-header-planning" class="tool-group-header clear">
				<img width="600" height="200" src="http://www.communitycommons.org/wp-content/uploads/2013/07/meeting-hand-w-pen.jpg" class="attachment-full" alt="book-brigade-600x200">
				<p class="tool-group-description">Plan your Screening to Action event.</p>
			</div>
		</header>
  	    <div class="content-row">
			<div class="tool-group-tool quarter-block planning">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-planning/" title="Link to the map tool" rel="bookmark">Planning Guide</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block planning">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-facilitator-tips/" title="Link to the map tool" rel="bookmark">Facilitator Tips</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block planning">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-room/" title="Link to the map tool" rel="bookmark">Room Set Up and Equipment</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block planning">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-agendas/" title="Link to the map tool" rel="bookmark">Screening to Action Agendas</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
		</div><!-- End .content-row -->

  </div>
  <!-- MOVING TO ACTION -->
  <div id="tool-group-moving-to-action" class="tool-group  accent-red">
		<header class="entry-header clear">
			<h1 class="entry-title">Action Resources</h1>
			<div id="tool-group-header-planning" class="tool-group-header clear">
				<img width="600" height="200" src="http://www.communitycommons.org/wp-content/uploads/2013/07/WOTN-action-resources.jpg" class="attachment-full" alt="Moving to action">
				<p class="tool-group-description">Move to Action.</p>
			</div>
		</header>
  	    <div class="content-row">
			<div class="tool-group-tool quarter-block moving-to-action">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-moving-to-action/" title="Link to the map tool" rel="bookmark"><em>The Weight of the Nation</em>&trade; Moving to Action Resources</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block moving-to-action">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-kids-moving-action" title="Link to the map tool" rel="bookmark"><em>The Weight of the Nation for Kids</em> Moving to Action Resources</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block moving-to-action">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/community-activation-kit/" title="Link to the map tool" rel="bookmark">Community Activation Kit</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block moving-to-action">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://initiatives.communitycommons.org/connect/MapOftheMovement.aspx" title="Link to the map tool" rel="bookmark">Find Local Partners</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
		</div><!-- End .content-row -->

  </div>
  <!-- ADDITIONAL RESOURCES -->
  <div id="tool-group-wotn-resources" class="tool-group accent-green">
		<header class="entry-header clear">
			<h1 class="entry-title">Additional Resources</h1>
			<div id="tool-group-header-wotn-resources" class="tool-group-header clear">
				<img width="600" height="200" src="http://www.communitycommons.org/wp-content/uploads/2013/07/WOTN-Additional-resources.png" class="attachment-full" alt="Additional resources">
				<p class="tool-group-description">Accelerate your progress.</p>
			</div>
		</header>
  	    <div class="content-row">
			<div class="tool-group-tool quarter-block wotn-resources">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-reports/" title="Link to the map tool" rel="bookmark">National Reports</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block wotn-resources">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-youth-facts/" title="Link to the map tool" rel="bookmark"><em>The Weight of the Nation for Kids</em> Youth Health Facts</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block wotn-resources">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://www.communitycommons.org/wotn-maps-support/" title="Link to the map tool" rel="bookmark">Maps to Support Screening to Action</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
			<div class="tool-group-tool quarter-block wotn-resources">
				<header class="entry-header clear">
					<h3 class="entry-title"><a href="http://assessment.communitycommons.org/DataReport/" title="Link to the map tool" rel="bookmark">Data to Support Screening to Action</a></h3>
				</header>
				<!-- <div class="entry-content">
					<p>This should be short but will probably be longer than I expect. You know?</p>
				</div> -->
			</div>
		</div><!-- End .content-row -->

  </div>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php 
		$home_url = get_home_url();
			switch ($home_url) {
				case 'http://commonsdev.local':
					$id_kids = 3;
					$id_adult = 7;
					$id_event = 8;
					break;
				case 'http://www.communitycommons.org':
					$id_kids = 8;
					$id_adult = 7;
					$id_event = 3;
					break;
				case 'http://dev.communitycommons.org':
					$id_kids = 9;
					$id_adult = 8;
					$id_event = 11;
					break;
				default:
					# code...
					break;
				}
	?>
	<div id="wotn-quickstart-kids-modal" class="modal-content" style="">
		<?php echo do_shortcode( '[gravityform id="' . $id_kids . '" name="Weight of the Nation for Kids Quickstart Guide Support"]' ); ?>
		<?php //if function_exists('gravity_form') 
		// 		gravity_form(9, true, true, false, '', false); ?>
	</div>
	<div id="wotn-quickstart-modal" class="modal-content" style="">
		<?php echo do_shortcode( '[gravityform id="' . $id_adult . '" name="Weight of the Nation Quickstart Guide Support"]' ); ?>
		<?php //if function_exists('gravity_form') 
				//gravity_form(8, true, true, false, '', false); ?>
	</div>
	<div id="wotn-event-submission-modal" class="modal-content" style="">
	<?php 
		//Get the right form IDs
		//echo do_shortcode( '[gravityform id="' . $id_event . '" name="Weight of the Nation: Screening to Action-Quickstart Guide Event Submission" ajax="true"]' ); 
		?>
	</div>

	<script type="text/javascript">
	jQuery(function () {
		  // Load modal dialog on click
		  jQuery('.open-quickstart-kids-modal').click(function (k) {
		    jQuery('#wotn-quickstart-kids-modal').modal({overlayClose:true, minHeight:500});
		    return false;
		  });
		  jQuery('.open-quickstart-modal').click(function (g) {
		    jQuery('#wotn-quickstart-modal').modal({overlayClose:true, minHeight:500});
		    return false;
		  });
		  //This form is too large to work in a modal
		  // jQuery('.open-event-submission-modal').click(function (u) {
		  //   jQuery('#wotn-event-submission-modal').modal({overlayClose:true, minHeight:500});
		  //   return false;
		  // });
		});
	</script>

<?php get_footer(); ?>