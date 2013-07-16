<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.common.core.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.hbar.js'; ?>"></script>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.meter.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.hbar.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.common.key.js'; ?>"></script>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.hprogress.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.pie.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.common.dynamic.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.common.tooltips.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/libraries/RGraph.common.effects.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/includes/RGraph/css/demos.css';?>" type="text/css" media="screen" />
    <script>
    
   
        window.onload = function ()
        {
          ShowGauge();
        
        }
        
        function ShowGauge()
        {
          
      // RGraph.Clear(document.getElementById('hbar'))
        var hbar = new RGraph.HProgress('hbar', 0,100,[2,10,35,100])
        hbar.Set('colors', ['#A3C167','#B3A2C7','#E6E0EC','#FFFFFF'])
     
       
        
        var hbar2 = new RGraph.HProgress('hbar2', 0,100,[2,10,35,100])
        hbar2.Set('colors', ['#A3C167','#B3A2C7','#E6E0EC','#FFFFFF'])
        
     
       var pie = new RGraph.Pie('pie', [2,25,23.4,50])
            .Set('labels', ['', '','',''])
            .Set('tooltips', ['2%','25%','23.4%','50%'])
            .Set('tooltips.event', 'onmousemove')
            .Set('colors', ['#A3C167','#B3A2C7','#E6E0EC','#FFFFFF'])
            .Set('text.color', '#000000')
            .Set('exploded', 1)
            .Set('radius', 70);
          //  .Draw();
        
            var explode = 1;
            
            if (RGraph.isOld()) {
                pie.Set('chart.exploded', [explode, explode]);
                pie.Draw();
            } else {
                RGraph.Effects.Pie.RoundRobin(pie, {frames: navigator.userAgent.indexOf('Chrome') > 0? 45 : 90});

                setTimeout(function () {pie.Explode(0, explode);}, navigator.userAgent.indexOf('Chrome') > 0 ? 750 : 1500);
                setTimeout(function () {pie.Explode(1, explode);}, navigator.userAgent.indexOf('Chrome') > 0 ? 750 : 1750);
            }
 
        // Add the click listener for the third segment
        pie.onclick = function (e, shape)
        {
            if (!pie.Get('exploded') || !pie.Get('chart.exploded')[shape['index']]) {
                pie.Explode(shape['index'], 10);
            }
            
            e.stopPropagation();
        }
        
        // Add the mousemove listener for the third segment
        pie.onmousemove = function (e, shape)
        {
            e.target.style.cursor = 'pointer';
        }

        // Add the window click listener that resets the Pie chart
        window.onmousedown = function (e)
        {
            pie.Set('exploded', 1);
            RGraph.Redraw();
        }
        
               
       RGraph.Effects.HProgress.Grow(hbar2);
       RGraph.Effects.HProgress.Grow(hbar); 
        
        
           
       var min= 0
       var max = 100
        var val= 25
       var meter = new RGraph.Meter('cvs',min, max, val)
                meter.Set('red.start', 0)
                meter.Set('red.end', 3)
                meter.Set('yellow.start', 3)
                meter.Set('yellow.end', 25)
                meter.Set('green.color','#E6E0EC' )
                meter.Set('red.color','#A3C167' )
                meter.Set('yellow.color','#B3A2C7' )
                meter.Set('green.start', 25)
                meter.Set('green.end', 50)
                meter.Set('angles.start', PI + 0.0)
                meter.Set('angles.end', TWOPI - 0.0)                      
                meter.Set('segment.radius.start', 25)
                meter.Set('linewidth.segments', 1);
                //meter.Set('chart.background.color', 'rgba(0,0,0,0)');
                               RGraph.isOld() ? meter.Draw() : RGraph.Effects.Meter.Grow(meter);
                //RGraph.Effects.Meter.Grow(meter);
                

//           
                if (!RGraph.isOld()) {
                meter.canvas.onmousedown = function (e)
                {
                    var obj = RGraph.ObjectRegistry.getObjectByXY(e);
                    
                    if (obj) {
                        var value = obj.getValue(e);
                        
                        obj.value = value;
                        RGraph.Effects.Meter.Grow(obj);
                    }
                }
            }
       //        
//$("#dudeoverlay").stop().animate({left:'-265px'},{queue:false,duration:3500} );  
        
                 }
                  
    </script>
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#dudeoverlay").stop().animate({width:'50'},{queue:false,duration:1000} );
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
