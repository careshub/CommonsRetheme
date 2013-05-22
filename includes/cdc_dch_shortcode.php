<?php

function cdc_dch_grouphome()
{ 
	echo "<p>This is the landing page.</p>";
	echo "<p>Logic Model.</p>";
	echo "<p>Video.</p>";
	
	global $current_user;    
	$cuid = (string)$current_user->ID;
	$mapurl = "http://maps.communitycommons.org/api/service.svc/json/reset-dch/?id=" . $cuid . "&key=XSbJBeM6ii6JD1irnJZ1ukf4F632Upfj";
	
?>

<!--<input type="button" onclick="window.location='<?php $mapurl ?>';" value="Start Over">--><br><br>

<?php 

	
        $form_id = 6;        
        $cdcusers = RGFormsModel::get_leads($form_id, '45', 'ASC');
		global $current_user;
		$count = 0;
		// loop through all the returned results
        foreach ($cdcusers as $cdcuser) {                
				if ($current_user->display_name == $cdcuser['45'])
				{
					$count = $count + 1;
				}            
        }
		 if ($count > 0) {
				?>
				<input type="button" value="Return to Digital Journey" onclick="window.location='http://dev.communitycommons.org/cdc-dch-v2/';" />
				<input type="button" value="Return to Footprint Tool" onclick="window.location='http://dev2.communitycommons.org/footprint/default.aspx?t=DCH';" />
				<input type="button" value="Return to Core Report" onclick="window.location='http://dev2.communitycommons.org/CHNA/SelectArea.aspx?reporttype=core&t=DCH&action=edit';" /><br>
				
				<?php
				//wp_redirect( 'http://assessment.communitycommons.org/Footprint/Default.aspx?t=DCH' );
				//exit();    
		 } else {
		 ?>
			 <input type="button" onclick="window.location='http://dev.communitycommons.org/cdc-dch-v2/';" value="Get Started on Digital Journey">
		 <?php	 
		 }
	


}

add_shortcode( 'cdc_dch_grouphome', 'cdc_dch_grouphome' );





