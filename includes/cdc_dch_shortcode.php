<?php
function cdc_dch_top() {
?>
<style type="text/css">
.popup {z-index:10; width:700px; height:600px; background-color:#d3d3d3;border:solid 5px #bebebe; margin:0 auto;padding:15px;display:none;  
  position:fixed;top:50%; left:50%; margin-left:-350px; margin-top:-300px;}
.closex {float:right;cursor:pointer;color:#0645AD;}
.closex:hover { TEXT-DECORATION: underline; font-weight:bold; }
.overlay {
    display: none; /* ensures it’s invisible until it’s called */
    position: absolute; /* makes the div go into a position that’s absolute to the browser viewing area */
    left: 35%; /* positions the div half way horizontally */
    top: 75%; /* positions the div half way vertically */
    padding: 25px; 
    border: 2px solid black;
    background-color: #ffffff;
    width: 30%;
    height: 30%;
    z-index: 100; /* makes the div the top layer, so it’ll lay on top of the other content */
}
#fade {
    display: none;  /* ensures it’s invisible until it’s called */
    position: fixed;  /* makes the div go into a position that’s absolute to the browser viewing area */
    left: 0%; /* makes the div span all the way across the viewing area */
    top: 0%; /* makes the div span all the way across the viewing area */
    background-color: black;
    -moz-opacity: 0.7; /* makes the div transparent, so you have a cool overlay effect */
    opacity: .70;
    filter: alpha(opacity=70);
    width: 100%;
    height: 100%;
    z-index: 90; /* makes the div the second most top layer, so it’ll lay on top of everything else EXCEPT for divs with a higher z-index (meaning the #overlay ruleset) */
}
.gf_progressbar_title {display:none;}
#comments {display:none;}
</style>

<div id="overlay1" class="overlay">
	<div class="closex"  onclick="javascript:closediv('1');return false;">[X] close</div>
	<div>
		<h2>Reflection Point One - Resources</h2>
		<p>
			<ul>
				<li><a href="http://www.communitycommons.org/wp-content/uploads/2013/06/guidingprinciples.pdf" target="_blank">Guiding Principles</a></li>
				<li><a href="http://www.communitycommons.org/wp-content/uploads/2013/06/practices.pdf" target="_blank">Recommended Practices for Enhancing Community Health Improvement</a></li>
			</ul>
		</p>
	</div>
	<input type="button" value="Next" id="next1" onclick="nextPg('6','1')" />
</div>
<div id="overlay2" class="overlay">
	<div class="closex"  onclick="javascript:closediv('2');return false;">[X] close</div>
	<div>
		<h2>Reflection Point Two - Resources</h2>
		<p>
			<ul>
				<li>Resource 1</li>
				<li>Resource 2</li>
			</ul>
		</p>
	</div>
	<input type="button" value="Next" id="next2" onclick="nextPg('9','2')" />
</div>
<div id="overlay3" class="overlay">
	<div class="closex"  onclick="javascript:closediv('3');return false;">[X] close</div>
	<div>
		<h2>Reflection Point Three - Resources</h2>
		<p>
			<ul>
				<li>Resource 1</li>
				<li>Resource 2</li>			
			</ul>
		</p>
	</div>
	<input type="button" value="Next" id="next3" onclick="nextPg('11','3')" />
</div>
<div id="fade"></div>

<script type="text/javascript">
	var $j = jQuery.noConflict();
	var baseurl = window.location.protocol + "//" + window.location.host + "/";
	var formid = 9;
	if (baseurl == "http://dev.communitycommons.org/") {
		formid = 10;
	} 
		
	function navpg(x){	
		if (x.value=='/groups/cdc-dch/') {		
			location.href=x.value;
		} else {			
			$j("#gform_target_page_number_" + formid).val(x.value); $j("#gform_" + formid).trigger("submit",[true]);	
			$j("#steps").val(x.value);
		}
	}
	function navpg2(x){			
		if (x=='/groups/cdc-dch/') {
			location.href=x;
		} else {
			$j("#gform_target_page_number_" + formid).val(x); $j("#gform_" + formid).trigger("submit",[true]);	
			$j("#steps").val(x);	
		}		
	}	
	function nextPg(x,y) {
		$j("#gform_target_page_number_" + formid).val(x); $j("#gform_" + formid).trigger("submit",[true]);
		$j("#steps").val(x);
		closediv(y);
	}
	
	$j(document).bind('gform_post_render', function(event, form_id, current_page){
		//alert("Mike's test - PAGE:" + current_page);
	
		if (current_page == 5)
		{			
			$j("#steps").val(4);
			$j('input[name=input_56]').change(function() {			
				var value9 = $j('input[name=input_9]:checked').val();	
				var value20 = $j('input[name=input_20]:checked').val();
				var value108 = $j('input[name=input_108]:checked').val();
				var value19 = $j('input[name=input_19]:checked').val();
				var value18 = $j('input[name=input_18]:checked').val();
				var value17 = $j('input[name=input_17]:checked').val();
				var value16 = $j('input[name=input_16]:checked').val();
				var value15 = $j('input[name=input_15]:checked').val();
				var value14 = $j('input[name=input_14]:checked').val();
				var value13 = $j('input[name=input_13]:checked').val();
				var value12 = $j('input[name=input_12]:checked').val();
				var value56 = $j('input[name=input_56]:checked').val();		
				if (value9 < 3 || value20 < 3 || value108 < 3 || value19 < 3 || value18 < 3 || value17 < 3 || value16 < 3 || value15 < 3 || value14 < 3 || value13 < 3 || value12 < 3 || value56 < 3) {
					$j("#overlay1").fadeIn();
					$j("#fade").fadeIn();
				}
			});
			
		} else if (current_page == 8) {		
			$j("#steps").val(7);
			$j('input[name=input_29]').change(function() {			
				var value28 = $j('input[name=input_28]:checked').val();
				var value32 = $j('input[name=input_32]:checked').val();
				var value31 = $j('input[name=input_31]:checked').val();
				var value30 = $j('input[name=input_30]:checked').val();
				var value29 = $j('input[name=input_29]:checked').val();		
				if (value28 < 3 || value32 < 3 || value31 < 3 || value30 < 3 || value29 < 3) {
					//$j("#overlay2").fadeIn();
					//$j("#fade").fadeIn();
				}
			});			
		} else if (current_page == 10) { 
			$j("#steps").val(9);
			$j('input[name=input_64]').change(function() {			
				var value59 = $j('input[name=input_59]:checked').val();
				var value61 = $j('input[name=input_61]:checked').val();
				var value62 = $j('input[name=input_62]:checked').val();
				var value63 = $j('input[name=input_63]:checked').val();
				var value64 = $j('input[name=input_64]:checked').val();		
				if (value59 < 3 || value61 < 3 || value62 < 3 || value63 < 3 || value64 < 3) {
					//$j("#overlay3").fadeIn();
					//$j("#fade").fadeIn();
				}
			});					
		} else {
			$j("#steps").val(current_page);
		}	
		

		
	});
	
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

	function closediv(y) {
		$j("#overlay" + y).fadeOut();
		$j("#fade").fadeOut();
	}

	
</script>
<?php 



	$pt1 = '<div style="width:800px; text-align:left;position:relative;top:-20px;"><img src="http://www.communitycommons.org/wp-content/uploads/2013/08/banner2.jpg" alt="Community Health Improvement Journey" style="box-shadow: 0px 0px 0px #ffffff;"></div>';

	return $pt1;

}

add_shortcode( 'cdc_dch_top', 'cdc_dch_top' );

function cdc_dch_bot() {
	$a = array(
		'Group Home' => '/groups/cdc-dch/',
		'Community Health Improvement Process Overview' => 1,				
		'Step 1: Health Equity' => 2,
		'Step 2. Strong Coalitions' => 3,
		'Step 3. Define Community' => 4,
		'Step 4. Explore Community Needs' => 6,
		'Step 5. Setting Priorities' => 7,
		'Step 6. Intervention Selection' => 9,		
		'Step 7. Align Community Assets' => 11,
		'Step 8. Implement Interventions' => 12,
		'Step 9. Evaluation and Monitoring' => 13,
		'Name your Journey' => 14,
		'Journey Summary' => 15		
	);

	$pt1 = '<div style="float:right;text-align:left;position:relative;top:-60px;">Navigate to:<br /><select style="font-family:Calibri,Arial;" onchange="javascript:navpg(this);" id="steps">';
	$pt2 = '';
	foreach($a as $option => $val) {
		$pt2 = $pt2 . "<option value='".$val."'>".$option."</option>";			
	}
	$pt3 = '</select><br /><a href="/cdc-dch-journey-feedback/" target="_blank" class="button" style="margin-top:10px;">Send us your feedback!</a></div>';
	$mb = $pt1.$pt2.$pt3;
	return $mb;
}

add_shortcode( 'cdc_dch_bot', 'cdc_dch_bot' );