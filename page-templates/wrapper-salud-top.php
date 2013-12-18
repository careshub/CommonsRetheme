<div class="salud-header clear">
	<a href="#" class="logo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/SA-logox200.png" class=""></a>
	<h1>Salud America! <br /><span class="salud-tagline">Growing Healthy Change</span></h1>
	<h3 class="screamer saorange">Let's reduce Latino childhood obesity!
		<div class="sa-social-icons visible-maxi">
	        <a href='http://www.facebook.com/pages/SaludToday/160946931268' class="facebook-whx26"></a>
			<a href='http://twitter.com/saludtoday' class="twitter-whx26"></a>
			<a href='http://www.youtube.com/user/SaludToday' class="youtube-whx26"></a>
		</div>
    </h3>
	<div class="sa-kids-photo"><img src="/wp-content/themes/CommonsRetheme/img/salud_america/sa-kids-335.png"></div>

</div>

<?php 
	if ( is_singular("saresources") ) {
		get_sidebar( 'salud-single' ); 
	} elseif ( is_singular("sapolicies") ) {
		get_sidebar( 'salud-singlepolicy' ); 
	} elseif ( is_page('salud-america') ) {
		get_sidebar( 'salud-home' );
	} elseif ( is_page_template( 'page-templates/salud-america.php' ) || is_page_template( 'page-templates/salud-america-eloi.php' ) ) {
		get_sidebar( 'salud-single' );
	} else {
		get_sidebar( 'salud-single' ); 
	}

?>
	<div id="primary" class="site-content">