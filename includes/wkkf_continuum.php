<?php 
function continuum1($loc) {
$continuumArr = array(				
						"nola" => array(
								"continuum" => array(
												"Unawareness" => 122233,
												"Awareness" => 323423,
												"Mobilization" => 134423,
												"Implementation" => 44423,
												"Transform" =>12,883
									),
								"total_spending" => "$657,385",
							),
						"miece" => array(
								"continuum" => array(
												"Mobilization" => 6522342,
												"Connection" => 1211095,
												"ECE System Building" => 1744430,
												"Alignment" => 105600,
												"Ready to Learn" => 1763126
												),
								"total_spending" => "$11,346,593",
							),
					);

?>
	<script type='text/javascript' src='https://www.google.com/jsapi'></script>
	<div class="bigstats" style="padding:20px;font-size:20pt;">Total Spending: <?php echo $continuumArr[$loc]['total_spending'];?></div>
	<div id="continuumPie" style="display:inline-block;width:450px;position:relative;top:-17px;">
	</div>
	<script type="text/javascript">
		jQuery(function() {
			var chart;
			jQuery(document).ready(function() {
			
			var loc = <?php echo json_encode($loc) ?>;
			if (loc == "nola") {
				var continuumInfo = {				
							"Unawareness": 122233,
							"Awareness": 323423,
							"Mobilization": 134423,
							"Implementation": 44423,
							"Transform": 12883
						};
			} else if (loc == "miece") {
				var continuumInfo = {		
						"Mobilization": 6522342,
						"Connection": 1211095,
						"ECE System Building": 1744430,
						"Alignment": 105600,
						"Ready to Learn": 1763126								
					};	
			}
// var myStr = "";					
// for(var key in continuumInfo) {
  // console.log( key + " : " + continuumInfo[key] + "<br />");
  // myStr = myStr + 
// }

		
		
		
			function animateSlice(point) {
				point.slice();
			}
			chart = new Highcharts.Chart({
						chart: {
							renderTo: 'continuumPie',
							margin: [0, 0, 0, 0],
							plotBackgroundColor: '#e6e6e6',
							plotBorderWidth: 0,
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

	<div style="display:inline-block;vertical-align:top;">
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
<select style="margin-bottom:10px;font-family:Calibri,Arial;">
	<option value="" selected>---Select Topic---</option>
	<option value="Childhood Obesity">Childhood Obesity</option>
	<option value="Access to Healthy Food">Access to Healthy Food</option>
	<option value="Healthy Food in Schools">Healthy Food in Schools</option>
	<option value="Poverty">Poverty</option>
	<option value="Education">Education</option>
</select>
<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/stages.jpg' ?>" width="99%" />
<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/perspectives.png' ?>" />
<div id="bar_stages_perspectives" style="width:100%;height:200px;margin:0 auto;position:relative;right:10px;"></div>
<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/funding.png' ?>" />
<div id="column_stages_investments" style="width:100%;height:200px;margin:0 auto;position:relative;right:10px;"></div>

	<script type="text/javascript">
	
						jQuery(function () {
							jQuery('#bar_stages_perspectives').highcharts({
								chart: {
									renderTo: 'bar_stages_perspectives',
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
									labels: {enabled:false},
									tickLength: 0,
									tickWidth: 0								
								},
								yAxis: {
									max: 100,
									min: 0,
									labels: {enabled: false},
									title: {enabled: false},
									plotLines: [{
										color: '#FF0000',
										width: 2,
										value: 80,
										zIndex: 5,
										label: {
											text: 'Transform',
											verticalAlign: 'bottom',
											textAlign: 'right',
											y: -10
										}
									},										
									{
										color: '#FF0000',
										width: 2,
										value: 60,
										zIndex: 5,
										label: {
											text: 'Implementation',
											verticalAlign: 'bottom',
											textAlign: 'right',
											y: -10
										}	
									},
									{
										color: '#FF0000',
										width: 2,
										value: 40,
										zIndex: 5,
										label: {
											text: 'Mobilization',
											verticalAlign: 'bottom',
											textAlign: 'right',
											y: -10
										}	
									},
									{
										color: '#FF0000',
										width: 2,
										value: 20,
										zIndex: 5,
										label: {
											text: 'Awareness',
											verticalAlign: 'bottom',
											textAlign: 'right',
											y: -10
										}	
									},
									{
										color: '#FF0000',
										width: 2,
										value: 0,
										zIndex: 5,
										label: {
											text: 'Unawareness',
											verticalAlign: 'bottom',
											textAlign: 'right',
											y: -10
										}
									}
									]	
								},

								colors: ['#b3a2c7'],
								plotOptions: {
									series: {
										stacking: 'normal',
										pointWidth: 50,
										pointPadding: 0		

									}

								},
								legend: {enabled: false},
								credits: {
									enabled: false
								},
								tooltip: {enabled: false},
								series: [{
									data: [{
										name: 'Grantee Perspective',
										color: '#77933c',
										y: 70
									}, {
										name: 'Staff Perspective',
										color: '#a3c167',
										y: 99
									}]
								}]
								});
							});
    
	jQuery(function () {
        jQuery('#column_stages_investments').highcharts({
			chart: {
				renderTo: 'column_stages_investments',
				type: 'column',
				backgroundColor: '#e6e6e6',
				plotBackgroundColor: '#e6e6e6',
				plotBorderWidth: null,
				plotShadow: false
			},
			exporting: {
				enabled: false
			},	
			legend: {enabled: false},
			credits: {
				enabled: false
			},
			title: false,
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						inside: false,
						color: '#000000',
						format: '${point.y:,.0f}'
					},
					pointStart: 10,
					pointInterval: 20
				},
				series: {
					stacking: 'normal',
					pointWidth: 170,
					pointPadding: 0		

				}

			},
            xAxis: {

				maxPadding: 0,
				labels: {enabled: false},
				
				plotLines: [{
							color: '#FF0000',
							width: 2,
							value: 80,
							zIndex: 5,
							label: {
								text: 'Transform',
								verticalAlign: 'bottom',
								textAlign: 'right',
								y: -10
							}
						},										
						{
							color: '#FF0000',
							width: 2,
							value: 60,
							zIndex: 5,
							label: {
								text: 'Implementation',
								verticalAlign: 'bottom',
								textAlign: 'right',
								y: -10
							}	
						},
						{
							color: '#FF0000',
							width: 2,
							value: 40,
							zIndex: 5,
							label: {
								text: 'Mobilization',
								verticalAlign: 'bottom',
								textAlign: 'right',
								y: -10
							}	
						},
						{
							color: '#FF0000',
							width: 2,
							value: 20,
							zIndex: 5,
							label: {
								text: 'Awareness',
								verticalAlign: 'bottom',
								textAlign: 'right',
								y: -10
							}	
						},
						{
							color: '#FF0000',
							width: 2,
							value: 0,
							zIndex: 5,
							label: {
								text: 'Unawareness',
								verticalAlign: 'bottom',
								textAlign: 'right',
								y: -10
							}
						}
						]					
            },
            yAxis: {
				title: {enabled: false},
				labels: {enabled: false}
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="padding:0"><b>${point.y:,.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },

            series: [{
						data: [
						{name: 'Unawareness', color: '#7f7f7f', y:122233},{name: 'Awareness', color: '#7f7f7f', y:343423},{name: 'Mobilization', color: '#7f7f7f', y:134423},{name: 'Implementation', color: '#7f7f7f', y:44423},{name: 'Transform', color: '#7f7f7f', y:12883}]				
    
            }]
        });
    });
    


	</script>





<?php
}