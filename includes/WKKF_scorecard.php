<?php 
add_action( 'init', 'register_wkkf_scorecard' );

function register_wkkf_scorecard() {

    $labels = array( 
        'name' => _x( 'Scorecards', 'wkkf_scorecard' ),
        'singular_name' => _x( 'Scorecard', 'wkkf_scorecard' ),
        'add_new' => _x( 'Add New', 'wkkf_scorecard' ),
        'add_new_item' => _x( 'Add New Scorecard', 'wkkf_scorecard' ),
        'edit_item' => _x( 'Edit Scorecard', 'wkkf_scorecard' ),
        'new_item' => _x( 'New Scorecard', 'wkkf_scorecard' ),
        'view_item' => _x( 'View Scorecard', 'wkkf_scorecard' ),
        'search_items' => _x( 'Search Scorecards', 'wkkf_scorecard' ),
        'not_found' => _x( 'No scorecards found', 'wkkf_scorecard' ),
        'not_found_in_trash' => _x( 'No scorecards found in Trash', 'wkkf_scorecard' ),
        'parent_item_colon' => _x( 'Parent Scorecard:', 'wkkf_scorecard' ),
        'menu_name' => _x( 'Scorecards', 'wkkf_scorecard' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Data input for WKKF Scorecard',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
		'map_meta_cap' => true
    );

    register_post_type( 'wkkf_scorecard', $args );
}

//Building the input form in the WordPress admin area
add_action( 'admin_init', 'wkkf_scorecard_meta_box_add' );
function wkkf_scorecard_meta_box_add()
{
	 add_meta_box( 'wkkf-definitions-metabox', 'Scorecard Definitions (WKKF staff only)', 'wkkf_definitions_metabox', 'wkkf_scorecard', 'normal', 'high');
	 add_meta_box( 'wkkf-childoutcomes-metabox', 'Child Outcomes', 'wkkf_childoutcomes_metabox', 'wkkf_scorecard', 'normal', 'high');
	 add_meta_box( 'wkkf-continuum-metabox', 'Continuum', 'wkkf_continuum_metabox', 'wkkf_scorecard', 'normal', 'high');
	 add_meta_box( 'wkkf-investments-metabox', 'Investments (WKKF staff only)', 'wkkf_investments_metabox', 'wkkf_scorecard', 'normal', 'high');
}

function wkkf_definitions_metabox()
{
?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/jquery.numeric.js'; ?>"></script>
<table>
	<tr>
		<td>
			<strong>WKKF Priority Place:</strong>
		</td>
		<td>
			<select id="wkkf_pplace">
				<option value="" disabled selected>---Select Priority Place---</option>
				<option value="Michigan">Michigan</option>
				<option value="Mississippi">Mississippi</option>
				<option value="New Mexico">New Mexico</option>
				<option value="Louisiana">Louisiana</option>
				<option value="Haiti">Haiti</option>	
				<option value="Mexico">Mexico</option>
			</select>
		</td>

	</tr>
	<tr>
		<td>
			<strong>Baseline year:</strong>
		</td>
		<td><select name="baselineyear1" id="baselineyear1"></select></td>	
		
	</tr>
	<tr>
		<td>
			<strong>Goal year:</strong>
		</td>			
		<td><select name="goalyear1" id="goalyear1"></select></td>	
	</tr>
</table>
<table id="outcomeTable" cellpadding="5px" style="background-color:#ebebeb;border:solid 1px #dcdcdc;border-collapse:collapse;">
	<thead style="background-color:#dcdcdc;">
	  <tr>
		<th align="left" style="vertical-align:top;">Child Outcome</th>
		<th align="left" style="vertical-align:top;">Baseline <div id="byear"></div></th>	
		<th align="left">	
			<strong>Benchmarks by year</strong>
			<select id="selBenchYear" name="selBenchYear"></select>			
		</th>
		<th align="left" style="vertical-align:top;">Goal <div id="gyear"></div></th>		
		<th align="left" style="vertical-align:top;">Measurement Method</th>
	  </tr>
	</thead>

	<tbody>
	  <tr id="oRow1" class="mb">
		<td><input name="outcome1" id="outcome1" type="text" size="85" /></td>
		<td><input name="baseline1" id="baseline1" type="text" size="5" class="positive-integer" /></td>	
		<td>
			<div id="benchmarks1">

			</div>
		</td>
		<td><input name="goal1" id="goal1" type="text" size="5" class="positive-integer" /></td>		
		<td>
			<select name="measurement1" id="measurement1">
				<option value="" selected disabled>---Select---</option>
				<option value="Percent">Percent (%)</option>
				<option value="Number">Number</option>
			</select>
		</td>
	  </tr>
	</tbody>
</table>
<p><input type="button" value="Add new child outcome" onclick="addRow()" /></p>
<script type="text/javascript">

	var currYear = new Date().getFullYear();

	for (i = currYear + 27; i > 1990; i--)
	{    
		jQuery('#goalyear1').append(jQuery('<option />').val(i).html(i));
	}
	for (j = currYear; j > 1990; j--)
	{    
		jQuery('#baselineyear1').append(jQuery('<option />').val(j).html(j));
	}

	var benchstr = '<div id="bench1_' + currYear + '"><table><tr><td><input type="text" name="bench1Q1_' + currYear + '" id="bench1Q1_' + currYear + '" placeholder="Qtr 1" class="positive-integer" size="5" /></td><td><input type="text" name="bench1Q2_' + currYear + '" id="bench1Q2_' + currYear + '" placeholder="Qtr 2" class="positive-integer" size="5" /></td><td><input type="text" name="bench1Q3_' + currYear + '" id="bench1Q3_' + currYear + '" placeholder="Qtr 3" class="positive-integer" size="5" /></td><td><input type="text" name="bench1Q4_' + currYear + '" id="bench1Q4_' + currYear + '" placeholder="Qtr 4" class="positive-integer" size="5" /></td></tr></table></div>';
	jQuery("#benchmarks1").html(benchstr);	
	
	
	function addRow() {
		var lastrowID = jQuery('.mb:last').attr('id');		
		var lastrowNum = lastrowID.charAt(lastrowID.length-1);
		var newrowNum = parseInt(lastrowNum) + 1;

		
		jQuery('#outcomeTable > tbody:last').append('<tr id="oRow' + newrowNum + '" class="mb"><td><input name="outcome' + newrowNum + '" id="outcome' + newrowNum + '" type="text" size="85" /></td><td><input name="baseline' + newrowNum + '" id="baseline' + newrowNum + '" type="text" size="5" class="positive-integer" /></td><td><div id="benchmarks' + newrowNum + '"></div></td><td><input name="goal' + newrowNum + '" id="goal' + newrowNum + '" type="text" size="5" class="positive-integer" /></td><td><select name="measurement' + newrowNum + '" id="measurement' + newrowNum + '"><option value="" selected disabled>---Select---</option><option value="Percent">Percent (%)</option><option value="Number">Number</option></select></td><td><input type="button" value="Remove" onclick="removeRow(' + newrowNum + ')" /></td></tr>');
		jQuery('#outcomeTable_A > tbody:last').append('<tr id="oRow' + newrowNum + '_A"><td><div style="font-weight:bold;" id="outcome' + newrowNum + '_A"></div></td><td align="left"><div id="baseline' + newrowNum + '_A"></div></td><td><input type="text" name="wkkf_C' + newrowNum + '" size="5" class="positive-integer" value="<?php echo $wkkf_C1; ?>" /><div style="display:inline-block;" id="measurement' + newrowNum + '_A"></div></td><td><div id="benchmarks' + newrowNum + '_A"></div></td><td align="left"><div id="goal' + newrowNum + '_A"></div></td></tr>');
			
		
			
		jQuery('.benchtemp_A').empty();	

		var bm1 = jQuery('#benchmarks1').html();
		var bm1_A = jQuery('#benchmarks1_A_template').html();
		var bmnext = bm1.replace("bench1", "bench" + newrowNum, "g");
		var bmnext_A = bm1_A.replace("bench1", "bench" + newrowNum, "g");
		
		
		jQuery('#benchmarks' + newrowNum).html(bmnext);
		jQuery('#benchmarks' + newrowNum + '_A').html(bmnext_A);
	
	alert(bm1_A);
	
		jQuery('#outcome' + newrowNum).blur(function() {			
			jQuery('#outcome' + newrowNum + '_A').html(jQuery('#outcome' + newrowNum).val());
		});
		jQuery('#baseline' + newrowNum).blur(function() {
			jQuery('#baseline' + newrowNum + '_A').html(jQuery('#baseline' + newrowNum).val());
		});
		
		jQuery('#bench' + newrowNum + 'Q1_' + jQuery('#selBenchYear').val()).blur(function() {
			
			jQuery('#bench' + newrowNum + 'Q1_' + jQuery('#selBenchYear').val() + "_A").html(jQuery('#bench' + newrowNum + 'Q1_' + jQuery('#selBenchYear').val()).val());	
		});
		jQuery('#bench' + newrowNum + 'Q2_' + jQuery('#selBenchYear').val()).blur(function() {
			jQuery('#bench' + newrowNum + 'Q2_' + jQuery('#selBenchYear').val() + "_A").html(jQuery('#bench' + newrowNum + 'Q2_' + jQuery('#selBenchYear').val()).val());	
		});
		jQuery('#bench' + newrowNum + 'Q3_' + jQuery('#selBenchYear').val()).blur(function() {
			jQuery('#bench' + newrowNum + 'Q3_' + jQuery('#selBenchYear').val() + "_A").html(jQuery('#bench' + newrowNum + 'Q3_' + jQuery('#selBenchYear').val()).val());	
		});
		jQuery('#bench' + newrowNum + 'Q4_' + jQuery('#selBenchYear').val()).blur(function() {
			jQuery('#bench' + newrowNum + 'Q4_' + jQuery('#selBenchYear').val() + "_A").html(jQuery('#bench' + newrowNum + 'Q4_' + jQuery('#selBenchYear').val()).val());	
		});		
		
		
		
		jQuery('#goal' + newrowNum).blur(function() {
			jQuery('#goal' + newrowNum + '_A').html(jQuery('#goal' + newrowNum).val());
		});	
		jQuery('#measurement' + newrowNum).change(function() {
			if (jQuery('#measurement' + newrowNum).val() != "Number") {
				jQuery('#baseline' + newrowNum + '_A').html(jQuery('#baseline' + newrowNum).val() + '%');
				jQuery('#goal' + newrowNum + '_A').html(jQuery('#goal' + newrowNum).val() + '%');	
				jQuery('#measurement' + newrowNum + '_A').html('%');
			} else {
				jQuery('#baseline' + newrowNum + '_A').html(jQuery('#baseline' + newrowNum).val());
				jQuery('#goal' + newrowNum + '_A').html(jQuery('#goal' + newrowNum).val());
				jQuery('#measurement' + newrowNum + '_A').html('');
			}
		});
		jQuery(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	}
	function removeRow(x) {
		jQuery('#oRow' + x).remove();
		jQuery('#oRow' + x + '_A').remove();
	}
</script>
<?php
}

function wkkf_childoutcomes_metabox()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $wkkf_C1 = $custom["wkkf_C1"][0];

    $wkkf_C2 = $custom["wkkf_C2"][0];

    $wkkf_C3 = $custom["wkkf_C3"][0];

    $wkkf_C4 = $custom["wkkf_C4"][0];

    $wkkf_C5 = $custom["wkkf_C5"][0];

    $wkkf_C6 = $custom["wkkf_C6"][0];


?>

<div style="overflow:auto;">
	<table id="outcomeTable_A" cellpadding="5px" style="background-color:#ebebeb;border:solid 1px #dcdcdc;border-collapse:collapse;">
		<thead style="background-color:#dcdcdc;">
			<tr>
				<th align="left" style="width:350px;vertical-align:top;">
					<strong>Child Outcome</strong>
				</th>
				<th align="left" style="width:150px;vertical-align:top;">
					<strong>Baseline <div id="byear_A"></div></strong>
				</th>
				<th align="left" style="width:150px;vertical-align:top;">
					<strong>Current Year (<?php echo date('Y'); ?>)</strong>
				</th>		
				<th align="left">
					<strong>Benchmarks by year</strong>
					<select id="selBenchYear_A" name="selBenchYear_A"></select>
					<table width="100%"><tr><td><strong>Qtr 1</strong></td><td><strong>Qtr 2</strong></td><td><strong>Qtr 3</strong></td><td><strong>Qtr 4</strong></td></tr></table>
				</th>
				<th align="left" style="width:150px;vertical-align:top;">	
					<strong>Goal <div id="gyear_A"></div></strong>
				</th>			
			</tr>
		</thead>
		<tbody>
			<tr  id="oRow1_A">
				<td>
					<div style="font-weight:bold;" id="outcome1_A"></div>
				</td>
				<td align="left">
					<div id="baseline1_A"></div>
				</td>
				<td align="left">
					<input type="text" name="wkkf_C1" size="5" class="positive-integer" value="<?php echo $wkkf_C1; ?>"><div style="display:inline-block;" id="measurement1_A" /></div>
				</td>	
				<td align="left">
					<div id="benchmarks1_A"></div>
				</td>
				<td align="left">
					<div id="goal1_A"></div>
				</td>			
			</tr>		
		</tbody>
	</table>
</div>
<div id="benchmarks1_A_template" style="display:none;"></div>

<script type="text/javascript">
var benchstr_A = '<div id="bench1_' + currYear + '_A"><table width="100%"><tr><td><div id="bench1Q1_' + currYear + '_A"></div></td><td><div id="bench1Q2_' + currYear + '_A"></div></td><td><div id="bench1Q3_' + currYear + '_A"></div></td><td><div id="bench1Q4_' + currYear + '_A"></div></td></tr></table></div>';
jQuery("#benchmarks1_A").html(benchstr_A);
var benchstr_A_template = '<div id="bench1_' + currYear + '_A"><table width="100%"><tr><td><div id="bench1Q1_' + currYear + '_A" class="benchtemp_A"></div></td><td><div id="bench1Q2_' + currYear + '_A" class="benchtemp_A"></div></td><td><div id="bench1Q3_' + currYear + '_A" class="benchtemp_A"></div></td><td><div id="bench1Q4_' + currYear + '_A" class="benchtemp_A"></div></td></tr></table></div>';
jQuery("#benchmarks1_A_template").html(benchstr_A_template);


jQuery( document ).ready(function() {
	var currYear = new Date().getFullYear();
	jQuery("#byear,#byear_A").html("(" + currYear + ")");


	jQuery(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });

	jQuery( "#baselineyear1" ).change(function() {
		jQuery("#byear").html("(" + jQuery( "#baselineyear1" ).val() + ")");
		jQuery("#byear_A").html("(" + jQuery( "#baselineyear1" ).val() + ")");
	  	var goalyr = parseInt(jQuery( "#goalyear1" ).val());
		var baseyr = parseInt(jQuery( "#baselineyear1" ).val());	
		jQuery('#selBenchYear')
		    .find('option')
			.remove()
			.end()
			;
		jQuery('#selBenchYear_A')
		    .find('option')
			.remove()
			.end()
			;
		for (i = baseyr; i < goalyr; i++)
		{    			
			jQuery('#selBenchYear').append(jQuery('<option />').val(i).html(i));
			jQuery('#selBenchYear_A').append(jQuery('<option />').val(i).html(i));
			if (i == baseyr) {
				benchyearStr = benchyearStr + '<div id="bench1_' + i + '" class="' + i + ' benchmark"><table><tr><td><input type="text" name="bench1Q1_' + i + '" id="bench1Q1_' + i + '" placeholder="Qtr 1, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q2_' + i + '" id="bench1Q2_' + i + '" placeholder="Qtr 2, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q3_' + i + '" id="bench1Q3_' + i + '" placeholder="Qtr 3, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q4_' + i + '" id="bench1Q4_' + i + '" placeholder="Qtr 4, ' + i + '" class="positive-integer" size="10" /></td></tr></table></div>';
				benchyearStr_A = benchyearStr_A + '<div id="bench1_' + i + '_A" class="' + i + ' benchmark"><table width="100%"><tr><td><div id="bench1Q1_' + i + '_A"></div></td><td><div id="bench1Q2_' + i + '_A"></div></td><td><div id="bench1Q3_' + i + '_A"></div></td><td><div id="bench1Q4_' + i + '_A"></div></td></tr></table></div>';
				
			} else {
				benchyearStr = benchyearStr + '<div id="bench1_' + i + '"  class="' + i + ' benchmark" style="display:none;"><table><tr><td><input type="text" name="bench1Q1_' + i + '" id="bench1Q1_' + i + '" placeholder="Qtr 1, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q2_' + i + '" id="bench1Q2_' + i + '" placeholder="Qtr 2, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q3_' + i + '" id="bench1Q3_' + i + '" placeholder="Qtr 3, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q4_' + i + '" id="bench1Q4_' + i + '" placeholder="Qtr 4, ' + i + '" class="positive-integer" size="10" /></td></tr></table></div>';		
				benchyearStr_A = benchyearStr_A + '<div id="bench1_' + i + '_A"  class="' + i + ' benchmark" style="display:none;"><table width="100%"><tr><td><div id="bench1Q1_' + i + '_A"></div></td><td><div id="bench1Q2_' + i + '_A"></div></td><td><div id="bench1Q3_' + i + '_A"></div></td><td><div id="bench1Q4_' + i + '_A"></div></td></tr></table></div>';
				
			}		
		}
		jQuery('#benchmarks1').html(benchyearStr);		
		jQuery('#benchmarks1_A').html(benchyearStr_A);
	});

	jQuery( "#goalyear1" ).change(function() {
		jQuery("#gyear").html("(" + jQuery( "#goalyear1" ).val() + ")");
		jQuery("#gyear_A").html("(" + jQuery( "#goalyear1" ).val() + ")");
	  	var goalyr = parseInt(jQuery( "#goalyear1" ).val());
		var baseyr = parseInt(jQuery( "#baselineyear1" ).val());	
		jQuery('#selBenchYear')
		    .find('option')
			.remove()
			.end()
			;
		jQuery('#selBenchYear_A')
		    .find('option')
			.remove()
			.end()
			;		
		var benchyearStr = "";
		var benchyearStr_A = "";
		for (i = baseyr; i < goalyr; i++)
		{    
			jQuery('#selBenchYear').append(jQuery('<option />').val(i).html(i));
			jQuery('#selBenchYear_A').append(jQuery('<option />').val(i).html(i));
			if (i == baseyr) {
				benchyearStr = benchyearStr + '<div id="bench1_' + i + '" class="' + i + ' benchmark"><table><tr><td><input type="text" name="bench1Q1_' + i + '" id="bench1Q1_' + i + '" placeholder="Qtr 1, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q2_' + i + '" id="bench1Q2_' + i + '" placeholder="Qtr 2, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q3_' + i + '" id="bench1Q3_' + i + '" placeholder="Qtr 3, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q4_' + i + '" id="bench1Q4_' + i + '" placeholder="Qtr 4, ' + i + '" class="positive-integer" size="10" /></td></tr></table></div>';
				benchyearStr_A = benchyearStr_A + '<div id="bench1_' + i + '_A" class="' + i + ' benchmark"><table width="100%"><tr><td><div id="bench1Q1_' + i + '_A"></div></td><td><div id="bench1Q2_' + i + '_A"></div></td><td><div id="bench1Q3_' + i + '_A"></div></td><td><div id="bench1Q4_' + i + '_A"></div></td></tr></table></div>';
			} else {
				benchyearStr = benchyearStr + '<div id="bench1_' + i + '"  class="' + i + ' benchmark" style="display:none;"><table><tr><td><input type="text" name="bench1Q1_' + i + '" id="bench1Q1_' + i + '" placeholder="Qtr 1, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q2_' + i + '" id="bench1Q2_' + i + '" placeholder="Qtr 2, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q3_' + i + '" id="bench1Q3_' + i + '" placeholder="Qtr 3, ' + i + '" class="positive-integer" size="10" /></td><td><input type="text" name="bench1Q4_' + i + '" id="bench1Q4_' + i + '" placeholder="Qtr 4, ' + i + '" class="positive-integer" size="10" /></td></tr></table></div>';		
				benchyearStr_A = benchyearStr_A + '<div id="bench1_' + i + '_A"  class="' + i + ' benchmark" style="display:none;"><table width="100%"><tr><td><div id="bench1Q1_' + i + '_A"></div></td><td><div id="bench1Q2_' + i + '_A"></div></td><td><div id="bench1Q3_' + i + '_A"></div></td><td><div id="bench1Q4_' + i + '_A"></div></td></tr></table></div>';
			
			}
		}
		jQuery('#benchmarks1').html(benchyearStr);
		jQuery('#benchmarks1_A').html(benchyearStr_A);
	});
	

	
	jQuery('#outcome1').blur(function() {
		jQuery('#outcome1_A').html(jQuery('#outcome1').val());
	});
	jQuery('#baseline1').blur(function() {
		jQuery('#baseline1_A').html(jQuery('#baseline1').val());
	});
	jQuery('#goal1').blur(function() {
		jQuery('#goal1_A').html(jQuery('#goal1').val());
	});	
	jQuery('#measurement1').change(function() {
		if (jQuery('#measurement1').val() != "Number") {
			jQuery('#baseline1_A').html(jQuery('#baseline1').val() + '%');
			jQuery('#goal1_A').html(jQuery('#goal1').val() + '%');	
			jQuery('#measurement1_A').html('%');
		} else {
			jQuery('#baseline1_A').html(jQuery('#baseline1').val());
			jQuery('#goal1_A').html(jQuery('#goal1').val());
			jQuery('#measurement1_A').html('');
		}
	});		
	
	jQuery("#goalyear1").trigger("change");
	
	jQuery('#selBenchYear').change(function() {
		var lastrowID = jQuery('.mb:last').attr('id');		
		var lastrowNum = lastrowID.charAt(lastrowID.length-1);

		var idStr="";
		for (i = 1; i <= lastrowNum; i++) {
			idStr = idStr + "#benchmarks" + i + ","; 
		}
		idStr = idStr.slice(0, -1)
	
		jQuery(idStr).hide();
		//Display benchmarks for selected year
		jQuery( "." + jQuery('#selBenchYear').val() + ".benchmark").css( "display", "block" );		
		//Hide benchmarks for years not selected
		jQuery(".benchmark").not("." + jQuery('#selBenchYear').val()).css("display", "none");
		jQuery(idStr).fadeIn();
	});
	
	jQuery('#bench1Q1_' + currYear ).blur(function() {		
		jQuery('#bench1Q1_' + currYear + '_A').html(jQuery('#bench1Q1_' + currYear ).val());
	});
	jQuery('#bench1Q2_' + currYear ).blur(function() {		
		jQuery('#bench1Q2_' + currYear + '_A').html(jQuery('#bench1Q2_' + currYear ).val());
	});
	jQuery('#bench1Q3_' + currYear ).blur(function() {		
		jQuery('#bench1Q3_' + currYear + '_A').html(jQuery('#bench1Q3_' + currYear ).val());
	});
	jQuery('#bench1Q4_' + currYear ).blur(function() {		
		jQuery('#bench1Q4_' + currYear + '_A').html(jQuery('#bench1Q4_' + currYear ).val());
	});
});
</script>
<?php
}

function wkkf_continuum_metabox() {
    global $post;
    $custom = get_post_custom($post->ID);
	
    $GPstage1 = $custom["GPstage1"][0];
	$GPprogress1 = $custom["GPprogress1"][0];
	$GPbaseline1 = $custom["GPbaseline1"][0];
    $GPgoal1 = $custom["GPgoal1"][0];
    $GPstage2 = $custom["GPstage2"][0];
	$GPprogress2 = $custom["GPprogress2"][0];
	$GPbaseline2 = $custom["GPbaseline2"][0];
    $GPgoal2 = $custom["GPgoal2"][0];
    $GPstage3 = $custom["GPstage3"][0];
	$GPprogress3 = $custom["GPprogress3"][0];
	$GPbaseline3 = $custom["GPbaseline3"][0];
    $GPgoal3 = $custom["GPgoal3"][0];

    $SPstage1 = $custom["SPstage1"][0];
	$SPprogress1 = $custom["SPprogress1"][0];
	$SPbaseline1 = $custom["SPbaseline1"][0];
    $SPgoal1 = $custom["SPgoal1"][0];
    $SPstage2 = $custom["SPstage2"][0];
	$SPprogress2 = $custom["SPprogress2"][0];
	$SPbaseline2 = $custom["SPbaseline2"][0];
    $SPgoal2 = $custom["SPgoal2"][0];
    $SPstage3 = $custom["SPstage3"][0];
	$SPprogress3 = $custom["SPprogress3"][0];
	$SPbaseline3 = $custom["SPbaseline3"][0];
    $SPgoal3 = $custom["SPgoal3"][0];	

?>
<div>
	<strong><u>Grantee Perspective</u></strong><br />
	<table style="margin-left:20px;" cellpadding="5px">
		<tr>
			<td>

			</td>
			<td align="center">
				<strong>Stage</strong>
			</td>				
			<td align="center">
				<strong>Progress</strong>
			</td>

			<td align="center">
				<strong>Baseline</strong>
			</td>
			<td align="center">
				<strong>Goal</strong>
			</td>		
		</tr>	
		<tr>
			<td>
				Healthy School Food
			</td>
			<td>
				<select name="GPstage1" id="GPstage1">
					<option value="" disabled selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>
			</td>
			<td>
				<select name="GPprogress1" id="GPprogress1">
					<option value="" disabled selected>---Progress Level---</option>
					<option value="A little progress">A little progress</option>
					<option value="Some progress">Some progress</option>
					<option value="Mostly complete">Mostly complete</option>
					<option value="Stage completed">Stage completed</option>
				</select>	
			</td>
			<td align="center">
				<input type="text" id="GPbaseline1" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="GPgoal1" placeholder="Stage (XX%)" />
			</td>			
		</tr>
		<tr>
			<td>
				Home Visitations
			</td>
			<td>
				<select name="GPstage2" id="GPstage2">
					<option value="" disabled selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>			
			</td>
			<td align="center">
				<select name="GPprogress2" id="GPprogress2">
					<option value="" disabled selected>---Progress Level---</option>
					<option value="A little progress">A little progress</option>
					<option value="Some progress">Some progress</option>
					<option value="Mostly complete">Mostly complete</option>
					<option value="Stage completed">Stage completed</option>
				</select>				
			</td>

			<td align="center">
				<input type="text" id="GPbaseline2" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="GPgoal2" placeholder="Stage (XX%)" />
			</td>
		
		</tr>
		<tr>
			<td>
				Quality Teaching
			</td>
			<td>
				<select name="GPstage3" id="GPstage3">
					<option value="" disabled selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>			
			</td>
			<td align="center">
				<select name="GPprogress3" id="GPprogress3">
					<option value="" disabled selected>---Progress Level---</option>
					<option value="A little progress">A little progress</option>
					<option value="Some progress">Some progress</option>
					<option value="Mostly complete">Mostly complete</option>
					<option value="Stage completed">Stage completed</option>
				</select>					
			</td>
			<td align="center">
				<input type="text" id="GPbaseline3" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="GPgoal3" placeholder="Stage (XX%)" />
			</td>
		
		</tr>		
	</table>
</div>
<div style="margin-top:25px;">
	<strong><u>Staff Perspective</u></strong><br />
	<table style="margin-left:20px;" cellpadding="5px">
		<tr>
			<td>

			</td>
			<td align="center">
				<strong>Stage</strong>
			</td>				
			<td align="center">
				<strong>Progress</strong>
			</td>

			<td align="center">
				<strong>Baseline</strong>
			</td>
			<td align="center">
				<strong>Goal</strong>
			</td>		
		</tr>	
		<tr>
			<td>
				Healthy School Food
			</td>
			<td>
				<select name="SPstage1" id="SPstage1">
					<option value="" disabled selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>
			</td>
			<td>
				<select name="SPprogress1" id="SPprogress1">
					<option value="" disabled selected>---Progress Level---</option>
					<option value="A little progress">A little progress</option>
					<option value="Some progress">Some progress</option>
					<option value="Mostly complete">Mostly complete</option>
					<option value="Stage completed">Stage completed</option>
				</select>	
			</td>
			<td align="center">
				<input type="text" id="SPbaseline1" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="SPgoal1" placeholder="Stage (XX%)" />
			</td>			
		</tr>
		<tr>
			<td>
				Home Visitations
			</td>
			<td>
				<select name="SPstage2" id="SPstage2">
					<option value="" disabled selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>			
			</td>
			<td align="center">
				<select name="SPprogress2" id="SPprogress2">
					<option value="" disabled selected>---Progress Level---</option>
					<option value="A little progress">A little progress</option>
					<option value="Some progress">Some progress</option>
					<option value="Mostly complete">Mostly complete</option>
					<option value="Stage completed">Stage completed</option>
				</select>				
			</td>

			<td align="center">
				<input type="text" id="SPbaseline2" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="SPgoal2" placeholder="Stage (XX%)" />
			</td>
		
		</tr>
		<tr>
			<td>
				Quality Teaching
			</td>
			<td>
				<select name="SPstage3" id="SPstage3">
					<option value="" disabled selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>			
			</td>
			<td align="center">
				<select name="SPprogress3" id="SPprogress3">
					<option value="" disabled selected>---Progress Level---</option>
					<option value="A little progress">A little progress</option>
					<option value="Some progress">Some progress</option>
					<option value="Mostly complete">Mostly complete</option>
					<option value="Stage completed">Stage completed</option>
				</select>					
			</td>
			<td align="center">
				<input type="text" id="SPbaseline3" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="SPgoal3" placeholder="Stage (XX%)" />
			</td>
		
		</tr>		
	</table>
</div>	
<?php
}

function wkkf_investments_metabox() {
?>
	<table>
		<tr>
			<td>
				<strong>1.</strong> - Read the <a href="http://cares.missouri.edu" target="_blank" style="font-style:italic;">instructions</a>
			</td>
		</tr>
		<tr>
			<td>
				<strong>2.</strong> - Download template .CSV file <a href="http://cares.missouri.edu" target="_blank" style="font-style:italic;">here</a>
			</td>
		</tr>
		<tr>
			<td>
				<strong>3.</strong> - Upload .CSV file here: <input type="file" id="csvupload" accept="text/csv" />			
			</td>
		</tr>
	</table>
<?php
}

add_action( 'save_post', 'wkkfscorecard_save' );
function wkkfscorecard_save() { 
 
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

    if ($post->post_type == 'wkkf_scorecard') {
       wkkfscorecard_save_event_field("wkkf_C1");

	   wkkfscorecard_save_event_field("wkkf_C2");

	   wkkfscorecard_save_event_field("wkkf_C3");

	   wkkfscorecard_save_event_field("wkkf_C4");

	   wkkfscorecard_save_event_field("wkkf_C5");

	   wkkfscorecard_save_event_field("wkkf_C6");

	   
	   wkkfscorecard_save_event_field("GPstage1");
	   wkkfscorecard_save_event_field("GPprogress1");
	   wkkfscorecard_save_event_field("GPbaseline1");
	   wkkfscorecard_save_event_field("GPgoal1");
	   wkkfscorecard_save_event_field("GPstage2");
	   wkkfscorecard_save_event_field("GPprogress2");
	   wkkfscorecard_save_event_field("GPbaseline2");
	   wkkfscorecard_save_event_field("GPgoal2");
	   wkkfscorecard_save_event_field("GPstage3");
	   wkkfscorecard_save_event_field("GPprogress3");
	   wkkfscorecard_save_event_field("GPbaseline3");
	   wkkfscorecard_save_event_field("GPgoal3");
	   wkkfscorecard_save_event_field("SPstage1");
	   wkkfscorecard_save_event_field("SPprogress1");
	   wkkfscorecard_save_event_field("SPbaseline1");
	   wkkfscorecard_save_event_field("SPgoal1");
	   wkkfscorecard_save_event_field("SPstage2");
	   wkkfscorecard_save_event_field("SPprogress2");
	   wkkfscorecard_save_event_field("SPbaseline2");
	   wkkfscorecard_save_event_field("SPgoal2");
	   wkkfscorecard_save_event_field("SPstage3");
	   wkkfscorecard_save_event_field("SPprogress3");
	   wkkfscorecard_save_event_field("SPbaseline3");
	   wkkfscorecard_save_event_field("SPgoal3");	   
	   
    }
}

function wkkfscorecard_save_event_field($event_field) {
    global $post;
    //Don't save empty metas
    if(!empty($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else {
        //Also note that disabled fields are not saved. e.g. if "National" is selected, state, finalgeo and lat/lon will all be deleted. If "State" is selected, finalgeo and lat/lon will all be deleted.
        delete_post_meta($post->ID, $event_field);
    }
}


