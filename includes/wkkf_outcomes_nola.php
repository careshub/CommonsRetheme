<?php 

function nola_outcomes() {
?>
            <div id="row1" class='chartboxparent'>
					<a href="#" data-reveal-id="modal_outcomes1">
					   <div class="chartbox"> 

						<?php nola_outcomes1A(); ?>
							
					   </div>
					</a>
					<div class="chartbox_spacer"></div>
					<div class="chartbox"><?php nola_outcomes1B(); ?></div>
					<div class="chartbox_spacer"></div>
					<div class="chartbox"><?php nola_outcomes1C(); ?></div>
					<br><br>
			   <div id="row2" class="chartboxparent_spacer">&nbsp;<br>
					<div class="chartbox_bot">
						<?php nola_outcomes2A(); ?>
					</div>
					<div class="chartbox_spacer"></div>
				    <div class="chartbox_bot"><?php nola_outcomes2B(); ?></div>
				    <div class="chartbox_spacer"></div>
				    <div class="chartbox_bot">
						 <!--style="float:left;margin-left:25px;"--><!--<div style="float:left;display:inline-block;position:relative;font-family:calibri,arial;font-weight:bold;font-size:60pt;color:#696b97;top:50px;">%</div>-->
						<?php nola_outcomes2C(); ?>
						<span align="center" class="textstats">% of schools contracting with<br />School Food Authorities</span>
						
				    </div>
				   
			   </div>

			</div>





<?php
}

function nola_outcomes1A() {


			
				?>
                <canvas id="meter1" width="275">[No canvas support]</canvas><br /><br />
			    <span class="bigstats">31%</span><br /><br /><span class="textstats">of kids eating healthy school foods</span>
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
function nola_outcomes1B() {
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
<span class="bigstats">2,500</span><br /><br /><span class="textstats">healthy school meals served daily</span>
<?php
}
function nola_outcomes1C() {
?>
<br /><br /><br />
<span class="bigstats">25%</span>
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
<span class="textstats">of schools contracting with School Food Authorities</span>
	
<?php

}
function nola_outcomes2A() {
		?>

			<div id="pie1" style="width:90%;height:200px;margin:0px auto;"></div>
			<span class="bigstats">24%</span><br /><br /><span class="textstats">of kids eating healthy school foods</span>
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
function nola_outcomes2B() {
?>

				
                <canvas id="meter2" width="275">[No canvas support]</canvas><br /><br />
			    <span class="bigstats">45%</span><br /><br /><span class="textstats">healthy school meals served daily</span>
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
function nola_outcomes2C() {
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