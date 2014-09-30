<?php
/**
 Template Name: Subscription Matrix 
*/
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php                         
				cc_subscribe_matrix();                        
				while ( have_posts() ) : the_post(); ?>
			<?php                              
				//get_template_part( 'content', 'page' ); ?>				
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); 

function cc_subscribe_matrix() {
?>

	<div style="font-weight:bold;font-size:16pt;margin-bottom:20px;">Have you ever wanted to...</div>
	<div style="width:700px;height:300px;border:solid 2px #bcbcbc;">
		<div style="width:25%;height:300px;float:left;border-right:solid 2px #bcbcbc;">
			<div style="padding:10px;">
				<ul>
					<li>
						&bull; Engage with community stories and network with peers on the Commons?
					</li>
					<li>
						&bull; Map and report on national data for your community?
					</li>
					<li>
						&bull; Save up to 5 maps and 5 reports to your personal profile?
					</li>
				</ul>
				<div style="position:absolute;top:420px;"><input type="button" id="button1" value="+ Learn More" /></div>
			</div>
		</div>
		<div style="width:25%;height:300px;float:left;border-right:solid 2px #bcbcbc;">
			<div style="padding:10px;">
				<ul>
					<li>
						&bull; Map your own local data alongside national data?
					</li>
					<li>
						&bull; Use advanced mapping tools?
					</li>
					<li>
						&bull; Save unlimited maps and reports to your profile?
					</li>
				</ul>
				<div style="position:absolute;top:420px;"><input type="button" id="button2" value="+ Learn More" /></div>
			</div>
		</div>
		<div style="width:25%;height:300px;float:left;border-right:solid 2px #bcbcbc;">
			<div style="padding:10px;">
				<ul>
					<li>
						&bull; Increase peer learning across your collaborative by creating an online network?
					</li>
					<li>
						&bull; Share files, maps and reports privately within your collaborative?
					</li>
					<li>
						&bull; Create and edit documents collaboratively and privately within your network?
					</li>
				</ul>
				<div style="position:absolute;top:420px;"><input type="button" id="button3" value="+ Learn More" /></div>
			</div>
		</div>
		<div style="width:24%;height:300px;float:left;">
			<div style="padding:10px;">
				<ul>
					<li>
						&bull; Plug in and accelerate learning within and across your collaborative?
					</li>
					<li>
						&bull; Visualize locally uploaded data in maps and reports and share them within your network?
					</li>
					<li>
						&bull; Tell your story using maps and data and share it across an online network?
					</li>
				</ul>
				<div style="position:absolute;top:420px;"><input type="button" id="button4" value="+ Learn More" /></div>
			</div>
			
		</div>		
	</div>
	
	<div id="matrix" style="display:none;width:960px;border:solid 2px #bcbcbc;">
		<table width="100%" cellpadding="15">
			<tbody>
				<tr style="display:none;">
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>					
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Individual Profile
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Access Interactive Mapping
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Access Reporting System
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Option to Join Hubs
					</td>				
				</tr>		
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						5 at a time
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						5 at a time
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						Umlimited
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						Unlimited
					</td>
					<td style="width:26%;">
						Save Maps and Reports
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Update Subscription Options
					</td>				
				</tr>		
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Activity Feed
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Self-Serve Upload of Local Data
					</td>				
				</tr>				
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Branded Home Page
					</td>				
				</tr>	
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Discussion Forum
					</td>				
				</tr>				
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Hub Access Privacy Options
					</td>				
				</tr>				
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Share Unlimited Maps and Reports with Hub Members
					</td>				
				</tr>				
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Content Library
					</td>				
				</tr>				
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Additional Customization of Hub Home Page
					</td>				
				</tr>		
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Access to Collaborative Storytelling Tools
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						5 at a time
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						5 at a time
					</td>
					<td style="width:26%;">
						Option to Create Hublets
					</td>				
				</tr>		
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Content Sharing Privacy Options
					</td>				
				</tr>
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
					
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						&#x2713;
					</td>
					<td style="width:26%;">
						Advanced Mapping Tools
					</td>				
				</tr>				
				<tr style="border-bottom:solid 1px #dcdcdc;">
					<td style="width:18.25%;padding:10px;text-align:center;">
						<a href="http://www.communitycommons.org/register/"><input type="button" id="regButton" value="Register" /></a>
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						<a href="http://dev.communitycommons.org/subscription/"><input type="button" id="subButton" value="Subscribe" /></a>
					</td>
					<td style="width:18.25%;padding:10px;text-align:center;">
						<input type="button" id="formButton1" value="Get a Hub" />
					</td>
					<td style="width:17.6%;padding:10px;text-align:center;">
						<input type="button" id="formButton2" value="Get a Hub" />
					</td>
					<td style="width:26%;">
						
					</td>				
				</tr>
			</tbody>
		</table>
	</div>


	
	<script type="text/javascript">
		jQuery( document ).ready(function($) {
			$( "#button1" ).click(function() {
				$( "#matrix" ).slideDown( "slow", function() {
				
					var txt = '1';
					var column = $('table tr th').filter(function() {
						return $(this).text() === txt;
					}).index();

					if(column > -1) {
						$('table tr').each(function() {
							$(this).find('td').not(column).css('background-color', '#FFFFFF');
							$(this).find('td').eq(column).css('background-color', '#FFFFCC');
						});
					}
					
				});
			});
			$( "#button2" ).click(function() {
				$( "#matrix" ).slideDown( "slow", function() {
				
					var txt = '2';
					var column = $('table tr th').filter(function() {
						return $(this).text() === txt;
					}).index();

					if(column > -1) {
						$('table tr').each(function() {
							$(this).find('td').not(column).css('background-color', '#FFFFFF');
							$(this).find('td').eq(column).css('background-color', '#FFFFCC');
						});
					}
					
				});
			});
			$( "#button3" ).click(function() {
				$( "#matrix" ).slideDown( "slow", function() {
				
					var txt = '3';
					var column = $('table tr th').filter(function() {
						return $(this).text() === txt;
					}).index();

					if(column > -1) {
						$('table tr').each(function() {
							$(this).find('td').not(column).css('background-color', '#FFFFFF');
							$(this).find('td').eq(column).css('background-color', '#FFFFCC');
						});
					}
					
				});
			});
			$( "#button4" ).click(function() {
				$( "#matrix" ).slideDown( "slow", function() {
				
					var txt = '4';
					var column = $('table tr th').filter(function() {
						return $(this).text() === txt;
					}).index();

					if(column > -1) {
						$('table tr').each(function() {
							$(this).find('td').not(column).css('background-color', '#FFFFFF');
							$(this).find('td').eq(column).css('background-color', '#FFFFCC');							
						});
					}
					
				});
			});			
		});
	
	
	
	</script>
<?php	
}