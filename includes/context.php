 <script>
//         if(!RGraph.isOld()) {
//            CreateCharts();
//        }else {
//           
//        }
        
       window.onload = CreateCharts;
        function CreateCharts()
        {
            var hbarcontext = new RGraph.HBar('hbarrace', [60,30,3,0.3,0]);            
            hbarcontext.Set('chart.units.pre', '%');
            hbarcontext.Set('chart.units.post', '');
            hbarcontext.Set('chart.colors', ['Gradient(#ffd737:#FDB515)']);
            hbarcontext.Set('chart.strokestyle', 'rgba(0,0,0,0)');
            hbarcontext.Set('chart.labels.above', true);
            hbarcontext.Set('chart.labels.above', true);
            hbarcontext.Set('chart.vmargin', 20);
            hbarcontext.Set('chart.background.grid', false);
            hbarcontext.Set('chart.labels', ['White','African American','Asian','NonWhite']);
            
            if (!RGraph.isOld()) {
                hbarcontext.Set('chart.tooltips', ['White','African American','Asian','NonWhite']);
                hbarcontext.Set('chart.tooltips.event', 'onmousemove');
            }
            
            hbarcontext.Set('chart.labels.above.decimals', 1);
            hbarcontext.Set('chart.xlabels', false);
            hbarcontext.Set('chart.gutter.left', 120);
            hbarcontext.Set('chart.gutter.right', 50);
            hbarcontext.Set('chart.gutter.top', 10);
            hbarcontext.Set('chart.noxaxis', true);
            hbarcontext.Set('chart.noxtickmarks', true);
            hbarcontext.Set('chart.noytickmarks', true);
            hbarcontext.Draw();
            RGraph.Effects.HBar.Grow(hbarcontext);
   
            
            var hbarcontext3 = new RGraph.HBar('hbarhispanic', [38,62]);
             hbarcontext3.Set('chart.background.grid', false);
                hbarcontext3.Set('chart.gutter.left', 120);
            hbarcontext3.Set('chart.colors', ['Gradient(#E6E0EC:#B3A2C7)']);
            hbarcontext3.Set('chart.labels', ['Hispanic','NonHispanic']);
            hbarcontext3.Set('chart.strokestyle', 'rgba(0,0,0,0)');
             RGraph.Effects.HBar.Grow(hbarcontext3);
        } 
        
       
    </script> 
      <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#maleoverlay").stop().animate({height:'90'},{queue:false,duration:1000} );
                       $("#femaleoverlay").stop().animate({height:'70'},{queue:false,duration:2000} );
		});	 
                   
	</script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>  
<?php
/*
 * Child Outcome PHP page
 * 

function allcharts()
{
    	global $current_user;
	$return_string = '';   
        
} */
?>

