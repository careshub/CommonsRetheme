<?php 

function grmi_outcomes() {
?>
					<div id="row1" class='chartboxparent'>
						<a href="#" data-reveal-id="modal_outcomes1">
						   <div class="chartbox"> 

							<?php grmi_outcomes1A(); ?>
								
						   </div>
						</a>
						<div class="chartbox_spacer"></div>
						<div class="chartbox"><?php grmi_outcomes1B(); ?></div>
						<div class="chartbox_spacer"></div>
						<div class="chartbox"><?php grmi_outcomes1C(); ?></div>
						<br><br>
					</div>





<?php
}
function grmi_outcomes1A() {			
?>
				
	<link rel='stylesheet' type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/tick.css';?>" />
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/tick.js'; ?>"></script> 
	<div class="tick tick-flip" align="center">0</div>
	<script type="text/javascript">
		jQuery(document).ready(function(){
				  jQuery( '.tick' ).ticker(
					{
					  incremental: 1,
					  stopnum: 20,
					  delay: 50,
					  separators: true
					});
				
		});
	</script>
	 
	<span align="center" class="textstats">% of Hope Zone Kids with Access<br />to Affordable Early Learning</span>				
				

				
<?php 
}
function grmi_outcomes1B() {
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
                categories: ['Number of Hope Zone Formal ECE Providers'],
				lineWidth: 0,				
				labels: {
					enabled: true,
					format: '{value} K'
				}
            },
            yAxis: {
                min: 0,
				max: 25,
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
                name: 'Goal',
                data: [14]
            },
			{
                name: 'Current',
                data: [10]
            }, 			
			{
                name: 'Baseline',
                data: [10]
            }
			
			]
        });
    });
    

	</script>
<span class="bigstats">10 </span><br /><br /><span class="textstats">Hope Zone Formal ECE Providers</span>


<?php
}

