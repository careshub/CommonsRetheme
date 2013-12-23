<?php
/**
 * The sidebar containing the group sub nav and widget area.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<!-- <p> Salud sidebar single </p> -->
		<!-- <div id="group-navigation">  
		    <div id="group_sidebar">
				<div id="item-header-avatar">
				<?php bp_group_avatar() ?>
				</div>
			</div> -->
		    <div id="item-buttons">

				<?php do_action( 'bp_group_header_actions' ); ?>

			</div><!-- #item-buttons -->
		<!-- </div>      -->
		<div class="sidebar-activity-tabs no-ajax" id="object-nav" role="navigation">
			<!-- <ul>
				<?php bp_get_options_nav(); ?>
				<?php do_action( 'bp_group_options_nav' ); ?>
			</ul> -->

			<?php //Add sidebar navigation menu 
				$args = array(
					'theme_location' => 'salud-nav',
					//'menu'            => '', 
					'container'       => '', 
					//'container_class' => 'salud-nav', 
					//'container_id'    => '',
					//'menu_class' 	=> 'footer-nav',
					//'menu_id'         => 'menu-{menu slug}[-{increment}]',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					//'items_wrap'      => '%3$s',
					'depth'           => 0,
					'walker'          => ''
					);
				wp_nav_menu( $args );
				?>
		</div>
	<?php
		
		$geogterm = wp_get_object_terms( $post->ID, 'geographies' );
		if(!empty($geogterm)){
		  if(!is_wp_error( $geogterm )){					
			foreach($geogterm as $gterm){

			}					
		  }
		}
                        
	$geostate = substr ($gterm->description, 5, 4);
                $geoidstate = "04000$geostate";        
                        
	?>

    <div>
        <strong>Percent Adults Age 18+ Obese (BMI >= 30)  by County</strong>
        
        <div style="padding-top:5px">
        	<script src='http://maps.communitycommons.org/jscripts/mapWidget.js?ids=348&vm=348&w=200&h=200&geoid=<?php echo $geoidstate; ?>&l=1'></script>
        </div>        
    
		<div id="dial">
			<script src='http://maps.communitycommons.org/jscripts/dialWidget.js?geoid=<?php echo $gterm->description?>&id=779'></script>
		</div>

	
        <input type="button" id="btnSubmit1" value="Poverty rate" onclick="changeDial('779')" />
		<input type="button" id="btnSubmit2" value="Children in Poverty " onclick="changeDial('781')" />
		<input type="button" id="btnSubmit3" value="Pop. With No HS Diploma" onclick="changeDial('760')" />
	
	
	
	
		<!--**********************************************Mike's stuff**********************************-->
		<script type="text/javascript">
			function changeDial(id) {
				var geoid = '<?php echo $gterm->description ?>';
				var s = document.createElement("script");
				s.type = "text/javascript";
				s.src = "http://maps.communitycommons.org/jscripts/dialWidget.js?geoid=" + geoid + "&id=" + id;
				
                var dial = document.getElementById('dial');
                if (!document._write) document._write = document.write;
                document.write = function (str) {
                    dial.innerHTML += str;
                };

                while (dial.firstChild) {  dial.removeChild(dial.firstChild); }
                dial.appendChild(s);
                }

		</script>
		
		
		
		<!--********************************************************************************************** -->				
	
    </div>


	<!-- <div class="policy-meta">
		<div class="policy-stats">
			<h3 class="widget-title">Regional Snapshot:<br /> Anytown</h3>
			<div class="stat-group clear">
				<h6 class="stat-title">Poverty rate</h6>
				<a href="http://datavis.communitycommons.org/viewer/?bbox=-9463866.3621,3920689.2672,-9342209.9661,4084338.2471&mapid=255">
					<img src="/wp-content/themes/CommonsRetheme/img/poverty-atlanta-180x180.png">
				</a>
				<img src="/wp-content/themes/CommonsRetheme/img/poverty-key.png">
			</div>

			<div class="stat-group clear">
			<h6 class="stat-title">Percent Hispanic: 23%</h6>
				<div class="meter nostripes">
					<span style="width: 23%"><span></span></span>
				</div>
			</div>

			<div class="stat-group clear">
			<h6 class="stat-title">Obesity rate: 26%</h6>
				<div class="meter nostripes red">
					<span style="width: 26%"><span></span></span>
				</div>
			</div>
			<div class="stat-group clear">
				<h6 class="stat-title">Percent with High School diploma: 54%</h6>
				<div class="meter nostripes green">
					<span style="width: 68%"><span></span></span>
				</div>
			</div>

		</div>
	</div> --> <!-- end .policy-meta -->
		<?php //if ( is_active_sidebar( 'groups-single-sidebar' ) ) :
		// 			dynamic_sidebar( 'groups-single-sidebar' ); 
		// 	endif;
		?>

		</div><!-- #secondary -->