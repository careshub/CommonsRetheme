<?php 
function continuum1() {
?>
	<div id="doughnut1" style="height: 300px; width: 600px;">
	</div>
	<script type="text/javascript">
	 window.onload = function () {
			var continuum_doughnut = new CanvasJS.Chart("doughnut1",
			{
			  title:{
				text: "Total Spending: $657,385",
				fontFamily: "Impact",
				fontWeight: "normal",
			  },
			  backgroundColor: "#f0f0f0",
			  legend:{
				verticalAlign: "bottom",
				horizontalAlign: "center"
			  },
			  data: [
			  {
			   //startAngle: -90,
			   indexLabelFontSize: 14,
			   indexLabelFontFamily: "Arial",
			   indexLabelFontColor: "darkgrey",
			   indexLabelLineColor: "darkgrey",
			   indexLabelPlacement: "outside",
			   type: "doughnut",
			   showInLegend: false,
			   dataPoints: [
			   {  y: 52.24, legendText:"Unawareness 52%", indexLabel: "Unawareness 52%" },
			   {  y: 20.45, legendText:"Mobilization 20%", indexLabel: "Mobilization 20%" },
			   {  y: 18.59, legendText:"Unawareness 19%", indexLabel: "Unawareness 19%" },
			   {  y: 6.75, legendText:"Implementation 7%", indexLabel: "Implementation 7%" },
			   {  y: 1.95, legendText:"Transform 2%", indexLabel: "Others 2%" },
			   ]
			 }
			 ]
		   });

			continuum_doughnut.render();
		}
	</script>


<?php
}
?>