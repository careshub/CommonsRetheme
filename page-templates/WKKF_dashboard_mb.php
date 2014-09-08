<?php
/**
 * Template Name: WKKF_dashboard_mb
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 * 
 */

get_header(); ?>



<!--highcharts -->
<script src="/wp-content/themes/CommonsRetheme/js/Highcharts-4.0.3/exporting-server/java/highcharts-export/highcharts-export-convert/target/classes/phantomjs/jquery.1.9.1.min.js"></script>
<script src="/wp-content/themes/CommonsRetheme/js/Highcharts-4.0.3/js/highcharts.js"></script>
<script src="/wp-content/themes/CommonsRetheme/js/Highcharts-4.0.3/js/highcharts-more.js"></script>
<script src="/wp-content/themes/CommonsRetheme/js/Highcharts-4.0.3/js/highcharts-all.js"></script>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

<!--#################################### JSFIDDLE ######################################### -->
<style>
.summary {
    float: left;
    margin:1%;
    background-color:#f1f1f1;    
}
    
.sumsingle {
    width:47%;
    min-height:280px;
    
}

.sumdouble {
    
    width:96%;
    min-height:280px;
  
}
li {
    font-size: 14px;
    margin-left: 10px;
    list-style-type:disc;
    line-height: 15px;

 }
.li2 {
    font-size: 12px;
    margin-left: 15px;
    list-style-type:circle;

 } 
h2 {
    font-size:1em;
    text-align:center;
    margin: 5px
}
.text-box {
    font-size:13px;
    margin:3%;
    text-align:left;
    line-height: 20px;
    margin: 10px
}
.expanded-topic {
    float: left;
    width:939px;
    height:885px;
    margin:1%;
    background-color:#e9e9e9;
    display:none;
    border-style:solid; 
    border-width:1px
}
table.general {
	border-spacing: 0px;}
.general th, .general td {
	padding: 5px 30px 5px 10px;
	border-spacing: 0px;
	font-size: 75%;
	margin: 0px;}
.general th, .general td {
	text-align: left;
	background-color: #e0e9f0;
	border-top: 1px solid #f1f8fe;
	border-bottom: 1px solid #cbd2d8;
	border-right: 1px solid #cbd2d8;}
.general tr.head th {
	color: #fff;
	background-color: #90b4d6;
	border-bottom: 2px solid #547ca0;
	border-right: 1px solid #749abe;
	border-top: 1px solid #90b4d6;
	text-align: center;
	text-shadow: -1px -1px 1px #666666;
	letter-spacing: 0.15em;}
.general td {
	text-shadow: 1px 1px 1px #ffffff;}
.general tr.even td, .general tr.even th {
	background-color: #e8eff5;}
.general tr.head th:first-child {
	-webkit-border-top-left-radius: 5px;
	-moz-border-radius-topleft: 5px;
	border-top-left-radius: 5px;}
.general tr.head th:last-child {
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	border-top-right-radius: 5px;}
a.info 
{ 
    position:relative; 
    z-index:24; background-color:#e9e9e9; 
    color:#000; 
    text-decoration:none 
} 

a.info:hover {z-index:25; background-color:#e9e9e9} 

a.info span{display: none} 

a.info:hover span 
{ 
	display: block;
	position: absolute;
        font-size: 14px;
        line-height: 15px;
	bottom: -7px;
        left: -10.5px;
        width:438px;
        height:260px;
	margin: 1%;
	padding: 10px;
	font-weight: normal;
	background: #e5e5e5;
	text-align: left;
	border: 1px solid #666;
} 
.fcititlesum{
    float: left;
    width:180px;
    height:20px;
    margin-top:5px;
    margin-left:10px;
    font-size:12px;
    margin-bottom:0px;
    }
title1{
    font-size:2em;
    margin: 10px   
    }
  
title2{
    font-size:18px;
    position:relative;
    position:center    
    }
    
title3{
    font-size:14px;
    position:relative;
    position:center;
        
    }
.title2box{
    float:left;
    width:700px;
    height:20px;
    margin:0.5%;

    } 
.title3box{
    float:left;
    width:400px;
    height:25px;
    margin:0.5%;
    margin-bottom:0px;
 
    }     

.fcititle{
    float: left;
    width:400px;
    margin:0.5%;
    margin-bottom:0px;
    }
    
.fcibox{
    float: left;
    width:400px;
    height:120px;
    margin:0.5%;
    background-color:#e9e9e9;
    border-style:null; 
    border-width:1px  
    }
.oibox{
    float:left;
    width:250px;
    height:120px;
    margin:0.5%;
    background-color:#e9e9e9;
    border-style:null; 
    border-width:1px    
    }    
  
 .fcibox .line {
    display:none;
    }
    .fcibox.toggle .line {
    display:block;
    }
    .fcibox.toggle .bar {
    display:none;
    }
    
 .oibox .line {
    display:none;
    }
    .oibox.toggle .line {
    display:block;
    }
    .oibox.toggle .bar {
    display:none;
    }   

.summary-text {
    display: none;
    font-size:1em;
    margin:5%;
    text-align:left;
    margin: 10px;
    float:left;
    font-size:13px;
}
.hiddenbydefault{
    display: none;    
}

.chart {
    height:270;
    margin-left:5px;
    float:left;
}
.subtopic-toggle {
	margin-bottom:2px;
	font-size:10pt;
}
</style>

<script>
jQuery(document).ready(function($) {
	$("#map1").show();
	$("#map1link").css('font-weight','bold');
	$("#map1link").click( function(e) {		
		$("#map1").show();
		$("#map2").hide();
		$("#map3").hide();
		$(this).css('font-weight','bold');
		$(this).siblings('.loadlink').css('font-weight','normal');
		e.preventDefault();
	});
	$("#map2link").click( function(e) {		
		$("#map1").hide();
		$("#map2").show();
		$("#map3").hide();
		$(this).css('font-weight','bold');
		$(this).siblings('.loadlink').css('font-weight','normal');
		e.preventDefault();
	});
	$("#map3link").click( function(e) {		
		$("#map1").hide();
		$("#map2").hide();
		$("#map3").show();
		$(this).css('font-weight','bold');
		$(this).siblings('.loadlink').css('font-weight','normal');		
		e.preventDefault();
	});	

    // Shows/hides text block on click of a.info
    $('a.info-toggle').on('click', function(e){
        $(this).parents('.summary').find( '.summary-text, .chart' ).toggle();
        e.preventDefault();
    });
    // Shows the correct subtopic div (text or chart version is independent)
    $('a.subtopic-toggle').on('click', function(e){
        subtopic = $(this).attr('id');
        target = '#subtopic-' + subtopic;
        $(this).parents('.summary').find( '.subtopic' ).hide();
        $(this).parents('.summary').find( target ).show();
		
		$(this).siblings('.who').css('font-weight','normal');
		$(this).siblings('.where').css('font-weight','normal');
		$(this).siblings('.what').css('font-weight','normal');
		$(this).siblings('.how').css('font-weight','normal');
		$(this).siblings('.progress').css('font-weight','normal');
		$(this).css('font-weight','bold');
        
		e.preventDefault();
    });
    
    // Show the map legend on click
    $('.summary .toggle').on('click', function(e){
        topic = $(this).parents('.summary').attr( "data-topic" );
        console.log( topic );
        $('#overview').toggle();
        $('#' + topic + '-expanded').toggle();
        e.preventDefault();
    });
    $('.expanded-topic .toggle').on('click', function(e){
        $('.expanded-topic').hide();
        $('#overview').toggle();
        e.preventDefault();
    });
    
});


</script>


<?php
$datafci1sum= 31;
$benchfci1sum=35;
$datafci2sum= 39;
$benchfci2sum=42;
$datafci3sum= 913;
$benchfci3sum=1500;
$datafci4sum= 51;
$benchfci4sum=52;
$datafci5sum= 38;
$datafci6sum= 46;
$datafci7sum= 17;

$datafci1_ex= 60;
$benchfci1_ex=45;
$datafci2_ex= 35;
$benchfci2_ex=30;
$datafci3_ex= 38;
$benchfci3_ex=40;
$datafci4_ex= 38;
$benchfci4_ex=41;
$datafci5_ex= 8;
$benchfci5_ex=10;

	$geoid = '01000US';

	$under18_response = wp_remote_get( 'http://maps.communitycommons.org/api/service.svc/json/Under18/?geoid=' . $geoid );
	if( is_array( $under18_response ) ) {
		$r = wp_remote_retrieve_body( $under18_response );
		$output = json_decode( $r, true );
		$under18_num = $output['WKKF_under18Result'][0]['num'];
		$under18_perc = $output['WKKF_under18Result'][0]['perc'];
		$over18_perc = 100 - $under18_perc;
		$totpop = $output['WKKF_under18Result'][0]['totpop'];
		$over18_num = $totpop - $under18_num;
	  } 
	$race_response = wp_remote_get( 'http://maps.communitycommons.org/api/service.svc/json/WKKFRace/?geoid=' . $geoid );
	if( is_array( $race_response ) ) {
		$r = wp_remote_retrieve_body( $race_response );
		$output = json_decode( $r, true );
		$race_A = $output['WKKF_RaceResult'][0]['AGE_A_0_17P'];
		$race_B = $output['WKKF_RaceResult'][0]['AGE_B_0_17P'];
		$race_H = $output['WKKF_RaceResult'][0]['AGE_H_0_17P'];
		$race_I = $output['WKKF_RaceResult'][0]['AGE_I_0_17P'];
		$race_N = $output['WKKF_RaceResult'][0]['AGE_N_0_17P'];
		$race_O = $output['WKKF_RaceResult'][0]['AGE_O_0_17P'];
		$race_W = $output['WKKF_RaceResult'][0]['AGE_W_0_17P'];
		
		//*********STILL NEED TO ADD THIS TO THE CHART*************
	  }	  
if (is_page('wkkf-dashboard-mb')) {	  
?>

<div id="overview">
        <div style="margin-top:30px;margin-bottom:15px; margin-left:15px; font-size:24pt; text-align:center;font-family: 'Lato', sans-serif;color:#686565;">WKKF Education & Learning Dashboard</div>
        <div id="who-section" class="summary sumsingle" data-topic="who" style="margin-top:20px; position: relative">
		<div style="height:20px;font-size:16px;margin:8px;border-bottom:solid 1px #d1cece;"><span style="color:#000000;font-weight:bold;">WHO //</span><span style="color:#0081c6;margin-left:10px;font-family: 'Lato', sans-serif;">Population-Level Landscape</span></div>
                
                <div id="subtopic-demographics" class="subtopic">
                    <div class="demographics chart">
                        <div>
                            <div class="percUnder18" style="width: 210px; height: 110px; margin-left: 1px; float:left"></div>
                            <div class="race1" style="width: 210px; height: 110px; margin-left: 25px; float:right"></div> 
                        </div>
                        <div style="margin:0%">
                            <div class="language" style="width: 420px; height: 110px; margin-left: 5px; float:left; position:relative;right:-90px;"></div>
                            <div class="householdsize" style="width: 0px; height: 110px; margin-right:1px; float:left"></div>
                        </div>
                    </div>
                  <div class="demographics summary-text">
                      <p>There are around <b>24 million</b> young children (<6 years old) in the U.S.</br></br>
                          Child poverty is on the rise: from 43% in 2006 increased up to 49% in 2011, reaching <b>11.5 million children</b></br></br>
                          These are their main characteristics:</p></br>  
                      <ul style="font-size:12px">
                          <li style="font-size:12px">Race:
                              <ul>
                                  <li class="li2">Black: 70%</li>
                                  <li class="li2">American Indian: 70%</li>
                                  <li class="li2">Latino: 67%</li>
                              </ul>
                          </li></br>
                          <li style="font-size:12px">Parents & household:
                              <ul>
                                  <li class="li2">Non-employed parents: 88%</li>
                                  <li class="li2">Single-parent: 75%</li>
                              </ul>
                          </li>
                      </ul>
                  </div>
                </div>
                <div id="subtopic-education" class="subtopic hiddenbydefault">
                    <div class="education chart">
                        <div>
                            <div class="highedinst" style="width: 210px; height: 110px; margin-left: 1px;  float:left"></div>
                            <div class="freeredlunch" style="width: 210px; height: 110px; margin-left: 25px; float:right"></div> 
                        </div>
                        <div style="margin:0%">
                            <div class="elemsch" style="width: 210px; height: 110px; margin-left: 5px; float:left"></div>
                            <div class="tests" style="width: 210px; height: 110px; margin-left: 1px; float:right"></div>
                            
                        </div>
                    </div>
                  <div class="education summary-text">
                      Education text
                  </div>
                </div>
                <div id="subtopic-economics" class="subtopic hiddenbydefault">
                    <div class="economics chart">
                        <div>
                            <div class="unemployment" style="width: 210px; height: 110px; margin-left: 1px; float:left"></div>
                            <div class="income" style="width: 210px; height: 110px; margin-left: 25px; float:right"></div> 

                        </div>
                        <div style="margin:0%">
                            <div class="assistance" style="width: 210px; height: 110px; margin-left: 5px; float:left"></div>
                            <div class="poverty" style="width: 210px; height: 110px; margin-left: 1px; float:right"></div>
                        </div>
                    </div>
                  <div class="economics summary-text">
                      Economics text
                  </div>
                </div>
                <div id="subtopic-health" class="subtopic hiddenbydefault">
                    <div class="health chart">
                        <div>
                            <div class="obesity" style="width: 210px; height: 110px; margin-left: 1px; float:left"></div>
                            <div class="mortality" style="width: 210px; height: 110px; margin-left: 25px; float:right"></div> 
                        </div>
                        <div style="margin:0%">
                            <div class="uninsured" style="width: 210px; height: 110px; margin-left: 5px; float:left"></div>
                            <div class="birthweight" style="width: 210px; height: 110px; margin-left: 1px; float:right"></div>
                        </div>
                    </div>
                  <div class="health summary-text">
                      Health text
                  </div>
                </div>                
                

              <div class="controls">
                  <a id="demographics" class="subtopic-toggle who" href="#" style="position:absolute; bottom:2%; left:2%">Children</a>
                  <a id="education" class="subtopic-toggle who" href="#" style="position:absolute; bottom:2%; left:20%">Family</a>
                  <a id="economics" class="subtopic-toggle who" href="#" style="position:absolute; bottom:2%; left:36%">Community</a>
                  <a id="health" class="subtopic-toggle who" href="#" style="position:absolute; bottom:2%; left:70%"></a>
              </div>
        <a href="/wkkf-dashboard-mb/who/" title="Click to expand" style="position:absolute; bottom:-1%; right:0%"><img src="http://dev.communitycommons.org/wp-content/uploads/2014/09/see_more.png" /></a>
        </div>
	<div id="where-section" class="summary sumsingle" data-topic="where" style="border-color:#5E9732; margin-top:20px; position: relative">
		<div style="height:20px;font-size:16px;margin:8px;border-bottom:solid 1px #d1cece;"><span style="color:#000000;font-weight:bold;">WHERE //</span><span style="color:#0081c6;margin-left:10px;font-family: 'Lato', sans-serif;">Geographic Context</span></div>
              <div id="subtopic-demographics" class="subtopic">
                  <div id="mapdiv" class="demographics chart">

				    <div id="map1" style="display:none;"><script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=3597&vm=3597&w=440&h=200&l=0&bbox=-14582113.088652689,2804241.044125512,-7170778.826123968,6419406.733900247&maplink=new'></script></div>
					<div id="map2" style="display:none;"><script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=6872&vm=6872&w=440&h=200&l=0&bbox=-14582113.088652689,2804241.044125512,-7170778.826123968,6419406.733900247&maplink=new'></script></div>
					<div id="map3" style="display:none;"><script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=4811&vm=4811&w=440&h=200&l=0&bbox=-14582113.088652689,2804241.044125512,-7170778.826123968,6419406.733900247&maplink=new'></script></div>
					  
                  </div>      
                  <div class="demographics summary-text">
                      <p  style="font-size:13px">In the U.S. <b>29 million</b> people aged 25 or over don't hold a High School Diploma.</br></br>
                          The following areas are characterized by displaying the highest rates of population without a High School Diploma, so they require special attention:</p></br>  
                      <ul style="font-size:12px">
                          <li style="font-size:12px">South:</li>
                              <ul>
                                  <li class="li2">New Orleans Parish, LA: 35%</li>
                                  <li class="li2">Memphis, TN: 32%</li>
                              </ul>
                          </li></br>
                          <li style="font-size:12px">Midwest:
                              <ul>
                                  <li class="li2">Kansas City, MO: 31%</li>
                                  <li class="li2">Chicago, IL: 28%</li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </div>
              <div id="subtopic-education" class="subtopic hiddenbydefault">
                    <div class="education chart">
                        <p  style="font-size:13px; margin-left:15px">Population with no High School Diploma</p>
                        <img style=" width:420px; height:200px; margin:1%; margin-left:15px" src="/wp-content/uploads/2014/03/WKKF_mapVPF2.png" />
                    </div>
                  <div class="education summary-text">
                      Education map text
                  </div>
                </div>
                <div id="subtopic-economics" class="subtopic hiddenbydefault">
                    <div class="economics chart" style="margin-left: 5px; float:left;">
                        <p  style="font-size:13px; margin-left:15px">Population at or above 200% poverty</p>
                        <img style=" width:420px; height:200px; margin:1%; margin-left:15px" src="/wp-content/uploads/2014/03/WKKF_mapVPF3.png" />
                    </div>
                  <div class="economics summary-text">
                      Economics map text
                  </div>
                </div>
                <div id="subtopic-health" class="subtopic hiddenbydefault">
                    <div class="health chart">
                        <p  style="font-size:13px; margin-left:15px">Infant mortality rate</p>
                        <img style=" width:420px; height:200px; margin:1%; margin-left:15px" src="/wp-content/uploads/2014/03/WKKF_mapVPF4.png" />
                    </div>
                  <div class="health summary-text">
                      Health map text
                  </div>
                </div>   
              <div class="controls">
                         
                  <a id="map1link" class="loadlink" href="3597" style="position:absolute; bottom:2%; left:2%; font-size:10pt;">Children in Poverty</a>
                  <a id="map2link" class="loadlink" href="6872" style="position:absolute; bottom:2%; left:32%; font-size:10pt;">NAEYC Facilities</a>
                  <a id="map3link" class="loadlink" href="4811" style="position:absolute; bottom:2%; left:57%; font-size:10pt;">200% Poverty</a>
                  
              </div>			  
        <a href="/wkkf-dashboard-mb/where/" title="Click to expand" style="position:absolute; bottom:-1%; right:0%"><img src="http://dev.communitycommons.org/wp-content/uploads/2014/09/see_more.png" /></a>
	</div>
	 
        <div id="why-section" class="summary sumsingle" data-topic="why" style="border-color:#0081c6; position: relative">
                    <div style="height:20px;font-size:16px;margin:8px;border-bottom:solid 1px #d1cece;"><span style="color:#000000;font-weight:bold;">WHAT //</span><span style="color:#0081c6;margin-left:10px;font-family: 'Lato', sans-serif;">Overview of E&L Goals and Outcomes</span></div>
                 <div id="subtopic-goals" class="subtopic">
                    <div class="text-box">
                    <p>
                      <b>Goals:</b></br>
						Education & Learning supports families and communities so that they create and strengthen the early education and learning environments that propel vulnerable children to be ready for school and achieve early school success. Specifically, the team aims to build and strengthen a comprehensive high quality 0-8 early care and education system where children are the priority and families are the co-creators.
                        </br>
                    </p>
                    </div>
                 </div>
                 <div id="subtopic-strategies" class="subtopic hiddenbydefault">
                    <div class="text-box">
                        <div>
                            <div style="background-color:#0ba6c3; color:#ffffff; font-size:13px; text-align:left; float:left; margin-left:0px; padding:4px;margin-bottom:10px;"><b>Family Engagement</b>: We support community-based family engagement efforts that empower parents, caregivers and families as leaders in childrens development.</div>

							<div style="background-color:#ffcc7c; color:#ffffff; font-size:13px; text-align:left; float:left; margin-left:0x; padding:4px;margin-bottom:10px;"><b>Effective Teaching</b>: We seek to improve the quality of both teaching and learning through leadership and professional development.</div>

							<div style="background-color:#87af6c; color:#ffffff; font-size:13px; text-align:left; float:left; margin-left:0px; padding:4px;margin-bottom:10px;"><b>Aligning Systems</b>: We support aligning systems to increase collaboration and improve the effectiveness of everyone who works in early child development.</div>

						</div>

                    </div>
                </div>
   
             <div class="controls">       
                <a id="goals" class="subtopic-toggle what" href="#" style="position:absolute; bottom:1%; left:2%">Goals</a>
                <a id="strategies" class="subtopic-toggle what" href="#" style="position:absolute; bottom:1%; left:22%">Outcomes</a>     
             </div>       
            <a href="/wkkf-dashboard-mb/what/" title="Click to expand" style="position:absolute; bottom:-1%; right:0%"><img src="http://dev.communitycommons.org/wp-content/uploads/2014/09/see_more.png" /></a>
        </div>    

    
    	<div id="how-section" class="summary sumsingle" data-topic="how" style="border-color:#008BB0; position: relative">
		<div style="height:20px;font-size:16px;margin:8px;border-bottom:solid 1px #d1cece;"><span style="color:#000000;font-weight:bold;">HOW //</span><span style="color:#0081c6;margin-left:10px;font-family: 'Lato', sans-serif;">Programming Approaches</span></div>
		<div id="subtopic-grantmaking" class="subtopic">
                  <div class="grantmaking chart">
                        <div class="grant" style="min-width: 400px; height: 220px; margin-left:10px; float:left"></div>
                  </div>
                  <div class="grantmaking summary-text">
                      Grantmaking text
                  </div>
                </div>
                <div id="subtopic-non-grantmaking" class="subtopic hiddenbydefault">
                  <div class="non-grantmaking chart">
                        <div class="nongrant" style="min-width: 400px; height: 220px; margin-left:10px; float:left"></div>
                  </div>
                  <div class="non-grantmaking summary-text">
                      Non-grantmaking text
                  </div>
                </div> 
                <div id="subtopic-resource-deployment" class="subtopic hiddenbydefault">
                  <div class="resource-deployment chart">
                      <div class="resourcedep" style="min-width: 400px; height: 220px; margin-left:10px; float:left"></div>
                  </div>
                  <div class="resource-deployment summary-text">
                      Resource Deployment text
                  </div>
                </div> 
           <div class="controls">    
                <a id="grantmaking" class="subtopic-toggle how" href="#" style="position:absolute; bottom:2%; left:2%">Change Strategy</a>
                <a id="resource-deployment" class="subtopic-toggle how" href="#" style="position:absolute; bottom:2%; left:35%">Funding Strategy</a>
           </div>         
           <a href="/wkkf-dashboard-mb/how/" title="Click to expand" style="position:absolute; bottom:-1%; right:0%"><img src="http://dev.communitycommons.org/wp-content/uploads/2014/09/see_more.png" /></a>
	</div>
    <div id="what-section" class="summary sumdouble" data-topic="what" style="border-color:#7C3520; position: relative; height:100px">
		<div style="height:20px;font-size:16px;margin:8px;border-bottom:solid 1px #d1cece;"><span style="color:#000000;font-weight:bold;">PROGRESS //</span><span style="color:#0081c6;margin-left:10px;font-family: 'Lato', sans-serif;">Indicator Baselines and Target Goals</span></div>
                <div id="subtopic-overall" class="subtopic"> 
                  <div class="overall chart">
                    <!--<div style="margin-left: 20px; float:left">
                        <div>
                            <div class="fcititlesum">3rd grade reading proficiency</div>
                            <div class="fcititlesum" style="margin-left: 30px;">3rd grade math proficiency</div>
                            <div class="fcititlesum" style="margin-left: 40px;">Vulnerable families with good jobs</div>
                            <div class="fcititlesum" style="margin-left: 50px;">Families with children 0-8 yrs old at/above 200% poverty level</div>
                        </div>
                        <div>
                            <div class="fcibar1sum" style="width: 200px; height: 100px; margin-left: 5px; float:left"></div>
                            <div class="fcibar2sum" style="width: 200px; height: 100px; margin-left: 15px;  float:left"></div>
                            <div class="fcibar3sum" style="width: 200px; height: 100px; margin-left: 15px; float:left"></div>
                            <div class="fcibar4sum" style="width: 200px; height: 100px; margin-left: 30px;  float:left"></div>
                        </div>    

                    </div>-->
                    <div style="margin-left: 0px; float:left;margin-top:45px;">
                        <div>
                            <div class="fcititlesum" style="margin-left: 45px; width:250px">States adopting quality improvement system for 0-5 ECE programs</div>
                            <div class="fcititlesum" style="margin-left: 45px; width:250px">States adopting standards-based quality teaching & learning practices for PK-3</div>
                            <div class="fcititlesum" style="margin-left: 45px; width:250px">States having policies to increase vulnerable children's access to quality ECE programs</div>
                        </div>
                        <div>
                            <div class="fcibar5sum" style="width: 250px; height: 100px; margin-left: 35px; float:left"></div>
                            <div class="fcibar6sum" style="width: 250px; height: 100px; margin-left: 45px; float:left"></div>
                            <div class="fcibar7sum" style="width: 250px; height: 100px; margin-left: 45px; float:left"></div>
                        </div>        
                    </div>
                  </div>  
                        
                  <div class="overall summary-text">
                      <div class="text-box" style="width:47%; height:230px;float: left;">
                            <p>
                                OVERALL ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh.</br></br>Ut malesuada sollicitudin tincidunt. 
                                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                                </br>
                            </p>
                      </div>
                      <div class="text-box" style="width:47%; height:230px; margin-left:15px;float: left">
                            <p>
                                OVERALL ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh.</br></br>Ut malesuada sollicitudin tincidunt. 
                                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                                </br>
                            </p>
                      </div>
                  </div>
                </div>
                <div id="subtopic-outcomes" class="subtopic hiddenbydefault">
                    <div class="outcomes chart">
                        Outcomes chart
                    </div>
                    <div class="outcomes summary-text">
                      <div class="text-box" style="width:47%; height:230px;float: left;">
                            <p>
                                OUTCOMES ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh.</br></br>Ut malesuada sollicitudin tincidunt. 
                                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                                </br>
                            </p>
                      </div>
                      <div class="text-box" style="width:47%; height:230px; margin-left:15px;float: left">
                            <p>
                                OUTCOMES ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh.</br></br>Ut malesuada sollicitudin tincidunt. 
                                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                                </br>
                            </p>
                      </div>
                    </div>
                </div> 
                <div id="subtopic-impact" class="subtopic hiddenbydefault">
                    <div class="impact chart">
                        Impact chart
                    </div>
                    <div class="impact summary-text">
                      <div class="text-box" style="width:47%; height:230px;float: left;">
                            <p>
                                IMPACT ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh.</br></br>Ut malesuada sollicitudin tincidunt. 
                                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                                </br>
                            </p>
                      </div>
                      <div class="text-box" style="width:47%; height:230px; margin-left:15px;float: left">
                            <p>
                                IMPACT ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh.</br></br>Ut malesuada sollicitudin tincidunt. 
                                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                                </br>
                            </p>
                      </div>
                    </div>
                </div> 
                    
        <a href="/wkkf-dashboard-mb/progress/" title="Click to expand" style="position:absolute; bottom:-1%; right:0%"><img src="http://dev.communitycommons.org/wp-content/uploads/2014/09/see_more.png" /></a>
                <div id="subtopic-implications" class="subtopic hiddenbydefault">
                    <div class="text-box">
                    <p>
                      <b>Implications</b></br>
                        Research is clear that poverty is the single greatest threat to children's well-being. But effective public policies can make a difference. Investments in the most vulnerable children are also critical</br></br>
                        One key factor to ensure high-quality early care and learning is the quality of teaching. At the same time of increasing the credential/degree requirements of early childhood professionals,
                        there are also needs to be on-going support to existing teaching workforce in 0-8 learning settings.
                        </br>
                    </p>
                    </div>
                </div>  		
             <div class="controls">    
				<a id="overall" class="subtopic-toggle progress" href="#" style="position:absolute; bottom:1%; left:2%">Progress</a>			 
                <a id="implications" class="subtopic-toggle progress" href="#" style="position:absolute; bottom:1%; left:22%">Implications</a>      
             </div> 		
		
        </div>   



</div>
<?php 
}
if (is_page('where')) {
?>
<div id="where-expanded" data-topic="where" style="border-color:#FDBB30; margin-top:40px; position: relative">
        <div style="margin-left:10px;height:25px;font-size:18pt;padding-top:7px;text-align:left;"><b>WHERE //</b><span style="color:#0081c6;margin-left:15px;font-family: 'Lato', sans-serif;">Geographic Context</span><span style="float:right;"><a href="/wkkf-dashboard-mb" class="button">Return to Dashboard</a></span></div><br /><br />
		<p style="margin-left:10px;">Please click on a map to expand it:</p>
		<div id="map1" class="summary sumsingle">
			<script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=3597&vm=3597&w=450&h=240&l=0&bbox=-14582113.088652689,2804241.044125512,-7170778.826123968,6419406.733900247&maplink=new'></script>	
			<p style="text-align:center;margin-top:10px;">Population Below the Poverty Level, Children (Age 0-4), ACS 2008-12</p>
		</div>
		<div id="map2" class="summary sumsingle">
					  <script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=6872&vm=6872&w=450&h=240&l=0&bbox=-14582113.088652689,2804241.044125512,-7170778.826123968,6419406.733900247&maplink=new'></script>		
			<p style="text-align:center;margin-top:10px;">NAEYC-Accredited Facilities</p>
		</div>
		<div id="map3" class="summary sumsingle">
					  <script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=4811&vm=4811&w=450&h=240&l=0&bbox=-14582113.088652689,2804241.044125512,-7170778.826123968,6419406.733900247&maplink=new'></script>		
			<p style="text-align:center;margin-top:10px;">Population at or below 200% Poverty</p>
		</div>		

</div>
<?php
}
if (is_page('who')) {
?>
<div id="who-expanded" data-topic="who" style="border-color:#FDBB30; margin-top:40px; position: relative">
        <div style="margin-left:10px;height:25px;font-size:18pt;padding-top:7px;text-align:left;"><b>WHO //</b><span style="color:#0081c6;margin-left:15px;font-family: 'Lato', sans-serif;">Population-Level Landscape</span><span style="float:right;"><a href="/wkkf-dashboard-mb" class="button">Return to Dashboard</a></span></div><br /><br />

        <div class="race_ex" style="width: 300px; height: 240px; margin-left: 25px; float:left"></div>
        <div class="gender_ex" style="width: 200px; height: 240px; margin-left: 35px; float:left"></div>
        <div class="age_ex" style="width: 350px; height: 240px; margin-right: 25px; float:right"></div>
        <div class="householdsize_ex" style="width: 400px; height: 240px; margin-left:25px; float:left; margin-top: 20px"></div>
        <div class="family_ex" style="width: 440px; height: 240px; margin-right: 40px;  float:right; margin-top: 20px"></div>
        <div class="attainment_ex" style="min-width: 400px; height: 240px; margin-left:25px; float:left; margin-top: 20px"></div> 
        <div class="language_ex" style="width: 400px; height: 240px; margin-right:40px; float:right; margin-top: 20px"></div>

</div>
<?php 
}
if (is_page('how')) {

?>
<div id="how-expanded" data-topic="how" style="border-color:#008BB0; margin-top:40px; position: relative">
        <div style="margin-left:10px;height:25px;font-size:18pt;padding-top:7px;text-align:left;"><b>HOW //</b><span style="color:#0081c6;margin-left:15px;font-family: 'Lato', sans-serif;">Programming Approaches</span><span style="float:right;"><a href="/wkkf-dashboard-mb" class="button">Return to Dashboard</a></span></div><br /><br />
		<div style="margin-left:10px;"><a href="#ssi">Strategy-Specific Indicators</a> | <a href="#ssli">Strategy-Specific Leading Indicators</a> | <a href="#cs">Change Strategies</a> | <a href="#fs">Funding Strategies</a></div>
        <br />
	<div style="margin-left: 10px ">
		<a name="ssi"></a>
		<div style="border-color:#0081c6; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Strategy-Specific Indicators</title2></div> 
	</div>		
	<div style="margin-left: 10px ">
		<a name="ssli"></a>
		<div style="border-color:#0081c6; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Strategy-Specific Leading Indicators</title2></div> 
	</div>
	<div style="margin-left: 10px ">
		<a name="cs"></a>
		<div style="border-color:#0081c6; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Change Strategies</title2></div> 
	</div>
	<div style="margin-left: 10px ">
		<a name="fs"></a>
		<div style="border-color:#0081c6; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Funding Strategies</title2></div> 
	</div>	
	<br />
	<br />
	<br />
	<br />
		<p style="margin-left:10px;       line-height: 20px;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh. Ut malesuada sollicitudin tincidunt. 
            Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br>
        </p>
        <div class="budget1_ex" style="width: 450px; height: 300px; margin-left: 15px; margin-top:15px; float:left"></div>
        <div class="budget2_ex" style="width: 450px; height: 300px; margin-left: 5px; margin-top:15px; float:left"></div>
        <div style="width: 430px; height: 300px; margin-left: 10px; margin-top:40px; float:left;">
            <p style="line-height: 20px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh. Ut malesuada sollicitudin tincidunt. 
                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br></br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh. Ut malesuada sollicitudin tincidunt. 
                Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br>
            </p>
        </div>
        <div class="budget3_ex" style="width: 450px; height: 300px; margin-left: 5px; margin-top:30px; float:left"></div>

</div>
<?php 
}
if (is_page('what')) {

?>
<div id="what-expanded" data-topic="what" style="border-color:#0081c6; margin-top:40px;">
        <div style="height:25px;font-size:18pt;padding-top:7px;text-align:left;"><b>WHAT //</b><span style="color:#0081c6;margin-left:15px;font-family: 'Lato', sans-serif;">Overview of E&L Goals and Outcomes</span><span style="float:right;"><a href="/wkkf-dashboard-mb" class="button">Return to Dashboard</a></span></div><br /><br />


		<p style="font-size:14pt;margin-bottom:15px;color:#0081c6;font-family: 'Lato', sans-serif;">Goals</p>

		<p style="margin-left:10px;margin-bottom:20px;">
						Education & Learning supports families and communities so that they create and strengthen the early education and learning environments that propel vulnerable children to be ready for school and achieve early school success. Specifically, the team aims to build and strengthen a comprehensive high quality 0-8 early care and education system where children are the priority and families are the co-creators.

		</p>
		<p style="font-size:14pt;margin-bottom:15px;color:#0081c6;font-family: 'Lato', sans-serif;">Outcomes</p>
		<p style="margin-left:10px;margin-bottom:20px;">
                            <div style="background-color:#0ba6c3; color:#ffffff; font-size:12pt; text-align:left; padding:10px;margin-bottom:10px;">Family Engagement</div>		
								<div style="margin-left:10px; margin-bottom:15px; padding-top:10px">
									<ul>
										<li>Support family leadership development</li>
										<li>Build institutional capacity for family-entered engagement structure, practices & policies</li>
									</ul>							
								</div>
							<div style="background-color:#ffcc7c; color:#ffffff; font-size:12pt; text-align:left; padding:10px;margin-bottom:10px;">Effective Teaching</div>		
								<div style="margin-left:10px; margin-bottom:15px; padding-top:10px">
									<ul>
										<li>Support quality 0-8 teachers’ professional learning (in-service and pre-service)</li>
										<li>Create quality 0-8 systems through aligning pre- and in-service training, accreditation standards & programs</li>
									</ul>								
								</div>
							<div style="background-color:#87af6c; color:#ffffff; font-size:12pt; text-align:left; padding:10px;margin-bottom:10px;">Aligning Systems</div>	
								<div style="margin-left:10px; margin-bottom:15px; padding-top:10px">
									<ul>
										<li>Strengthen whole-child, whole-family support programs & system</li>
										<li>Elevate early childhood education as a priority in the state</li>
										<li>Disseminate child-centered equitable national policy agenda</li>
									</ul>								
								</div>	
        </p>
	<a href="#" class="toggle" style="position:absolute; bottom:2%; right:2%"><b style="color:#7f7f7f; font-size: 13px;">&larr; Minimize</b></a>
</div>
<?php
}
?>
<div id="where-expanded" class="expanded-topic" data-topic="where" style="border-color:#5E9732; margin-top:40px; position: relative">
        <h2 style="background-color:#5E9732; height:25px;  color:#ffffff; font-size:18px;padding-top:7px">Where</h2></br>
        <p style="margin-left:10px; line-height: 20px;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis libero enim, vel dapibus quam pretium non. Maecenas nec risus dapibus, lobortis nulla a, tempus nibh. Ut malesuada sollicitudin tincidunt. 
            Donec luctus sollicitudin ultrices. Donec ac augue sit amet sapien cursus luctus nec et arcu. Quisque eu aliquet metus, quis molestie lacus. Maecenas dui odio, venenatis ac tristique vitae, faucibus sit amet massa.</br>
        </p>
        <img style=" width:900px; height:442px; margin:1%; margin-left:20px; padding-top:50px" src="/wp-content/uploads/2014/03/WKKF_mapVPF_ex.png" />
        <a class="info" href="#" style="position:absolute; bottom:1%; left:10%"><b style="color:#7f7f7f; font-size: 12px;">Demographics</b>
        <a class="info" href="#" style="position:absolute; bottom:1%; left:30%"><b style="color:#7f7f7f; font-size: 12px;">Education</b>   
        <a class="info" href="#" style="position:absolute; bottom:1%; left:50%"><b style="color:#7f7f7f; font-size: 12px;">Economics</b>   
	<a class="info" href="#" style="position:absolute; bottom:1%; left:70%"><b style="color:#7f7f7f; font-size: 12px;">Health</b>
	<a href="#" class="toggle" style="position:absolute; bottom:1%; right:2%"><b style="color:#7f7f7f; font-size: 13px;">&larr; Minimize</b></a>
</div>
<?php 
if (is_page('progress')) {
?>
<div id="what-expanded" data-topic="what" style="border-color:#7C3520; margin-top:40px; position: relative">
        <div style="height:25px;font-size:18pt;padding-top:7px;text-align:left;"><b>PROGRESS //</b><span style="color:#0081c6;margin-left:15px;font-family: 'Lato', sans-serif;">Indicator Baselines and Target Goals</span><span style="float:right;"><a href="/wkkf-dashboard-mb" class="button">Return to Dashboard</a></span></div><br /><br />
	
        <div style="margin-bottom:25px;font-size:10pt;">
		<a href="#kci">Key Condition Indicators</a> | <a href="#likc">Leading Indicators of the Key Conditions</a> | <a href="#ssi">Strategy-Specific Indicators</a> | <a href="#ssli">Strategy-Specific Leading Indicators</a> | <a href="#implications">Implications</a>

		</div>		
        <p style="margin-left:10px; line-height: 20px;">
            We want to partner with families, schools and communities in making a difference in young children's learning and development. To do so, we support 
            community-based family engagement efforts that empower parents, caregivers and families as leaders in children's development, recognizing that this is a shared responsibility with schools and communities. </br></br>
        </p>
        <div style="margin-left:10px; line-height: 20px;">Strategy-specific outcomes:</br></br>
            <ul style="margin-left:10px; line-height: 20px">
                <li style="line-height: 20px">State or organizational infrastructure to support "next" practices</li>
                <li style="line-height: 20px">State & national dedicated funding for principle-based family engagement</li>
                <li style="line-height: 20px">Statewide leadership to champion principle-based family engagement</li>
            </ul>    
        </div>
        <div style="padding-top:20px; padding-bottom:15px">
            <div>
                <div style="float:left;margin:1%; padding-bottom:15px">    
                <img style=" width:30px; height:2px; vertical-align:middle;margin-right:8px;margin-left:8px; font-size:12px" src="/wp-content/uploads/2014/03/wkkf_blueline.png" />Baseline
                <img style=" width:30px; height:2px;  vertical-align:middle;margin-right:8px;margin-left:8px; font-size:12px" src="/wp-content/uploads/2014/03/wkkf_redline.png" />Benchmark
                <img style=" width:30px; height:2px;  vertical-align:middle;margin-right:8px;margin-left:8px; font-size:12px" src="/wp-content/uploads/2014/03/wkkf_greenline.png" />Goal</div>
            <div style="float:right; margin:1%; padding-bottom:15px">
                <img style=" width:12px; height:12px; ; vertical-align:top;margin-right:8px;margin-left:8px; font-size:12px" src="/wp-content/uploads/2014/03/green_dot1.png"/>Above benchmark
                <img style=" width:12px; height:12px; vertical-align:top;margin-right:8px;margin-left:8px; font-size:12px" src="/wp-content/uploads/2014/03/red_triangle.png" />Below benchmark</div> 
            </div>
        </div>
	<div style="margin-left: 10px ">
		<a name="kci"></a>
		<div class="title2box" style="border-color:#235937; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Key Condition Indicators</title2></div> 
	</div>
	<div style="margin-left: 10px ">
	<a name="likc"></a>
		<div class="title2box" style="border-color:#235937; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Leading Indicators of the Key Conditions</title2></div> 
	</div>        
	<div id="titlerow1" style=" margin-left: 10px ">
		<a name="ssi"></a>
		<div class="title2box" style="border-color:#235937; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Strategy-Specific Indicators</title2></div> 
	</div>
    <div>     
        
        <div class="fcititle" style="margin-left: 35px;margin-top:20px ">Programs reflecting principle-based family engagement</div>
        <div class="fcititle" style="margin-left: 70px;margin-top:20px ">Creation fo principle-based family engagement policy agenda</div>
    </div>
<div id="fcirow">

        <div id="fci1" class="fcibox" data-type="bar" style="border-color:#7f7f7f; position: relative; margin-bottom:15px; margin-left: 25px ">
          <div id="fcibar1" class="fci1 bar" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div>
          <div id="fciline1" class="fci1 line" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div>
          <img style=" width:12px; height:12px; margin:1%; position:absolute; bottom:2%; left:2%" src="/wp-content/uploads/2014/03/<?php if ($datafci1_ex>$benchfci1_ex){echo "green_dot1.png";} elseif($datafci1_ex<$benchfci1_ex){echo "red_triangle.png";}?>" />
          <a href="#" class="toggle" style="position:absolute; bottom:2%; right:8%"><img style=" width:70px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_linepct.png" /></a>
          <a class="info" href="#" style="position:absolute; bottom:2%; right:2%"><img style=" width:15px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_info.png" />
              <span><b># of children who are ready for school in communities or states served</br></br>Source: </b>US Department of Education</br></br><b>Year: </b>2012</br></br><b>Description: </b>
              "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
              </span>
          </a>
        </div>

    
    <div id="fci2" class="fcibox" style="border-color:#7f7f7f; position: relative; margin-bottom:15px; margin-left: 70px ">
      <div id="fcibar2" class="fci2 bar" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div> 
      <div id="fciline2" class="fci2 line" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div>  
      <img style=" width:12px; height:12px; margin:1%; position:absolute; bottom:2%; left:2%" src="/wp-content/uploads/2014/03/<?php if ($datafci2_ex>$benchfci2_ex){echo "green_dot1.png";} elseif($datafci2_ex<$benchfci2_ex){echo "red_triangle.png";}?>" />
      <a href="#" class="toggle" style="position:absolute; bottom:2%; right:8%"><img style=" width:70px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_linepct.png" /></a>
      <a class="info" href="#" style="position:absolute; bottom:2%; right:2%"><img style=" width:15px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_info.png" />
           <span><b># of children who are reading-and-math proficient by third grade</br></br>Source: </b>US Department of Education</br></br><b>Year: </b>2012</br></br><b>Description: </b>
           "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            </span>
      </a>      
    </div>

</div>
	<div style="margin-left: 10px ">
		<a name="ssli"></a>
		<div class="title2box" style="border-color:#235937; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#0081c6">Strategy-Specific Leading Indicators</title2></div> 
	</div>
<div style="margin-left: 35px">
    <div class="title3box" style="border-color:#235937; position: relative;margin-top:20px"><title3>Communities with partnerships where families and schools share responsibility</title2></div>
    <div class="title3box" style="border-color:#235937; position: relative; margin-left: 60px;margin-top:20px "><title3>States with statewide awareness of principle-based family engagement</title2></div>    
</div>
<div id="fcirow">

        <div id="fci3" class="fcibox" data-type="bar" style="border-color:#7f7f7f; position: relative; margin-bottom:15px; margin-left: 25px ">
          <div id="fcibar3" class="fci3 bar" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div>
          <div id="fciline3" class="fci3 line" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div>
          <img style=" width:12px; height:12px; margin:1%; position:absolute; bottom:2%; left:2%" src="/wp-content/uploads/2014/03/<?php if ($datafci3_ex>$benchfci3_ex){echo "green_dot1.png";} elseif($datafci3_ex<$benchfci3_ex){echo "red_triangle.png";}?>" />
          <a href="#" class="toggle" style="position:absolute; bottom:2%; right:8%"><img style=" width:70px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_linepct.png" /></a>
          <a class="info" href="#" style="position:absolute; bottom:2%; right:2%"><img style=" width:15px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_info.png" />
              <span><b># of states implementing a statewide quality system for 0-5 early care and education (ECE) programs</br></br>Source: </b>Lorem ipsum dolor</br></br><b>Year: </b>2013</br></br><b>Description: </b>
              "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
              </span>
          </a>
        </div>

    
    <div id="fci4" class="fcibox" style="border-color:#7f7f7f; position: relative; margin-bottom:15px; margin-left: 70px ">
      <div id="fcibar4" class="fci4 bar" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div> 
      <div id="fciline4" class="fci4 line" style="width: 400px; height: 110px; margin-left: 5px ;margin-top: 5px; float:left"></div>  
      <img style=" width:12px; height:12px; margin:1%; position:absolute; bottom:2%; left:2%" src="/wp-content/uploads/2014/03/<?php if ($datafci4_ex>$benchfci4_ex){echo "green_dot1.png";} elseif($datafci4_ex<$benchfci4_ex){echo "red_triangle.png";}?>" />
      <a href="#" class="toggle" style="position:absolute; bottom:2%; right:8%"><img style=" width:70px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_linepct.png" /></a>
      <a class="info" href="#" style="position:absolute; bottom:2%; right:2%"><img style=" width:15px; height:15px; margin:1%" src="/wp-content/uploads/2014/03/wkkf_info.png" />
           <span><b># of states having & implementing early learning standardxs or developmental guidelines to support access and quality of early care and education programs</br></br>Source: </b>Lorem ipsum dolor</br></br><b>Year: </b>2012</br></br><b>Description: </b>
           "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            </span>
      </a>      
    </div>

</div>
<div style="margin-left: 10px ">
	<a name="implications"></a>
	<div class="title2box" style="border-color:#235937; position: relative; text-align:left;margin-top:30px;"><title2 style="color:#dea326">Implications</title2></div> 
</div>


</div> 
<?php
}
?>

</div>        



<!-- ############################# CHART FUNCTIONS ######################################### -->

<!-- ############################# WHO CHARTS ######################################### -->

<script>  
   $(function () {    
    $('.numUnder18').highcharts({
        chart: {
          backgroundColor:'transparent',
            plotBorderWidth: null,
            plotShadow: false,
                               margin: [0, 0, 0, 0],
        spacingTop: 0,
        spacingBottom: 0,
        spacingLeft: 0,
        spacingRight: 0
        },
        title: {
            style: {
                fontSize: '13px'
            },
            text: 'Population < 18'
        },

        tooltip: {
    	    pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                size:'65%',
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
         credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Number Under 18',
            data: [
                {name:'Pop. < 18',
                 y: <?php echo $under18_num; ?>,
                 color:'#9393c4',
                 sliced: false
                },
                {
                    name: 'Pop. >= 18',
                    y: <?php echo $over18_num; ?>,
                    color:'#e86c85'
                }
            ]
        }]
    });
});
</script>
  
<script>  
   $(function () {    
    $('.percUnder18').highcharts({
        chart: {
          backgroundColor:'transparent',
            plotBorderWidth: null,
            plotShadow: false,
                               margin: [0, 0, 0, 0],
        spacingTop: 0,
        spacingBottom: 0,
        spacingLeft: 0,
        spacingRight: 0
        },
        title: {
            style: {
                fontSize: '13px'
            },
            text: '% Population < 18'
        },

        tooltip: {
    	    pointFormat: '<b>{point.percentage:.1f}%</b><br />{point.x}'
        },
        plotOptions: {
            pie: {
                size:'65%',
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
         credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Percent Under 18',
            data: [
                {name:'Pop. < 18',
                 y: 23.3,
				 x: 73658019,
                 color:'#9393c4',
                 sliced: false
                },
                {
                    name: 'Pop. >= 18',
                    y: 76.7,
					x: 242470820,
                    color:'#e86c85'
                }
            ]
        }]
    });
});
</script>

<script>
   $(function () {
        $('.race1').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent',
				height: '130'
            },
            title: {
                            style: {
                fontSize: '13px'
            },
                text: 'Race '
            },
            xAxis: {
                categories: ['White','African-American', 'Asian', 'Hawaiian/ Pacific Islander', 'Am. Indian / Alask. Native', 'Hispanic (of any race)'],
                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
            },
            yAxis: {
                min: 0,
                max:50,
                title: {
                    text: null
                }

   
            },
            tooltip: {
                valueSuffix: ' %',
                pointFormat: '<b>{point.y}</b>'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#0ba6c3',
                    pointWidth: 6
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [52, 32, 8, 5, 1, 1]
            }]
        });
    });

  </script>
<script>
$(function () {
        $('.language').highcharts({
        chart: {
	        type: 'column',
                backgroundColor:'transparent',
                plotBorderWidth: null,
                plotShadow: false,
            events: {
            load: function () {
                var label = this.renderer.label("English: <b>79.5%</b> Other: <b>20.5%</b>")
                .css({
                    width: '50px',
                    fontSize: '9px',

                })
                .attr({
                    
                })
                .add();
                
                label.align(Highcharts.extend(label.getBBox(), {
                    align: 'right',
                    x: 0, // offset
                    floating: true,
                    verticalAlign: 'top',
                    y: 32 // offset
                }), null, 'spacingBox');
                
            }
			}, 
		width:225
	    },
        title: {
            style: {
                fontSize: '11px'
            },
                text: 'Language Spoken at Home',

            },

	    xAxis: {
                labels: {
                    enabled:false,
                },
	        categories: ['English', 'Spanish/Spanish Creole', 'Other Indo-European', 'Asian/Pac. Island', 'Other']
	    },
        yAxis: {
                title: {
                    text: null,
                },
               tickPositions: [0, 20, 40, 60, 80],
               
        },
            tooltip: {
                formatter: function() {
                    return this.x +': '+ '<b>'+ this.y +'%'
                        ;
                }
            },
	    plotOptions: {
	        series: {
	            pointWidth: 25
	        }
	    },
	           
         credits: {
            enabled: false
        },
        legend: {
            enabled: false
            
        },
	    series: [{
	        data: [{y: 79.5, color: '#0081c6'},{y: 12.7, color: '#F8971D'},{y: 3.7, color: '#F8971D'},{y: 3.2, color: '#F8971D'},{y: 0.9, color: '#F8971D'}]
	    }]
	});
});

</script>
<script>
$(function () {
	$('.highedinst').highcharts({
	    chart: {
	        type: 'column',
                backgroundColor:'transparent',
                plotBorderWidth: null,
                plotShadow: false
	    },
        title: {
            style: {
                fontSize: '11px'
            },
                text: 'Higher Ed. Inst. by Type',

            },
        subtitle: {
            style: {
                fontSize: '10px'
            },
                text: 'Total.: 7,734',

            }, 
	    xAxis: {
	        categories: ['2-Year', '2 to 4 Year', '4 Year'],
                labels: {
                enabled: false
            } 
	    },
        yAxis: {
                title: {
                    enabled: false
                },
                tickInterval:1000
        },
            tooltip: {
                pointFormat: "<b>{point.y:,.0f}</b>",
                positioner: function () {
                    return { x: 50, y: 40 };
                },
                style: {
                fontSize: '10px',
                padding: 2,
                },
            },
	    plotOptions: {
	        series: {
	            pointWidth: 15
	        }
	    },
	           
         credits: {
            enabled: false
        },
        legend: {
            enabled: false
        },
	    series: [{
	        data: [2154, 2363 , 3217],
                color:'#008BB0'
	    }]
	});
});
</script>

<script>
$(function () {
	
    $('.freeredlunch').highcharts({
	
	    chart: {
	        type: 'gauge',
                backgroundColor:'transparent',
                width: 200,
                height: 160,
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,
            spacingBottom: 0,

	    },
	    
	    title: {
              style: {
                fontSize: '11px'
            },
	        text: 'Free/Reduced Price Eligible'
	    },
	    
	    pane: {
	        startAngle: -90,
	        endAngle: 90,
            background: null
	    },
        
        plotOptions: {
  
            gauge: {
                dataLabels: {
                    enabled: false
             },
                dial: {
                    baseLength: '0%',
                    baseWidth: 5,
                    radius: '100%',
                    rearLength: '0%',
                    topWidth: 1
                }
            }
        },
	       
	    // the value axis
	    yAxis: {
            labels: {
                enabled: true,
               distance: 20,
            },
            tickPositions: [0, 20, 40, 60, 80, 100],
            tickPosition: 'outside',
            minorTickLength: 0,
	        min: 0,
	        max: 100,
	        plotBands: [{
	            from: 0,
	            to: 25,
	            color: '#b5636b', // red
                thickness: '50%'
	        }, {
	            from: 25,
	            to: 75,
	            color: '#FDBB30', // yellow
                thickness: '50%'
	        }, {
	            from: 75,
	            to: 100,
	            color: '#5E9732', // green
                thickness: '50%'
	        }]        
	    },
                         credits: {
            enabled: false
        },
	
	    series: [{
	        name: 'Eligible',
	        data: [47.5],
            	        tooltip: {
	            valueSuffix: '%',
                    
	        }
	    }]
	
	});
});
</script>  

<script>
    $(function () {
        $('.elemsch').highcharts({
	    chart: {
            plotBackgroundColor: null,
            backgroundColor:'transparent',
            plotBorderWidth: 0,
            plotShadow: false,
            width: 200,
            height: 130,
            
        },
        title: {
            text: 'Elementary Schools',
            style: {
                fontSize: '13px'
            },
            align: 'center',
            x:0,
            y:5,

        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}% <br/> <b>{point.y:,.0f} </b>'
        },
        plotOptions: {
            pie: {
                size: 120,
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
          credits: {
          enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Household size',
            innerSize: '60%',
            data: [
                {name:'Public', y:54113, color:'#008BB0'},
                 {name:'Private', y:25983, color:'#E6BB83'}

            ],
        }]
    });
});
    
</script>
<script>

$(function () {
        $('.tests').highcharts({
            chart: {
                type: 'column',
                backgroundColor:'transparent',
            },
            title: {
              style: {
                fontSize: '13px'
            },
                text: 'Test Proficiency'
            },
            xAxis: {
                categories: ['Reading', 'Math'],
                labels: {
                    enabled: false
                },
            },
            yAxis: {
                min: 0,
                tickPositions: [0, 50, 100],
                title: {
                    enabled: false,
                }
            },
            tooltip: {
                pointFormat: '{series.name}:  <b>{point.percentage:.1f}%</b><br/>',
                shared: false,
                positioner: function () {
                    return { x: 80, y: 40 };
                },
                style: {
                fontSize: '10px',
                padding: 2,
                },
            },
            plotOptions: {
                column: {
                    stacking: 'percent'
                }
            },
            credits: {
               enabled: false
            },
            legend: {
               enabled: false
            },
                series: [{
                name: 'Not Proficient',
                    data: [{y: 64.8, color: 'lightgrey'},{y: 58.2, color: 'lightgrey'}]
            }, {
                name: 'Proficient',
                data: [{y: 35.2, color: '#6391b5'},{y: 41.8, color: '#b5636b'}]
            }]
        });
    });

</script>
<script>
    $(function () {
        $('.unemployment').highcharts({
            chart: {
             backgroundColor:'transparent',
             plotBorderWidth: null,
             plotShadow: false
            },
            title: {
              style: {
                fontSize: '13px'
            },
                text: 'Unemployment',

            },
            
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    enabled: false
                },
            },
            yAxis: {
                title: {
                  enabled: false,
                },
                min:0,
                max:30,
                tickPositions: [0, 10, 20, 30],
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '%',
                crosshairs: true,
                shared: true,
              style: {
                fontSize: '10px',
                padding: 2,
            },
                
            },
            legend: {
                enabled: false,
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
                     credits: {
            enabled: false
        },
            series: [{
                name: 'Battle Creek',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                color:'#008BB0'
            }, {
                name: 'Michigan',
                data: [5, 5.2, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5],
                color:'#FDBB30'
            }, {
                name: 'United States',
                data: [3.2, 3, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0],
                color:'#919195'
            }]
            
        });
    });
    
</script>
<script>

$(function () {
	$('.income').highcharts({
	    chart: {
	        type: 'column',
                backgroundColor:'transparent',
                plotBorderWidth: null,
                plotShadow: false
	    },
        title: {
            style: {
                fontSize: '13px'
            },
                text: 'Household Income',

            },
        subtitle: {
            style: {
                fontSize: '9px'
            },
                text: 'Avg.: $32,452',

            },            
	    xAxis: {
	        categories: ['Below $25,000', '$25,000 - $50,000', '$50,000 - $100,000', '$100,000 - $200,000', '$200,000 or more'],
               labels: {
                enabled:false,   
                style: {
                    fontSize:'10px'
                }
            }               
            },
        yAxis: {
           tickPositions: [0, 25, 50],
                title: {
                    enabled:false,
                }
        },
            tooltip: {
                formatter: function() {
                    return this.x +': '+ '<b>'+ this.y +'%'
                        ;
                },
                positioner: function () {
                    return { x: 50, y: 50 };
                },
               style: {
                fontSize: '10px',
                padding: 2,
                },
            },
	    plotOptions: {
	        series: {
	            pointWidth: 20
	        }
	    },
	           
         credits: {
            enabled: false
        },
        legend: {
            enabled:false,
        },
	    series: [{
	        data: [22.0, 40.0, 31.0, 5.0, 2.0],
                color:'#E6BB83'
	    }]
	});
});


</script>
<script>

$(function () {
        $('.assistance').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent',      
            },
            title: {
              style: {
                fontSize: '13px'
            },                
                text: 'Assistance'
            },
            xAxis: {
                categories: ['Medicaid', 'SNAP', 'WIC', 'Free/Reduced Lunch'],
                labels: {
                    enabled:false
                },
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                max:50,
                tickPositions: [0, 10, 20, 30, 40, 50],
                                title: {
                    text: null
                }
            },
            tooltip: {
                valueSuffix: ' %',
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    }
                },
                                series: {
	              pointWidth: 8,

	        } 
            },
            legend: {
             enabled:false,
            },
            credits: {
                enabled: false
            },
            series: [{
	        data: [22.0, 40.0, 31.0, 5.0],
                color:'#008BB0'
	    }]

        });
    });
    


</script>
<script>
$(function () {
	
    $('.poverty').highcharts({
	
	    chart: {
	        type: 'gauge',
                backgroundColor:'transparent',
                width: 200,
                height: 160,
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,
            spacingBottom: 0,

	    },
	    
	    title: {
              style: {
                fontSize: '13px'
            },
	        text: 'Poverty (200%)'
	    },
	    
	    pane: {
	        startAngle: -90,
	        endAngle: 90,
            background: null
	    },
        
        plotOptions: {
  
            gauge: {
                dataLabels: {
                    enabled: false
             },
                dial: {
                    baseLength: '0%',
                    baseWidth: 5,
                    radius: '100%',
                    rearLength: '0%',
                    topWidth: 1
                }
            }
        },
	       
	    // the value axis
	    yAxis: {
            labels: {
                enabled: true,
               distance: 20,
            },
            tickPositions: [0, 20, 40, 60, 80, 100],
            tickPosition: 'outside',
            minorTickLength: 0,
	        min: 0,
	        max: 100,
	        plotBands: [{
	            from: 0,
	            to: 15,
	            color: '#5E9732', // green
                thickness: '50%'
	        }, {
	            from: 15,
	            to: 40,
	            color: '#FDBB30', // yellow
                thickness: '50%'
	        }, {
	            from: 40,
	            to: 100,
	            color: '#b5636b', // red
                    
                thickness: '50%'
	        }]        
	    },
                         credits: {
            enabled: false
        },
	
	    series: [{
	        name: 'In Poverty',
	        data: [27],
            	        tooltip: {
	            valueSuffix: '%'
	        }
	    }]
	
	});
});
    
</script>
<script>
$(function () {
        $('.obesity').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent',
            },
            title: {
                            style: {
                fontSize: '13px'
            },
                text: 'Obesity'
            },
            xAxis: {
                categories: ['']
            },
            yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: null
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
                    legend: {
            enabled: false
        },

            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +
                        this.series.name +': '+ this.y +'%'
                        ;
                }
            },
            plotOptions: {
                bar: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
              credits: {
      enabled: false
  },
            series: [{
                name: 'Obese',
                color:'#b5636b',                
                data: [22.5]
            }, {
                name: 'Overweight',
                color:'#F8971D',                
                data: [37.5]
            }, {
                name: 'Healthy Weight',
                color:'#919195',
                data: [40]
            } ]
        });
    });
    

</script>
<script>
$(function () {
        $('.mortality').highcharts({
            chart: {
                backgroundColor:'transparent'
            },
            title: {
              style: {
                fontSize: '13px'
            },
                text: 'Infant Mortality Rate',
                x: -20 //center
            },
            
            xAxis: {
                categories: ['2009', '2010', '2011', '2012', '2013']
            },
            
            
            yAxis: {
                min:0,
                tickPositions: [0, 2, 4, 6],
                title: {
                    text: null,
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                enabled:false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Rate',                    
                data: [3.5,3.0,3.2,2.9,3.2],
                color:'#008BB0'
            }]
        });
    });
</script>
<script>
$(function () {
$('.uninsured').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent',      
            },
            title: {
              style: {
                fontSize: '13px'
            },
                text: 'Uninsured'
            },

            xAxis: {
                categories: ['Total', 'Under age 18', 'Age 18-64', 'Age 65 and up'],
                title: {
                    text: null
                },
                labels: {
                    enabled:false,
                },
            },
            yAxis: {

                title: {
                    text: null
                }
            },
            tooltip: {
                valueSuffix: ' %',
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    }
                },
                                series: {
	              pointWidth: 8,

	        } 
            },
            legend: {
            enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Uninsured',
                data: [{y: 12, color: '#5E9732'},{y: 8, color: '#008BB0'},{y: 10, color: '#008BB0'},{y: 15, color: '#008BB0'}]
            }]
        });
    });
   
    
</script>
<script>
$(function () {
        $('.birthweight').highcharts({
            chart: {
	        type: 'column',
                backgroundColor:'transparent',
                plotBorderWidth: null,
                plotShadow: false
	    },
        title: {
            style: {
                fontSize: '13px'
            },
                text: 'Low birthweight',

            },

	    xAxis: {
                labels: {
                    enabled:false,
                },
	        categories: ['Battle Creek', 'Calhoun County', 'Alcona County', 'Benzie County', 'Flint County']
	    },
        yAxis: {
                title: {
                    text: null,
                },
               tickPositions: [0, 25, 50],
               plotLines: [{
                    color: '#DB0962',
                    width: 1,
                    value: 31,
                    dashStyle: 'longdash',
                    label:{
                       text: 'United States: 31%',
                       style: {
                        color:'gray',
                        fontSize: '10px'
                        },
                       align: 'right',
                       x:-10}
 
                        
            },]
        },
            tooltip: {
                formatter: function() {
                    return this.x +': '+ '<b>'+ this.y +'%'
                        ;
                }
            },
	    plotOptions: {
	        series: {
	            pointWidth: 25
	        }
	    },
	           
         credits: {
            enabled: false
        },
        legend: {
            enabled: false
        },
	    series: [{
	        data: [{y: 26.4, color: '#7C3520'},{y: 40.0, color: '#E6BB83'},{y: 31.0, color: '#E6BB83'},{y: 12.0, color: '#E6BB83'},{y: 18.0, color: '#E6BB83'}]
	    }]
	});
});

</script>
<script>
   $(function () {
        $('.race_ex').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: 'Race '
            },
            xAxis: {
                categories: ['White','African-american', 'Asian', 'Hawaiian/ Pacific Islander', 'Am. Indian / Alask. Native', 'Hispanic (of any race)'],
                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
            },
            yAxis: {
                min: 0,
                max:60,
                title: {
                    text: 'Pop. (%)',
                    align: 'high'
                }
   
            },
            tooltip: {
                valueSuffix: ' %',
                pointFormat: '<b>{point.y}</b>'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#0ba6c3',
                    pointWidth: 15
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [52, 32, 8, 5, 1, 1]
            }]
        });
    });

  </script>
  
  <script>  
   $(function () {    
    $('.gender_ex').highcharts({
        chart: {
          backgroundColor:'transparent',
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            style: {
                fontSize: '16px'
            },
            text: 'Gender'
        },

        tooltip: {
    	    pointFormat: '<b>{point.percentage:.1f}%</b>'
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
         credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Gender',
            data: [
                {name:'Male',
                 y: 45.0,
                 color:'#9393c4',
                 sliced: true
                },
                {
                    name: 'Female',
                    y: 55.0,
                    color:'#e86c85'
                }
            ]
        }]
    });
});
</script>
<script>
$(function () {
    var chart,
        categories = ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75-79', '80-84', '85-89', '90-94',
            '95-99', '100 +'];
    $(document).ready(function() {
        $('.age_ex').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent',    
            },
            title: {
                text: 'Population pyramid'
            },

            xAxis: [{
                categories: categories,
                reversed: false,
                labels: {
                    step: 1,
                    style: {
                    fontSize:'8px'
                }
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function(){
                        return (Math.abs(this.value) / 1000000) + 'M';
                    }
                },
                min: -4000000,
                max: 4000000
            },
            legend: {
            enabled: false
            },
         credits: {
            enabled: false
        },    
            plotOptions: {
                series: {
                    stacking: 'normal',
	            pointWidth: 8
	        }
                
            },
    
            tooltip: {
                formatter: function(){
                    return '<b>'+ this.series.name +', age '+ this.point.category +'</b><br/>'+
                        'Population: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },
    
            series: [{
                name: 'Male',
                color: '#008BB0',
                data: [-1746181, -1884428, -2089758, -2222362, -2537431, -2507081, -2443179,
                    -2664537, -3556505, -3680231, -3143062, -2721122, -2229181, -2227768,
                    -2176300, -1329968, -836804, -354784, -90569, -28367, -3878]
            }, {
                name: 'Female',
                color: '#FDBB30',                
                data: [1656154, 1787564, 1981671, 2108575, 2403438, 2366003, 2301402, 2519874,
                    3360596, 3493473, 3050775, 2759560, 2304444, 2426504, 2568938, 1785638,
                    1447162, 1005011, 330870, 130632, 21208]
            }]
        });
    });
    
});

</script>
<script>
$(function () {
	$('.householdsize_ex').highcharts({
	    chart: {
            plotBackgroundColor: null,
            backgroundColor:'transparent',
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Household size',
            style: {
                fontSize: '16px'
            },
            align: 'center',

        },
        tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                size: 280,
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
          credits: {
          enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Household size',
            innerSize: '60%',
            data: [
                {name:'1 person', y:12.8, color:'#008BB0'},
                 {name:'2 people', y:26.8, color:'#E6BB83'},
                 {name:'3 people', y:45.0, color:'#A0CF67'},
                 {name:'4 people', y:8.5, color:'#D06F1A'},
                 {name:'5+ people', y:6.2, color:'#0081c6'}

            ],
        }]
    });
});
</script>



<script>

$(function () {
        $('.family_ex').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent',      
            },
            title: {
                text: 'Single parent households'
            },
            xAxis: {
                categories: ['Single', 'Single w/ children <18'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                max:50,
                labels: {
                    overflow: 'justify'
                },
                                title: {
                    text: null
                }
            },
            tooltip: {
                valueSuffix: ' %',
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    }
                },
                                series: {
	              pointWidth: 18,

	        } 
            },
            legend: {
                                    itemStyle: {
        fontSize: '10px'
    },
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0,
                backgroundColor: 'transparent'

            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Male householder',
                data: [10, 45],
                color:'#7ba61d'
            }, {
                name: 'Female householder',
                data: [20, 40],
                color:'#FDBB30'
            }]
        });
    });


</script>
<script>
$(function () {
	$('.attainment_ex').highcharts({
	    chart: {
	        type: 'column',
                backgroundColor:'transparent',
                plotBorderWidth: null,
                plotShadow: false
	    },
        title: {
                text: 'Educational Attainment',

            },
	    xAxis: {
	        categories: ['Incomplete High School', 'High School/GED', 'Some College', 'Bachelors degree', 'Masters degree', 'Doctoral degree'],
                labels: {
                style: {
                    fontSize:'9px'
                }
            } 
	    },
        yAxis: {
                title: {
                    text: '%',
                    rotation:0,
                }
        },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +': '+ this.y +'%'
                        ;
                }
            },
	    plotOptions: {
	        series: {
	            pointWidth: 40
	        }
	    },
	           
         credits: {
            enabled: false
        },
        legend: {
            enabled: false
        },
	    series: [{
	        data: [2.0, 25.0 , 23.0, 30.0, 15.0, 5.0],
                color:'#637eb5'
	    }]
	});
});
</script>
<script>
    $(function () {
        $('.language_ex').highcharts({
            chart: {
	        type: 'column',
                backgroundColor:'transparent',
                plotBorderWidth: null,
                plotShadow: false
	    },
        title: {
                text: 'Linguistic isolation',

            },

	    xAxis: {
	        categories: ['Total', 'Population 5-17', 'Population 18-64', 'Population 65+']
	    },
        yAxis: {
                title: {
                    text: '%',
                    rotation:0,
                }
        },
            tooltip: {
                formatter: function() {
                    return this.x +': '+ '<b>'+ this.y +'%'
                        ;
                }
            },
	    plotOptions: {
	        series: {
	            pointWidth: 40
	        }
	    },
	           
         credits: {
            enabled: false
        },
        legend: {
            enabled: false
        },
	    series: [{
	        data: [{y: 26.4, color: '#0d233a'},{y: 40.0, color: '#88b563'},{y: 31.0, color: '#88b563'},{y: 5.0, color: '#88b563'}]
	    }]
	});
});
    
</script>

<!-- ############################# WHAT PROGRESS CHARTS ######################################### -->

<script>
   $(function () {
        $('.fcibar1sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 37,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci1sum ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 31,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:60,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci1sum ?> + '%</b>' + '<br />' +
                    'Baseline 2009: ' + this.point.baseline + '% <br />' +
                    'Target 2015: ' + <?php echo $benchfci1sum ?> + '% <br />' +
                    'Target 2020: ' + this.point.goal  + '% <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci1sum ?>, baseline:31, benchmark:<?php echo $benchfci1sum ?>, goal:37}]
            }]
        });
    });

  </script>

  <script>
   $(function () {
        $('.fcibar2sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: ['White'],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
                

            },
            yAxis: {
                lineWidth: 1,  
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 70,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci2sum ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 15,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:100,
                title: {
                    text: null,
                   
                }
   
            },
      
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci2sum ?> + '%</b>' + '<br />' +
                    'Baseline 2009: ' + this.point.baseline + '% <br />' +
                    'Target 2015: ' + <?php echo $benchfci2sum ?> + '% <br />' +
                    'Target 2020: ' + this.point.goal  + '% <br />'}
                  },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci2sum ?>, baseline:39, benchmark:<?php echo $benchfci2sum ?>, goal:45}]
            }]
        });
    });

  </script>

<script>
   $(function () {
        $('.fcibar3sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 5000,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci3sum ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 913,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:5500,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci3sum ?> + '%</b>' + '<br />' +
                    'Baseline 2013: ' + this.point.baseline + '<br />' +
                    'Target 2015: ' + this.point.benchmark + '<br />' +
                    'Target 2020: ' + this.point.goal  + '<br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci3sum ?>, baseline:913, benchmark:'1,500', goal:'5,000'}]
            }]
        });
    });

  </script>

  <script>
   $(function () {
        $('.fcibar4sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: ['White'],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
                

            },
            yAxis: {
                lineWidth: 1,  
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 53,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci4sum ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 51,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 30,
                max:55,
                title: {
                    text: null,
                   
                }
   
            },
      
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci4sum ?> + '%</b>' + '<br />' +
                    'Baseline 2010: ' + this.point.baseline + '% <br />' +
                    'Target 2015: ' + <?php echo $benchfci4sum ?> + '% <br />' +
                    'Target 2020: ' + this.point.goal  + '% <br />'}
                  },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci4sum ?>, baseline:51, benchmark:<?php echo $benchfci4sum ?>, goal:53}]
            }]
        });
    });

  </script>
  <script>
   $(function () {
        $('.fcibar5sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 40,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
,
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 45,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:60,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Baseline 2013: ' + <?php echo $datafci5sum ?> + '</b>' + '<br />' +
                    'Target 2015: ' + this.point.target2015 + ' <br />' +
                    'Target 2020: ' + this.point.target2020  + ' <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci5sum ?>, target2015:40, target2020:45}]
            }]
        });
    });

  </script>

  <script>
   $(function () {
        $('.fcibar6sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: ['White'],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
                

            },
            yAxis: {
                lineWidth: 1,  
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: 'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:60,
                title: {
                    text: null,
                   
                }
   
            },
      
            tooltip: {
                
                formatter: function() {return '<b>Baseline 2010: ' + <?php echo $datafci6sum ?> + '</b>' + '<br />' +
                    'Target 2015: ' + this.point.target2015 + ' <br />' +
                    'Target 2020: ' + this.point.target2020  + ' <br />'}
                  },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci6sum ?>, target2015:'NA', target2020:'NA'}]
            }]
        });
    });

  </script>

<script>
   $(function () {
        $('.fcibar7sum').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value:'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:60,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Baseline 2013: ' + <?php echo $datafci7sum ?> + '</b>' + '<br />' +
                    'Target 2015: ' + this.point.target2015 + ' <br />' +
                    'Target 2020: ' + this.point.target2020  + ' <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci7sum ?>, target2015:'NA', target2020:'NA'}]
            }]
        });
    });

  </script>
  
<script>
   $(function () {
        $('#fcibar1').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 80,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci1_ex ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 20,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:100,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci1_ex ?> + '%</b>' + '<br />' +
                    'Baseline 2008: ' + this.point.baseline + '% <br />' +
                    'Benchmark: ' + <?php echo $benchfci1_ex ?> + '% <br />' +
                    'Goal 2020: ' + this.point.goal  + '% <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci1_ex ?>, baseline:20, bechmark:<?php echo $benchfci1_ex ?>, goal:80}]
            }]
        });
    });

  </script>

  <script>
   $(function () {
        $('#fcibar2').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: ['White'],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
                

            },
            yAxis: {
                lineWidth: 1,  
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 60,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci2_ex ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 8,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:100,
                title: {
                    text: null,
                   
                }
   
            },
      
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci2_ex ?> + '%</b>' + '<br />' +
                    'Baseline 2008: ' + this.point.baseline + '% <br />' +
                    'Benchmark: ' + <?php echo $benchfci2_ex ?> + '% <br />' +
                    'Goal 2020: ' + this.point.goal  + '% <br />'}
                  },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#ffb947',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci2_ex ?>, baseline:8, bechmark:<?php echo $benchfci2_ex ?>, goal:60}]
            }]
        });
    });

  </script>
  
  
  <script>
   $(function () {
        $('#fcibar3').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 45,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci3_ex ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 38,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:100,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci3_ex ?> + '%</b>' + '<br />' +
                    'Baseline 2013: ' + this.point.baseline + '% <br />' +
                    'Benchmark: ' + <?php echo $benchfci3_ex ?> + '% <br />' +
                    'Goal 2020: ' + this.point.goal  + '% <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#f3cbae',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci3_ex ?>, baseline:38, bechmark:<?php echo $benchfci3_ex ?>, goal:45}]
            }]
        });
    });

  </script>
  <script>
   $(function () {
        $('#fcibar4').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 45,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci4_ex ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 38,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:100,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci4_ex ?> + '%</b>' + '<br />' +
                    'Baseline 2010: ' + this.point.baseline + '% <br />' +
                    'Benchmark: ' + <?php echo $benchfci4_ex ?> + '% <br />' +
                    'Goal 2020: ' + this.point.goal  + '% <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#f3cbae',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci4_ex ?>, baseline:38, bechmark:<?php echo $benchfci4_ex ?>, goal:45}]
            }]
        });
    });

  </script>
  <script>
   $(function () {
        $('#fcibar5').highcharts({
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: [''],

                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }
                
                

            },
            yAxis: {
                lineWidth: 1, 
                plotLines: [{
                    color: '#5a8e22',
                    width: 1,
                    value: 25,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }
            },
                             {
                    color: '#df1060',
                    width: 1.5,
                    value: [<?php echo $benchfci5_ex ?>],
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                                 
            },
                          {
                    color: '#0060a7',
                    width: 1,
                    value: 'NA',
                    zIndex: 5,
                    dashStyle: 'longdash',
                    label:{
                       text: null,
                       style: {
                        fontSize: '9px'
                        },
                       align: 'left',
                       x:10,
                       y:5 }                              
                          }],
                min: 0,
                max:100,
                title: {
                    text: null,
                   
                }
   
            },
            tooltip: {
                
                formatter: function() {return '<b>Value: ' + <?php echo $datafci5_ex ?> + '%</b>' + '<br />' +
                    'Baseline 2012: ' + this.point.baseline + '% <br />' +
                    'Benchmark: ' + <?php echo $benchfci5_ex ?> + '% <br />' +
                    'Goal 2020: ' + this.point.goal  + '% <br />'}
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#f3cbae',
                    pointWidth: 50
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [{y:<?php echo $datafci5_ex ?>, baseline:'NA', bechmark:<?php echo $benchfci5_ex ?>, goal:25}]
            }]
        });
    });

  </script>
  
<script>
  $(function () {
    $('#fciline1').highcharts({
        chart: {
            backgroundColor:'transparent'
        },
        title: {
            text: null
        },
        xAxis: {
            categories: ['2009', '2010', '2011', '2012', '2013'],
            lineWidth: 1,
        },
                    
        yAxis: {
                        plotLines: [{
                    color: '#128e41',
                    width: 1,
                    value: 78,
                    zIndex: 5,
                    dashStyle: 'longdash',
                    
            },
                             {
                    color: '#1256b3',
                    width: 1,
                    value: [35],
                    zIndex: 5,
                    dashStyle: 'longdash',
                                                 
            }],
            min:0,
            max:100,
            labels: {
                    enabled: true
                }, 
            title: {
                    text: null
                },
        },
        tooltip: {
                valueSuffix: ' %',
                pointFormat: '<b>{point.y}</b>'
        },
        legend: {
                enabled: false
            },
        credits: {
                enabled: false
            },
        
        series: [{
            data: [40.1, 43.6, 41.2, 48.2,<?php echo $datafci1 ?>],
            color: '#020202',
        }]
    });
});
</script>  

<!-- ############################# HOW CHARTS ######################################### -->  
  
  <script>
jQuery(function () {
        jQuery('.grant').highcharts({

            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                style: {
                    fontSize: '13px'
                },
                text: 'Commitment by Change Strategy'
            },
                subtitle: {
            style: {
                fontSize: '13px'
            },
                text: 'Total.: $187,669,500',

            }, 

            xAxis: {
                categories: ['Aligning Systems','Affective Teaching', 'Family Engagement', 'Emerging/Other', 'NA'],

                
                title: {
                    text: null
                }


            },
            yAxis: {
                min: 0,
                title: {
                    enabled: false
                },
                labels: {
                    formatter: function() {
                        return this.value / 1000000 +'M';
                    }
              
                }

            },

            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        format: '${point.y:,.0f}'        
                    }
                }
            },

            credits: {
                enabled: false
            },
            legend: {
            enabled: false
             },
            series: [{
                data: [{y:81713891, color:'#ffcc7c'}, {y:46278970, color:'#4f81ba'},{y:52217290, color:'#e86c85'},{y:2633849, color:'#95664c'},{y:4825500, color:'#919195'}]
            }]
        });
    });
</script>
<script>

jQuery(function () {
        jQuery('.nongrant').highcharts({
			credits: false,
 chart: {
          backgroundColor:'transparent',
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            style: {
                fontSize: '13px'
            },
            text: 'Commitment by Objective'
        },
                        subtitle: {
            style: {
                fontSize: '13px'
            },
                text: 'Total.: $187,669,500',

            }, 

        tooltip: {
    	    pointFormat: '<b>${point.y:,.1f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.y:,.1f}'
                }
            }
        },
         credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Gender',
            data: [
                                {name:'Kids Ready for School',
                 y: 119056370.52,
                 color:'#0081c6',
                 sliced: true
                                 
                },
                                              {
                                  name: 'Early School Success',
                    y: 63787629.88,
                    color:'#F8971D',
                    sliced: true
                },
                {name:'Career and College Readiness',
                 y: 825500,
                 color:'#008BB0',
                 sliced: true
                },



               {name:'Investing in Innovation (I3 grants)',
                 y: 4000000,
                 color:'#5E9732',
                 sliced: true
                },

            ]
        }]
    });
});

</script>
<script>
jQuery(function () {
        jQuery('.resourcedep').highcharts({
			credits: false,
        chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                style: {
                    fontSize: '13px'
                },
                text: 'Commitment by Funding Strategy '
            },
                        subtitle: {
            style: {
                fontSize: '13px'
            },
                                            text: 'Total.: $187,669,500',

            }, 
            xAxis: {
                categories: [ 'Elevate Integrative Models, Practices', 'Quality Professional Development', 'Build Organizational Capacity', 'Family Leadership Development','Child and Family Support Systems', 'Disseminate Integrative Models', 'Build School Leadership Capacity', 'Emerging/Other', 'NA'],
                title: {
                    text: null
                },
                labels: {
                    enabled: false
                }, 
            },
            yAxis: {
                min: 0,
                max:50000000,
                title: {
                    text: 'Amount (Million $)',
                    align: 'high',
                        style: {
                            fontSize: '10px'
                },
                }
   
            },
            tooltip: {

                pointFormat: '<b>${point.y}</b>'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    },
                    color:'#008BB0',
                    pointWidth: 10
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                
                showInLegend: false,
                data: [43155097.65, 31477476.4, 28038488.95, 23212695.75, 22011069.5, 15678259, 14303489, 4967424.15, 4825500 ]
            }]
        });
    });
</script>
<script>

jQuery(function () {
        jQuery('.budget1_ex').highcharts({
			credits: false,
            chart: {
                backgroundColor:'transparent'
            },
            title: {
                text: 'Budget Progression'
            },
            xAxis: {
                categories: ['2010/2011', '2011/2012', '2012/2013', '2013/2014'],
                title: {
                text: 'Fiscal Year'
            }
            },
            
            yAxis: {
                min: 0,
                title: {
                    text: 'USD (millions)'
                }
            },
            

            series: [{
                type: 'column',
                name: 'Paid',
                color: '#008BB0',
                data: [9907101, 15942591, 14751230]
            }, {
                type: 'spline',
                name: 'Approved',
                color: '#F8971D',
                data: [19127938, 10999999, 17000000, 20000336],
                marker: {
                	lineWidth: 2,
                	lineColor: '#F8971D',
                	fillColor: '#F8971D'
                }
            }, {
                type: 'spline',
                name: 'Adjusted',
                color: '#5E9732',
                data: [13127938, 16489291, 15000336],
                marker: {
                	lineWidth: 2,
                	lineColor: '#5E9732',
                	fillColor: '#5E9732'
                }
                }]
        });
    });
</script>
<script>
jQuery(function () {
        jQuery('.budget2_ex').highcharts({
			credits: false,
            chart: {
                type: 'spline',
                backgroundColor:'transparent'
            },
            title: {
                text: 'Budget Performance Progression'
            },
            xAxis: {
                categories:  ['2010/2011', '2011/2012', '2012/2013']
            },
            yAxis: {
                title: {
                    text: 'Percentage'
                },
                labels: {
                    formatter: function() {
                        return this.value +'%';
                    }
                }
            },
            yAxis:  {          
               plotLines: [{
                color: '#000000',
                width: 2,
                value: 100
                }],
                
              title: {
                    text: 'Percentage'
                },
                
              labels: {
                    formatter: function() {
                        return this.value +'%';
                    }
                }
        },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineWidth: 2
                    }
                }
            },
            
            series: [{
                name: 'Adjusted Vs. Approved',
                color: '#FDBB30',
                marker: {
                    symbol: 'square',
                    lineColor: '#FDBB30',
                    fillColor: '#FDBB30'
                },
                data: [68.6, 149.9, 88.2]
    
            }, {
                name: 'Paid Vs. Approved',
                color: '#5E9732',                
                marker: {
                    symbol: 'diamond',
                    lineColor: '#5E9732',
                    fillColor: '#5E9732'
                },
                data: [51.8, 144.9, 86.8]
            }, {
                name: 'Paid Vs. Adjusted',
                color: '#0081C6',                
                marker: {
                    symbol: 'circle',
                    lineColor: '#0081C6',
                    fillColor: '#0081C6'
                },
                data: [75.5, 96.7, 98.3]
            }]
        });
    });
</script>
<script>
jQuery(function () {
        jQuery('.budget3_ex').highcharts({
			credits: false,
            chart: {
                type: 'bar',
                backgroundColor:'transparent'
            },
            title: {
                text: 'Budget 2012/2013 By Objective'
            },
            subtitle: {
                text: 'By Objective'
            },

            xAxis: {
                categories: ['Leadership', 'Convening', 'Evaluation', 'Communication', 'PRI'],

                
                title: {
                    text: null
                }


            },
            yAxis: {
                min: 0,
                title: {
                    text: 'USD (thousands)',
                    align: 'high'
                },
                labels: {
                    formatter: function() {
                        return this.value / 1000 +'K';
                    }
              
                }

            },

            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },

            credits: {
                enabled: false
            },
            legend: {
            enabled: false
             },
            series: [{
                data: [{y:313672, color:'#F6971D'}, {y:242000, color:'#008BB0'},{y:161850, color:'#0081c6'},{y:15436, color:'#A0CF67'}, {y:10800, color:'#E6BB83'}]
            }]
        });
    });
   
</script>






<?php get_footer(); ?>

