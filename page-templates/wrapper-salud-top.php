<div class="salud-header clear">
	<a href="#" class="logo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/SA-logox200.png" class=""></a>
	<h1>Salud America! <br /><span class="salud-tagline">Growing Healthy Change</span></h1>
	<h3>Your portal to reduce Latino child obesity.</h3>
	<div class="sa-kids-photo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/sa-kids-335.png"></div>

</div>

<?php 
	if ( is_singular("saresources") ) {
		get_sidebar( 'salud-singlepolicy' ); 
	} elseif ( is_singular("sapolicies") ) {
		get_sidebar( 'salud-singlepolicy' ); 
	} elseif ( is_page_template( 'page-templates/salud-america.php' ) || is_page_template( 'page-templates/salud-america-eloi.php' ) ) {
		get_sidebar( 'salud-single' );
	}

?>
	<div id="primary" class="site-content">