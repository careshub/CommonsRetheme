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


add_filter( 'manage_edit-sapolicies_columns', 'my_edit_sapolicies_columns' ) ;

function my_edit_sapolicies_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'SA Policy' ),
		'type' => __( 'Type' ),
		'stage' => __( 'Stage' ),
		'last_modified' => __( 'Last Modified' )
	);

	return $columns;
}

add_action( 'manage_sapolicies_posts_custom_column', 'my_manage_sapolicies_columns', 10, 2 );

function my_manage_sapolicies_columns( $column, $post_id ) {
	switch( $column ) {		
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
                case 'last_modified' :                        
                        echo the_modified_time('F j, Y')?> at <?php the_modified_time('g:i a');
                        break;
	}
}

function sap_columns_register_sortable( $columns ) {
        $columns["type"] = "type";
        $columns["stage"] = "stage";
	$columns["last_modified"] = "last_modified";
	return $columns;
}
add_filter( "manage_edit-sapolicies_sortable_columns", "sap_columns_register_sortable" );




//Building the input form in the WordPress admin area
add_action( 'admin_init', 'sa_policy_meta_box_add' );
function sa_policy_meta_box_add()
{
	 add_meta_box( 'sa_policy_meta_box', 'Policy Information', 'sa_policy_meta_box', 'SA Policies', 'normal', 'high');
	 add_meta_box( 'sa_geog_meta_box', 'Geography', 'sa_geog_meta_box', 'SA Policies', 'normal', 'high' );   
         
}
add_action( 'admin_menu','sapolicy_remove_metas');
function sapolicy_remove_metas() {
    remove_meta_box('geographiesdiv','sapolicies','side');
    // remove_meta_box('commentstatusdiv','sapolicies','normal');
    remove_meta_box('trackbacksdiv','sapolicies','normal');
}
       
function sa_geog_meta_box()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $geog = $custom["sa_geog"][0];
    $state = $custom["sa_state"][0];
    $selectedgeog = $custom["sa_finalgeog"][0];    
    
?>
<style type="text/css">
    #leftcolumn, #rightcolumn, #leftcolumn2, #rightcolumn2  { width: 300px; float: left; }
</style>

<div id="leftcolumn">
    <?php
        $geogdef="";
        if ($geog == null)
        {
            $geogdef="---Select a Geography---";
        }else {            
            $geogdef=$geog;
        }
    ?>    
    
    <select id="sa_geog" name="sa_geog">
      <option selected="true" value="<?php echo $geog; ?>"><?php echo $geogdef; ?></option>
      <option value="National">National</option>
      <option value="State">State</option>
      <option value="County">County</option>
      <option value="City">City</option>
      <option value="School District">School District</option>
      <option value="US Congressional District">US Congressional District</option>
      <option value="State House District">State House District</option>
      <option value="State Senate District">State Senate District</option>      
    </select>    
    
    

</div>
<div id="rightcolumn">
    <div id="states">    
        <?php
	$args5 = array(
                'parent' => 718,
                'hide_empty' => 0 
                
	);
        
	$terms = get_terms( 'geographies', $args5 );
	
        
	if ( $terms ) {
                print( '<select name="sa_state" id="sa_state" class="sa_state">' );
                if ($state != '') {
                    $properST = get_term_by('slug',$state,'geographies');
                    printf( '<option value="%s">%s</option>', $properST->slug, $properST->name );
                } else {
                    print( '<option value="" selected="selected">Select a State</option>');
                }
		foreach ( $terms as $term ) {
		$mnb =	printf( '<option value="%s">%s</option>', $term->slug, $term->name );
                echo $mnb;
		}
		print( '</select>' );
	} else {
            print('no terms');
        }

        ?>   

        </div>
        <div id="moregeog">
            <div id="selgeog"> 
                <select name="sa_selectedgeog" id="sa_selectedgeog" class="sa_selectedgeog">
                <?php
                 if ($geog !== null) {
                        echo "<option selected='true' value='" . $selectedgeog . "'>" . $selectedgeog . "</option>";
                    }            
                 ?>                   
                    
                </select>
				<input type="hidden" id="sa_finalgeog" name="sa_finalgeog" />
				<div id="sa_latlongs"></div>
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
    <strong>Stage:</strong><br>

    <input type="radio" name="sa_policystage" value="Pre Policy" onClick="setStage('pre');"
           <?php 
                if ($sapolicy_stage == "Pre Policy") {
                    echo " checked";
                }
           ?>
           > Pre-Policy<br>
    <input type="radio" name="sa_policystage" value="Develop Policy" onClick="setStage('develop');"
            <?php 
                if ($sapolicy_stage == "Develop Policy") {
                    echo " checked";
                }
           ?>> Develop Policy<br>
    <input type="radio" name="sa_policystage" value="Enact Policy" onClick="setStage('enact');"
           <?php 
                if ($sapolicy_stage == "Enact Policy") {
                    echo " checked";
                }
           ?>           
           > Enact Policy<br>
    <input type="radio" name="sa_policystage" value="Post Policy" onClick="setStage('post');"
           <?php 
                if ($sapolicy_stage == "Post Policy") {
                    echo " checked";
                }
           ?>           
           > Post-Policy<br>

</div>
<div id="rightcolumn2">
    <div id="morestage">
        <div id="prestage" style="<?php 
if ($sapolicy_stage === "pre") {
    echo "display:block";
} else {
    echo "display:none";
}
?>">
            <strong>Pre-Policy</strong><br>
            <input type="checkbox" id="sa_pre1" name="sa_pre1" value='Describe Problem' <?php 
                if ($pre1 == true) {
                    echo " checked";
                } 
           ?>                     
                   > Describe Problem<br>
            <input type="checkbox" id="sa_pre2" name="sa_pre2" value='Study Causes and Consequences'<?php 
                if ($pre2 == true) {
                    echo " checked";
                } 
           ?>                  
                   > Study Causes and Consequences<br>
            <input type="checkbox" id="sa_pre3" name="sa_pre3" value='Describe Trend and Spread of Issues'<?php 
                if ($pre3 == true) {
                    echo " checked";
                } 
           ?>                   
                   > Describe Trend and Spread of Issues<br>
        </div>
        <div id="developstage" style="<?php 
if ($sapolicy_stage === "develop") {
    echo "display:block";
} else {
    echo "display:none";
}
?>">
            <strong>Develop Policy</strong><br>
            <input type="checkbox" id="sa_dev1" name="sa_dev1" value='Promote Awareness'<?php 
                if ($dev1 == true) {
                    echo " checked";
                } 
           ?>                     
                   > Promote Awareness<br>
            <input type="checkbox" id="sa_dev2" name="sa_dev2" value='Re-frame Issues'<?php 
                if ($dev2 == true) {
                    echo " checked";
                } 
           ?>                   
                   > Re-frame Issues<br>
            <input type="checkbox" id="sa_dev3" name="sa_dev3" value='Mobilize Publics'<?php 
                if ($dev3 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Mobilize Publics<br>
        </div>
        <div id="enactstage" style="<?php 
if ($sapolicy_stage === "enact") {
    echo "display:block";
} else {
    echo "display:none";
}
?>">
            <strong>Enact Policy</strong><br>
            <input type="checkbox" id="sa_enact1" name="sa_enact1" value='Create Advocacy'<?php 
                if ($enact1 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Create Advocacy<br>
            <input type="checkbox" id="sa_enact2" name="sa_enact2" value='Frame Policy'<?php 
                if ($enact2 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Frame Policy<br>
            <input type="checkbox" id="sa_enact3" name="sa_enact3" value='Pass Policy or Legislation'<?php 
                if ($enact3 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Pass Policy or Legislation<br><br>
            <strong>Date Enacted</strong><br><input id="sa_dateenacted" name="sa_dateenacted" value="<?php 
                if ($dateenacted != "") {
                    echo $dateenacted;
                }
           ?>"><br>
            <strong>Date Implemented</strong><br><input id="sa_dateimplemented" name="sa_dateimplemented" value="<?php 
                if ($dateimplemented != "") {
                    echo $dateimplemented;
                }
           ?>"><br>
        </div>
        <div id="poststage" style="<?php 
if ($sapolicy_stage === "post") {
    echo "display:block";
} else {
    echo "display:none";
}
?>">
            <strong>Post-Policy</strong><br>
            <input type="checkbox" id="sa_post1" name="sa_post1" value='Implement Policy'<?php 
                if ($post1 == true) {
                    echo " checked";
                } 
           ?>> Implement Policy<br>
            <input type="checkbox" id="sa_post2" name="sa_post2" value='Ensure Access and Equity'<?php 
                if ($post2 == true) {
                    echo " checked";
                }
           ?>> Ensure Access and Equity<br>
            <input type="checkbox" id="sa_post3" name="sa_post3" value='Sustain, Change, Abandon'<?php 
                if ($post3 == true) {
                    echo " checked";
                } 
           ?>> Sustain, Change, Abandon<br>            
        </div>    
    </div>
</div>
<div style="clear:both"></div>

            


      

   
<script type="text/javascript">

var $j = jQuery.noConflict();
    $j(document).ready(function()
    {
        $j("#sa_dateenacted").datepicker();
        $j("#sa_dateimplemented").datepicker();
		
		var sg = $j('#sa_geog').val()
		if ($j('#sa_selectedgeog').val() == null) {
			$j('#sa_selectedgeog').hide();		
		}
		if ($j("#sa_state").val()=="") {
			$j("#sa_state").hide();		
		}
		if (sg == 'National') {
			$j("#sa_state").hide();
			$j('#sa_selectedgeog').hide();
		}		
		if (sg == 'State') {
			$j('#sa_selectedgeog').hide();
		}
		
		
		
		$j("#sa_state,#sa_geog").change(function()
			   {
					var sageog = $j("#sa_geog").val();
					var selstate = $j("#sa_state").val();
					 
					 if (sageog == 'National'){	
						$j("#sa_state,#sa_selectedgeog").val('');							
						$j("#sa_selectedgeog,#sa_state").hide();
						$j("#sa_finalgeog").val('United States');	
					 } else if (sageog == 'State'){
						$j("#sa_state").show();
						$j("#sa_selectedgeog").hide();
						$j("#sa_finalgeog").val(selstate);						
					 } else { 					   
						$j("#sa_selectedgeog,#sa_state").show();
						$j("#sa_finalgeog").val($j("#sa_selectedgeog").val());
						$j("#sa_finalgeog").val($j("#sa_selectedgeog").val());
					 } 
					
			   	 	if (selstate !== "") {
						   	
						  	  
						   
						   var dataString = 'selstate=' + selstate + '&geog=' + sageog;
						
						   $j.ajax
						   ({
							   type: "POST",               
							   url: "http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/ajax/geography.php",
							   data: dataString,
							   cache: false,               
							   error: function() {
								   alert("I'm hitting an error.");
							   },
							   success: function(k)
							   {       
								   //alert(k);
								   $j("#sa_selectedgeog").html(k);         

							   } 
						   });
				   }
				   
				   
				   //console.log($j("#sa_finalgeog").val());
			   });
			   
	   $j("#sa_selectedgeog").change(function()
	   {
			$j("#sa_finalgeog").val($j("#sa_selectedgeog").val());	
			//console.log($j("#sa_finalgeog").val());
			if ($j("#sa_finalgeog").val() !== '') {
						   	
						  //	alert($j("#sa_finalgeog").val());

                                                      var dataString2 = 'finalgeog=' + $j("#sa_finalgeog").val() + '&geog=' + $j("#sa_geog").val() + '&state=' + $j("#sa_state").val();  
                                                  
						   
						
						   $j.ajax
						   ({
							   type: "POST",               
							   url: "http://dev.communitycommons.org/wp-content/themes/CommonsRetheme/ajax/getlatlong.php",
							   data: dataString2,
							   cache: false,               
							   error: function() {
								   alert("I'm hitting an error2.");
							   },
							   success: function(p)
							   {       
								   //alert(p);
								   $j("#sa_latlongs").html(p);         

							   } 
						   });
				   }
				   			
			
			
	   });

  });
	
	
	




function setStage(y) {

    var pre = document.getElementById('prestage');
    var develop = document.getElementById('developstage');
    var enact = document.getElementById('enactstage');
    var post = document.getElementById('poststage');
// TODO: Why not set them all none and only change the one?
    if (y === "pre") {
        pre.style.display="block";
        develop.style.display="none";
        enact.style.display="none";
        post.style.display="none";    
    }
    if (y === "develop") {        
        pre.style.display="none";
        develop.style.display="block";
        enact.style.display="none";
        post.style.display="none";    
    }
    if (y ==="enact") {
        pre.style.display="none";
        develop.style.display="none";
        enact.style.display="block";
        post.style.display="none";    
    }
    if (y === "post") {
        pre.style.display="none";
        develop.style.display="none";
        enact.style.display="none";
        post.style.display="block";    
    }
}

</script>

<?php }

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
	
       sapolicy_save_event_field("sa_geog");
       sapolicy_save_event_field("sa_state");
       sapolicy_save_event_field("sa_finalgeog");
    }
}

function sapolicy_save_event_field($event_field) {
    global $post;
    if(isset($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else{
        delete_post_meta($post->ID, $event_field);
    }
}

add_action('init', 'sapolicy_jquery'); 
function sapolicy_jquery(){
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('sticky_post-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);
    }

function sa_searchpolicies() {
        ?>
    <div>

	</div>
	<form action="" method="POST" enctype="multipart/form-data" name="sa_ps">
			SA Policy Search:<br><input type="text" id="saps" name="saps" value="<?php 
			if(isset($_POST['saps'])) {
				echo $_POST['saps']; 
			}
			elseif(isset($_GET['qs'])) {
				
					echo $_GET['qs'];
				
			}
				?>" />

			<input id="searchsubmit" type="submit" alt="Search" value="Search" />
	</form>
<br>
	
	<a href="#" id="toggle">+ Advanced Search</a>
	<br><br>
    <div id="advancedsearch" style="width:800px;display:none;">
		<form id="advsearch" action="?qs=<?php echo $_POST['saps'] ?>" method="POST" enctype="multipart/form-data" name="sa_ps2">
			<div style="float:left;">
				<h4>Advocacy Targets</h4>
				<?php 
				
				$ATterms = get_terms('sa_advocacy_targets');
				foreach ($ATterms as $ATterm) {
					echo "<input type='checkbox' name='sa_advocacy_target[]' value='" . $ATterm->term_id . "' /> " . substr($ATterm->name, 0, 25) . "...<br>";
				}
				?>
			</div>
			<div style="float:left;padding-left:20px;">
				<h4>Policy Stages</h4>
				<input type="checkbox" name="policy_stages[]" value="Pre Policy" /> Pre Policy<br>
				<input type="checkbox" name="policy_stages[]" value="Develop Policy" /> Develop Policy<br>
				<input type="checkbox" name="policy_stages[]" value="Enact Policy" /> Enact Policy<br>
				<input type="checkbox" name="policy_stages[]" value="Post Policy" /> Post Policy
			</div>
			<div style="float:left;padding-left:20px;">
				<h4>Tags</h4>
				<?php $sat_args = array('orderby' => count, 'order' => DESC, 'number' => 7);
				$sapolicytags = get_terms('sa_policy_tags', $sat_args);
				foreach ($sapolicytags as $sapolicytag) {
					echo "<input type='checkbox' name='sa_sapolicy_tag[]' value='" . $sapolicytag->term_id . "' /> " . $sapolicytag->name . " (" . $sapolicytag->count . ")<br>";
				}			
				?>
			</div>
			<div><input type="submit" id="updateresults" value="Update Results" /></div>
		</form>	
		
	</div>
<br>
	<script type="text/javascript">
		var $j = jQuery.noConflict();
		
		$j(document).ready(function(){


		   $j('#advancedsearch').hide();	
		   $j('#toggle').click(function(){
				$j('#advancedsearch').slideToggle('slow');
				if ($j("#toggle").text() == "+ Advanced Search") {
					$j("#toggle").text("- Advanced Search");
				}
				else {
					$j("#toggle").text("+ Advanced Search");
				}
		   });

		});	
		
		
		
		
    
	</script>

<?php
	global $wpdb; 

	
	if(isset($_POST['saps']))
    {		           
			$saps = $_POST['saps']; 			

		    $query = new WP_Query( array(
					's' => $saps, 
					'post_type' => 'sapolicies'));
			
		    if($query->have_posts()) : 
			  while($query->have_posts()) : 
				 $query->the_post();
				 ?>
					<div style='color:#fe9600;font-weight:bold;font-size:13pt;'><a href='<?php the_permalink() ?>'><?php sa_highlight_search_results($saps, the_title()) ?></a></div><br>
					<div><?php sa_highlight_search_results($saps, the_content()) ?></div><br>
				 <?php   

			  endwhile;
		   else: 
			  echo "No Results";	
		   endif;	
	}
	$advocacy_targets="";
	$policy_stages="";
	$sa_tags="";
	if(isset($_POST['sa_advocacy_target']))
	 {
		 $sats = $_POST['sa_advocacy_target'];
		 foreach ($sats as $sat) {
			$chk1 .= $sat . ",";
		 }		 
		 $chk1=rtrim($chk1, ",");		 
	 }
	if(isset($_POST['policy_stages']))
	 {
		 $pss = $_POST['policy_stages'];
		 foreach ($pss as $ps) {
			$chk2 .= $ps . ",";
		 }
		 $chk2=rtrim($chk2, ",");		
			
	 }	
	if(isset($_POST['sa_sapolicy_tag']))
	 {
		 $ssts = $_POST['sa_sapolicy_tag'];
		 foreach ($ssts as $sst) {
			$chk3 .= $sst . ",";
		 }
		 $chk3=rtrim($chk3, ",");		
	 }
	 
	if(isset($_POST['sa_advocacy_target']) || isset($_POST['policy_stages']) || isset($_POST['sa_sapolicy_tag'])) {
		$filter_args = array(
					 'post_type' => 'sapolicies',
					 's' => $_GET['qs'],
					 'category__in' => array($chk1)
					 // 'meta_query' => array(
										// 'key' => 'sa_policystage',
										// 'value' => array($chk2)
					 
					 //)
					 
					 );
						var_dump($filter_args);
		$query2 = new WP_Query($filter_args);
		    if($query2->have_posts()) : 
			  while($query2->have_posts()) : 
				 $query2->the_post();
				 ?>
					<div style='color:#fe9600;font-weight:bold;font-size:13pt;'><a href='<?php the_permalink() ?>'><?php sa_highlight_search_results($saps, the_title()) ?></a></div><br>
					<div><?php sa_highlight_search_results($saps, the_content()) ?></div><br>
				 <?php   

			  endwhile;
		   else: 
			  echo "No Results";	
		   endif;						
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
        <form method="POST" action="" name="sa_ls" enctype="multipart/form-data"> 
            SA Policy Search by Location:<br><input type="text" id="locationtxt" size="65" name="locationtxt" />
            <input type="submit" name="submit" value="Search"/>
        </form>
<br><br>
<?php
        if(isset($_POST['locationtxt']))
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
      
        //print_r($query);
        $results = $wpdb->get_results($query);
         if (!$results) {
          die("Invalid query: " . $wpdb->show_errors());
        } else {
            //var_dump($results);
            echo "Your search: " . $loc;
            ?>
            <div id="contact-content">
                    <script type="text/javascript">
                    var markers = [];    
                    function samap_initialize() {

                        var firstpt = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);

                        var firstLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);              

                        var firstOptions = {
                            zoom: 7,
                            center: firstLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP 
                        };

                        var map = new google.maps.Map(document.getElementById("map_sapolicies"), firstOptions);

                        var firstimage = 'http://localhost/wordpress/wp-content/themes/twentytwelve/includes/star-3.png';
                        var policyimage = 'http://localhost/wordpress/wp-content/themes/twentytwelve/includes/text.png';
                        
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
        


    }
}	
	
