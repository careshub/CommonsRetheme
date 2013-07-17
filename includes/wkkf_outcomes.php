<?php 
function outcomes1A() {
?>

				<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/RGraph/libraries/RGraph.meter.js'; ?>"></script>
                <canvas id="canvas1" width="275">[No canvas support]</canvas><br /><br />
			    <strong style="font-size:18pt;">31%</strong><br /><br />of kids eating healthy school foods
				<script type="text/javascript">

					
	
				 
				  
					var meter = new RGraph.Meter('canvas1', 0, 100, 31)
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

}
function outcomes1C() {

}
function outcomes2A() {
		?>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/highcharts.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/exporting.js'; ?>"></script>
			<div id="pie1" style="width:220px;height:220px;margin:0px auto;"></div>
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
						title: {
							text: ''
						},
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