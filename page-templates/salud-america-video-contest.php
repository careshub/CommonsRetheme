<?php
/*
Template Name: Salud America Video Contest
*/

get_header(); 


?>

	<div id="primary" class="site-content" style="width:100%;">
		<div id="content" role="main">
			<div class="entry-content">
			<?php 
			cc_sa_video_contest();
			
			while ( have_posts() ) : the_post(); ?>
				
				
			<?php endwhile; // end of the loop. ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>
<?php
function cc_sa_video_contest() {
?>
	<style type="text/css">
		input[type=checkbox] {
		  /* All browsers except webkit*/
		  transform: scale(1.5);

		  /* Webkit browsers*/
		  -webkit-transform: scale(1.5);
		}	
	</style>
	
	<h3 class="screamer saorange">Vote for Best Video + Enter to Win a Free Salud America! T-shirt!</h3>

	<div id="voting_booth">
		<?php
			//user must be registered with CC to vote
			if ( is_user_logged_in() ) {	 
				$current_user = wp_get_current_user();
				$uid = $current_user->ID;
				
				if (isset( $_POST['submitVote'] )) {	
					if ( isset ( $_POST['sa_vid_vote'] ) ){
						$vidtitle = "";
						if ( $_POST['sa_vid_vote'] == 1 ) {
							$vidtitle = 'A no-soda resolution in Texas';	
						} elseif ( $_POST['sa_vid_vote'] == 2 ) {
							$vidtitle = 'Water on every desk for students in Cutler-Orosi, California';
						} elseif ( $_POST['sa_vid_vote'] == 3 ) {
							$vidtitle = 'School swaps out sugary drinks in Fairfax, Virginia';
						} elseif ( $_POST['sa_vid_vote'] == 4 ) {
							$vidtitle = 'Grocery Stores tag healthy foods in California';
						} elseif ( $_POST['sa_vid_vote'] == 5 ) {
							$vidtitle = 'Fresh marketing at Latino corner store in Watsonville, California';
						} elseif ( $_POST['sa_vid_vote'] == 6 ) {						
							$vidtitle = 'L.A. corner store gets marketing makeover inside and out';
						}						
						$arr = array(
							'post_title' => $uid . "_SA_Video_Vote",
							'post_content' => $vidtitle,
							'post_status' => 'publish',
							'post_type' => 'sa_video_vote'
						);
						$newpostid = wp_insert_post( $arr );
						add_post_meta( $newpostid, 'vote_video_id', $_POST['sa_vid_vote'], true );

					}								
				}
				//User must be registered with Salud America interest group to vote.
				$user_args = array(
							'include' => $uid,
							'meta_key' => 'salud_interest_group',
							'meta_value' => 'agreed'
						);
				$user_query = new WP_User_Query( $user_args );				
				// User Loop
				if ( ! empty( $user_query->results ) ) {				
						$args = array(
								'post_type' => 'sa_video_vote',
								'author' => $uid
								);
						$the_query = new WP_Query( $args );
						// The Loop
						if ( $the_query->have_posts() ) {
							// A post (vote) has been found...only one per user. Deny voting.
							echo "Sorry! You have already voted in this contest.";
						} else {
							// no posts (votes) found, proceed with voting.				
				?>		
								<form id="sa_vid_contest_form" class="standard-form" method="post" action="">
									<div class="row">		
										<div class="third-block" style="text-align:center;">
											A no-soda resolution in Texas<br /><br />											
											<iframe width="269" height="202" src="//www.youtube.com/embed/bq_vtBpio30" frameborder="0" allowfullscreen></iframe><br />
											<input id="cb1" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="1"> Vote
										</div>
										<div class="third-block" style="text-align:center;">
											Water on every desk for students in Cutler-Orosi, California<br />
											<iframe width="269" height="202" src="//www.youtube.com/embed/CWdhjBDRS_s" frameborder="0" allowfullscreen></iframe><br />
											<input id="cb2" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="2"> Vote
										</div>
										<div class="third-block" style="text-align:center;">
											School swaps out sugary drinks in Fairfax, Virginia<br />
											<iframe width="269" height="202" src="//www.youtube.com/embed/xLcjApFPKx8" frameborder="0" allowfullscreen></iframe><br />
											<input id="cb3" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="3"> Vote
										</div>				
									</div>
									<div class="row">		
										<div class="third-block" style="text-align:center;">
											Grocery Stores tag healthy foods in California<br />
											<iframe width="269" height="202" src="//www.youtube.com/embed/o6ZvBEKDv2c" frameborder="0" allowfullscreen></iframe><br />
											<input id="cb4" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="4"> Vote
										</div>
										<div class="third-block" style="text-align:center;">
											Fresh marketing at Latino corner store in Watsonville, California<br />
											<iframe width="269" height="202" src="//www.youtube.com/embed/C8NnL9iTqd4" frameborder="0" allowfullscreen></iframe><br />
											<input id="cb5" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="5"> Vote
										</div>
										<div class="third-block" style="text-align:center;">
											L.A. corner store gets marketing makeover inside and out<br />
											<iframe width="269" height="202" src="//www.youtube.com/embed/XB9HoKRdcdo" frameborder="0" allowfullscreen></iframe><br />
											<input id="cb6" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="6"> Vote
										</div>				
									</div>		
									<div style="width:100%;text-align:center;"><input type="submit" id="submitVote" name="submitVote" value="Submit your Vote" style="font-size:18pt;" /></div>
								</form>
				<?php
						}
						/* Restore original Post Data */
						wp_reset_postdata();
				} else {
					echo "You must be registered with Salud America before you can vote. Click <a href='/register/?salud-america=1' target='_blank'>here</a> to register.";
				}						
			} else {
				echo "To vote, you must <a href='/register/?salud-america=1' target='_blank'>REGISTER</a> with this platform.";
			}
		?>
	</div>
	<div style="width:100%;text-align:center;font-size:8pt;margin-top:15px;"><a href="#" id="toggleRules">See Contest Rules</a></div>
	<div id="rules" style="font-size:8pt;margin-top:25px;"><strong>RULES:</strong><br />
	This contest is open to everyone regardless of race/ethnicity, gender, etc. The contest begins on Nov. 6, 2014, and ends at 11:59 p.m. CST on Nov. 20, 2014. To enter, individuals must first register with the Salud America! Growing Healthy Change website, and then click to vote for their favorite video among four potential choices. Each registered user may cast only one vote. Casting a vote enters the registered user into a drawing for a T-shirt. The drawing will occur and the winner notified by Dec. 3, 2014, via email and must contact us directly at saludtoday@uthscsa.edu to claim prizes.
	</div>

		<script type="text/javascript">
			jQuery( document ).ready(function($) {	
				
				$( "#rules" ).hide();
				$(".sa_vid_cb").click(function() {
					selectedBox = this.id;
					$(".sa_vid_cb").each(function() {
						if ( this.id == selectedBox )
						{
							this.checked = true;
						}
						else
						{
							this.checked = false;
						};        
					});
				}); 
				$( "#submitVote" ).click(function() {
					var atLeastOneIsChecked = $('input[name="sa_vid_vote"]:checked').length > 0;
					if (atLeastOneIsChecked == false) {
						alert("In order to vote, you must check one of the boxes under a video.");
						return false;
					} else {
						alert("Thank you! Your vote has been recorded and your name entered into the drawing for a free Salud America! T-shirt and jump rope!");
					}					
				});	
				$('#toggleRules').on("click",function(){
					$("#rules").slideToggle();
				});
			});			


		</script>


	
<?php
}