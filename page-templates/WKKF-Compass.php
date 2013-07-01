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
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
get_header(); ?>
<script type="text/javascript" src="/wordpress/wp-content/themes/commonsretheme/js/wkkf.js"></script>
<link rel='stylesheet' type="text/css" href="/wordpress/wp-content/themes/commonsretheme/css/wkkf.css" />

	<div id="primary" class="site-content width-full">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php //get_template_part( 'content', 'page-notitle' ); ?>
				<?php //comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

      <?php
      $focusPlaces = array(
					'nola' => array( 'place' => 'New Orleans, LA', 'thumb' => 'Louisiana.png')
        , 'grmi' => array( 'place' => 'Grand Rapids, MI', 'thumb' => 'Michigan.png')
        , 'jxms' => array( 'place' => 'Jackson, MS', 'thumb' => 'Mississippi.png')
        , 'newm' => array( 'place' => 'New Mexico', 'thumb' => 'New_Mexico.png')
        , 'chmx' => array( 'place' => 'Chiapas, Mexico', 'thumb' => 'neworleansmapicon.png')
        , 'hati' => array( 'place' => 'Haiti', 'thumb' => 'neworleansmapicon.png')
        );
      $wkkfPages = array(
					'context' => array( 'name' => 'Context', 'next' => 'outcomes', 'prev' => 'map', 'img' => 'context.png')
        , 'outcomes' => array( 'name' => 'Child Outcomes', 'next' => 'outcomesdet', 'prev' => 'context', 'img' => 'childoutcomes.png')
        , 'outcomesdet' => array( 'name' => 'Child Outcomes Detail', 'next' => 'continvest', 'prev' => 'outcomes', 'img' => 'childoutcomesdetail.png')
        , 'continvest' => array( 'name' => 'Continuum Investments', 'next' => 'contstages', 'prev' => 'outcomesdet', 'img' => 'continvest.png')
        , 'contstages' => array( 'name' => 'Continuum Stages', 'next' => 'live', 'prev' => 'continvest', 'img' => 'contstages.png')
        , 'live' => array( 'name' => 'Live Feeds', 'next' => 'map', 'prev' => 'contstages', 'img' => 'livefeeds.png')
        , 'map' => array( 'name' => 'Community Map', 'next' => 'context', 'prev' => 'live', 'img' => 'communitymap.png')
        );
      
      function GoToCompassPage($baseurl, $priplace, $page){
        $newPage=$baseurl . "?loc=" . $priplace . "&pg=" . $page;
        return $newPage;
      }
      function GetPrevPage($curr){
        $newPage=$GLOBALS['wkkfPages'][$curr]['prev'];
        return $newPage;
      }
      function GetNextPage($curr){
        $newPage=$GLOBALS['wkkfPages'][$curr]['next'];
        return $newPage;
      }
      function GetPrevPageName($curr){
        $newPage=$GLOBALS['wkkfPages'][$GLOBALS['wkkfPages'][$curr]['prev']]['name'];
        return $newPage;
      }
      function GetNextPageName($curr){
        $newPage=$GLOBALS['wkkfPages'][$GLOBALS['wkkfPages'][$curr]['next']]['name'];
        return $newPage;
      }
      ?>
      <?php 
        $fullUri="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $uriQueryIndex=strpos($fullUri,'?');
        $uriNoQuery=substr($fullUri,0,$uriQueryIndex);
        $loc=$_GET['loc']; 
        $pg=$_GET['pg'];
        
        $imgFolder='/wordpress/wp-content/themes/commonsretheme/img/WKKF/';
        $place=$focusPlaces[$loc]['place'];
        $placeThumb=$focusPlaces[$loc]['thumb'];
        
        $pgImg=$wkkfPages[$pg]['img'];
      ?>
            
      
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
                <div><span class="nav-arrow">
                    <a href="<?php echo GoToCompassPage($uriNoQuery, $loc, GetPrevPage($pg)); ?>">&#8666;<?php echo GetPrevPageName($pg); ?></a>
                  </span></div><br />
                <div><span class="nav-arrow">
                    <a href="<?php echo GoToCompassPage($uriNoQuery, $loc, GetNextPage($pg)); ?>"><?php echo GetNextPageName($pg); ?>&#8667;</a>
                  </span></div>
              </div>
              </div>
              <!-- Column 3 end -->
            </div>
          </div>
        </div>
      </div>
      <div class="main ">
        <img id="uxPageHolderImage" class="page-holder-image " src="<?php echo $imgFolder . $pgImg; ?>"></img>
      </div>      
      
		</div><!-- #content -->
	</div><!-- #primary -->
  
<?php get_footer(); ?>