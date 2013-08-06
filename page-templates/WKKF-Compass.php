<?php
/**
 * Template Name: WKKF Compass
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);
get_header(); ?>
<script type="text/javascript">
			var $j = jQuery.noConflict();
			
			$j(document).ready(function(){				
				if ((getUrlVars()["pg"])==null && (getUrlVars()["loc"]!=null)) {
					//alert(window.location.pathname);
					var currPath=window.location.pathname;
					window.location.href=currPath + '?loc=' + getUrlVars()["loc"] + "&pg=context";
				} 				
			});	
			
			function getUrlVars()
			{
				var vars = [], hash;
				var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
				for(var i = 0; i < hashes.length; i++)
				{
					hash = hashes[i].split('=');
					vars.push(hash[0]);
					vars[hash[0]] = hash[1];
				}
				return vars;
			}
			
</script>
<?php

include ('getData.php');


?>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/wkkf.js'; ?>"></script>
<link rel='stylesheet' type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/wkkf.css';?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/RGraph/libraries/RGraph.common.core.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/RGraph/libraries/RGraph.common.effects.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/RGraph/libraries/RGraph.meter.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/highcharts.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/exporting.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/reveal.css'; ?>" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/jquery.reveal.js'; ?>"></script>


<?php
	 include( get_stylesheet_directory() . '/includes/wkkf_context.php');
	 include( get_stylesheet_directory() . '/includes/wkkf_outcomes.php');
	 include( get_stylesheet_directory() . '/includes/wkkf_continuum.php');
?>



      <?php while ( have_posts() ) : the_post(); ?>
        <?php //get_template_part( 'content', 'page-notitle' ); ?>
        <?php //comments_template( '', true ); ?>
      <?php endwhile; // end of the loop. ?>

      <?php //page variables
      $showImg = true; //show or hide image instead of actual html content
      $focusPlaces = array(
          'nola'=>array('place'=>'New Orleans, LA', 'thumb'=>'Louisiana.png')
        , 'grmi'=>array('place'=>'Grand Rapids, MI', 'thumb'=>'Michigan.png')
        , 'jxms'=>array('place'=>'Jackson, MS', 'thumb'=>'Mississippi.png')
        , 'newm'=>array('place'=>'New Mexico', 'thumb'=>'New_Mexico.png')
        , 'chmx'=>array('place'=>'Chiapas, Mexico', 'thumb'=>'neworleansmapicon.png')
        , 'hati'=>array('place'=>'Haiti', 'thumb'=>'neworleansmapicon.png')
        );
      $wkkfPages = array(
          'context'=>array(
            'name'=>'Context', 'next'=>'outcomes', 'prev'=>'map', 'img'=>'context.png', 'showVar'=>'showContext')
        , 'outcomes'=>array( 
            'name'=>'Child Outcomes', 'next'=>'continvest', 'prev'=>'context', 'img'=>'childoutcomes.png', 'showVar'=>'showChildOut')
        , 'outcomesdet'=>array(
            'name'=>'Child Outcomes Detail', 'next'=>'continvest', 'prev'=>'outcomes', 'img'=>'childoutcomesdetail.png')
        , 'continvest'=>array(
            'name'=>'Continuum Investments', 'next'=>'contstages', 'prev'=>'outcomes', 'img'=>'continvest.png', 'showVar'=>'showContinuum')
        , 'contstages'=>array(
            'name'=>'Continuum Stages', 'next'=>'live', 'prev'=>'continvest', 'img'=>'contstages.png', 'showVar'=>'showStages')
        , 'live'=>array(
            'name'=>'Live Feeds', 'next'=>'map', 'prev'=>'contstages', 'img'=>'livefeeds.png', 'showVar'=>'showLive')
        , 'map'=>array(
            'name'=>'Community Map', 'next'=>'context', 'prev'=>'live', 'img'=>'communitymap.png', 'showVar'=>'showMap')
        );
      
      $imgFolder= get_stylesheet_directory_uri() . '/img/WKKF/';
      $fullUri=getUrl();
      $isLocal = (strpos($fullUri,'localhost') > 0);
      $uriQueryIndex=strpos($fullUri,'?');
      $uriNoQuery=substr($fullUri,0,$uriQueryIndex);
      
      $loc='WKKF Compass'; $place='WKKF'; $placeThumb='wkkf.png'; //global defaults
      $pg='Home'; $pgImg=''; //global defaults
      $showDash=false;$showContext=false;$showChildOut=false;$showContinuum=false;$showLive=false;$showMap=false;$showStages=false; //global defaults
      
      function getUrl(){
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
         $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
         $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
      }
	  
	  function wkkfsc_switchPage($newpg){
		$newUrl = str_replace('&pg='.$_GET['pg'], '&pg='.$newpg, getUrl());
		return $newUrl;
      }
	  
	  
      InitPage();
      ?>
      <?php //page functions
      function InitPage(){
        global $loc, $place, $placeThumb, $focusPlaces, $isLocal; //use global vars
        if ( ! ( isset($_GET['loc']) && isset($focusPlaces[$_GET['loc']]) ) ) return;
        //if ($isLocal) echo 'Have location. ';
        $loc=$_GET['loc'];
        $place=$focusPlaces[$loc]['place'];
        $placeThumb=$focusPlaces[$loc]['thumb'];
        SetNavLinks();
      }
      function SetNavLinks(){
        //Can set nav links if we have the right query attributes
        global $pg, $pgImg, $wkkfPages, $isLocal, $showImg; //use global vars         
        if ( ! ( isset($_GET['pg']) && isset($wkkfPages[$_GET['pg']]) ) ) return;
        //if ($isLocal) echo 'Have page. ';
        $pg=$_GET['pg'];
        $pgImg=$wkkfPages[$pg]['img'];
        //if ($isLocal) { //show contents if on localhost
          $showImg=false;
          global $$wkkfPages[$pg]['showVar']; //get flag for which div to show
          $$wkkfPages[$pg]['showVar']=true; //set flag for which div to show
        //}
      }
      function GoToCompassPage($baseUrl, $focusPlace, $page){
        $newPage=$baseUrl . "?loc=" . $focusPlace . "&amp;pg=" . $page;
        return $newPage;
      }
      function GetPrevPage($curr){
        global $wkkfPages;
        $newPage=$wkkfPages[$curr]['prev'];
        return $newPage;
      }
      function GetNextPage($curr){
        global $wkkfPages;
        $newPage=$wkkfPages[$curr]['next'];
        return $newPage;
      }
      function GetPrevPageName($curr){
        global $wkkfPages;
        $newPage=$wkkfPages[$wkkfPages[$curr]['prev']]['name'];
        return $newPage;
      }
      function GetNextPageName($curr){
        global $wkkfPages;
        $newPage=$wkkfPages[$wkkfPages[$curr]['next']]['name'];
        return $newPage;
      }
      ?>

  <div id="primary" class="site-content width-full">
    <div id="content" role="main" style="border:solid 2px #BFBFBF;background-color:#f0f0f0;padding:20px;">          
      
      <div id="uxCompassHeader" class="colmask threecol header">
        <div class="colmid">
          <div class="colleft">
            <div class="col1 outer">
              <!-- Column 1 (middle) start -->
              <div class="middle">
                <div id="uxLocation" class="location-text inner"><?php echo $place; if (isset($pg)) {echo ' - ' . $wkkfPages[$pg]['name'];}?></div>
              </div>
              <!-- Column 1 end -->
            </div>
            <div class="col2 outer">
              <!-- Column 2 (left) start -->
              <div class="middle">
                <img id="uxLocationMap" class="location-thumbnail inner" src="<?php echo $imgFolder . $placeThumb; ?>"></img>
              </div>

              <!-- Column 2 end -->
            </div>
            <div class="col3 outer">
              <!-- Column 3 (right) start -->
              <div class="middle">
              <div id="uxNavigation" class="nav-section inner">

				

                  <a href="<?php echo (isset($pg) && $pg !== 'Home') ? GoToCompassPage($uriNoQuery, $loc, GetPrevPage($pg)) : ''; ?>" style="text-decoration:none;">
                    <span class="nav-arrow"><img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/navleft.png' ?>" width="30px" style="vertical-align:middle;" /></span>

                  </a>

					<select id="pageselector" name="pageselector" style="font-family:Calibri,Arial;font-size:14pt;padding:5px;">
						<?php	
							if (isset($pg)) {
							
								echo "<option selected value='" . $pg . "'>" . $wkkfPages[$pg]['name'] . "</option>";
							}
							foreach ($wkkfPages as $key => $value) {
								if (isset($value['showVar'])) {
									echo "<option value='" . wkkfsc_switchPage($key) . "'>" . $value['name'] . "</option>";
								}
							}
						?>
					</select>

                  <a href="<?php echo (isset($pg) && $pg !== 'Home') ? GoToCompassPage($uriNoQuery, $loc, GetNextPage($pg)) : ''; ?>" style="text-decoration:none;">

                    <span class="nav-arrow"><img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/navright.png' ?>" width="30px" style="vertical-align:middle;" /></span>
                  </a>
                
				
              </div>
              </div>
              <!-- Column 3 end -->
            </div>
          </div>
        </div>
      </div>
      
      <div id="uxCompassContents" class="contents">
        <img id="uxPageHolderImage" class="page-holder-image <?php echo ($showImg === true) ? '' : 'display-none'; ?>" 
             src="<?php echo $imgFolder . $pgImg; ?>"></img>
      
        <div id="uxDashboard" class="dashboard-cont <?php echo ($showDash === true) ? '' : 'display-none'; ?>"><!-- select location and/or page depending on permissions -->
          <div class="left-half">place</div>
          <div class="right-half">holder<br />whoa there</div>
        </div>

        <div id="uxContext" class="<?php echo ($showContext === true) ? '' : 'display-none'; ?>">
			<?php wkkf_context(); ?>

        </div>
        <div id="uxChildOutcomes" class="<?php echo ($showChildOut === true) ? '' : 'display-none'; ?>">
            
            <div class="chartyear">
				<div>
					<div style="font-family:Calibri,Arial;font-size:12pt;font-weight:bold;color:#7f7f7f;float:left;">VIEWING THE IMPACT MADE UP TO &nbsp;<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/prev.png' ?>" width="20px" style="vertical-align:middle;" /> 2013 <img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/next.png' ?>" width="20px" style="vertical-align:middle;" /></div>
					<div style="margin-left:600px;">
						<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/wkkflegend.jpg' ?>" />
					</div>
				</div>
            </div>
            <div id="row1" class='chartboxparent'>
					<a href="#" data-reveal-id="modal_outcomes1">
					   <div class="chartbox"> 

						<?php outcomes1A(); ?>
							
					   </div>
					</a>
					<div class="chartbox_spacer"></div>
					<div class="chartbox"><?php outcomes1B(); ?></div>
					<div class="chartbox_spacer"></div>
					<div class="chartbox"><?php outcomes1C(); ?></div>
					<br><br>
			   <div id="row2" class="chartboxparent_spacer">&nbsp;<br>
					<div class="chartbox_bot">
						<?php outcomes2A(); ?>
					</div>
					<div class="chartbox_spacer"></div>
				    <div class="chartbox_bot"><?php outcomes2B(); ?></div>
				    <div class="chartbox_spacer"></div>
				    <div class="chartbox_bot">
						 <!--style="float:left;margin-left:25px;"--><!--<div style="float:left;display:inline-block;position:relative;font-family:calibri,arial;font-weight:bold;font-size:60pt;color:#696b97;top:50px;">%</div>-->
						<?php outcomes2C(); ?>
						<span align="center" class="textstats">% of schools contracting with<br />School Food Authorities</span>
						
				    </div>
				   
			   </div>

			</div>
        </div>

        <div id="uxContinuum" class="<?php echo ($showContinuum === true) ? '' : 'display-none'; ?>" style="height:550px;background-color:#e6e6e6;" >
			<?php continuum1(); ?>
        </div>

        <div id="uxStages" class="<?php echo ($showStages === true) ? '' : 'display-none'; ?>" style="height:850px;background-color:#e6e6e6;padding:15px;" >
			<?php continuum_stages(); ?>
        </div>		
		
        <div id="uxLiveFeeds" class="<?php echo ($showLive === true) ? '' : 'display-none'; ?>">
			<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/nola_map.jpg' ?>" width="900px" />

        </div>
        <div id="uxCommunityMap" class="<?php echo ($showMap === true) ? '' : 'display-none'; ?>">
			<img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/feeds.jpg' ?>" width="900px" />

        </div>		
        <div style="text-align:right;padding:10px;"><img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/wkkf.png' ?>" /></div>  
      </div><!-- #uxCompassContents -->  
    </div><!-- #content -->
  </div><!-- #primary -->
  
	<div id="modal_outcomes1" class="reveal-modal xxlarge">
		 <h1>Child-Level Outcomes</h1><br /><br />
		 <img src="<?php echo get_stylesheet_directory_uri() . '/img/WKKF/outcome_detail1.jpg' ?>" />
		 <a class="close-reveal-modal">&#215;</a>
	</div>
  

 
<?php get_footer(); ?>