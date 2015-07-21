<?php
/**
 Template Name: CC Subscription Placeholder
*/
get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php                         
				cc_subscription_placeholder();                        
				while ( have_posts() ) : the_post(); ?>
			<?php                              
				//get_template_part( 'content', 'page' ); ?>				
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); 

function cc_subscription_placeholder() {
?>
		<style>
			table, th, td {
				border: 1px solid #cccccc;
			}
			.site-content {
				width:100%;
			}
		</style>
			<div class="screamer">Individual Subscription Services</div>
			<p>In addition to our Hubs, Community Commons is preparing to roll out an Individual Subscription Service to give users even more options when it comes to making the tools on the Commons more meaningful for your local community change efforts.</p>
			<p>Until now, only our Hubs had access to the tool that allows them to add their own data into the Commons. Due to high demand from individual users, we’re making these tools available to everyone through a subscription.</p>
			<p>Purchase individual subscriptions by the month or save 25% with an annual subscription.</p>
			<p style="font-style:italic;">Are you an organization or a coalition? You might be more interested in a Hub. <a href="http://www.communitycommons.org/what-is-a-hub/" target="_blank">Find out more</a>.</p>
			<h1>Coming soon!</h1>
			<table border="1">
				<thead>
					<tr>
						<td>
						
						</td>

						<td style="font-weight:bold;text-align:center;">
							The Uploader
						</td>
						<td style="font-weight:bold;text-align:center;">
							The Data Builder
						</td>					
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							Save unlimited maps and reports
						</td>

						<td style="text-align:center;">
							&#10004;
						</td>
						<td style="text-align:center;">
							&#10004;
						</td>					
					</tr>
					<tr>
						<td>
							Access advanced mapping tools
						</td>

						<td style="text-align:center;">
							&#10004;
						</td>
						<td style="text-align:center;">
							&#10004;
						</td>					
					</tr>
					<tr>
						<td>
							Upload data in the form of tables and shapefiles or connect to external web map services
						</td>

						<td style="text-align:center;">
							&#10004;
						</td>
						<td style="text-align:center;">
							&#10004;
						</td>					
					</tr>
					<tr>
						<td>
							Build and create map layers on your desktop computer (points, lines & areas) or mobile device (points)
						</td>

						<td style="text-align:center;">
							
						</td>
						<td style="text-align:center;">
							&#10004;
						</td>					
					</tr>
					<tr>
						<td style="font-weight:bold;">
							Price/Month
						</td>

						<td style="font-weight:bold;text-align:center;">
							$99.00*
						</td>
						<td style="font-weight:bold;text-align:center;">
							$299.00*
						</td>					
					</tr>
					<tr>
						<td style="font-weight:bold;">
							Price/Year
						</td>

						<td style="font-weight:bold;text-align:center;">
							$950.00*
						</td>
						<td style="font-weight:bold;text-align:center;">
							$2,870.00*
						</td>					
					</tr>
				<tbody>
			</table>
			<span style="font-style:italic;">*Pricing subject to change</span>
			<br /><br />
			<p><strong>Save unlimited maps and reports:</strong> Do you want to save lots of maps and reports on the Commons? As a subscriber, you can save as many reports and maps as you wish!</p>
			<p><strong>Access advanced mapping tools:</strong> Access cool mapping tools like radius selection and multi-criteria query. As a subscriber, you’ll have access to future advanced tools as they are developed. </p>
			<p><strong>Upload data in the form of Tables and Shapefiles or Connect to Web Map Services:</strong> Love the data on the Commons but want to add your own? Upload Excel tables directly into the Commons to see them mapped. These data can be point locations, like addresses, or they can be  ZIP codes, census tracts, or counties. The data will appear only for you when you access the mapping tool and can be overlaid with thousands of other datasets from the Commons. Subscribers can also link to Google maps (KML), ArcGIS Online, and Open Geospatial Consortium Web Map Services (WMS).</p>
			<p><strong>Build and create map layers on your desktop computer or mobile device:</strong> Don't have an Excel file but want to add data on the map? You can do just that using the Data Builder! Subscribers will define what they want to collect and build a custom menu including text and number fields, drop down menus, photos, websites, etc. You can then add to the layer point by point, line by line, or area by area. The layer can be added to over time and accessed via desktop or mobile device. Once this data is added to the Commons, it can be overlaid with thousands of other map layers.</p>
			<p style="font-style:italic;">Are you an organization or a coalition? You might be more interested in a Hub. <a href="http://www.communitycommons.org/what-is-a-hub/" target="_blank">Find out more</a></p>
<?php
}

	