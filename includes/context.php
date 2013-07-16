 <script>
//         if(!RGraph.isOld()) {
//            CreateCharts();
//        }else {
//           
//        }
        
       window.onload = CreateCharts;
        function CreateCharts()
        {
            var hbar = new RGraph.HBar('hbarrace', [60,30,3,0.3,0]);            
            hbar.Set('chart.units.pre', '%');
            hbar.Set('chart.units.post', '');
            hbar.Set('chart.colors', ['Gradient(#ffd737:#FDB515)']);
            hbar.Set('chart.strokestyle', 'rgba(0,0,0,0)');
            hbar.Set('chart.labels.above', true);
            hbar.Set('chart.labels.above', true);
            hbar.Set('chart.vmargin', 20);
            hbar.Set('chart.background.grid', false);
            hbar.Set('chart.labels', ['White','African American','Asian','NonWhite']);
            
            if (!RGraph.isOld()) {
                hbar.Set('chart.tooltips', ['White','African American','Asian','NonWhite']);
                hbar.Set('chart.tooltips.event', 'onmousemove');
            }
            
            hbar.Set('chart.labels.above.decimals', 1);
            hbar.Set('chart.xlabels', false);
            hbar.Set('chart.gutter.left', 120);
            hbar.Set('chart.gutter.right', 50);
            hbar.Set('chart.gutter.top', 10);
            hbar.Set('chart.noxaxis', true);
            hbar.Set('chart.noxtickmarks', true);
            hbar.Set('chart.noytickmarks', true);
            hbar.Draw();
            RGraph.Effects.HBar.Grow(hbar);
     //   }
//        }
           // RGraph.isOld() ? hbar.Draw() : 

//            var pie = new RGraph.Pie('hbarrace_race', [65,35]);
//            pie.Set('chart.colors', ['#FDB515', 'gray']);
//            pie.Set('chart.labels', ['$1.28bn disbursed','$2.01bn* pledged']);
//            pie.Set('chart.labels.sticks', true);
//            pie.Set('chart.labels.sticks.length', 15);
//            pie.Set('chart.exploded', 5);
//            
//            if (!RGraph.isOld()) {
//                pie.Set('chart.shadow', true);
//                pie.Set('chart.shadow.offsetx', 0);
//                pie.Set('chart.shadow.offsety', 0);
//                pie.Set('chart.shadow.blur', 10);
//                pie.Set('chart.tooltips', ['$1.28bn disbursed','$2.01bn* pledged']);
//                pie.Set('chart.tooltips.event', 'onmousemove');
//            }
//
//            pie.Set('chart.radius', 50);
//            pie.Set('chart.centerx', 700);
//            pie.Set('chart.centery', 180);
//            pie.Set('chart.strokestyle', 'rgba(0,0,0,0)');
//
//            RGraph.isOld() ? pie.Draw() : RGraph.Effects.Pie.RoundRobin(pie, {'frames': 60});
            
//            var hbar2 = new RGraph.HBar('hbarhispanic', [18,15,16,29,21,25,24])
//                .Set('chart.labels', ['Hispanic','NonHispanic'])
//                .Set('chart.background.grid', false)
//                .Set('chart.noxaxis', true)
//                .Draw();
            
            var hbar3 = new RGraph.HBar('hbarhispanic', [38,62]);
             hbar3.Set('chart.background.grid', false);
                hbar3.Set('chart.gutter.left', 120);
            hbar3.Set('chart.colors', ['Gradient(#E6E0EC:#B3A2C7)']);
            hbar3.Set('chart.labels', ['Hispanic','NonHispanic']);
            hbar3.Set('chart.strokestyle', 'rgba(0,0,0,0)');
             RGraph.Effects.HBar.Grow(hbar3);
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

