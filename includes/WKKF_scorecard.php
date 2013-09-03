<?php 
add_action( 'init', 'register_cpt_scorecard' );

function register_cpt_scorecard() {

    $labels = array( 
        'name' => _x( 'Scorecards', 'scorecard' ),
        'singular_name' => _x( 'Scorecard', 'scorecard' ),
        'add_new' => _x( 'Add New', 'scorecard' ),
        'add_new_item' => _x( 'Add New Scorecard', 'scorecard' ),
        'edit_item' => _x( 'Edit Scorecard', 'scorecard' ),
        'new_item' => _x( 'New Scorecard', 'scorecard' ),
        'view_item' => _x( 'View Scorecard', 'scorecard' ),
        'search_items' => _x( 'Search Scorecards', 'scorecard' ),
        'not_found' => _x( 'No scorecards found', 'scorecard' ),
        'not_found_in_trash' => _x( 'No scorecards found in Trash', 'scorecard' ),
        'parent_item_colon' => _x( 'Parent Scorecard:', 'scorecard' ),
        'menu_name' => _x( 'Scorecards', 'scorecard' ),
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

    register_post_type( 'scorecard', $args );
}

//Building the input form in the WordPress admin area
add_action( 'admin_init', 'wkkf_scorecard_meta_box_add' );
function wkkf_scorecard_meta_box_add()
{
	 add_meta_box( 'wkkf-childoutcomes-metabox', 'Child Outcomes', 'wkkf_childoutcomes_metabox', 'scorecard', 'normal', 'high');
	 add_meta_box( 'wkkf-continuum-metabox', 'Continuum', 'wkkf_continuum_metabox', 'scorecard', 'normal', 'high');
         
}

function wkkf_childoutcomes_metabox()
{

?>
	<table>
		<tr>
			<td>
				
			</td>
			<td align="center">
				<strong>Current</strong>
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
				Percent of Kids Eating Healthy School Food
			</td>
			<td>
				<input type="text" name="C1" size="5">%
			</td>
			<td>
				<input type="text" name="B1" size="5">%
			</td>
			<td>
				<input type="text" name="G1" size="5">%
			</td>			
		</tr>
		<tr>
			<td>
				Number of Daily Healthy School Meals Served
			</td>
			<td>
				<input type="text" name="C2" size="5">
			</td>
			<td>
				<input type="text" name="B2" size="5">
			</td>
			<td>
				<input type="text" name="G2" size="5">
			</td>			
		</tr>
		<tr>
			<td>
				Percent of Schools Contracting With School Food Authorities
			</td>
			<td>
				<input type="text" name="C3" size="5">%
			</td>
			<td>
				<input type="text" name="B3" size="5">%
			</td>
			<td>
				<input type="text" name="G3" size="5">%
			</td>			
		</tr>
		<tr>
			<td>
				Percent of Births with a  Healthy Birth Weight
			</td>
			<td>
				<input type="text" name="C4" size="5">%
			</td>
			<td>
				<input type="text" name="B4" size="5">%
			</td>
			<td>
				<input type="text" name="G4" size="5">%
			</td>			
		</tr>
		<tr>
			<td>
				Percent of 3rd Graders Proficient in Reading
			</td>
			<td>
				<input type="text" name="C5" size="5">%
			</td>
			<td>
				<input type="text" name="B5" size="5">%
			</td>
			<td>
				<input type="text" name="G5" size="5">%
			</td>			
		</tr>		
		<tr>
			<td>
				Percent of 3rd Graders Proficient in Math
			</td>
			<td>
				<input type="text" name="C6" size="5">%
			</td>
			<td>
				<input type="text" name="B6" size="5">%
			</td>
			<td>
				<input type="text" name="G6" size="5">%
			</td>			
		</tr>
	</table>
<?php
}

function wkkf_continuum_metabox() {
?>
	<strong>Grantee Perspective</strong><br />
	<table style="margin-left:20px;" cellpadding="5px">
		<tr>
			<td>

			</td>
			<td>
			
			</td>				
			<td align="center">
				A little progress
			</td>
			<td align="center">
				Some progress
			</td>
			<td align="center">
				Mostly complete
			</td>
			<td align="center">
				Stage completed
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
					<option value="" selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>
			</td>
			<td align="center">
				<input type="radio" id="GPlittle1" name="GPprogress1" />
			</td>
			<td align="center">
				<input type="radio" id="GPsome1" name="GPprogress1" />
			</td>
			<td align="center">
				<input type="radio" id="GPmostly1" name="GPprogress1" />
			</td>
			<td align="center">
				<input type="radio" id="GPcomplete1" name="GPprogress1" />
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
					<option value="" selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>			
			</td>
			<td align="center">
				<input type="radio" id="GPlittle2" name="GPprogress2" />
			</td>
			<td align="center">
				<input type="radio" id="GPsome2" name="GPprogress2" />
			</td>
			<td align="center">
				<input type="radio" id="GPmostly2" name="GPprogress2" />
			</td>
			<td align="center">
				<input type="radio" id="GPcomplete2" name="GPprogress2" />
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
					<option value="" selected>---Select Stage---</option>
					<option value="Unawareness">Unawareness</option>
					<option value="Awareness">Awareness</option>
					<option value="Mobilization">Mobilization</option>
					<option value="Implementation">Implementation</option>
					<option value="Transform">Transform</option>
				</select>			
			</td>
			<td align="center">
				<input type="radio" id="GPlittle3" name="GPprogress3" />
			</td>
			<td align="center">
				<input type="radio" id="GPsome3" name="GPprogress3" />
			</td>
			<td align="center">
				<input type="radio" id="GPmostly3" name="GPprogress3" />
			</td>
			<td align="center">
				<input type="radio" id="GPcomplete3" name="GPprogress3" />
			</td>
			<td align="center">
				<input type="text" id="GPbaseline3" placeholder="Stage (XX%)" />
			</td>
			<td align="center">
				<input type="text" id="GPgoal3" placeholder="Stage (XX%)" />
			</td>
		
		</tr>		









		
	</table>
<?php
}