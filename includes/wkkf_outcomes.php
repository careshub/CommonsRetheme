<?php 
function outcomes1A() {
?>

				
                <canvas id="meter1" width="275">[No canvas support]</canvas><br /><br />
			    <strong style="font-size:18pt;">31%</strong><br /><br />of kids eating healthy school foods
				<script type="text/javascript">

					
	
				 
				  
					var meter = new RGraph.Meter('meter1', 0, 100, 31)
					.Set('units.post', '%')
					.Set('border', false)
					.Set('tickmarks.small.num', 0)
					.Set('tickmarks.big.num', 0)
					.Set('text.color', '#747474')
					.Set('text.size', 8)
					.Set('segment.radius.start', 40)
					.Set('background.color', '#e6e6e6')
					.Set('labels', true);
					meter.Set('chart.colors.ranges', [[0, 1, '#a3c167'],[1, 25, '#b3a2c7'],[25, 50, '#e6e0ec'],[50, 100, '#ffffff']])
					//.Draw();
					RGraph.Effects.Meter.Grow(meter, {'frames': 550});  	  
				  
	</script>
				
<?php 
}
function outcomes1B() {
?>
<div id="bar1" style="width:90%;height:160px;margin:0px auto;"></div>
	<script type="text/javascript">
jQuery(function () {
        jQuery('#bar1').highcharts({
            chart: {
                type: 'bar',
				margin: [0, 0, 0, 0],
				plotBackgroundColor: '#e6e6e6',
				spacingRight:0
				
            },
			exporting: {
				enabled: false
			},	
			title: false,
			credits: false,
            xAxis: {
                categories: ['Number of Healthy School Meals Served'],
				lineWidth: 0,				
				labels: {
					enabled: true,
					format: '{value} K'
				}
            },
            yAxis: {
                min: 0,
				max: 50000,
				lineWidth: 0,
				lineColor: '#e6e6e6',
				gridLineWidth: 0,
				minorGridLineWidth: 0,
				tickWidth: 0
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true,
				enabled: false
            },
            plotOptions: {				
                series: {					
                    stacking: 'normal'					
                }
            },
			colors: [
				'#ffffff',
				'#e6e0ec',
				'#b3a2c7',
				'#a3c167'
				],            
			series: [
		
			{
                name: 'N/A',
                data: [21000]
            },	
			{
                name: 'Goal',
                data: [27000]
            },
			{
                name: 'Current',
                data: [1000]
            }, 			
			{
                name: 'Baseline',
                data: [1000]
            }
			
			]
        });
    });
    

	</script>
<strong style="font-size:18pt;">2,500</strong><br /><br />healthy school meals served daily	
<?php
}
function outcomes1C() {
?>
<br /><br /><br />
<strong style="font-size:48pt;">25%</strong>
<div id="bar2" style="width:90%;height:60px;margin:0px auto;"></div>
	<script type="text/javascript">
jQuery(function () {
        jQuery('#bar2').highcharts({
            chart: {
                type: 'bar',
				margin: [0, 0, 0, 0],
				plotBackgroundColor: '#e6e6e6',
				spacingRight:0,
				height:50
				
            },
			exporting: {
				enabled: false
			},	
			title: false,
			credits: false,
            xAxis: {
                categories: ['Number of Healthy School Meals Served'],
				lineWidth: 0,				
				labels: {
					enabled: true,
					format: '{value} K'
				}
            },
            yAxis: {
                min: 0,
				max: 50000,
				lineWidth: 0,
				lineColor: '#e6e6e6',
				gridLineWidth: 0,
				minorGridLineWidth: 0,
				tickWidth: 0
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true,
				enabled: false
            },
            plotOptions: {				
                series: {					
                    stacking: 'normal'					
                }
            },
			colors: [
				'#ffffff',
				'#e6e0ec',
				'#b3a2c7',
				'#a3c167'
				],            
			series: [
		
			{
                name: 'N/A',
                data: [21000]
            },	
			{
                name: 'Goal',
                data: [27000]
            },
			{
                name: 'Current',
                data: [1000]
            }, 			
			{
                name: 'Baseline',
                data: [1000]
            }
			
			]
        });
    });
    

	</script>
of schools contracting with School Food Authorities
	
<?php

}
function outcomes2A() {
		?>

			<div id="pie1" style="width:90%;height:200px;margin:0px auto;"></div>
			<strong style="font-size:18pt;">24%</strong><br /><br />of kids eating healthy school foods
			<script type="text/javascript">
				jQuery(function () {
					jQuery('#pie1').highcharts({
						chart: {
							margin: [0, 0, 0, 0],
							plotBackgroundColor: '#e6e6e6',
							plotBorderWidth: null,
							plotShadow: false
						},
						exporting: {
							enabled: false
						},						
						title: false,
						credits: false,
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
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
						colors: [
							'#a3c167',
							'#b3a2c7',
							'#e6e0ec',
							'#ffffff'
							],
						
						series: [{
							type: 'pie',
							name: 'kids eating healthy<br />school foods',
							data: [
								['Baseline', 1],
								['Current', 24],
								['Goal', 25],
								['n/a', 50]
							
							]
						}]
					});
				});				

						
			</script>
			
		<?php
}
function outcomes2B() {
?>

				
                <canvas id="meter2" width="275">[No canvas support]</canvas><br /><br />
			    <strong style="font-size:18pt;">45%</strong><br /><br />healthy school meals served daily
				<script type="text/javascript">

					
	
				 
				  
					var meter = new RGraph.Meter('meter2', 0, 100, 45)
					.Set('units.post', '%')
					.Set('border', false)
					.Set('tickmarks.small.num', 0)
					.Set('tickmarks.big.num', 0)
					.Set('text.color', '#747474')
					.Set('text.size', 8)
					.Set('segment.radius.start', 40)
					.Set('background.color', '#e6e6e6')
					.Set('labels', true);
					meter.Set('chart.colors.ranges', [[0, 1, '#a3c167'],[1, 25, '#b3a2c7'],[25, 50, '#e6e0ec'],[50, 100, '#ffffff']])
					//.Draw();
					RGraph.Effects.Meter.Grow(meter, {'frames': 550});  	  
				  
	</script>
				
<?php 
}
function outcomes2C() {
	?>
	<link rel='stylesheet' type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/tick.css';?>" />
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/tick.js'; ?>"></script> 
	<div class="tick tick-flip" align="center">0</div>
	<script type="text/javascript">
		jQuery(document).ready(function(){
				  jQuery( '.tick' ).ticker(
					{
					  incremental: 1,
					  stopnum: 25,
					  delay: 50,
					  separators: true
					});
				
		});
	</script>
<?php
}


?>