<?php

function cdc_dch_grouphome()
{ 
	// echo "<p>This is the landing page.</p>";
	// echo "<p>Logic Model.</p>";
	// echo "<p>Video.</p>";
	
	global $current_user;
	    $return_string = '';    
	// $cuid = (string)$current_user->ID;
	// $mapurl = "http://maps.communitycommons.org/api/service.svc/json/reset-dch/?id=" . $cuid . "&key=XSbJBeM6ii6JD1irnJZ1ukf4F632Upfj";
    $form_id = 4;        
    $cdcusers = RGFormsModel::get_leads($form_id, '45', 'ASC');
	$count = 0;
	// loop through all the returned results
    foreach ($cdcusers as $cdcuser) {                
			if ($current_user->display_name == $cdcuser['45'])
			{
				$count = $count + 1;
			}            
    }
	 if ($count > 0) {
	 
	 				$return_string = '<div style="display:inline";><div style="padding:5px;"><a href="http://communitycommons.org/cdc-dch-v2/" class="button">Return to Community Health Improvement Journey</a>&nbsp;<a href="http://assessment.communitycommons.org/footprint/default.aspx?t=DCH;" class="button">Return to Footprint Tool</a>&nbsp;<a href="http://communitycommons.org/CHNA/SelectArea.aspx?reporttype=core&t=DCH&action=edit;" class="button">Return to Core Report</a></div></div>';

			?>
			<!--<input type="button" value="Return to Community Health Improvement Journey" onclick="window.location='http://communitycommons.org/cdc-dch-v2/';" />
			<input type="button" value="Return to Footprint Tool" onclick="window.location='http://assessment.communitycommons.org/footprint/default.aspx?t=DCH';" />
			<input type="button" value="Return to Core Report" onclick="window.location='http://communitycommons.org/CHNA/SelectArea.aspx?reporttype=core&t=DCH&action=edit';" /><br>-->
			
			<?php
			//wp_redirect( 'http://assessment.communitycommons.org/Footprint/Default.aspx?t=DCH' );
			//exit();    
	 } else {
	 	     $return_string = '<div><a href="http://communitycommons.org/cdc-dch-v2/" class="button">Get Started on Your Community Health Improvement Journey</a></div>';
	
	 ?>
			<!--- <a href="http://communitycommons.org/cdc-dch-v2/" class="button">Get Started on Your Community Health Improvement Journey</a>--->
	 <?php	 
	 }
	
return $return_string;

}

add_shortcode( 'cdc_dch_grouphome', 'cdc_dch_grouphome' );

function cdc_dch_nav() {
?>
<script type="text/javascript">
	function navpg(x){
		var $j = jQuery.noConflict();		
		$j("#gform_target_page_number_4").val(x.value); $j("#gform_4").trigger("submit",[true]);		
	}
</script>
<?php 


	$mb = '<div style="float:right;">Navigate to: <select onchange="javascript:navpg(this);"><option value="2">Step 1. Establish Coalitions (Identify Stakeholders)</option><option value="3">Step 2. Define Community</option><option value="5">Step 3. Vulnerable Populations</option><option value="6">Step 4. Core Report</option><option value="7">Step 5. Setting Priorities</option><option value="9">Step 6. Intervention Selection</option><option value="10">Step 7. Engage Healthcare</option><option value="11">Step 8. Community Involvement</option><option value="12">Step 9. Implement Interventions</option><option value="13">Step 10. Evaluations and Metrics</option></select></div>';
	return $mb;

}

add_shortcode( 'cdc_dch_nav', 'cdc_dch_nav' );



