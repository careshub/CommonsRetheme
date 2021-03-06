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

	<div id="voting_booth">
		<?php
			//user must be registered with CC to vote

		if ( is_page('salud-america-video-contest') ) {

			if ( is_user_logged_in() ) {
				$current_user = wp_get_current_user();
				$uid = $current_user->ID;



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
					?>
						<div style="width:100%;text-align:center;margin-bottom:20px;background-color:#FAFAD2;padding:20px 0 20px 0;">Sorry! You have already voted in this contest.</div>

						<script type="text/javascript">
							jQuery( document ).ready(function($) {
								$("#submitVote").hide();
							});
						</script>
					<?php
						}

				} else {
					//User not registered with SA on the Commons.
					?>

					<div id="sa_signup" style="width:100%;text-align:center;margin-bottom:10px;background-color:#FAFAD2;padding:10px 0 10px 0;">You must be registered with Salud America before you can vote.


						<br /><br />
						<form id="sa_signup_form" class="standard-form" method="post" action="">
						  <img src="http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/salud_america/SA-logox50.png" style="vertical-align:middle;" />&nbsp;&nbsp;
						  <strong>Join the Group: <em>Salud America!</em> Growing Healthy Change</strong><br /><br />
						  <input type="checkbox" name="salud_interest_group" id="salud_interest_group" value="agreed" checked="checked" /> Yes, I&rsquo;m interested in work by Salud America! to reduce Latino childhood obesity.<br />
						  <input type="checkbox" name="salud_newsletter" id="salud_newsletter" value="agreed" checked="checked" /> I would like to receive email updates on this topic.

						  <p style="font-style:italic;font-size:8pt;">Periodically, Salud America! sends out news updates and brief surveys.</p>
						<p><input type="submit" name="submitsasignup" value="Sign Up!"/></p>
						</form>

					</div>
					<script type="text/javascript">
						jQuery( document ).ready(function($) {
							$("#submitVote").hide();
						});
					</script>
					<?php
				}


			} else {
		?>
				<div style="width:100%;text-align:center;margin-bottom:20px;background-color:#FAFAD2;padding:20px 0 20px 0;">To vote, you must <a href='/wp-login.php?redirect_to=http%3A%2F%2Fdev.communitycommons.org%2Fsalud-america-video-contest%2F'>log in</a>. If you are new and would like to join us, please <a href='/register/?salud-america=1'>click here to register</a>.</div>
				<script type="text/javascript">
					jQuery( document ).ready(function($) {
						$("#submitVote").hide();
					});
				</script>
		<?php
			}
				if (isset( $_POST['submitsasignup'] )) {
					if ($_POST['salud_interest_group'] == 'agreed') {
						add_user_meta($uid, 'salud_interest_group', 'agreed');
					?>
						<script type="text/javascript">
							jQuery( document ).ready(function($) {
								$("#submitVote").show();
								$("#sa_signup").hide();
							});
						</script>
					<?php
					}
					if ($_POST['salud_newsletter'] == 'agreed') {
						add_user_meta($uid, 'salud_newsletter', 'agreed');
					}
				}
				if (isset( $_POST['submitVote'] )) {
					if ( isset ( $_POST['sa_vid_vote'] ) ){
						$vidtitle = "";
						if ( $_POST['sa_vid_vote'] == 1 ) {
							$vidtitle = 'Run, Chicago, Run';
						} elseif ( $_POST['sa_vid_vote'] == 2 ) {
							$vidtitle = 'Moms Heart Parks';
						} elseif ( $_POST['sa_vid_vote'] == 3 ) {
							$vidtitle = 'Stickball in NYC';
						} elseif ( $_POST['sa_vid_vote'] == 4 ) {
							$vidtitle = 'Into the Woods (on a Safe Trail)';
						} elseif ( $_POST['sa_vid_vote'] == 5 ) {
							$vidtitle = 'A Corridor to Health';
						} elseif ( $_POST['sa_vid_vote'] == 6 ) {
							$vidtitle = 'Walk at School';
						}
						$arr = array(
							'post_title' => $uid . "_SA_Video_Vote",
							'post_content' => $vidtitle,
							'post_status' => 'publish',
							'post_type' => 'sa_video_vote',
							'post_author' => $uid,
						);
						$newpostid = wp_insert_post( $arr );
						add_post_meta( $newpostid, 'sa_vote_video_id', $_POST['sa_vid_vote'], true );
						do_action( 'after_sa_video_vote', $current_user );
					?>
						<script type="text/javascript">
							jQuery( document ).ready(function($) {
								$("#submitVote").hide();
								window.location.href='/salud-america/';
							});
						</script>
					<?php
					}
				}

				?>
        <h3 class="screamer saorange">Vote for Best Video + Enter to Win a Free T-shirt and Jump Rope!</h3>
		<div id="ballot">
			<p>Latino kids need safe, easy-to-get-to places to play</p>
			<h3>WATCH and VOTE for your favorite "#SaludHeroes of Active Spaces" (who helped give kids new places to play) by March 25, 2015, and be entered into a random drawing to WIN a free Salud America! T-shirt and jump rope!</h3><br /><br />

			<form id="sa_vid_contest_form" class="standard-form" method="post" action="">
				<div class="row">
					<div class="half-block" style="text-align:center;">
						Run, Chicago, Run<br />
						<iframe width="400" height="250" src="//www.youtube.com/embed/URBpLBDUJEQ" frameborder="0" allowfullscreen></iframe><br />
						<input id="cb1" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="1"> Vote
					</div>
					<div class="half-block" style="text-align:center;">
						Moms Heart Parks<br />
						<iframe width="400" height="250" src="//www.youtube.com/embed/1qrAEDRvEoo" frameborder="0" allowfullscreen></iframe><br />
						<input id="cb2" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="2"> Vote
					</div>
				</div>
				<div class="row">
					<div class="half-block" style="text-align:center;">
						Stickball in NYC<br />
						<iframe width="400" height="250" src="//www.youtube.com/embed/iCBXZu4tGOg" frameborder="0" allowfullscreen></iframe><br />
						<input id="cb3" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="3"> Vote
					</div>
					<div class="half-block" style="text-align:center;">
						Into the Woods (on a Safe Trail)<br />
						<iframe width="400" height="250" src="//www.youtube.com/embed/PQ79uc2BBpE" frameborder="0" allowfullscreen></iframe><br />
						<input id="cb4" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="4"> Vote
					</div>
				</div>
				<div class="row">
					<div class="half-block" style="text-align:center;">
						A Corridor to Health<br />
						<iframe width="400" height="250" src="//www.youtube.com/embed/N-3xaJJkTmA" frameborder="0" allowfullscreen></iframe><br />
						<input id="cb5" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="5"> Vote
					</div>
					<div class="half-block" style="text-align:center;">
						Walk at School<br />
						<iframe width="400" height="250" src="//www.youtube.com/embed/luwie_w9slw" frameborder="0" allowfullscreen></iframe><br />
						<input id="cb6" type="checkbox" class="sa_vid_cb" name="sa_vid_vote" value="6"> Vote
					</div>
				</div>
				<div style="width:100%;text-align:center;"><input type="submit" id="submitVote" name="submitVote" value="Submit your Vote" style="font-size:18pt;" /></div>
			</form>
		</div> <!-- end #ballot -->
		<p class="aligncenter"><a id="togglerules" style="text-decoration:underline;cursor:pointer;">See contest rules</a></p>

		<div id="rules">
			<p>This contest is open to everyone (except Salud America! staff or grantees). The contest begins on March 11, 2015, and ends at 11:59 p.m. CST on March 25, 2015. To enter, individuals must first register with the Salud America! Growing Healthy Change <a href="http://www.communitycommons.org/salud-america/" target="_blank">website</a>, and then click to vote for their favorite video among four potential choices. Each registered user may cast only one vote. Casting a vote enters the registered user into a drawing for a T-shirt and jump rope package. The drawing&rsquo;s winner will be notified by April 8, 2015, via email.  The winner must contact us directly at <a href="mailto:saludamerica@uthscsa.edu?subject=SA Video Contest">saludamerica@uthscsa.edu</a> to claim their prize package. Entry into drawing is subject to all applicable laws and regulations.</p>
		</div>
        <div style="margin-bottom:20px;"><h3>Past contests</h3></div>
        <ul class="no-bullets">
            <li><strong><a href="/salud-america-video-contest-dec14">December 2014:</strong></a> Winner - &ldquo;Grocery stores tag healthy foods in California&rdquo;</li>
            <li><strong><a href="/salud-america-video-contest-jan15">January 2015:</strong></a> Winner - &ldquo;Biking to and from School&rdquo;</li>
            <li><strong><a href="/salud-america-video-contest-feb15">February 2015:</strong></a> Winner - &ldquo;Teens Help Advertise the Good Stuff at Corner Stores&rdquo;</li>
        </ul>
				<?php
	} // end if ( is_page('salud-america-video-contest') )

	if (is_page('salud-america-video-contest-dec14')) {
     ?>
        <h3 class="screamer saorange">Video contest December 2014</h3>
        <div class="row">
	        <div  style="text-align:center;background-color:#cc3366;padding-top:5px;padding-bottom:1px">
		        <h3 style="color:#fff">WINNER!</h3>
	        </div>
			<div  style="text-align:center;border-style:solid;border-width:10px;border-color:#cc3366;margin-bottom:20px">
				<br />Grocery Stores tag healthy foods in California<br /><br />
				<iframe width="520" height="325" src="//www.youtube.com/embed/o6ZvBEKDv2c" frameborder="0" allowfullscreen></iframe><br />
			</div>
		</div>
	    <div style="text-align:left;background-color:#008eaa;">
		    <h3 style="color:#fff; margin-left:10px">Watch all the videos in the contest</h3>
	    </div>

	    <div class="row">
            <div class="half-block" style="text-align:center;">
				Water on every desk for students in Cutler-Orosi, California<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/CWdhjBDRS_s" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="half-block" style="text-align:center;">
				L.A. corner store gets marketing makeover inside and out<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/XB9HoKRdcdo" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row">
            <div class="half-block" style="text-align:center;">
        		Fresh marketing at Latino corner store in Watsonville, California<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/C8NnL9iTqd4" frameborder="0" allowfullscreen></iframe>
	        </div>
	        <div class="half-block" style="text-align:center;">
				A no-soda resolution in Texas<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/bq_vtBpio30" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
			<div class="half-block" style="text-align:center;">
				School swaps out sugary drinks in Fairfax, Virginia<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/xLcjApFPKx8" frameborder="0" allowfullscreen></iframe><br />
			</div>
        </div>
	<?php
	} // End if (is_page('salud-america-video-contest-dec14'))

	if (is_page('salud-america-video-contest-jan15')) {
     ?>
        <h3 class="screamer saorange">Video contest January 2015</h3>
        <div class="row">
	        <div  style="text-align:center;background-color:#cc3366;padding-top:5px;padding-bottom:1px">
		        <h3 style="color:#fff">WINNER!</h3>
	        </div>
			<div  style="text-align:center;border-style:solid;border-width:10px;border-color:#cc3366;margin-bottom:20px">
				<br />Biking to and from School<br /><br />
				<iframe width="520" height="325" src="//www.youtube.com/embed/ji_0Qqp7ibU" frameborder="0" allowfullscreen></iframe><br />
			</div>
		</div>
	    <div style="text-align:left;background-color:#008eaa;">
		    <h3 style="color:#fff; margin-left:10px">Watch all the videos in the contest</h3>
	    </div>

	    <div class="row">
            <div class="half-block" style="text-align:center;">
				Mud Run for Kids<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/lmobfBUBVgc" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="half-block" style="text-align:center;">
				P.E. + Recess + Class Exercise = Activity Trifecta<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/PnnfjCorEsI" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row">
            <div class="half-block" style="text-align:center;">
                                Taking a "Brain Break" in Class<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/7vO1cjPshxo" frameborder="0" allowfullscreen></iframe>
	        </div>
	        <div class="half-block" style="text-align:center;">
				Calling on "P.E. Specialists"<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/o9upXLS7YN8" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
			<div class="half-block" style="text-align:center;">
				Free Wheels for Kids<br /><br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/DCcT87o0kCI" frameborder="0" allowfullscreen></iframe><br />
			</div>
        </div>
	<?php
	} // End if (is_page('salud-america-video-contest-jan15'))
if (is_page('salud-america-video-contest-feb15')) {
     ?>
        <h3 class="screamer saorange">Video contest February 2015</h3>
        <div class="row">
	        <div  style="text-align:center;background-color:#cc3366;padding-top:5px;padding-bottom:1px">
		        <h3 style="color:#fff">WINNER!</h3>
	        </div>
			<div  style="text-align:center;border-style:solid;border-width:10px;border-color:#cc3366;margin-bottom:20px">
				<br />Teens Help Advertise the Good Stuff at Corner Stores<br /><br />
				<iframe width="520" height="325" src="//www.youtube.com/embed/KT-2AQ8Gcvw" frameborder="0" allowfullscreen></iframe><br />
			</div>
		</div>
	    <div style="text-align:left;background-color:#008eaa;">
		    <h3 style="color:#fff; margin-left:10px">Watch all the videos in the contest</h3>
	    </div>

	    <div class="row">
            <div class="half-block" style="text-align:center;">
				No More "Chemical" School Food<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/S4sntStTmFQ" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="half-block" style="text-align:center;">
				Youth for Better Restaurants<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/0GzVSAVjJWE" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row">
            <div class="half-block" style="text-align:center;">
                                Bye, Bye, Chocolate Milk<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/vap9gpzi3iE" frameborder="0" allowfullscreen></iframe>
	        </div>
	        <div class="half-block" style="text-align:center;">
				Kickin' Nutrition<br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/F5BOjCmr0rQ" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
			<div class="half-block" style="text-align:center;">
				Vending Machines of Health<br /><br />
				<iframe width="400" height="250" src="//www.youtube.com/embed/Cobq6OYSl9w" frameborder="0" allowfullscreen></iframe><br />
			</div>
        </div>
	<?php
	} // End if (is_page('salud-america-video-contest-feb15'))

	/* Restore original Post Data */
	wp_reset_postdata();
	?>
	</div>

	<script type="text/javascript">
		jQuery( document ).ready(function($) {
			$("#rules").hide();
			$( "#togglerules" ).click(function() {
				$( "#rules" ).slideToggle( "slow", function() {
					// Animation complete.
				});
			});
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

		});
	</script>
<?php
} // End function cc_sa_video_contest()