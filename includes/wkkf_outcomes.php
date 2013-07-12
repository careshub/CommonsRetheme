<?php 
function outcomes1A() {
?>

				<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/RGraph/libraries/RGraph.meter.js'; ?>"></script>
                <canvas id="canvas1" width="275">[No canvas support]</canvas><br /><br />
			    <strong style="font-size:18pt;">31%</strong><br /><br />of kids eating healthy school foods
				<script type="text/javascript">

					
					CanvasJS.addColorSet("wkkfReportCardColors1",
					 [//colorSet Array
					 "#A3C167",
					 "#B3A2C7",
					 "#E6E0EC",
					 "#FFFFFF"
					]); 	
				 
				  
					var meter = new RGraph.Meter('canvas1', 0, 100, 31)
					.Set('units.post', '%')
					.Set('border', false)
					.Set('tickmarks.small.num', 0)
					.Set('tickmarks.big.num', 0)
					.Set('text.color', '#747474')
					.Set('text.size', 8)
					.Set('labels', true);
					meter.Set('chart.colors.ranges', [[0, 1, '#a3c167'],[1, 25, '#b3a2c7'],[25, 50, '#e6e0ec'],[50, 100, '#ffffff']])
					//.Draw();
					RGraph.Effects.Meter.Grow(meter, {'frames': 550});  	
					
				
				  


					
					
					
				  
				  
	</script>
				
<?php 
}
function outcomes1B() {

}

function outcomes2A() {
		?>
			<div id="pie1" style="width:220px;height:220px;margin:0px auto;"></div>
			<strong style="font-size:18pt;">26%</strong><br /><br />of kids eating healthy school foods
			<script type="text/javascript">
				
					var outcome_pie1 = new CanvasJS.Chart("pie1",
					{
					  colorSet: "wkkfReportCardColors1",	
					  backgroundColor: "#e6e6e6",	  
					  data: [
					  {
					   indexLabelPlacement: "inside",
					   indexLabelFontColor: "white",
					   indexLabelFontSize: 10,
					   startAngle: -90,
					   type: "pie",
					   showInLegend: false,
					   dataPoints: [
					   {  y: 1 },
					   {  y: 24 },
					   {  y: 25 },
					   {  y: 50 },
					   ]
					 }
					 ]
				   });
					
					outcome_pie1.render();	
						
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