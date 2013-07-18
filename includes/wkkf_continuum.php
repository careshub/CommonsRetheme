<?php 
function continuum1() {
?>
	<script type='text/javascript' src='https://www.google.com/jsapi'></script>
	<div class="bigstats" style="padding:20px;font-size:20pt;">Total Spending: $657,385</div>
	<div id="continuumPie" style="width:550px;height:375px;position:absolute;top:300px;padding:20px;">
	</div>
	<script type="text/javascript">
		jQuery(function() {
			var chart;
			jQuery(document).ready(function() {
        
			function animateSlice(point) {
				point.slice();
			}
			chart = new Highcharts.Chart({
						chart: {
							renderTo: 'continuumPie',
							margin: [0, 0, 0, 0],
							plotBackgroundColor: '#e6e6e6',
							plotBorderWidth: null,
							plotShadow: false
						},
						exporting: {
							enabled: false
						},		
						credits: false,
						title: false,
						tooltip: {
							pointFormat: '{series.name}: <b>${point.y}</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								stickyTracking: false,
								cursor: 'pointer',
								dataLabels: {
									enabled: false,
									color: '#000000',
									connectorColor: '#000000',
									format: '<b>{point.name}</b>: {point.percentage:.1f} %'
								},
								point: {
									events: {
										mouseOver: function() {
											animateSlice(this);
										},
										mouseOut: function() {
											animateSlice(this);
										}
									}
								}								
							}
						},

            series: [{
                type: 'pie',
                name: 'Continuum',
				dataLabels: {
					enabled: true,
					distance: 5
					},				
                data: [
                    {
                    name: 'Unawareness',
                    id: 'Unawareness-slice',
                    y: 122233
                    },
                {
                    name: 'Awareness',
                    id: 'Awareness-slice',
                    y: 343423
                    },
                {
                    name: 'Mobilization',
                    id: 'Mobilization-slice',
                    y: 134423
                    },
                {
                    name: 'Implementation',
                    id: 'Implementation-slice',
                    y: 44423
                    },
                {
                    name: 'Transform',
                    id: 'Transform-slice',
                    y: 12883
                    }
                    ]}]						
						
						
						

					});
					jQuery('ul').on('mouseover mouseout', 'dt', function() {
						var sliceId = jQuery(this).data('slice');
						animateSlice(chart.get(sliceId));
					});						
					
				});	
			});
			
			
			
				
	 window.onload = function () {
		
			(function($) {
    
			  var allPanels = $('.accordion > li').hide();
				
			  $('.accordion > dt > a').click(function() {
				allPanels.slideUp();
				$(this).parent().next().slideDown();
				return false;
			  });

			})(jQuery);		
			
		}
		  google.load('visualization', '1', {packages:['table']});
		  google.setOnLoadCallback(drawTable);
		  function drawTable() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Name');
			data.addColumn('number', 'Amount');			
			data.addRows([
			  ['City of New Orleans',  {v: 34223, f: '$34,223'}],
			  ['Echoing Green',   {v: 123343,   f: '$123,343'}],
			  ['Greater New Orleans Afterschool Part.', {v: 164579, f: '$164,579'}],
			  ['Greater New Orleans Foundation',   {v: 12883,  f: '$12,883'}],
			  ['Kids Rethink New Orleans Schools',   {v: 8395,  f: '$8,395'}]
			]);
			
			var table1 = new google.visualization.Table(document.getElementById('tblUnawareness'));
			table1.draw(data, {showRowNumber: false});
			var table2 = new google.visualization.Table(document.getElementById('tblAwareness'));
			table2.draw(data, {showRowNumber: false});
			var table3 = new google.visualization.Table(document.getElementById('tblMobilization'));
			table3.draw(data, {showRowNumber: false});
			var table4 = new google.visualization.Table(document.getElementById('tblImplementation'));
			table4.draw(data, {showRowNumber: false});
			var table5 = new google.visualization.Table(document.getElementById('tblTransform'));
			table5.draw(data, {showRowNumber: false});
		  }
	</script>

	<div style="width:400px;position:absolute;top:300px;margin-left:525px;float:right;">
		<ul class="accordion">

		<dt id="dt1" data-slice="Unawareness-slice"><a href="">Stage 1 - Unawareness</a></dt>
		<li><div id='tblUnawareness'></div></li>

		<dt id="dt2" data-slice="Awareness-slice"><a href="">Stage 2 - Awareness</a></dt>
		<li><div id='tblAwareness'></div></li>

		<dt id="dt3" data-slice="Mobilization-slice"><a href="">Stage 3 - Mobilization</a></dt>
		<li><div id='tblMobilization'></div></li>

		<dt id="dt4" data-slice="Implementation-slice"><a href="">Stage 4 - Implementation</a></dt>
		<li><div id='tblImplementation'></div></li>
		
		<dt id="dt5" data-slice="Transform-slice"><a href="">Stage 5 - Transform</a></dt>
		<li><div id='tblTransform'></div></li>

		</ul>
	</div>
<?php
}

function continuum_stages() {
?>
<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/stages.jpg' ?>" width="99%" />
<div id="bar_stages" style="width:100%;height:200px;margin:0 auto;"></div>
	<script type="text/javascript">
	
						jQuery(function () {
							jQuery('#bar_stages').highcharts({
								chart: {
									renderTo: 'bar_stages',
									type: 'bar',
									backgroundColor: '#e6e6e6',
									plotBackgroundColor: '#e6e6e6',
									plotBorderWidth: null,
									plotShadow: false
								},
								exporting: {
									enabled: false
								},						
								title: false,
																

								xAxis: {
									
									tickWidth: 1,
									tickmarkPlacement: 'between',
									labels: {enabled: false},
									title: {
										text: 'Progress'
									}
								},
								yAxis: {
									categories: ['Unawareness', 'Awareness', 'Mobilization', 'Implementation', 'Transform'],
									title: {
										text: 'Stage'										
									},
									labels: {enabled: true}
								},
								tooltip: {
									valueSuffix: ' %'
								},
								colors: ['#b3a2c7'],
								plotOptions: {
									series: {
										stacking: 'normal',
										pointWidth: 50,
										pointPadding: 0,																			

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