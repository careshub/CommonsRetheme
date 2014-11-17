<?php
/*
Template Name: CDC-DCH Checklists
*/

get_header(); 


?>

	<div id="primary" class="site-content" style="width:100%;">
		<div id="content" role="main">
			<div class="entry-content">
			<?php 
			cc_cdcdch_checklists();
			
			while ( have_posts() ) : the_post(); ?>
				
				
			<?php endwhile; // end of the loop. ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>
<?php
function cc_cdcdch_checklists() {
if ( is_user_logged_in() ) {	 
	$current_user = wp_get_current_user();
	$uid = $current_user->ID;
?>
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
			<style type="text/css">
				.tabhead {
					font-weight:bold;
				}
				.subcats {
					font-weight:bold;
				}
				.ui-widget {
					font-family: "Open Sans", Helvetica, Arial, sans-serif;
				}
			</style>
	
		<?php			
		if ( is_page('introduction-check-in-and-evaluate') ) {
		
			//Check if post exists by title using uid	
			$the_slug = $uid . '_cdcdch_checklist_intro';
			$args=array(
			  'name' => $the_slug,
			  'post_type' => 'cdcdch_checklist',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);			
			$custom_fields = get_post_custom($my_posts[0]->ID);
			
		
				
		
		?>
		<div id="intro">
					<form id="cdcdch_checklist_intro_form" class="standard-form" method="post" action="/cdcdch-checklist-processing/">
					<header class="entry-header">
						<h1 class="entry-title screamer spacious">Introduction: Check-In & Evaluate</h1>
					</header>					
					<table>
						<thead>
							<tr>
								<td style="text-align:center; width:60%;font-weight:bold;">
									Strategy
								</td>
								<td style="text-align:center;font-weight:bold;">
									Strongly Agree
								</td>
								<td style="text-align:center;font-weight:bold;">
									Agree
								</td>
								<td style="text-align:center;font-weight:bold;">
									Disagree
								</td>
								<td style="text-align:center;font-weight:bold;">
									Strongly Disagree
								</td>							
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="5" class="subcats">
									Using Indicators (e.g., Heart Disease, Obesity, Diabetes) to Inform Geographic Boundaries
								</td>
							</tr>
							<tr>
								<td>
									Coalition has a sense for which indicators are important to key stakeholders and community members.  
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define1" value="4" <?php if( $custom_fields['define1'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define1" value="3" <?php if( $custom_fields['define1'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define1" value="2" <?php if( $custom_fields['define1'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define1" value="1" <?php if( $custom_fields['define1'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
							<tr>
								<td>
									Indicators are identified through multiple data sources and reports.  
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define2" value="4" <?php if( $custom_fields['define2'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define2" value="3" <?php if( $custom_fields['define2'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define2" value="2" <?php if( $custom_fields['define2'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define2" value="1" <?php if( $custom_fields['define2'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
							<tr>
								<td>
									Target area has a prevalence of indicators falling below the national average.  
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define3" value="4" <?php if( $custom_fields['define3'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define3" value="3" <?php if( $custom_fields['define3'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define3" value="2" <?php if( $custom_fields['define3'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define3" value="1" <?php if( $custom_fields['define3'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
							<tr>
								<td>
									Indicators selected are considered important to multiple sectors and people in the target area.  
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define4" value="4" <?php if( $custom_fields['define4'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define4" value="3" <?php if( $custom_fields['define4'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define4" value="2" <?php if( $custom_fields['define4'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define4" value="1" <?php if( $custom_fields['define4'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>		
							<tr>
								<td colspan="5" class="subcats">
									Identification of Areas Experiencing the Highest Need 
								</td>
							</tr>
							<tr>
								<td>
									Data on social determinants of health are used to identify vulnerable populations within the targeted area. 
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define5" value="4" <?php if( $custom_fields['define5'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define5" value="3" <?php if( $custom_fields['define5'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define5" value="2" <?php if( $custom_fields['define5'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define5" value="1" <?php if( $custom_fields['define5'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
							<tr>
								<td>
									Stakeholders agree on the areas and populations of focus.
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define6" value="4" <?php if( $custom_fields['define6'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define6" value="3" <?php if( $custom_fields['define6'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define6" value="2" <?php if( $custom_fields['define6'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define6" value="1" <?php if( $custom_fields['define6'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
							<tr>
								<td colspan="5" class="subcats">
									Multi-Sector Collaboration
								</td>
							</tr>
							<tr>
								<td>
									Multiple sectors are represented in the coalition. 
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define7" value="4" <?php if( $custom_fields['define7'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define7" value="3" <?php if( $custom_fields['define7'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define7" value="2" <?php if( $custom_fields['define7'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define7" value="1" <?php if( $custom_fields['define7'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
							<tr>
								<td>
									Coalition is convened regularly and every member has an opportunity to weigh in on the agenda. 
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define8" value="4" <?php if( $custom_fields['define8'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define8" value="3" <?php if( $custom_fields['define8'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define8" value="2" <?php if( $custom_fields['define8'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define8" value="1" <?php if( $custom_fields['define8'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>	
							<tr>
								<td colspan="5" class="subcats">
									Community Fits the Needs of Key Stakeholders
								</td>
							</tr>	
							<tr>
								<td>
									Key stakeholders agree on the area selected to define the community, and the area is one in which they are currently providing services.
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define9" value="4" <?php if( $custom_fields['define9'][0] == "4") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define9" value="3" <?php if( $custom_fields['define9'][0] == "3") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define9" value="2" <?php if( $custom_fields['define9'][0] == "2") echo 'checked="checked"'; ?> />
								</td>
								<td style="text-align:center;">
									<input type="radio" name="define9" value="1" <?php if( $custom_fields['define9'][0] == "1") echo 'checked="checked"'; ?> />
								</td>							
							</tr>
						</tbody>						
					</table>
			<br />
			<div style="width:100%;text-align:center;">
				<input type="submit" id="submit_cdcdch_checklist_intro" value="Save your Answers" name="submit_cdcdch_checklist_intro" style="font-size:16pt;" />
				<br /><a href="javascript:window.print()">Print This Page</a>
			</div>		
			</form>
			
		</div>
			
			
<?php 
}


if ( is_page('assess-needs-and-resources-check-in-and-evaluate') ) {
			//Check if post exists by title using uid	
			$the_slug = $uid . '_cdcdch_checklist_assess';
			$args=array(
			  'name' => $the_slug,
			  'post_type' => 'cdcdch_checklist',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);			
			$custom_fields = get_post_custom($my_posts[0]->ID);
			

?>
					<form id="cdcdch_checklist_assess_form" class="standard-form" method="post" action="/cdcdch-checklist-processing/">
					<header class="entry-header">
						<h1 class="entry-title screamer spacious">Assess Needs and Resources: Check-In & Evaluate</h1>
					</header>
					<table>
						<thead>
						<tr>
							<td style="text-align:center; width:60%;font-weight:bold;">
								Strategy
							</td>
							<td style="text-align:center;font-weight:bold;">
								Strongly Agree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Agree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Disagree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Strongly Disagree
							</td>							
						</tr>
						</thead>
						<tbody>
						<tr>
							<td colspan="5" class="subcats">
								Developing a Community Health Needs Assessment (CHNA) 
							</td>
						</tr>
						<tr>
							<td>
								Multiple data-gathering techniques were used in the CHNA (surveys, focus groups, interviews, etc.).
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess1" value="4" <?php if( $custom_fields['assess1'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess1" value="3" <?php if( $custom_fields['assess1'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess1" value="2" <?php if( $custom_fields['assess1'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess1" value="1" <?php if( $custom_fields['assess1'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Data for the CHNA were gathered from multiple sources.   
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess2" value="4" <?php if( $custom_fields['assess2'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess2" value="3" <?php if( $custom_fields['assess2'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess2" value="2" <?php if( $custom_fields['assess2'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess2" value="1" <?php if( $custom_fields['assess2'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition developed a comprehensive list of health and economic indicators for the target population. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess3" value="4" <?php if( $custom_fields['assess3'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess3" value="3" <?php if( $custom_fields['assess3'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess3" value="2" <?php if( $custom_fields['assess3'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess3" value="1" <?php if( $custom_fields['assess3'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition discussed the health indicators most important to the stakeholders.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess4" value="4" <?php if( $custom_fields['assess4'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess4" value="3" <?php if( $custom_fields['assess4'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess4" value="2" <?php if( $custom_fields['assess4'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess4" value="1" <?php if( $custom_fields['assess4'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition discussed the health goals of the community. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess5" value="4" <?php if( $custom_fields['assess5'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess5" value="3" <?php if( $custom_fields['assess5'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess5" value="2" <?php if( $custom_fields['assess5'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess5" value="1" <?php if( $custom_fields['assess5'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition developed a comprehensive list community assets.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess6" value="4" <?php if( $custom_fields['assess6'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess6" value="3" <?php if( $custom_fields['assess6'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess6" value="2" <?php if( $custom_fields['assess6'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess6" value="1" <?php if( $custom_fields['assess6'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition mapped the assets onto the target geographic area. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess7" value="4" <?php if( $custom_fields['assess7'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess7" value="3" <?php if( $custom_fields['assess7'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess7" value="2" <?php if( $custom_fields['assess7'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess7" value="1" <?php if( $custom_fields['assess7'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>				
						<tr>
							<td colspan="5" class="subcats">
								Transparency and Sharing
							</td>
						</tr>
						<tr>
							<td>
								Coalition shared results of data mining and CHNA with stakeholders and community members.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess8" value="4" <?php if( $custom_fields['assess8'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess8" value="3" <?php if( $custom_fields['assess8'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess8" value="2" <?php if( $custom_fields['assess8'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess8" value="1" <?php if( $custom_fields['assess8'][0] == "1") echo 'checked="checked"'; ?>/>
							</td>							
						</tr>
						<tr>
							<td>
								Coalition and community had an opportunity to discuss CHNA findings. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess9" value="4" <?php if( $custom_fields['assess9'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess9" value="3" <?php if( $custom_fields['assess9'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess9" value="2" <?php if( $custom_fields['assess9'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="assess9" value="1" <?php if( $custom_fields['assess9'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>	
						</tbody>
					</table>
			<br />
			<div style="width:100%;text-align:center;">
				<input type="submit" id="submit_cdcdch_checklist_assess" value="Save your Answers" name="submit_cdcdch_checklist_assess" style="font-size:16pt;" />
				<br /><a href="javascript:window.print()">Print This Page</a>
			</div>	
			</form>
				
<?php 
}
if ( is_page('focus-on-whats-important-check-and-evaluate') ) {
			//Check if post exists by title using uid	
			$the_slug = $uid . '_cdcdch_checklist_focus';
			$args=array(
			  'name' => $the_slug,
			  'post_type' => 'cdcdch_checklist',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);			
			$custom_fields = get_post_custom($my_posts[0]->ID);
?>

					<form id="cdcdch_checklist_focus_form" class="standard-form" method="post" action="/cdcdch-checklist-processing/">
					<header class="entry-header">
						<h1 class="entry-title screamer spacious">Focus on What's Important: Check-In & Evaluate</h1>
					</header>
					<table>
						<thead>
						<tr>
							<td style="text-align:center;width:60%;font-weight:bold;">
								Strategy
							</td>
							<td style="text-align:center;font-weight:bold;">
								Strongly Agree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Agree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Disagree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Strongly Disagree
							</td>							
						</tr>
						</thead>
						<tbody>
						<tr>
							<td colspan="5" class="subcats">
								Establish Criteria for Setting Priorities
							</td>
						</tr>
						<tr>
							<td>
								Coalition considered how many people were impacted (magnitude) when selecting the priority areas.  
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus1" value="4" <?php if( $custom_fields['focus1'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus1" value="3" <?php if( $custom_fields['focus1'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus1" value="2" <?php if( $custom_fields['focus1'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus1" value="1" <?php if( $custom_fields['focus1'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition considered how life threatening (severity) the problems were when selecting the priority areas.  
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus2" value="4" <?php if( $custom_fields['focus2'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus2" value="3" <?php if( $custom_fields['focus2'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus2" value="2" <?php if( $custom_fields['focus2'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus2" value="1" <?php if( $custom_fields['focus2'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								The selected priority areas are important to the community. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus3" value="4" <?php if( $custom_fields['focus3'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus3" value="3" <?php if( $custom_fields['focus3'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus3" value="2" <?php if( $custom_fields['focus3'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus3" value="1" <?php if( $custom_fields['focus3'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition considered the impact of the priority areas on vulnerable populations.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus4" value="4" <?php if( $custom_fields['focus4'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus4" value="3" <?php if( $custom_fields['focus4'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus4" value="2" <?php if( $custom_fields['focus4'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus4" value="1" <?php if( $custom_fields['focus4'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Human and financial resources are available to affect/change these priority areas.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus5" value="4" <?php if( $custom_fields['focus5'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus5" value="3" <?php if( $custom_fields['focus5'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus5" value="2" <?php if( $custom_fields['focus5'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus5" value="1" <?php if( $custom_fields['focus5'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Interventions/strategies exist that can affect/change these problems. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus6" value="4" <?php if( $custom_fields['focus6'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus6" value="3" <?php if( $custom_fields['focus6'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus6" value="2" <?php if( $custom_fields['focus6'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus6" value="1" <?php if( $custom_fields['focus6'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>	
						<tr>
							<td colspan="5" class="subcats">
								Identify Priorities
							</td>
						</tr>
						<tr>
							<td>
								Coalition used a CHNA for identifying the priorities. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus7" value="4" <?php if( $custom_fields['focus7'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus7" value="3" <?php if( $custom_fields['focus7'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus7" value="2" <?php if( $custom_fields['focus7'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus7" value="1" <?php if( $custom_fields['focus7'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td colspan="5" class="subcats">
								Validate Priorities
							</td>
						</tr>
						<tr>
							<td>
								The right sectors, stakeholders and community members were involved in selecting priority areas. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus8" value="4" <?php if( $custom_fields['focus8'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus8" value="3" <?php if( $custom_fields['focus8'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus8" value="2" <?php if( $custom_fields['focus8'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus8" value="1" <?php if( $custom_fields['focus8'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>		
						<tr>
							<td>
								All voices and positions were heard and people discussed conflicts. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus9" value="4" <?php if( $custom_fields['focus9'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus9" value="3" <?php if( $custom_fields['focus9'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus9" value="2" <?php if( $custom_fields['focus9'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus9" value="1" <?php if( $custom_fields['focus9'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition came to an agreement on which areas to prioritize.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus10" value="4" <?php if( $custom_fields['focus10'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus10" value="3" <?php if( $custom_fields['focus10'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus10" value="2" <?php if( $custom_fields['focus10'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="focus10" value="1" <?php if( $custom_fields['focus10'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						</tbody>						
					</table>
			<br />
			<div style="width:100%;text-align:center;">
				<input type="submit" id="submit_cdcdch_checklist_focus" value="Save your Answers" name="submit_cdcdch_checklist_focus" style="font-size:16pt;" />
				<br /><a href="javascript:window.print()">Print This Page</a>
			</div>	
			</form>
<?php 
}
if ( is_page('choose-effective-policies-and-programs-check-in-evaluate') ) {
			//Check if post exists by title using uid	
			$the_slug = $uid . '_cdcdch_checklist_choose';
			$args=array(
			  'name' => $the_slug,
			  'post_type' => 'cdcdch_checklist',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);			
			$custom_fields = get_post_custom($my_posts[0]->ID);
?>
					<form id="cdcdch_checklist_choose_form" class="standard-form" method="post" action="/cdcdch-checklist-processing/">
					<header class="entry-header">
						<h1 class="entry-title screamer spacious">Choose Effective Policies and Programs: Check-In & Evaluate</h1>
					</header>
					<table>
						<thead>
						<tr>
							<td style="text-align:center;width:60%;font-weight:bold;">
								Strategy
							</td>
							<td style="text-align:center;font-weight:bold;">
								Strongly Agree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Agree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Disagree
							</td>
							<td style="text-align:center;font-weight:bold;">
								Strongly Disagree
							</td>							
						</tr>
						</thead>
						<tbody>
						<tr>
							<td colspan="5" class="subcats">
								Identifying Human and Financial 
							</td>
						</tr>
						<tr>
							<td>
								Coalition identified human and financial resources available in targeted area.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose1" value="4" <?php if( $custom_fields['choose1'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose1" value="3" <?php if( $custom_fields['choose1'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose1" value="2" <?php if( $custom_fields['choose1'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose1" value="1" <?php if( $custom_fields['choose1'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition identified human and financial resources needed for CHI interventions. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose2" value="4" <?php if( $custom_fields['choose2'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose2" value="3" <?php if( $custom_fields['choose2'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose2" value="2" <?php if( $custom_fields['choose2'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose2" value="1" <?php if( $custom_fields['choose2'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition considered additional partners that could assist in implementation of intervention(s) by adding to human and financial resources.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose3" value="4" <?php if( $custom_fields['choose3'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose3" value="3" <?php if( $custom_fields['choose3'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose3" value="2" <?php if( $custom_fields['choose3'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose3" value="1" <?php if( $custom_fields['choose3'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>	
						<tr>
							<td colspan="5" class="subcats">
								Determining Indicators to Address
							</td>
						</tr>	
						<tr>
							<td>
								Social determinants of health were utilized to determine which indicators can be addressed by the intervention.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose4" value="4" <?php if( $custom_fields['choose4'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose4" value="3" <?php if( $custom_fields['choose4'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose4" value="2" <?php if( $custom_fields['choose4'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose4" value="1" <?php if( $custom_fields['choose4'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Data were examined and collected to determine the geographical areas to place interventions to reduce health disparities.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose5" value="4" <?php if( $custom_fields['choose5'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose5" value="3" <?php if( $custom_fields['choose5'][0] == "3") echo 'checked="checked"'; ?>/>
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose5" value="2" <?php if( $custom_fields['choose5'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose5" value="1" <?php if( $custom_fields['choose5'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>	
						<tr>
							<td colspan="5" class="subcats">
								Evidence-Based Interventions
							</td>
						</tr>	
						<tr>
							<td>
								Selected interventions are effective at achieving desired outcome(s). 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose6" value="4" <?php if( $custom_fields['choose6'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose6" value="3" <?php if( $custom_fields['choose6'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose6" value="2" <?php if( $custom_fields['choose6'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose6" value="1" <?php if( $custom_fields['choose6'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>	
						<tr>
							<td colspan="5" class="subcats">
								Community Engagement
							</td>
						</tr>
						<tr>
							<td>
								Coalition involved members from diverse sectors and communities in selecting interventions.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose7" value="4" <?php if( $custom_fields['choose7'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose7" value="3" <?php if( $custom_fields['choose7'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose7" value="2" <?php if( $custom_fields['choose7'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose7" value="1" <?php if( $custom_fields['choose7'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Selected interventions address priority issues for the community.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose8" value="4" <?php if( $custom_fields['choose8'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose8" value="3" <?php if( $custom_fields['choose8'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose8" value="2" <?php if( $custom_fields['choose8'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose8" value="1" <?php if( $custom_fields['choose8'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Coalition implemented specific processes to make community participation and involvement easier.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose9" value="4" <?php if( $custom_fields['choose9'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose9" value="3" <?php if( $custom_fields['choose9'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose9" value="2" <?php if( $custom_fields['choose9'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose9" value="1" <?php if( $custom_fields['choose9'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>		
						<tr>
							<td colspan="5" class="subcats">
								Cultural Tailoring of Interventions 
							</td>
						</tr>		
						<tr>
							<td>
								Coalition developed a process to tailor interventions to have the most impact on populations most affected. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose10" value="4" <?php if( $custom_fields['choose10'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose10" value="3" <?php if( $custom_fields['choose10'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose10" value="2" <?php if( $custom_fields['choose10'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose10" value="1" <?php if( $custom_fields['choose10'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Interventions are culturally appropriate for audience being targeted.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose11" value="4" <?php if( $custom_fields['choose11'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose11" value="3" <?php if( $custom_fields['choose11'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose11" value="2" <?php if( $custom_fields['choose11'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose11" value="1" <?php if( $custom_fields['choose11'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>	
						<tr>
							<td colspan="5" class="subcats">
								Monitoring and Evaluation 
							</td>
						</tr>	
						<tr>
							<td>
								Coalition identified the key outcomes and related activities that should result from the implementation of the interventions.
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose12" value="4" <?php if( $custom_fields['choose12'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose12" value="3" <?php if( $custom_fields['choose12'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose12" value="2" <?php if( $custom_fields['choose12'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose12" value="1" <?php if( $custom_fields['choose12'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>
						<tr>
							<td>
								Interventions fit the data needs of the key stakeholders and the community’s goals and priority populations. 
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose13" value="4" <?php if( $custom_fields['choose13'][0] == "4") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose13" value="3" <?php if( $custom_fields['choose13'][0] == "3") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose13" value="2" <?php if( $custom_fields['choose13'][0] == "2") echo 'checked="checked"'; ?> />
							</td>
							<td style="text-align:center;">
								<input type="radio" name="choose13" value="1" <?php if( $custom_fields['choose13'][0] == "1") echo 'checked="checked"'; ?> />
							</td>							
						</tr>		
						</tbody>
					</table>

			<br />
			<div style="width:100%;text-align:center;">
				<input type="submit" id="submit_cdcdch_checklist_choose" value="Save your Answers" name="submit_cdcdch_checklist_choose" style="font-size:16pt;" />
				<br /><a href="javascript:window.print()">Print This Page</a>
			</div>
			</form>
	  <?php
			
	 }
	 if (is_page('cdcdch-checklist-processing')) {
			if (isset( $_POST['submit_cdcdch_checklist_intro'] )) {			
				$the_slug = $uid . '_cdcdch_checklist_intro';
				$args=array(
				  'name' => $the_slug,
				  'post_type' => 'cdcdch_checklist',
				  'post_status' => 'publish',
				  'numberposts' => 1
				);
				$my_posts = get_posts($args);			
			
				$checklist_id;		
				
				if ( $my_posts ) {
					$checklist_id = $my_posts[0]->ID;				 
					//print_r('EXIST');
				} else {
					$post = array(
					  'post_name'      => $uid . '_cdcdch_checklist_intro',
					  'post_title'     => $uid . '_cdcdch_checklist_intro',
					  'post_status'    => 'publish',
					  'post_type'      => 'cdcdch_checklist',
					  'post_author'	=> $uid	
					);		
					$checklist_id = wp_insert_post( $post );
					add_post_meta($checklist_id, 'checklist_type', 'intro');
				}
			
				$answer_fields = array(
						'define1', 
						'define2',
						'define3',
						'define4',
						'define5',
						'define6',
						'define7',
						'define8',
						'define9'				
					);	
				foreach ( $answer_fields as $f ) {
					if (isset($_POST[$f])) {
						if ( ( $_POST[$f] == '-1' ) || (  $_POST[$f] == "" ) ) { //defaults for selects
							delete_post_meta($checklist_id, $f);
						} else {
							update_post_meta( $checklist_id, $f, $_POST[$f] );
						}
					}
				}
			}
			if (isset( $_POST['submit_cdcdch_checklist_assess'] )) {			
				//Check if post exists by title using uid	
				$the_slug = $uid . '_cdcdch_checklist_assess';
				$args=array(
				  'name' => $the_slug,
				  'post_type' => 'cdcdch_checklist',
				  'post_status' => 'publish',
				  'numberposts' => 1
				);
				$my_posts = get_posts($args);			
				$checklist_id;		
				
				if ( $my_posts ) {
					$checklist_id = $my_posts[0]->ID;				 
					//print_r('EXIST');
				} else {
					$post = array(
					  'post_name'      => $uid . '_cdcdch_checklist_assess',
					  'post_title'     => $uid . '_cdcdch_checklist_assess',
					  'post_status'    => 'publish',
					  'post_type'      => 'cdcdch_checklist',
					  'post_author'	=> $uid	
					);		
					$checklist_id = wp_insert_post( $post );
					add_post_meta($checklist_id, 'checklist_type', 'assess');
				}
			
				$answer_fields = array(
						'assess1', 
						'assess2',
						'assess3',
						'assess4',
						'assess5',
						'assess6',
						'assess7',
						'assess8',
						'assess9'				
					);	
				foreach ( $answer_fields as $f ) {
					if (isset($_POST[$f])) {
						if ( ( $_POST[$f] == '-1' ) || (  $_POST[$f] == "" ) ) { //defaults for selects
							delete_post_meta($checklist_id, $f);
						} else {
							update_post_meta( $checklist_id, $f, $_POST[$f] );
						}
					}
				}	
			}		
			if (isset( $_POST['submit_cdcdch_checklist_focus'] )) {			
				//Check if post exists by title using uid	
				$the_slug = $uid . '_cdcdch_checklist_focus';
				$args=array(
				  'name' => $the_slug,
				  'post_type' => 'cdcdch_checklist',
				  'post_status' => 'publish',
				  'numberposts' => 1
				);
				$my_posts = get_posts($args);			
				$checklist_id;		
				
				if ( $my_posts ) {
					$checklist_id = $my_posts[0]->ID;				 
					//print_r('EXIST');
				} else {
					$post = array(
					  'post_name'      => $uid . '_cdcdch_checklist_focus',
					  'post_title'     => $uid . '_cdcdch_checklist_focus',
					  'post_status'    => 'publish',
					  'post_type'      => 'cdcdch_checklist',
					  'post_author'	=> $uid	
					);		
					$checklist_id = wp_insert_post( $post );
					add_post_meta($checklist_id, 'checklist_type', 'focus');
				}
			
				$answer_fields = array(
						'focus1', 
						'focus2',
						'focus3',
						'focus4',
						'focus5',
						'focus6',
						'focus7',
						'focus8',
						'focus9',
						'focus10'		
					);	
				foreach ( $answer_fields as $f ) {
					if (isset($_POST[$f])) {
						if ( ( $_POST[$f] == '-1' ) || (  $_POST[$f] == "" ) ) { //defaults for selects
							delete_post_meta($checklist_id, $f);
						} else {
							update_post_meta( $checklist_id, $f, $_POST[$f] );
						}
					}
				}	
			}
			if (isset( $_POST['submit_cdcdch_checklist_choose'] )) {			
				//Check if post exists by title using uid	
				$the_slug = $uid . '_cdcdch_checklist_choose';
				$args=array(
				  'name' => $the_slug,
				  'post_type' => 'cdcdch_checklist',
				  'post_status' => 'publish',
				  'numberposts' => 1
				);
				$my_posts = get_posts($args);			
				$checklist_id;		
				
				if ( $my_posts ) {
					$checklist_id = $my_posts[0]->ID;				 
					//print_r('EXIST');
				} else {
					$post = array(
					  'post_name'      => $uid . '_cdcdch_checklist_choose',
					  'post_title'     => $uid . '_cdcdch_checklist_choose',
					  'post_status'    => 'publish',
					  'post_type'      => 'cdcdch_checklist',
					  'post_author'	=> $uid	
					);		
					$checklist_id = wp_insert_post( $post );
					add_post_meta($checklist_id, 'checklist_type', 'choose');
				
				}
			
				$answer_fields = array(
						'choose1', 
						'choose2',
						'choose3',
						'choose4',
						'choose5',
						'choose6',
						'choose7',
						'choose8',
						'choose9',
						'choose10',
						'choose11',
						'choose12',
						'choose13'
					);	
				foreach ( $answer_fields as $f ) {
					if (isset($_POST[$f])) {
						if ( ( $_POST[$f] == '-1' ) || (  $_POST[$f] == "" ) ) { //defaults for selects
							delete_post_meta($checklist_id, $f);
						} else {
							update_post_meta( $checklist_id, $f, $_POST[$f] );
						}
					}
				}	
			}

			echo "Your answers have been submitted successfully!<br /><a href='http://www.communitycommons.org/community-health-improvement-journey-draft-for-review-1014-2/'>Click here to return to the Community Health Improvement Journey</a>.<br /><a href='/cdcdch-backpack/'>Click here to return to the Backpack</a>.";
			
		}
	} else {
		echo "You must be logged in to view this page.";
	}
}