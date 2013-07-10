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
<?php
<<<<<<< HEAD
require ('getData.php')
?>
=======

require ('getData.php');
?>

>>>>>>> 4d4b4c1ed4229f204c37ed4ca6fe3b6ce706393b
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/wkkf.js'; ?>"></script>
<link rel='stylesheet' type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/wkkf.css';?>" />


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
            'name'=>'Child Outcomes', 'next'=>'outcomesdet', 'prev'=>'context', 'img'=>'childoutcomes.png', 'showVar'=>'showChildOut')
        , 'outcomesdet'=>array(
            'name'=>'Child Outcomes Detail', 'next'=>'continvest', 'prev'=>'outcomes', 'img'=>'childoutcomesdetail.png')
        , 'continvest'=>array(
            'name'=>'Continuum Investments', 'next'=>'contstages', 'prev'=>'outcomesdet', 'img'=>'continvest.png', 'showVar'=>'showContinuum')
        , 'contstages'=>array(
            'name'=>'Continuum Stages', 'next'=>'live', 'prev'=>'continvest', 'img'=>'contstages.png')
        , 'live'=>array(
            'name'=>'Live Feeds', 'next'=>'map', 'prev'=>'contstages', 'img'=>'livefeeds.png', 'showVar'=>'showLive')
        , 'map'=>array(
            'name'=>'Community Map', 'next'=>'context', 'prev'=>'live', 'img'=>'communitymap.png')
        );
      
      $imgFolder= get_stylesheet_directory_uri() . '/img/WKKF/';
      $fullUri=getUrl();
      $isLocal = (strpos($fullUri,'localhost') > 0);
      $uriQueryIndex=strpos($fullUri,'?');
      $uriNoQuery=substr($fullUri,0,$uriQueryIndex);
      
      $loc='WKKF Compass'; $place='WKKF'; $placeThumb='wkkf.png'; //global defaults
      $pg='Home'; $pgImg=''; //global defaults
      $showDash=false;$showContext=false;$showChildOut=false;$showContinuum=false;$showLive=false; //global defaults
      
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
      
      InitPage();
      ?>
      <?php //page functions
      function InitPage(){
        global $loc, $place, $placeThumb, $focusPlaces, $isLocal; //use global vars
        if ( ! ( isset($_GET['loc']) && isset($focusPlaces[$_GET['loc']]) ) ) return;
        if ($isLocal) echo 'Have location. ';
        $loc=$_GET['loc'];
        $place=$focusPlaces[$loc]['place'];
        $placeThumb=$focusPlaces[$loc]['thumb'];
        SetNavLinks();
      }
      function SetNavLinks(){
        //Can set nav links if we have the right query attributes
        global $pg, $pgImg, $wkkfPages, $isLocal, $showImg; //use global vars         
        if ( ! ( isset($_GET['pg']) && isset($wkkfPages[$_GET['pg']]) ) ) return;
        if ($isLocal) echo 'Have page. ';
        $pg=$_GET['pg'];
        $pgImg=$wkkfPages[$pg]['img'];
        if ($isLocal) { //show contents if on localhost
          $showImg=false;
          global $$wkkfPages[$pg]['showVar']; //get flag for which div to show
          $$wkkfPages[$pg]['showVar']=true; //set flag for which div to show
        }
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
    <div id="content" role="main">          
      
      <div id="uxCompassHeader" class="colmask threecol header">
        <div class="colmid">
          <div class="colleft">
            <div class="col1 outer">
              <!-- Column 1 (middle) start -->
              <div class="middle">
                <div id="uxLocation" class="location-text inner"><?php echo $place; ?></div>
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
                <div id="uxPrevPage" class="<?php echo (isset($pg) && $pg !== 'Home') ? '' : 'display-none'; ?>">
                  <a href="<?php echo (isset($pg) && $pg !== 'Home') ? GoToCompassPage($uriNoQuery, $loc, GetPrevPage($pg)) : ''; ?>">
                    <span class="nav-arrow">&#8666;</span>
                    <span class="">
                      <?php echo (isset($pg) && $pg !== 'Home') ? GetPrevPageName($pg) : ''; ?>
                    </span>
                  </a>
                </div><br />
                <div id="uxNextPage" class="<?php echo (isset($pg) && $pg !== 'Home') ? '' : 'display-none'; ?>">
                  <a href="<?php echo (isset($pg) && $pg !== 'Home') ? GoToCompassPage($uriNoQuery, $loc, GetNextPage($pg)) : ''; ?>">
                    <span class="">
                      <?php echo (isset($pg) && $pg !== 'Home') ? GetNextPageName($pg) : ''; ?>
                    </span>
                    <span class="nav-arrow">&#8667;</span>
                  </a>
                </div>
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
Context

        </div>
        <div id="uxChildOutcomes" class="<?php echo ($showChildOut === true) ? '' : 'display-none'; ?>">
            Child Outcomes
            <div class="chartyear">
              
            <h2>VIEWING THE IMPACT MADE UP TO &nbsp;<image src="http://localhost:8080/wordpress/wp-content/themes/CommonsRetheme/img/WKKF/prev.png" /> 2012 <image src="http://localhost:8080/wordpress/wp-content/themes/CommonsRetheme/img/WKKF/next.png" />
            </h2>
            </div>
            <div id="row1" class='chartboxparent'>

        <?php
$piChart = new gPieChart();
$piChart->addDataSet(array(23.4,25,10,20));
$piChart->setLegend(array("23.4", "25", "10","20"));
$piChart->setLabels(array("23.4%", "25%", "10%","20%"));
$piChart->setColors(array("ff3344", "11ff11", "22aacc", "3333aa"));
?>
           <div class="chartbox"> 
               <img src="<?php print $piChart->getUrl();  ?>" style='background:#E6E6E6;width: 290px;'/> <br><h2 align="center">25%<br> Percent of kids eating healthy.</h2> 
    </div>
    <div class="chartbox_spacer"></div>
    <div class="chartbox">dddddd</div>
    <div class="chartbox_spacer"></div>
       <div class="chartbox">dfsfs</div>
       <br><br>
   <div id="row2" class="chartboxparent_spacer">&nbsp;<br>
    <div class="chartbox_bot">               <img src="<?php print $piChart->getUrl();  ?>" style='background:#E6E6E6;width: 290px;'/> <br><h2 align="center">25%<br> Percent of kids eating healthy.</h2> 
    </div>
    <div class="chartbox_spacer"></div>
       <div class="chartbox_bot">row2-1</div>
       <div class="chartbox_spacer"></div>
       <div class="chartbox_bot">row2-3</div>
       
   </div>
           <?php 
          //echo '<div class="chartbox">&nbsp;'; 
          //echo do_shortcode("[wp_charts title='mypie' type='pie' labels='10,32,50,25,5' margin='5px 5px' data='10,32,50,25,5']"); 
          //echo '</div>';
          //echo '<div class="chartbox_spacer">&nbsp;</div>';
          echo '<div class="chartbox">&nbsp;';  
          echo do_shortcode("[easychart type='horizbar' height='150' title='SYSMark 2007: AMD v.s. Intel' groupnames='AMD Phenom X4 9950, Intel Core i7 940' groupcolors='005599,229944' valuenames='Overall,E-Learning,Video Creation,Productivity,3D' group1values='157,132,208,150,148' group2values='229,202,259,226,232' ]");
          echo '</div>';
           ?>

                
</div>
        </div>

        <div id="uxContinuum" class="<?php echo ($showContinuum === true) ? '' : 'display-none'; ?>">
Continuum

        </div>

        <div id="uxLiveFeeds" class="<?php echo ($showLive === true) ? '' : 'display-none'; ?>">
Live Feeds

        </div>
                
      </div><!-- #uxCompassContents -->  
    </div><!-- #content -->
  </div><!-- #primary -->
  
<?php get_footer(); ?>