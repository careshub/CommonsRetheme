<?php
/*
Author: Michael Barbaro
*/

//Defines the Salud America policy content type
add_action('init', 'SA_policies_init');
function SA_policies_init() 
{
	$policy_labels = array(
		'name' => _x('SA Policies', 'post type general name'),
		'singular_name' => _x('SA Policy', 'post type singular name'),
		'all_items' => __('All SA Policies'),
		'add_new' => _x('Add SA Policy', 'SA policies'),
		'add_new_item' => __('Add new SA Policy'),
		'edit_item' => __('Edit SA Policy'),
		'new_item' => __('New SA Policy'),
		'view_item' => __('View SA Policy'),
		'search_items' => __('Search in SA Policies'),
		'not_found' =>  __('No SA Policies found'),
		'not_found_in_trash' => __('No SA Policies found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $policy_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'hierarchical' => false,
    'show_in_menu' => true,
    // 'menu_position' => 22,
    'taxonomies' => array('sa_advocacy_targets', 'sa_policy_tags'),
    //'has_archive' => 'sapolicies',
    // 'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),
    'supports' => array('title','editor','comments'),
  	'capability_type' => 'sapolicies',
  	'map_meta_cap' => true
	);
	
	register_post_type('sapolicies',$args);
}

//Define which columns should be shown on the policies overview table
function sapolicies_edit_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'SA Policy' ),
    'advocacy_targets' => __('Advocacy Targets'),
		'type' => __( 'Type' ),
		'stage' => __( 'Stage' ),
		'date' => __( 'Date' )
	);

	return $columns;
}
add_filter( 'manage_edit-sapolicies_columns', 'sapolicies_edit_columns' ) ;
//Handle the output for the various columns
function my_manage_sapolicies_columns( $column, $post_id ) {
	switch( $column ) {	
    case 'advocacy_targets' :
      /* Get the post's taxonomy entries. */
      $terms = get_the_terms( $post->ID, 'sa_advocacy_targets' );
      foreach ( $terms as $term ) {
        $advocacy_targets[] = $term->name;
      }
      $advocacy_targets = join( ', ', $advocacy_targets );
      echo $advocacy_targets;
      break;	
		case 'type' :
			/* Get the post meta. */
			$type = get_post_meta( $post_id, 'sa_policytype', true );
      echo $type;
      break;
		case 'stage' :
			/* Get the post meta. */
			$stage = get_post_meta( $post_id, 'sa_policystage', true );  
      $stage2 = strtolower($stage);
      $stage3 = substr_replace($stage2, strtoupper(substr($stage2, 0, 1)), 0, 1);                    
      echo $stage3;
      break;
	}
}
add_action( 'manage_sapolicies_posts_custom_column', 'my_manage_sapolicies_columns', 10, 2 );

//Tell WP which columns should be sortable
function sapolicies_columns_register_sortable( $columns ) {
        $columns["type"] = "type";
        $columns["stage"] = "stage";
        //Note: Advo targets can't be sortable, because the value is a string.
      	return $columns;
}
add_filter( "manage_edit-sapolicies_sortable_columns", "sapolicies_columns_register_sortable" );

//Tell WP how to sort those columns
function sa_policies_column_orderby( $query ) {  
    if( ! is_admin() )  
        return;  

    $orderby = $query->get( 'orderby');  

    switch ($orderby) {
      case 'stage':
          $query->set('meta_key','sa_policystage');  
          $query->set('orderby','meta_value');        
        break;
      case 'type':
          $query->set('meta_key','sa_policytype');  
          $query->set('orderby','meta_value');        
        break;
    } 
} 
add_action( 'pre_get_posts', 'sa_policies_column_orderby' );

//Building the input form in the WordPress admin area
add_action( 'admin_init', 'sa_policy_meta_box_add' );
function sa_policy_meta_box_add()
{
	 add_meta_box( 'sa_policy_meta_box', 'Policy Information', 'sa_policy_meta_box', 'SA Policies', 'normal', 'high');
	 add_meta_box( 'sa_geog_meta_box', 'Geography', 'sa_geog_meta_box', 'SA Policies', 'normal', 'high' );   
         
}
// add_action( 'admin_menu','sapolicy_remove_metas');
function sapolicy_remove_metas() {
    remove_meta_box('geographiesdiv','sapolicies','side');
    remove_meta_box('commentstatusdiv','sapolicies','normal');
    remove_meta_box('trackbacksdiv','sapolicies','normal');
}
       
function sa_geog_meta_box()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $geog = $custom["sa_geog"][0];
    $state = $custom["sa_state"][0];
    $selectedgeog = $custom["sa_finalgeog"][0];
    $sa_latitude = $custom["sa_latitude"][0];
    $sa_longitude = $custom["sa_longitude"][0];
    $sa_nelat = $custom["sa_nelat"][0];
    $sa_nelng = $custom["sa_nelng"][0];
	$sa_swlat = $custom["sa_swlat"][0];
    $sa_swlng = $custom["sa_swlng"][0];
?>
<style type="text/css">
    #leftcolumn, #rightcolumn, #leftcolumn2, #rightcolumn2  { width: 44%; margin-right: 3%; float: left; }
</style>

<div id="leftcolumn">
    <!-- <h4>Geography</h4> -->
    <ul id="sa_geog_select">
      <li><input type="radio" name="sa_geog" id="sa_geog_national" value="National" <?php checked( $geog, 'National' ); ?>> <label for="sa_geog_national">National</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_state" value="State" <?php checked( $geog, 'State' ); ?>> <label for="sa_geog_state">State</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_county" value="County" <?php checked( $geog, 'County' ); ?>> <label for="sa_geog_county">County</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_city" value="City" <?php checked( $geog, 'City' ); ?>> <label for="sa_geog_city">City</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_school_district" value="School District" <?php checked( $geog, 'School District' ); ?>> <label for="sa_geog_school_district">School District</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_us_congress" value="US Congressional District" <?php checked( $geog, 'US Congressional District' ); ?>> <label for="sa_geog_us_congress">US Congressional District</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_state_house" value="State House District" <?php checked( $geog, 'State House District' ); ?>> <label for="sa_geog_state_house">State House District</label></li>
      <li><input type="radio" name="sa_geog" id="sa_geog_state_senate" value="State Senate District" <?php checked( $geog, 'State Senate District' ); ?>> <label for="sa_geog_state_senate">State Senate District</label></li>
    </ul>

</div>
<div id="rightcolumn">
    <div id="states">
        <?php
  //Populate States selectbox 
	$args5 = array(
                'parent' => 718,
                'hide_empty' => 0      
	);
        
	$terms = get_terms( 'geographies', $args5 );
  // echo '<pre>';
  // print_r($geog);
  // print_r($state);
  // print_r($selectedgeog);
  // echo '</pre>';
        
	if ( $terms ) {
    echo '<select name="sa_state" id="sa_state" class="sa_state">';

  		foreach ( $terms as $term ) {
        echo '<option value="' . $term->name . '"' ;
        if (!empty($state)) {
          echo ( $state == $term->name ? ' selected="selected"' : '' );
        }
        echo '>'. $term->name . '</option>';
  		}
		echo '</select>';
	} else {
            print('no terms');
        }

        ?>   

        </div>
        <div id="moregeog">
            <div id="selgeog">
              <!-- If a selection exists (editing an existing policy), set up the option list on page load. We also need to be able to generate it on the fly in the case of a new policy. -->
                <select name="sa_selectedgeog" id="sa_selectedgeog" class="sa_selectedgeog">
                <?php
                //Don't bother to try to load options if the geog value is empty or national or state.
                 if ( !empty($geog) && !in_array($geog, array ('National','State')) ) {
                    $geog_str_prefix = sa_get_geography_prefix($geog);

                    $geo_search_slug = $geog_str_prefix . $state;
                    $geoterm = get_term_by('slug', $geo_search_slug, 'geographies'); 
                    $tid = $geoterm->term_id;
                        $args = array(
                                'parent' => $tid,
                                'hide_empty' => 0,
                        );
                        $terms = get_terms( 'geographies', $args );
                        if ( $terms ) {                    
                                foreach ( $terms as $term ) {
                                   echo '<option value="' . $term->name . '"' ;
                                    if (!empty($selectedgeog)) {
                                      echo ( $selectedgeog == $term->name ? ' selected="selected"' : '' );
                                    }
                                    echo '>'. $term->name . '</option>';
                                    }
                            }

                    //load the values list for this geog and state, setting the selection along the way
                        // echo "<option selected='true' value='" . $selectedgeog . "'>" . $selectedgeog . "</option>";
                    }            
                 ?>                   
                    
                </select>
                <input type="hidden" id="sa_finalgeog" value="<?php echo $selectedgeog; ?>" name="sa_finalgeog" />
                <div id="geography_coords">
                  <input type="hidden" id="sa_latitude" value="<?php echo $sa_latitude; ?>" name="sa_latitude">
                  <input type="hidden" id="sa_longitude" value="<?php echo $sa_longitude; ?>" name="sa_longitude">
                  <input type="hidden" id="sa_nelat" value="<?php echo $sa_nelat; ?>" name="sa_nelat">
                  <input type="hidden" id="sa_nelng" value="<?php echo $sa_nelng; ?>" name="sa_nelng">
                  <input type="hidden" id="sa_swlat" value="<?php echo $sa_swlat; ?>" name="sa_swlat">
                  <input type="hidden" id="sa_swlng" value="<?php echo $sa_swlng; ?>" name="sa_swlng">
                </div>
            </div>            
        </div>
</div>

<div style="clear:both"></div>


<?php


}



function sa_policy_meta_box() {  
    global $post;
    $custom = get_post_custom($post->ID);
    $sapolicy_type = $custom["sa_policytype"][0];
    $sapolicy_stage = $custom["sa_policystage"][0];
    $pre1 = $custom["sa_pre1"][0];
    $pre2 = $custom["sa_pre2"][0];
    $pre3 = $custom["sa_pre3"][0];
    $dev1 = $custom["sa_dev1"][0];
    $dev2 = $custom["sa_dev2"][0];
    $dev3 = $custom["sa_dev3"][0];
    $enact1 = $custom["sa_enact1"][0];
    $enact2 = $custom["sa_enact2"][0];
    $enact3 = $custom["sa_enact3"][0];
    $post1 = $custom["sa_post1"][0];
    $post2 = $custom["sa_post2"][0];
    $post3 = $custom["sa_post3"][0];
    $dateenacted = $custom["sa_dateenacted"][0];
    $dateimplemented = $custom["sa_dateimplemented"][0];


   
        $ptdef="";
        if ($sapolicy_type == null){
            $ptdef="---Select a Policy Type---";
        }else {            
            $ptdef=$sapolicy_type;
        }
       
?> 
<!-- TODO: switch types to a taxonomy -->
    <strong>Type:</strong><br>
    <select name="sa_policytype">
      <option selected="true" value="<?php echo $sapolicy_type; ?>"><?php echo $ptdef; ?></option>
      <option value="Legislation/Ordinance">Legislation/Ordinance</option>
      <option value="Resolution">Resolution</option>
      <option value="Tax Ordinance">Tax Ordinance</option>
      <option value="Internal Policy">Internal Policy</option>
      <option value="Executive Order">Executive Order</option>
      <option value="Plan">Plan</option>
      <option value="Design Manual">Design Manual</option>
      <option value="Other">Other</option>  
    </select>
    <br><br>
<div id="leftcolumn2">
    <h4>Stage:</h4>
    <ul id="policy_stage_select">
      <li><input type="radio" name="sa_policystage" id="sa_policystage_pre_policy" value="emergence" <?php checked( $sapolicy_stage, 'emergence' ); ?>> <label for="sa_policystage_pre_policy">Emergence</label></li>

      <li><input type="radio" name="sa_policystage" id="sa_policystage_develop_policy" value="development" <?php checked( $sapolicy_stage, 'development' ); ?>> <label for="sa_policystage_develop_policy">Development</label></li>
      
      <li><input type="radio" name="sa_policystage" id="sa_policystage_enact_policy" value="enactment" <?php checked( $sapolicy_stage, 'enactment' ); ?>> <label for="sa_policystage_enact_policy">Enactment</label></li>
      
      <li><input type="radio" name="sa_policystage" id="sa_policystage_post_policy" value="implementation" <?php checked( $sapolicy_stage, 'implementation' ); ?>> <label for="sa_policystage_post_policy">Implementation</label></li>
    </ul>

</div>
<div id="rightcolumn2">
    <div id="morestage">
        
        <div id="prestage" class="policy_stage_details">
            <h4>Emergence</h4>
            <input type="checkbox" id="sa_pre1" name="sa_pre1" value='Describe Problem' <?php checked( $pre1, 'Describe Problem' ); ?> > <label for="sa_pre1">Describe Problem</label><br />
            
            <input type="checkbox" id="sa_pre2" name="sa_pre2" value='Study Causes and Consequences' <?php checked( $pre2, 'Study Causes and Consequences' ); ?>                        
                   > <label for="sa_pre2">Study Causes and Consequences</label><br />
            
            <input type="checkbox" id="sa_pre3" name="sa_pre3" value='Describe Trend and Spread of Issues' <?php checked( $pre3, 'Describe Trend and Spread of Issues' ); ?>> <label for="sa_pre1">Describe Trend and Spread of Issues</label><br />
        </div>
        
        <div id="developstage" class="policy_stage_details">
            <h4>Development</h4>
            <input type="checkbox" id="sa_dev1" name="sa_dev1" value='Promote Awareness' <?php checked( $dev1, 'Promote Awareness' ); ?>                 
                   > <label for="sa_dev1">Promote Awareness</label><br />            

            <input type="checkbox" id="sa_dev2" name="sa_dev2" value='Re-frame Issues' <?php checked( $dev2, 'Re-frame Issues' ); ?>> <label for="sa_dev2">Re-frame Issues</label><br />
            
            <input type="checkbox" id="sa_dev3" name="sa_dev3" value='Mobilize Publics' <?php checked( $dev3, 'Mobilize Publics' ); ?>> <label for="sa_dev3">Mobilize Publics</label><br />
        </div>
        
        <div id="enactstage" class="policy_stage_details">
            <h4>Enactment</h4>
            <input type="checkbox" id="sa_enact1" name="sa_enact1" value='Create Advocacy' <?php checked( $enact1, 'Create Advocacy' ); ?>             
                   > <label for="sa_enact1">Create Advocacy</label><br />
            <input type="checkbox" id="sa_enact2" name="sa_enact2" value='Frame Policy' <?php checked( $enact2, 'Frame Policy' ); ?>             
                   > <label for="sa_enact2">Frame Policy</label><br />
            <input type="checkbox" id="sa_enact3" name="sa_enact3" value='Pass Policy or Legislation' <?php checked( $enact3, 'Pass Policy or Legislation' ); ?>              
                   > <label for="sa_enact3">Pass Policy or Legislation</label><br />
            <label for="sa_dateenacted">Date Enacted<label><br />
            <input id="sa_dateenacted" name="sa_dateenacted" value="<?php 
                if ($dateenacted != "") {
                    echo $dateenacted;
                }
           ?>"><br />
        </div>
        
        <div id="poststage" class="policy_stage_details">
            <h4>Implementation</h4>
            <input type="checkbox" id="sa_post1" name="sa_post1" value='Implement Policy' <?php checked( $post1, 'Implement Policy' ); ?>> <label for="sa_post1">Implement Policy</label><br />
            <input type="checkbox" id="sa_post2" name="sa_post2" value='Ensure Access and Equity' <?php checked( $post2, 'Ensure Access and Equity' ); ?>> <label for="sa_post2">Ensure Access and Equity</label><br />
            <input type="checkbox" id="sa_post3" name="sa_post3" value='Sustain, Change, Abandon'<?php checked( $post2, 'Sustain, Change, Abandon' ); ?>> <label for="sa_post3">Sustain, Change, Abandon</label><br />  
            <label for="sa_dateimplemented">Date Implemented</label><br />
            <input id="sa_dateimplemented" name="sa_dateimplemented" value="<?php 
                if ($dateimplemented != "") {
                    echo $dateimplemented;
                }
           ?>"><br />          
        </div>    
    </div>
</div>
<div style="clear:both"></div>

            
<script type="text/javascript">
    //Show and hide appropriate stage divs
jQuery(document).ready(function(){

      refresh_sa_policy_stage_vis_setting();

      //On click, refresh the visibility. Hide them all, then show the selected one
        jQuery('#policy_stage_select input').live( 'change', function() {     refresh_sa_policy_stage_vis_setting();            
          } );
});

function refresh_sa_policy_stage_vis_setting() {
  //First, hide them all, then show the one that is selected
  jQuery('.policy_stage_details').hide();
      var visible_stage_div = jQuery('#policy_stage_select').find('input:checked').val();
      // console.log(visible_stage_div);
      switch (visible_stage_div){
        case "emergence":
              jQuery('#prestage').toggle();
          break;
        case "development":
              jQuery('#developstage').toggle();
          break;
        case "enactment":
              jQuery('#enactstage').toggle();
          break;
        case "implementation":
              jQuery('#poststage').toggle();
          break;
        }
 }

</script>

<script type="text/javascript">
//Handle the geography input form
jQuery(document).ready(function(){
      //On page load, update the inputs that are enabled
        refresh_sa_policy_enable_geog_inputs();

      //If a geography has been selected, but not copied over to #final_geog, do it.
      //TODO: Why are we using final_geog again?
        if ( ( jQuery('#sa_finalgeog').val() == '' ) && ( jQuery('#sa_selectedgeog').val() !== '' )  ) {
          jQuery("#sa_finalgeog").val(jQuery("#sa_selectedgeog").val());
        }

      //Refresh lat/longs on page load if any are empty
      var emptyCoords = jQuery('#geography_coords input').filter(function() { return this.value == ""; });

      //emptyCoords will return an object of objects if it finds any empty inputs
      if (emptyCoords.length > 0) {
          //This function will only run if #sa_finalgeog isn't empty
          get_sa_geog_lat_lon();
      } else {
        // console.log('No need to run the function');
      }

      //On change, refresh the option list and option list visibility
      //The page load setup is handled via php, so the js only has to handle the updates
        jQuery('#sa_geog_select').live( 'change', function() {           
            refresh_sa_policy_enable_geog_inputs();
            refresh_sa_policy_geographies();            
          });

        jQuery('#sa_state').live( 'change', function() {           
            refresh_sa_policy_geographies();          
          });

        jQuery("#sa_selectedgeog").live( 'change', function() {
            jQuery("#sa_finalgeog").val(jQuery("#sa_selectedgeog").val());
            get_sa_geog_lat_lon();
           });

});

function refresh_sa_policy_enable_geog_inputs() {
  //First, disable the inputs, then enable the needed inputs
  jQuery('#sa_state,#sa_selectedgeog').prop('disabled', true);

  var sa_major_geography = jQuery('#sa_geog_select').find('input:checked').val();
    switch ( sa_major_geography ) {
      case ( undefined ):
      case ('National'):
        //Leave inputs disabled
        break;
      case ('State'):
        jQuery('#sa_state').prop('disabled', false);
        break;
      default:
        jQuery('#sa_state,#sa_selectedgeog').prop('disabled', false);
    }

}

function refresh_sa_policy_geographies() {
  //First, hide them all, then show the one that is selected
  // jQuery('.policy_stage_details').hide();
      var sa_major_geography = jQuery('#sa_geog_select').find('input:checked').val();
      var sa_state_geography = jQuery("#sa_state").val();
      // console.log(sa_major_geography);
      // console.log(sa_state_geography);
    
        switch (sa_major_geography) {
          case ( undefined ):
            //Nothing selected, hold tight
            break;
          case ('National'):
          case ('State'):
          case ('State Senate District'):
            //TODO: State senate districts aren't behaving correctly - no terms seem to be available?
            //Clear finalgeog and lat/lon values
            //TODO: Why aren't we setting points for states?
            jQuery("#sa_finalgeog,#sa_latitude,#sa_longitude").val('');
            break;
          default:
          //Fetch the subdivisions if they're needed.
            if (sa_state_geography !== "") {
              var dataString = 'selstate=' + sa_state_geography + '&geog=' + sa_major_geography;
          
                 jQuery.ajax
                 ({
                   type: "POST",               
                   url: "http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/ajax/geography.php",
                   data: dataString,
                   cache: false,               
                   error: function() {
                     alert("I'm having trouble setting up the geographies list.");
                   },
                   success: function(k)
                   {       
                     //alert(k);
                     jQuery("#sa_selectedgeog").html(k);
                     //set finalgeo and lat/lon, in case the desired option is the first option... otherwise 'change' will never fire :)
                     jQuery("#sa_finalgeog").val(jQuery("#sa_selectedgeog option:first").val());
                      get_sa_geog_lat_lon();         

                   } 
                 });

             }
           }             
 }

function get_sa_geog_lat_lon(){
    if (jQuery("#sa_finalgeog").val() !== '') {  
      //  alert(jQuery("#sa_finalgeog").val());

      var dataString2 = 'finalgeog=' + jQuery("#sa_finalgeog").val() + '&geog=' + jQuery("#sa_geog").val() + '&state=' + jQuery("#sa_state").val();  
      //TODO: Make this a typical WP ajax request
       jQuery.ajax
       ({
         type: "POST",               
         url: "http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/ajax/getlatlong.php",
         data: dataString2,
         cache: false,               
         error: function() {
           alert("I can't calculate the lat & long.");
         },
         success: function(p)
         {       
           // console.log(p);
           // jQuery("#sa_latlongs").html(p);
           var coord = jQuery.parseJSON(p);
            jQuery("#sa_latitude").val(coord.latitude);
            jQuery("#sa_longitude").val(coord.longitude);
      			jQuery("#sa_nelat").val(coord.nelat);
      			jQuery("#sa_nelng").val(coord.nelng);
      			jQuery("#sa_swlat").val(coord.swlat);
      			jQuery("#sa_swlng").val(coord.swlng);
         } 
       });
   }
}

</script>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("#sa_dateenacted").datepicker();
    jQuery("#sa_dateimplemented").datepicker();
  });
</script>

<?php }

function sa_get_geography_prefix($geog){
   switch ($geog) {
     case 'County':     
     $geog_str_prefix="counties-";
       break;
    case 'City':    
     $geog_str_prefix="cities-";
       break;
     case 'School District':    
    $geog_str_prefix="schooldistricts-";
       break;
     case 'US Congressional District':     
    $geog_str_prefix="uscongressionaldistricts-";
       break;
     case  'State House District':     
    $geog_str_prefix="statehousedistricts-";
       break;
     case 'State Senate District':    
    $geog_str_prefix="statesenatedistricts-";
       break;
   }
   return $geog_str_prefix;
}
  
add_action( 'save_post', 'sapolicy_save' );
function sapolicy_save() { 
 
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

    if ($post->post_type == 'sapolicies') {
       sapolicy_save_event_field("sa_policytype");
       sapolicy_save_event_field("sa_policystage");       
       sapolicy_save_event_field("sa_pre1");
       sapolicy_save_event_field("sa_pre2");
       sapolicy_save_event_field("sa_pre3");
       sapolicy_save_event_field("sa_dev1");
       sapolicy_save_event_field("sa_dev2");
       sapolicy_save_event_field("sa_dev3");
       sapolicy_save_event_field("sa_enact1");
       sapolicy_save_event_field("sa_enact2");
       sapolicy_save_event_field("sa_enact3");
       sapolicy_save_event_field("sa_post1");
       sapolicy_save_event_field("sa_post2");
       sapolicy_save_event_field("sa_post3");       
       sapolicy_save_event_field("sa_dateenacted");
       sapolicy_save_event_field("sa_dateimplemented");       


    }
}

add_action( 'save_post', 'sa_geog_save' );
function sa_geog_save() {   
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

    if ($post->post_type == 'sapolicies') {
       sapolicy_save_event_field("sa_latitude");
       sapolicy_save_event_field("sa_longitude");  

		sapolicy_save_event_field("sa_nelat"); 
		sapolicy_save_event_field("sa_nelng"); 
		sapolicy_save_event_field("sa_swlat"); 
		sapolicy_save_event_field("sa_swlng"); 	   
	
       sapolicy_save_event_field("sa_geog");
       sapolicy_save_event_field("sa_state");
       sapolicy_save_event_field("sa_finalgeog");
    }
}

function sapolicy_save_event_field($event_field) {
    global $post;
    //Don't save empty metas
    if(!empty($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else {
        //Also note that disabled fields are not saved. e.g. if "National" is selected, state, finalgeo and lat/lon will all be deleted. If "State" is selected, finalgeo and lat/lon will all be deleted.
        delete_post_meta($post->ID, $event_field);
    }
}

//Not needed, WP includes jQuery UI
// add_action('init', 'sapolicy_jquery'); 
function sapolicy_jquery(){
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('sticky_post-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);
    }

function sa_searchpolicies() {
        ?>
<div id="cc-adv-search" class="clear">
	<form action="" method="POST" enctype="multipart/form-data" name="sa_ps">
			<div class="row">
        <input type="text" id="saps" name="saps" Placeholder="Enter search terms here" value="<?php 
    			if (isset($_POST['saps'])) {
    				echo $_POST['saps']; 
    			}	elseif (isset($_GET['qs'])) {
    					echo $_GET['qs'];	
    			}
    				?>" />
			
  			<input id="searchsubmit" type="submit" alt="Search" value="Search" />
      </div>
	
	<a role="button" id="cc_advanced_search_toggle" class="clear" >+ Advanced Search</a>
		 
			<div id="cc-adv-search-pane-container" class="row clear">
        <div class="cc-adv-search-option-pane third-block">
          <h4>Topic Area</h4>
          <ul>
            <?php 
            $ATterms = get_terms('sa_advocacy_targets');
            foreach ($ATterms as $ATterm) {
              echo '<li><input type="checkbox" name="sa_advocacy_target[]" id="sa_adv_target_' . $ATterm->term_id . '" value="' . $ATterm->term_id . '" /> <label for="sa_adv_target_' . $ATterm->term_id . '">' . $ATterm->name . '</label></li>';
            }
            ?>
          </ul>
        </div> <!-- End option pane -->
      
        <div class="cc-adv-search-option-pane third-block">
          <h4>Stage of Change</h4>        
          <ul>
            <li><input type="checkbox" name="policy_stages[]" id="policy-stage-emergence" value="emergence" /> <label for="policy-stage-emergence">Emergence</label></li>
            <li><input type="checkbox" name="policy_stages[]" id="policy-stage-develop" value="development" /> <label for="policy-stage-develop">Development</label></li>
            <li><input type="checkbox" name="policy_stages[]" id="policy-stage-enact" value="enactment" /> <label for="policy-stage-enact">Enactment</label></li>
            <li><input type="checkbox" name="policy_stages[]" id="policy-stage-implement" value="implementation" /> <label for="policy-stage-implement">Implementation</label></li>
          </ul>
        </div> <!-- End option pane -->
      
        <div class="cc-adv-search-option-pane third-block">
          <h4>Tags</h4>
          <?php $sat_args = array('orderby' => count, 'order' => DESC);
          $sapolicytags = get_terms('sa_policy_tags', $sat_args);
          ?>
          <div class="cc-adv-search-scroll-container">
          <ul>
            <?php
            foreach ($sapolicytags as $sapolicytag) {
              echo '<li><input type="checkbox" name="sa_sapolicy_tag[]" id="sa_policy_tag_' .  $sapolicytag->term_id . '" value="' . $sapolicytag->term_id . '" /> <label for="sa_policy_tag_' . $sapolicytag->term_id . '">' . $sapolicytag->name . ' (' . $sapolicytag->count . ')</label></li>';
            } 
            ?>
          </ul>
          </div> <!-- End scroll container -->
        </div> <!-- End option pane -->
      </div>
			
		</form>	
		
	</div>
	<script type="text/javascript">
		var $j = jQuery.noConflict();
		
		$j(document).ready(function(){

		   $j('#cc-adv-search-pane-container').hide();	
		   $j('#cc_advanced_search_toggle').click(function(){
  				$j('#cc-adv-search-pane-container').slideToggle('fast');
  				if ($j("#cc_advanced_search_toggle").text() == "+ Advanced Search") {
  					$j("#cc_advanced_search_toggle").text("- Advanced Search");
  				}
  				else {
  					$j("#cc_advanced_search_toggle").text("+ Advanced Search");
  				}
		   });

		});
    
	</script>

<?php
	global $wpdb; 

	if(isset($_POST['sa_advocacy_target']))
	 {
		 $chk1 = $_POST['sa_advocacy_target'];	 
	 }
	if(isset($_POST['policy_stages']))
	 {
		 $chk2 = $_POST['policy_stages'];			
	 }	
	if(isset($_POST['sa_sapolicy_tag']))
	 {
		 $chk3 = $_POST['sa_sapolicy_tag'];		
	 }
	 
	if(isset($_POST['sa_advocacy_target']) || isset($_POST['policy_stages']) || isset($_POST['sa_sapolicy_tag'])) {
		$post_ids = get_objects_in_term($chk1, 'sa_advocacy_targets');
		$post_ids2 = get_objects_in_term($chk3, 'sa_policy_tags');
		$post_ids3 = array_merge($post_ids,$post_ids2);
		$filter_args = array(
					 'post_type' => 'sapolicies',
					 's' => $_POST['saps'],
					 'post__in' => $post_ids3,					 
					 'meta_query' => array(
										array(
											'key' => 'sa_policystage',
											'value' => $chk2
											 )
					 					 )
					 
					 );
			//var_dump($filter_args);
			$query2 = new WP_Query($filter_args);
		    if($query2->have_posts()) : 
			  while($query2->have_posts()) : 
					$query2->the_post();
					get_template_part( 'content', 'sa-policy-short' ); 

			  endwhile;
		   else: 
			  echo "No Results - Search criteria too specific";	
		   endif;						
    } else {
  		if(isset($_POST['saps']))
  		{		           
  				$saps = $_POST['saps']; 			

  				$query = new WP_Query( array(
  						's' => $saps, 
  						'post_type' => 'sapolicies'));
  				
  				if($query->have_posts()) : 
  				  while($query->have_posts()) : 
  						$query->the_post();
  						get_template_part( 'content', 'sa-policy-short' );  

  				  endwhile;
  			   else: 
  				  echo "No Results - Search criteria too specific";	
  			   endif;	
  		}		
	}
}

function sa_highlight_search_results($saps,$text) {
				
				$keys2 = explode(" ",$saps);
				$text2 = preg_replace('/('.implode('|', $keys2) .')/iu', '<strong style="color:#EF403B;">'.$saps.'</strong>', $text);
				return $text2;
}



function sa_location_search()
{ 
        ?>
		
			<h4>Search for Changes in Progress by Location</h4>
				
        <form method="POST" action="" name="sa_ls" enctype="multipart/form-data"> 
            <input type="text" id="locationtxt" size="70" Placeholder="Type in location here" name="locationtxt" />
            <input type="submit" name="submit" value="Search"/>
        </form>
<br><br>
<?php
        if(isset($_POST['locationtxt']) && strlen($_POST['locationtxt'])>1)
    {
        global $wpdb;    
        $loc = $_POST['locationtxt'];  
        $loc2 = str_replace(" ","%20",$loc);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $loc2 . '&sensor=false');
        $output = json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $lng = $output->results[0]->geometry->location->lng;
        
   
        
        
        $query = "SELECT DISTINCT $wpdb->posts.ID, $wpdb->posts.post_title, $wpdb->posts.post_content, wpcflat.meta_value AS latitude, wpcflong.meta_value AS longitude,
            3959 * 2 * ASIN ( SQRT (POWER(SIN(($lat - wpcflat.meta_value)*pi()/180 / 2),2) + COS($lat * pi()/180) * COS(wpcflat.meta_value *pi()/180) * POWER(SIN(($lng - wpcflong.meta_value) *pi()/180 / 2), 2) ) ) as distance
        FROM $wpdb->posts
            LEFT JOIN $wpdb->postmeta as wpcflong ON ($wpdb->posts.ID = wpcflong.post_id)
            LEFT JOIN $wpdb->postmeta as wpcflat ON ($wpdb->posts.ID = wpcflat.post_id)

        WHERE $wpdb->posts.ID
        AND wpcflat.meta_key = 'sa_latitude'
        AND wpcflong.meta_key = 'sa_longitude'

        ORDER BY distance
        LIMIT 200";
      
	  ?>
  
	  
	  <?php
        
        $results = $wpdb->get_results($query);
		
        if (!$results) {
          die("Invalid query: " . $wpdb->show_errors());
        } else {
            //var_dump($results);
            echo "<div style='margin-bottom:12px;'>Your search: " . $loc . "</div>";
            ?>
            <div id="contact-content">
            	   <div class="map">
                        <style type="text/css">
                          #map_sapolicies img {
                             max-width: none;
                             border-width:0px;
                             -webkit-box-shadow: none;
                             -moz-box-shadow: none;
                             box-shadow: none;                           
                          }
                        </style>
                        <div id="map_sapolicies" style="width: 600px; height: 600px"></div><br><br>  
                    </div>

                </div>  
            <?php

            foreach ($results as $result){

                echo "<div style='color:#fe9600;font-weight:bold;font-size:13pt;'><a href='" . get_permalink($result->ID) . "'>" . $result->post_title . "</a></div><br>";
        				echo "<div>" . $result->post_content . "</div><div style='font-style:italic;'>Distance from search center: " . round($result->distance, 2) . " miles</div><br>";			
            }   
            
        }
		?>
	    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">		
			var $j = jQuery.noConflict();
			
			$j(document).ready(function(){				
				samap_initialize();
			});	                       
			
            function samap_initialize() {
						var markers = []; 
                        var firstpt = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);

                        var firstLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);              

                        var firstOptions = {
                            zoom: 7,
                            center: firstLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP 
                        };

                        var map = new google.maps.Map(document.getElementById("map_sapolicies"), firstOptions);

                        var firstimage = 'http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/star-3.png';
                        var policyimage = 'http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/doc-3.png';
                        
                        var firstmarker = new google.maps.Marker({
                            position: firstpt,
                            map: map,
                            icon: firstimage,
                            title: 'Your search location'
                        });


                        <?php 
                            foreach ($results as $result){
                                $theTitle = $result->post_title;
                                $theLat = $result->latitude;
                                $theLng = $result->longitude;
                                $pl = get_permalink($result->ID);    
                                
                        ?>
                      
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?php echo $theLat . ", " . $theLng ?>),
                            map: map,
                            icon: policyimage,
                            html: "<b><a href='<?php echo $pl; ?>'><?php echo $theTitle; ?></a></b><br>"
                          });
                        markers.push(marker);
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.setContent(this.html);
                            infowindow.open(map, this);
                        });
                            <?php } ?>
                        

                        var contentString1 = 'Your Search Location:<br><?php echo $loc ?>';

                        var infowindow = new google.maps.InfoWindow({
                            content: "loading..."
                        });

                        var infowindow1 = new google.maps.InfoWindow({
                            content: contentString1
                        });

                        google.maps.event.addListener(firstmarker, 'click', function() {
                            infowindow1.open(map,firstmarker);
                        });
                    }			
		</script>		
		<?php
		
    } else {
		$args5 = array(
			'post_type' => 'sapolicies',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'caller_get_posts'=> 1,
			'meta_query' => array(
					array(
						'key' => 'sa_latitude',	
						'compare' => 'EXISTS'
					),
					array(
						'key' => 'sa_longitude',
						'compare' => 'EXISTS'
					)
				)			  
		
		);
	
        $my_query = new WP_Query($args5);

	?>
	    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">		
			var $j = jQuery.noConflict();
			
			$j(document).ready(function(){				
				samap_start();
			});	                       
			
          function samap_start() {
						var markers = []; 
						var gMap = new google.maps.Map(document.getElementById('map_sastart')); 
						gMap.setZoom(4);      // This will trigger a zoom_changed on the map
						gMap.setCenter(new google.maps.LatLng(38.195279, -96.031494));
						gMap.setMapTypeId(google.maps.MapTypeId.ROADMAP);
						
						var policyimage = 'http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/img/doc-3.png';
						var infowindow = new google.maps.InfoWindow({
                            content: "loading..."
                        });
						
                        <?php 
							if( $my_query->have_posts() ) {
						  while ($my_query->have_posts()) : $my_query->the_post(); 	
							  $theLat2 = get_post_meta(get_the_ID(), 'sa_latitude', true);
							  $theLng2 = get_post_meta(get_the_ID(), 'sa_longitude', true); ?>
                      
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?php echo $theLat2 . ", " . $theLng2 ?>),
                            map: gMap,
                            icon: policyimage,
                            html: "<b><a href='<?php echo get_permalink(); ?>'><?php echo get_the_title(); ?></a></b><br>"
                          });
                        markers.push(marker);
                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.setContent(this.html);
                            infowindow.open(gMap, this);
                        });
                        <?php 
						  endwhile;
						} 
						?>						
						

					}
					
		</script>
		 <div id="map_sastart" style="width: 700px; height: 400px"></div><br><br>
	<?php
	}
}