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
	var $j = jQuery.noConflict();
	function navpg(x){				
		$j("#gform_target_page_number_4").val(x.value); $j("#gform_4").trigger("submit",[true]);		
	}
	function navpg2(x){				
		$j("#gform_target_page_number_4").val(x); $j("#gform_4").trigger("submit",[true]);		
	}	
	$j(document).ready(function()
	{
		if (!getUrlVars()["navpg"]) {
		} else {
			var pg = getUrlVars()["navpg"];			
			navpg2(pg);
		}	
		$j('#tacticbtn').click(function () {		
			window.open('https://www.communitiestransforming.org/');   
		});
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
	$a = array(
		'Step 1. Establish Strong Coalitions' => 2,
		'Step 2. Define Community' => 3,
		'Step 3. Identify Vulnerable Populations' => 5,
		'Step 4. Core Report' => 6,
		'Step 5. Setting Priorities' => 7,
		'Step 6. Intervention Selection' => 9,
		'Step 7. Engage Healthcare in Selecting Priorities and Interventions' => 11,
		'Step 8. Assess and Align Community Assets for Sustainability' => 12,
		'Step 9. Implement Interventions' => 13,
		'Step 10. Evaluations and Monitoring' => 14		
	);

	$pt1 = '<div style="float:right;text-align:right;">Navigate to: <select onchange="javascript:navpg(this);">';
	$pt2 = '';
	foreach($a as $val => $option) {
		$pt2 = $pt2 . "<option value='".$val."'>".$option."</option>";			
	}
	$pt3 = '</select><br><input type="button" value="Take me to TACTIC" id="tacticbtn"></div>';
	$mb = $pt1.$pt2.$pt3;
	return $mb;

}

add_shortcode( 'cdc_dch_nav', 'cdc_dch_nav' );



