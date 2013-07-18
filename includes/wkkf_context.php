<?php 
function wkkf_context() {
?>
<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/nola_context.jpg' ?>" width="900px" />
<table style="height:300px;width:100%;padding:15px;background-color:#e6e6e6;">
		<tr>
			<td style="width:25%;text-align:center;">
				<span class="bigstats">343,829</span><br /><span class="textstats">total population</span>
			</td>
			<td style="width:30%;text-align:center;">
				<span class="bigstats">83%</span><br /><span class="textstats">have high school degree or higher</span>
			</td>
			<td style="width:20%;text-align:center;">
				<span class="bigstats">$37,468</span><br /><span class="textstats">median household income</span>
			</td>
			<td style="width:25%;text-align:center;">
				<span class="textstats">racial makeup</span>			
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
				<span class="bigstats">31%</span><br /><span class="textstats">have bachelor's degree or higher</span>
			</td>
			<td style="width:20%;text-align:center;">
				<span class="bigstats">24%</span><br /><span class="textstats">living below poverty level</span>
			</td>
			<td style="width:25%;text-align:center;">
				<span class="textstats">hispanic origin</span>
				<div id="hispanicbar"></div>
			</td>	
		</tr>
</table>
					<script type="text/javascript">
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
									categories: ['Caucasian', 'African-American', 'Hispanic', 'Asian', 'Alaskan/Native American'],
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
										height:60
								},
								exporting: {
									enabled: false
								},						
								title: false,
																

								xAxis: {
									categories: ['Mexico', 'other Latin America'],
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