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
<table id="outcomeTable">
	<thead>
	  <tr>
		<th align="left">Child Outcome</th>
		<th align="left">Baseline</th>		
		<th align="left">Goal</th>		
		<th align="left">Measurement Method</th>
	  </tr>
	</thead>

	<tbody>
	  <tr id="oRow1">
		<td><input name="outcome1" id="outcome1" type="text" size="85"></td>
		<td><input name="baseline1" id="baseline1" type="text" size="5"></td>		
		<td><input name="goal1" id="goal1" type="text" size="5"></td>		
		<td>
			<select name="measurement1" id="measurement1">
				<option value="Percent (%)" selected>Percent (%)</option>
				<option value="Number">Number</option>
			</select>
		</td>
	  </tr>
	</tbody>
</table>
<input type="button" value="Add new child outcome" onclick="addRow()" />
<script type="text/javascript">

	for (i = new Date().getFullYear()+27; i > 1990; i--)
	{    
		jQuery('#goalyear1').append(jQuery('<option />').val(i).html(i));
	}
	for (j = new Date().getFullYear(); j > 1990; j--)
	{    
		jQuery('#baselineyear1').append(jQuery('<option />').val(j).html(j));
	}

    
 



	function addRow() {
		var lastrowID = jQuery('#outcomeTable tr:last').attr('id');
		var lastrowNum = lastrowID.charAt(lastrowID.length-1);
		var newrowNum = parseInt(lastrowNum) + 1;
		
		jQuery('#outcomeTable > tbody:last').append('<tr id="oRow' + newrowNum + '"><td><input name="outcome' + newrowNum + '" id="outcome' + newrowNum + '" type="text" size="85"></td><td><input name="baseline' + newrowNum + '" id="baseline' + newrowNum + '" type="text" size="5"></td><td><input name="goal' + newrowNum + '" id="goal' + newrowNum + '" type="text" size="5"></td><td><select name="measurement' + newrowNum + '" id="measurement' + newrowNum + '"><option value="Percent (%)" selected>Percent (%)</option><option value="Number">Number</option></select></td><td><input type="button" value="Remove" onclick="removeRow(' + newrowNum + ')" /></td></tr>');

	}
	function removeRow(x) {
		jQuery('#oRow' + x).remove();
		//alert('Removed oRow' + x); 
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
	<table>
		<tr>
			<td>
				
			</td>
			<td align="left" style="width:150px;">
				<strong>Current Year (<?php echo date('Y'); ?>)</strong>
			</td>
			<td align="right" style="width:150px;">
				<strong>Baseline</strong>
			</td>
			<td align="right" style="width:150px;">	
				<strong>Goal</strong>
			</td>			
		</tr>
		<tr>
			<td>
				Percent of Kids Eating Healthy School Food
			</td>
			<td>
				<input type="text" name="wkkf_C1" size="5" value="<?php echo $wkkf_C1; ?>">%
			</td>
			<td align="right">
				5%
			</td>
			<td align="right">
				28%
			</td>			
		</tr>
		<tr>
			<td>
				Number of Daily Healthy School Meals Served
			</td>
			<td>
				<input type="text" name="wkkf_C2" size="5" value="<?php echo $wkkf_C2; ?>">
			</td>
			<td align="right">
				67
			</td>
			<td align="right">
				31
			</td>			
		</tr>
		<tr>
			<td>
				Percent of Schools Contracting With School Food Authorities
			</td>
			<td>
				<input type="text" name="wkkf_C3" size="5">%
			</td>
			<td align="right">
				%
			</td>
			<td align="right">
				%
			</td>			
		</tr>
		<tr>
			<td>
				Percent of Births with a  Healthy Birth Weight
			</td>
			<td>
				<input type="text" name="wkkf_C4" size="5">%
			</td>
			<td align="right">
				%
			</td>
			<td align="right">
				%
			</td>			
		</tr>
		<tr>
			<td>
				Percent of 3rd Graders Proficient in Reading
			</td>
			<td>
				<input type="text" name="wkkf_C5" size="5">%
			</td>
			<td align="right">
				%
			</td>
			<td align="right">
				%
			</td>			
		</tr>		
		<tr>
			<td>
				Percent of 3rd Graders Proficient in Math
			</td>
			<td>
				<input type="text" name="wkkf_C6" size="5">%
			</td>
			<td align="right">
				%
			</td>
			<td align="right">
				%
			</td>			
		</tr>
	</table>
</div>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery( "#wkkf_pplace" ).change(function() {
	  alert(this.value);
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


