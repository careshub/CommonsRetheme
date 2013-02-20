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
		'capability_type' => 'sapolicies',
    'map_meta_cap'    => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','comments')
	); 
	register_post_type('sapolicies',$args);
}

//Building the input form in the WordPress admin area
add_action( 'admin_init', 'policy_meta_box_add' );
function policy_meta_box_add()
{
	 add_meta_box( 'policy_meta_box', 'Policy Information', 'policy_meta_box', 'SA Policies', 'normal', 'high');
         add_meta_box( 'geog-meta-box', 'Geography', 'geog_meta_box', 'SA Policies', 'normal', 'high' );         
}
    
       
function geog_meta_box()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $geog = $custom["geog"][0];
    $state = $custom["state"][0];
        
    
?>
<style type="text/css">
    #leftcolumn, #rightcolumn, #leftcolumn2, #rightcolumn2  { width: 300px; float: left; }
</style>

<div id="leftcolumn">
<input type="radio" name="geog" value="National" onClick="setDiv('National')" <?php 
                if ($geog == "National") {
                    echo " checked";
                }
           ?>> National<br>
<input type="radio" name="geog" value="State" onClick="setDiv('State')" <?php 
                if ($geog == "State") {
                    echo " checked";
                }
           ?>> State<br>
<input type="radio" name="geog" value="County" onClick="setDiv('County')" <?php 
                if ($geog == "County") {
                    echo " checked";
                }
           ?>> County<br>
<input type="radio" name="geog" value="City" onClick="setDiv('City')" <?php 
                if ($geog == "City") {
                    echo " checked";
                }
           ?>> City<br>
<input type="radio" name="geog" value="School District" onClick="setDiv('SD')" <?php 
                if ($geog == "School District") {
                    echo " checked";
                }
           ?>> School District<br>
<input type="radio" name="geog" value="US Congressional District" onClick="setDiv('USCD')"
       <?php 
                if ($geog == "US Congressional District") {
                    echo " checked";
                }
           ?>> US Congressional District<br>
<input type="radio" name="geog" value="State House District" onClick="setDiv('SHD')" <?php 
                if ($geog == "State House District") {
                    echo " checked";
                }
           ?>> State House District<br>
<input type="radio" name="geog" value="State Senate District" onClick="setDiv('SSD')" <?php 
                if ($geog == "State Senate District") {
                    echo " checked";
                }
           ?>> State Senate District<br>
</div>
<div id="rightcolumn" style="display:none">
    <div id="states">    
        <?php
	$args5 = array(
                'parent' => 2,
                'hide_empty' => 0 
                
	);
        
	$terms = get_terms( 'geographies', $args5 );
	
        
	if ( $terms ) {
                print( '<select name="state" id="state" class="state">' );
                if ($state != '') {
                    $properST = get_term_by('slug',$state,'geographies');
                    printf( '<option value="%s">%s</option>', $properST->slug, $properST->name );
                } else {
                    print( '<option value="" selected="selected">Select a state</option>');
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
            <div id="selcnty" style="display:none">
                <select name="cnty" id="cnty" class="cnty">
                    <option value="" selected="selected">Select a County</option>
                </select>
            </div>
            <div id="selcity" style="display:none">
                <select name="city" id="city" class="city">
                    <option value="" selected="selected">Select a City</option>
                </select>
            </div>            
        </div>
</div>

<div style="clear:both"></div>


<?php

    if ($geog != '') {
        echo '<script type="text/javascript">'
       , "setDiv('" . $geog . "');"
       , '</script>';
    }

}

function policy_meta_box() {  
    global $post;
    $custom = get_post_custom($post->ID);
    $sapolicy_type = $custom["policytype"][0];
    $sapolicy_stage = $custom["policystage"][0];
    $pre1 = $custom["pre1"][0];
    $pre2 = $custom["pre2"][0];
    $pre3 = $custom["pre3"][0];
    $dev1 = $custom["dev1"][0];
    $dev2 = $custom["dev2"][0];
    $dev3 = $custom["dev3"][0];
    $enact1 = $custom["enact1"][0];
    $enact2 = $custom["enact2"][0];
    $enact3 = $custom["enact3"][0];
    $post1 = $custom["post1"][0];
    $post2 = $custom["post2"][0];
    $post3 = $custom["post3"][0];
    $dateenacted = $custom["dateenacted"][0];
    $dateimplemented = $custom["dateimplemented"][0];
    $at1 = $custom["at1"][0];
    $at2 = $custom["at2"][0];
    $at3 = $custom["at3"][0];
    $at4 = $custom["at4"][0];
    $at5 = $custom["at5"][0];
    $at6 = $custom["at6"][0];
    $at7 = $custom["at7"][0];
    $otherATdesc = $custom["otherATdesc"][0];
    $otherat1 = $custom["otherat1"][0];
    $otherat2 = $custom["otherat2"][0];
    $otherat3 = $custom["otherat3"][0];
    $otherat4 = $custom["otherat4"][0];
    $otherat5 = $custom["otherat5"][0];
    $otherat6 = $custom["otherat6"][0];
    $otherat7 = $custom["otherat7"][0];
    $otherAT2desc = $custom["otherAT2desc"][0];
?> 

    <strong>Type:</strong><br>
    <select name="policytype">
      <option selected="true" value="<?php echo $sapolicy_type; ?>"><?php echo $sapolicy_type; ?></option>
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

    <input type="radio" name="policystage" value="pre" onClick="setStage('pre')"
           <?php 
                if ($sapolicy_stage == "pre") {
                    echo " checked";
                }
           ?>
           > Pre-Policy<br>
    <input type="radio" name="policystage" value="develop" onClick="setStage('develop')"
            <?php 
                if ($sapolicy_stage == "develop") {
                    echo " checked";
                }
           ?>> Develop Policy<br>
    <input type="radio" name="policystage" value="enact" onClick="setStage('enact')"
           <?php 
                if ($sapolicy_stage == "enact") {
                    echo " checked";
                }
           ?>           
           > Enact Policy<br>
    <input type="radio" name="policystage" value="post" onClick="setStage('post')"
           <?php 
                if ($sapolicy_stage == "post") {
                    echo " checked";
                }
           ?>           
           > Post-Policy<br>

</div>
<div id="rightcolumn2">
    <div id="morestage">
        <div id="prestage" style="display:none">
            <strong>Pre-Policy</strong><br>
            <input type="checkbox" id="pre1" name="pre1" value='Describe Problem' <?php 
                if ($pre1 == true) {
                    echo " checked";
                } 
           ?>                     
                   > Describe Problem<br>
            <input type="checkbox" id="pre2" name="pre2" value='Study Causes and Consequences'<?php 
                if ($pre2 == true) {
                    echo " checked";
                } 
           ?>                  
                   > Study Causes and Consequences<br>
            <input type="checkbox" id="pre3" name="pre3" value='Describe Trend and Spread of Issues'<?php 
                if ($pre3 == true) {
                    echo " checked";
                } 
           ?>                   
                   > Describe Trend and Spread of Issues<br>
        </div>
        <div id="developstage" style="display:none">
            <strong>Develop Policy</strong><br>
            <input type="checkbox" id="dev1" name="dev1" value='Promote Awareness'<?php 
                if ($dev1 == true) {
                    echo " checked";
                } 
           ?>                     
                   > Promote Awareness<br>
            <input type="checkbox" id="dev2" name="dev2" value='Re-frame Issues'<?php 
                if ($dev2 == true) {
                    echo " checked";
                } 
           ?>                   
                   > Re-frame Issues<br>
            <input type="checkbox" id="dev3" name="dev3" value='Mobilize Publics'<?php 
                if ($dev3 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Mobilize Publics<br>
        </div>
        <div id="enactstage" style="display:none">
            <strong>Enact Policy</strong><br>
            <input type="checkbox" id="enact1" name="enact1" value='Create Advocacy'<?php 
                if ($enact1 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Create Advocacy<br>
            <input type="checkbox" id="enact2" name="enact2" value='Frame Policy'<?php 
                if ($enact2 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Frame Policy<br>
            <input type="checkbox" id="enact3" name="enact3" value='Pass Policy or Legislation'<?php 
                if ($enact3 == true) {
                    echo " checked";
                } 
           ?>                    
                   > Pass Policy or Legislation<br><br>
            <strong>Date Enacted</strong><br><input id="dateenacted" name="dateenacted" value="<?php 
                if ($dateenacted != "") {
                    echo $dateenacted;
                }
           ?>"><br>
            <strong>Date Implemented</strong><br><input id="dateimplemented" name="dateimplemented" value="<?php 
                if ($dateimplemented != "") {
                    echo $dateimplemented;
                }
           ?>"><br>
        </div>
        <div id="poststage" style="display:none">
            <strong>Post-Policy</strong><br>
            <input type="checkbox" id="post1" name="post1" value='Implement Policy'<?php 
                if ($post1 == true) {
                    echo " checked";
                } 
           ?>> Implement Policy<br>
            <input type="checkbox" id="post2" name="post2" value='Ensure Access and Equity'<?php 
                if ($post2 == true) {
                    echo " checked";
                }
           ?>> Ensure Access and Equity<br>
            <input type="checkbox" id="post3" name="post3" value='Sustain, Change, Abandon'<?php 
                if ($post3 == true) {
                    echo " checked";
                } 
           ?>> Sustain, Change, Abandon<br>            
        </div>    
    </div>
</div>
<div style="clear:both"></div>
<br>
<strong>Advocacy Target:</strong><br>
            <input type="checkbox" id="at1" name="at1" value='Reduce access to unhealthy competitive foods in school'<?php 
                if ($at1 == true) {
                    echo " checked";
                } 
           ?>> Reduce access to unhealthy competitive foods in school<br>
            <input type="checkbox" id="at2" name="at2" value='Increase the number of healthy food retail outlets in underserved communities receiving funding from food financing initiatives'<?php 
                if ($at2 == true) {
                    echo " checked";
                } 
           ?>> Increase the number of healthy food retail outlets in under-served communities receiving funding from food financing initiatives<br>
            <input type="checkbox" id="at3" name="at3" value='Improve physical activity standards in out-of-school and out-of-class time in under-served communities'<?php 
                if ($at3 == true) {
                    echo " checked";
                } 
           ?>> Improve physical activity standards in out-of-school and out-of-class time in under-served communities<br>
            <input type="checkbox" id="at4" name="at4" value='Increase the use of joint use agreements and street-scale improvements in under-served communities'<?php 
                if ($at4 == true) {
                    echo " checked";
                } 
           ?>> Increase the use of joint use agreements and street-scale improvements in under-served communities<br>
            <input type="checkbox" id="at5" name="at5" value='Reducing unhealthy beverage consumption using pricing incentives and disincentives'<?php 
                if ($at5 == true) {
                    echo " checked";
                } 
           ?>> Reducing unhealthy beverage consumption using pricing incentives and disincentives<br>
            <input type="checkbox" id="at6" name="at6" value='Increase incentives and demand for strengthening industry self-regulation and government regulation of food marketing to kids'<?php 
                if ($at6 == true) {
                    echo " checked";
                } 
           ?>> Increase incentives and demand for strengthening industry self-regulation and government regulation of food marketing to kids<br>
            <input type="checkbox" id="at7" name="at7" value='Other'<?php 
                if ($at7 == true) {
                    echo " checked";
                } 
           ?> onchange="checkOther(this)"> Other<br>
            <div id="otherAT" style="display:none;margin-left: 40px;">
                <strong>Please describe:</strong><br>
                <textarea id="otherATdesc" name="otherATdesc" rows="5" cols="100"><?php echo $otherATdesc; ?></textarea><br>
                    <strong>Which of these policy areas best describe the advocacy work?:</strong><br>
                    <input type="checkbox" id="otherat1" name="otherat1" value='School food environment'<?php 
                if ($otherat1 == true) {
                    echo " checked";
                } 
           ?>> School food environment<br>
                    <input type="checkbox" id="otherat2" name="otherat2" value='Access to healthy, affordable foods in communities'<?php 
                if ($otherat2 == true) {
                    echo " checked";
                } 
           ?>> Access to healthy, affordable foods in communities<br>
                    <input type="checkbox" id="otherat3" name="otherat3" value='Increase PA in school settings'<?php 
                if ($otherat3 == true) {
                    echo " checked";
                } 
           ?>> Increase PA in school settings<br>
                    <input type="checkbox" id="otherat4" name="otherat4" value='Improve built environment for PA'<?php 
                if ($otherat4 == true) {
                    echo " checked";
                } 
           ?>> Improve built environment for PA<br>
                    <input type="checkbox" id="otherat5" name="otherat5" value='Pricing strategies to promote healthy foods'<?php 
                if ($otherat5 == true) {
                    echo " checked";
                } 
           ?>> Pricing strategies to promote healthy foods<br>
                    <input type="checkbox" id="otherat6" name="otherat6" value='Reduce youths exposure to the marketing of unhealthy foods through regulation, policy, and effective industry self-regulation'<?php 
                if ($otherat6 == true) {
                    echo " checked";
                } 
           ?>> Reduce youths exposure to the marketing of unhealthy foods through regulation, policy, and effective industry self-regulation<br>
                    <input type="checkbox" id="otherat7" name="otherat7" value='Other'<?php 
                if ($otherat5 == true) {
                    echo " checked";
                } 
           ?> onchange="checkOther2(this)"> Other<br>                
                    <div id="otherAT2" style="display:none;margin-left: 40px;">
                        <strong>Please describe:</strong><br>
                        <textarea id="otherAT2desc" name="otherAT2desc" rows="5" cols="100"><?php echo $otherAT2desc; ?></textarea><br>               
                    </div>            
                
            </div>


<?php       
    if ($sapolicy_stage != '') {
        echo '<script type="text/javascript">'
       , "setStage('" . $sapolicy_stage . "');"
       , '</script>';
    }
    if ($at7 != '') {    
        echo '<script type="text/javascript">'
        , 'var otherAT22 = document.getElementById("otherAT");'
        , 'otherAT22.style.display="block";'
        , '</script>';        
    }
    if ($otherat7 != '') {    
        echo '<script type="text/javascript">'
        , 'var otherAT23 = document.getElementById("otherAT2");'
        , 'otherAT23.style.display="block";'
        , '</script>';        
    }
    ?>
<script type="text/javascript">
  
var $j = jQuery.noConflict();
    $j(document).ready(function()
    {
        $j("#dateenacted").datepicker();
        $j("#dateimplemented").datepicker();
    });

function setDiv(x)
{
 var selcnty = document.getElementById('selcnty');
 var selcity = document.getElementById('selcity');
 if (x != 'National'){
    rightcolumn.style.display = "block";
 } else {
     rightcolumn.style.display = "none"; 
 }
 if (x == 'County') {     
     selcnty.style.display = "block";
     $j(".state").change(function()
        {
            
            
            var id=$j(this).val();
            var dataString = 'id=' + id;

            $j.ajax
            ({
                type: "POST",
                // url: "http://localhost/wordpress/wp-content/plugins/SA_Policies/geography.php",
                url: "../ajax/taxonomy-geography.php",
                data: dataString,
                cache: false,               
                error: function() {
                    alert("I'm hitting an error.");
                },
                success: function(x)
                {       
                    //alert(x);
                    $j(".cnty").html(x);               
                } 
            });
        });
 }
 else {     
     selcnty.style.display = "none";
 }
  if (x == 'City') {     
     selcity.style.display = "block";
     $j(".state").change(function()
        {
            var id2=$j(this).val();
            var dataString2 = 'id2=' + id2;

            $j.ajax
            ({
                type: "POST",
                // url: "http://localhost/wordpress/wp-content/plugins/SA_Policies/geography.php",
                url: "../ajax/taxonomy-geography.php",
                data: dataString2,
                cache: false,               
                error: function() {
                    alert("I'm hitting an error.");
                },
                success: function(x)
                {          
                    $j(".city").html(x);               
                } 
            });
        });
 }
 else {     
     selcity.style.display = "none";
 }

}
function setStage(y) {

    var pre = document.getElementById('prestage');
    var develop = document.getElementById('developstage');
    var enact = document.getElementById('enactstage');
    var post = document.getElementById('poststage');
// TODO: Why not set them all none and only change the one?
    if (y == "pre") {
        pre.style.display="block";
        develop.style.display="none";
        enact.style.display="none";
        post.style.display="none";    
    }
    if (y == "develop") {        
        pre.style.display="none";
        develop.style.display="block";
        enact.style.display="none";
        post.style.display="none";    
    }
    if (y == "enact") {
        pre.style.display="none";
        develop.style.display="none";
        enact.style.display="block";
        post.style.display="none";    
    }
    if (y == "post") {
        pre.style.display="none";
        develop.style.display="none";
        enact.style.display="none";
        post.style.display="block";    
    }
}
function checkOther(element) {    
    var otherAT = document.getElementById('otherAT');
    if (element.checked) {
        otherAT.style.display="block";
    } else {
        otherAT.style.display="none";
    }    
}
function checkOther2(element) {    
    var otherAT2 = document.getElementById('otherAT2');
    if (element.checked) {
        otherAT2.style.display="block";
    } else {
        otherAT2.style.display="none";
    }    
}
</script>

<?php }

add_action( 'save_post', 'sapolicy_save' );
function sapolicy_save() { 
//TODO: make this loop through the options if set rather than spelling them out.  
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
//TODO: non-object error
    if ($post->post_type == 'sapolicies') {
       save_event_field("policytype");
       save_event_field("policystage");       
       save_event_field("pre1");
       save_event_field("pre2");
       save_event_field("pre3");
       save_event_field("dev1");
       save_event_field("dev2");
       save_event_field("dev3");
       save_event_field("enact1");
       save_event_field("enact2");
       save_event_field("enact3");
       save_event_field("post1");
       save_event_field("post2");
       save_event_field("post3");       
       save_event_field("dateenacted");
       save_event_field("dateimplemented");       
       save_event_field("at1");
       save_event_field("at2");
       save_event_field("at3");
       save_event_field("at4");
       save_event_field("at5");
       save_event_field("at6");
       save_event_field("at7");
       save_event_field("otherATdesc");
       save_event_field("otherat1");
       save_event_field("otherat2");
       save_event_field("otherat3");
       save_event_field("otherat4");
       save_event_field("otherat5");
       save_event_field("otherat6");
       save_event_field("otherat7");
       save_event_field("otherAT2desc");
    }
}

add_action( 'save_post', 'geog_save' );
function geog_save() {   
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
//TODO: non-object error
    if ($post->post_type == 'sapolicies') {
       save_event_field("geog");
       save_event_field("state");
    }
}
//TODO: add cases for different types of fields and validation
function save_event_field($event_field) {
    global $post;
    if(isset($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else{
        delete_post_meta($post->ID, $event_field);
    }
}