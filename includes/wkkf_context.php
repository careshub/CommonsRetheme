<?php 
function wkkf_context($loc) {
?>
<style type="text/css">
	.datarow {
		display:inline-block;
		width:33%;
		text-align:center;
		
	}
	.datatitle {
		font-weight:bold;
		font-size:16pt;
		color:#fe9600;
		margin-top:25px;
	}
	.sourceinfo {
		font-size:7pt;
		margin-top: 35px;
		float:right;
		color:#999999;
	}
</style>
<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/' . $loc . '_context.jpg' ?>" width="900px" style="margin-bottom:20px;" />
<div id="nola_context" style="display:none;">	
	<table style="height:350px;width:100%;padding:15px;background-color:#e6e6e6;">
		<tr>
			<td style="width:25%;text-align:center;">
				<span class="bigstats nola">343,829</span><br /><span class="textstats">total population</span>
			</td>
			<td style="width:30%;text-align:center;">
				<span class="bigstats nola">83%</span><br /><span class="textstats">have high school degree or higher</span>
			</td>
			<td style="width:20%;text-align:center;">
				<span class="bigstats nola">$37,468</span><br /><span class="textstats">median household income</span>
			</td>
			<td style="width:25%;text-align:center;padding-left:20px;"">
				<span class="textstats">racial makeup %</span>			
				<div id="racialbar"></div>
			</td>			
		</tr>
		<tr>
			<td style="width:25%;text-align:center;margin:auto 0;">
			<div id="pie_malefemale" style="width:100%;margin:auto 0;"></div>
			
		
				<table style="width:100%;margin 0px auto;">
					<tr>
						<td style="text-align:center;">
							<strong style="font-size:14pt;color:#696b97;">45%</strong><br /><span class="textstats">male</span>
						</td>
						<td style="text-align:center;">
							<strong style="font-size:14pt;color:#696b97;">55%</strong><br /><span class="textstats">female</span>
						</td>
					</tr>
				</table>
				 
			</td>
			<td style="width:30%;text-align:center;">
				<span class="bigstats nola">31%</span><br /><span class="textstats">have bachelor's degree or higher</span>
			</td>
			<td style="width:20%;text-align:center;">
				<span class="bigstats nola">24%</span><br /><span class="textstats">living below poverty level</span>
			</td>
			<td style="width:25%;text-align:center;padding-left:20px;">
				<span class="textstats nola">hispanic origin %</span>
				<div id="hispanicbar"></div>
			</td>	
		</tr>
	</table>
</div>
<div id="miece_context" style="display:none;height:350px;width:98%;padding:15px;background-color:#e6e6e6;">
	<div>
		<div class="datatitle">Population:</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_1">9,883,360</span><br /><span class="textstats">total residents</span>
		</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_2">5.9</span><br /><span class="textstats">percent under the age of 5</span>
		</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_3">23.2</span><br /><span class="textstats">percent under the age of 18</span>
		</div>
	</div>
	<div>
		<div class="datatitle">Diversity:</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_4">14.3</span><br /><span class="textstats">percent African American</span>
		</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_5">4.5</span><br /><span class="textstats">percent Latino/Hispanic</span>
		</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_6">9</span><br /><span class="textstats">percent ESL households</span>
		</div>	
	</div>
	<div>
		<div class="datatitle">Economics:</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_7">$48,669</span><br /><span class="textstats">median household income</span>
		</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_8">8.9</span><br /><span class="textstats">percent umemployment rate (Dec. 2012)</span>
		</div>
		<div class="datarow">
			<span class="bigstats miece" id="miece_9">28</span><br /><span class="textstats">percent increase of child poverty (2005-2011)</span>
		</div>	
	</div>
	<div class="sourceinfo">
		(2010-12 statistics, courtesy of U.S. Census Bureau; the Kids Count in Michigan Data Book)
	</div>
</div>
<div id="grmi_context" style="display:none;height:350px;width:98%;padding:15px;background-color:#e6e6e6;">
	<div>
		<div class="datatitle">Population:</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_1">189,815</span><br /><span class="textstats">total residents</span>
		</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_2">8</span><br /><span class="textstats">percent under the age of 5</span>
		</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_3">24.7</span><br /><span class="textstats">percent under the age of 18</span>
		</div>
	</div>
	<div>
		<div class="datatitle">Diversity:</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_4">20.9</span><br /><span class="textstats">percent African American</span>
		</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_5">15.6</span><br /><span class="textstats">percent Latino/Hispanic</span>
		</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_6">16.2</span><br /><span class="textstats">percent ESL households</span>
		</div>	
	</div>
	<div>
		<div class="datatitle">Economics:</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_7">$38,731</span><br /><span class="textstats">median household income</span>
		</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_8">6.5</span><br /><span class="textstats">percent umemployment rate (Dec. 2012)</span>
		</div>
		<div class="datarow">
			<span class="bigstats grmi" id="grmi_9">42</span><br /><span class="textstats">percent increase of child poverty (2005-2011)</span>
		</div>	
	</div>
	<div class="sourceinfo">
		(2010-11 statistics, courtesy of U.S. Census Bureau; the Kids Count in Michigan Data Book)
	</div>
</div>
					<script type="text/javascript">
						jQuery( document ).ready(function() {  						
							var loc = <?php echo json_encode($loc) ?>;					
							jQuery('#' + loc + '_context').css( "display", "block" );
						
							var cnt = 0;
							jQuery('.bigstats.' +loc).each(function() {
								cnt = cnt + 1;
								var changeto = jQuery(this).text();
								var thisid = '#' + loc + '_' + cnt;
								
								var $obj = jQuery(thisid);
								$obj.css('opacity', '.3');
							    var original = $obj.text();

								var spin = function() {
									return Math.floor(Math.random() * 10);
								};

								var spinning = setInterval(function() {
									$obj.text(function() {
										var result = '';
										for (var i = 0; i < original.length; i++) {
											result += spin().toString();
										}
										return result;
									});
								}, 50);

								var done = setTimeout(function() {
									clearInterval(spinning);
									$obj.text(changeto).css('opacity', '1');
								}, 1000);
							});

						
							
						
						});
						
						
						
						
						jQuery(function () {							
							jQuery('#pie_malefemale').highcharts({
								chart: {
									margin: [0, 0, 0, 0],
									plotBackgroundColor: '#e6e6e6',
									plotBorderWidth: null,
									plotShadow: false,
									width:200,
									height:100
								},
								exporting: {
									enabled: false
								},						
								title: false,
								credits: false,
								colors: [	
									'#b3a2c7',								
									'#e6e0ec'																		
									],  								
								plotOptions: {
									pie: {
										allowPointSelect: true,
										cursor: 'pointer',
										dataLabels: {
											enabled: false,
											color: '#000000',
											connectorColor: '#000000',
											format: '<b>{point.name}</b>: {point.percentage:.1f} %'
										}
									}
								},
								tooltip: {enabled: false},
								series: [{
									type: 'pie',
									name: '% male and female',
									data: [
										['Female', 55],
										['Male', 45],
									
									]
								}]
							});
						});				

						jQuery(function () {
								jQuery('#racialbar').highcharts({
									chart: {
										type: 'bar',
										margin: [0, 0, 0, 0],
										plotBackgroundColor: '#e6e6e6',
										plotBorderWidth: null,
										plotShadow: false,
										width:230,
										height:130
								},
								exporting: {
									enabled: false
								},						
								title: false,
																

								xAxis: {
									categories: ['African-American', 'Caucasian', 'Asian', 'Alaskan/Native American', 'Native Hawaiian/Pacific Islander'],
									title: {
										text: null
									}
								},
								yAxis: {
									min: 0,
									title: {
										text: 'Population (millions)',
										align: 'high'
									},
									labels: {
										overflow: 'justify'
									},
									lineWidth: 0,
									lineColor: '#e6e6e6',
									gridLineWidth: 0,
									minorGridLineWidth: 0,
									tickWidth: 0									
								},
								tooltip: {
									valueSuffix: ' %'
								},
								colors: ['#b3a2c7'],
								plotOptions: {
									bar: {
										dataLabels: {
											enabled: true
										}
									}
								},
								legend: {enabled: false},
								credits: {
									enabled: false
								},
								series: [{
									name: '% of population',
									data: [60, 33, 5, 1, 1]
								}]
								});
							});
							
						jQuery(function () {
								jQuery('#hispanicbar').highcharts({
									chart: {
										type: 'bar',
										margin: [0, 0, 0, 0],
										plotBackgroundColor: '#e6e6e6',
										plotBorderWidth: null,
										plotShadow: false,
										width:250,
										height:50
								},
								exporting: {
									enabled: false
								},						
								title: false,
																

								xAxis: {
									categories: ['White, Non-Hispanic', 'Hispanic/Latino Origin'],
									title: {
										text: null
									}
								},
								yAxis: {
									min: 0,
									title: {
										text: 'Population (millions)',
										align: 'high'
									},
									labels: {
										overflow: 'justify'
									},
									lineWidth: 0,
									lineColor: '#e6e6e6',
									gridLineWidth: 0,
									minorGridLineWidth: 0,
									tickWidth: 0									
								},
								tooltip: {
									valueSuffix: ' %'
								},
								colors: ['#b3a2c7'],
								plotOptions: {
									bar: {
										dataLabels: {
											enabled: true
										}
									}
								},
								legend: {enabled: false},
								credits: {
									enabled: false
								},
								series: [{
									name: '% of population',
									data: [31, 5]
								}]
								});
							});
								
					</script>					
<?php 
}