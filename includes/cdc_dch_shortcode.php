<?php

function cdc_dch_grouphome()
{ 
	echo "<p>This is the landing page.</p>";
	echo "<p>Logic Model.</p>";
	echo "<p>Video.</p>";
	
	global $current_user;    
	$cuid = (string)$current_user->ID;
	$mapurl = "http://maps.communitycommons.org/api/service.svc/json/reset-dch/?id=" . $cuid . "&key=XSbJBeM6ii6JD1irnJZ1ukf4F632Upfj";
	echo $mapurl . "<br><br>";
?>
<input type="button" onclick="window.location='http://dev.communitycommons.org/cdc_dch1/';" value="Get Started">
<input type="button" onclick="window.location='<?php $mapurl ?>';" value="Start Over">

<?php 
}

add_shortcode( 'cdc_dch_grouphome', 'cdc_dch_grouphome' );





