<?php
/**
 * Template Name: CHI Journey
 *
 * Used on the 24 journey pages associated with the CHI Hub, but not contained in the CHI Hub.
 */

get_header(); ?>

	<div id="primary" class="site-content chi-journey">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page-screamer' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

			<?php /*
			This navigation select is included on every page of the CHI Journey.
			*/ ?>
			<div class="alignright">
				<select name="navDCH" onchange="navTo(this)">
					<option value="">---Navigate to Page---</option>
					<option value="/groups/chi/chi-journey/">CHI Journey Home</option>
					<option value="/groups/chi/chi-journey/">I. Organize</option>
					<option value="/introduction-check-in-and-evaluate/">        Check In &amp; Evaluate</option>
					<option value="/work-together/">        Work Together</option>
					<option value="/sustain-improvement/">        Sustain Improvement</option>
					<option value="/prioritize-vulnerability/">        Prioritize Vulnerability</option>
					<option value="/groups/chi/chi-journey/">II. Assess Needs &amp; Resources</option>
					<option value="/assess-needs-and-resources-check-in-and-evaluate/">        Check In &amp; Evaluate</option>
					<option value="/community-context/">        Community Context</option>
					<option value="/health-equity/">        Health Equity</option>
					<option value="/ chij-community-health-needs-assessment /">        CHNA Reporting Tool</option>
					<option value="/groups/chi/chi-journey/">III. Focus on What's Important</option>
					<option value="/focus-on-whats-important-check-and-evaluate/">        Check In &amp; Evaluate</option>
					<option value="/data-informed-decisions/">        Data-Informed Decisions</option>
					<option value="/community-engagement/">        Community Engagement</option>
					<option value="/identifying-priorities/">        Identifying Priorities</option>
					<option value="/groups/chi/chi-journey/">IV. Choose Effective Policies &amp; Programs</option>
					<option value="/choose-effective-policies-and-programs-check-in-evaluate/">        Check In &amp; Evaluate</option>
					<option value="/selecting-interventions/">        Selecting Interventions</option>
					<option value="/effective-interventions/">        Effective Interventions</option>
					<option value="/case-studies-and-work-plans/">        Case Studies &amp; Work Plans</option>
					<option value="/groups/chi/chi-journey/">V. Act on What's Important</option>
					<option value="/act-on-whats-important-check-in-evaluate/">        Check In &amp; Evaluate</option>
					<option value="/creating-an-action-plan/">        Creating an Action Plan</option>
					<option value="/activate-act-together/">        Activate &amp; Act Together</option>
					<option value="/case-studies-and-resources/">        Case Studies &amp; Resources</option>
					<option value="/groups/chi/chi-journey/">VI. Evaluate Actions</option>
					<option value="/evaluate-actions-check-in-and-evaluate/">        Check In &amp; Evaluate</option>
					<option value="/continuous-improvement-and-outcomes/">        Monitoring &amp; Evaluation</option>
					<option value="/models-and-resources/">        Case Study &amp; Resources</option>
					<option value="/designing-and-implementing-your-evaluation/">        Designing &amp; Implementing Your Evaluation</option>
				</select>
			</div>

			<script type="text/javascript">
				function navTo(sel) {
					var value = sel.value;
					window.location = value; }
			</script>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>