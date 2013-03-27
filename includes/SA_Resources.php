<?php

/*
Author: Michael Barbaro
*/

//Defines the Salud America policy content type
add_action('init', 'SA_resources_init');
function SA_resources_init() 
{
	$resource_labels = array(
		'name' => _x('SA Resources', 'post type general name'),
		'singular_name' => _x('SA Resource', 'post type singular name'),
		'all_items' => __('All SA Resources'),
		'add_new' => _x('Add SA Resource', 'SA resources'),
		'add_new_item' => __('Add new SA Resource'),
		'edit_item' => __('Edit SA Resource'),
		'new_item' => __('New SA Resource'),
		'view_item' => __('View SA Resource'),
		'search_items' => __('Search in SA Resources'),
		'not_found' =>  __('No SA Resources found'),
		'not_found_in_trash' => __('No SA Resources found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $resource_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','comments')
	); 
	register_post_type('saresources',$args);
}

//Building the input form in the WordPress admin area
add_action( 'admin_init', 'resource_meta_box_add' );
function resource_meta_box_add(){
	 add_meta_box( 'resource_meta_box', 'Resource Information', 'resource_meta_box', 'SA Resources', 'normal', 'high');     
}

function resource_meta_box()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $resourcetype = $custom["sa_resourcetype"][0];
    $resourcecategory = $custom["sa_resourcecategory"][0];  
	$resourcefile = $custom["sa_upload_file"][0]; 
	$resourcelink = $custom["sa_link"][0]; 
	$resourceembed = $custom["sa_embedcode"][0]; 
	$resourcesharing = $custom["sa_sharing"][0]; 

	$rtdef="";
	if ($resourcetype == null)
	{
		$rtdef="---Select a Resource Type---";
	}else {            
		$rtdef=$resourcetype;
	}
?>  <strong>Resource Type:</strong><br>  	
    <select id="sa_resourcetype" name="sa_resourcetype" onChange="openDiv(this);">
      <option selected="true" value="<?php echo $rtdef; ?>"><?php echo $rtdef; ?></option>
      <option value="File">File</option>
      <option value="Link">Link</option>
      <option value="Embed">Embed Code</option>  
    </select>   
	
	<div id="filediv" style="<?php 
if ($resourcetype === "File") {
    echo "display:block";
} else {
    echo "display:none";
}
?>">
		<br>
		<strong>Upload file:</strong><br>
		<input type="file" name="sa_upload_file" value="
		<?php
			if ($resourcefile !== null) {
				echo $resourcefile;
			}
		?>" />
	</div>
	<div id="linkdiv" style="<?php 
if ($resourcetype === "Link") {
    echo "display:block";
} else {
    echo "display:none";
}
?>">
		<br>
		<strong>Enter link here:</strong><br>
		<input type="text" name="sa_link" size="100" value="
		<?php
			if ($resourcelink !== null) {
				echo $resourcelink;
			}
		?>">
	</div>
	<div id="embeddiv" style="<?php 
if ($resourcetype === "Embed") {
    echo "display:block";
} else {
    echo "display:none";
}
?>"">
		<br>
		<strong>Enter embed code here:</strong><br>
		<textarea name="sa_embedcode" rows="4" cols="100" value="
		<?php
			if ($resourceembed !== null) {
				echo $resourceembed;
			}
		?>"></textarea>	
	</div>
	<br><br>
	<strong>Sharing:</strong><br>
	<div style="padding-left:20px;">
	<input type="radio" name="sa_sharing" value="curators"            
			<?php 
                if ($resourcesharing == "curators") {
                    echo " checked";
                }
           ?>> Curators<br>
	<input type="radio" name="sa_sharing" value="public"
			<?php 
                if ($resourcesharing == "public") {
                    echo " checked";
                }
           ?>> Public<br>
	</div>
	<br><br>
	<strong>Category:</strong><br>
	
<?php     

    $taxonomy="resourcecat";    
	$terms = get_terms( $taxonomy, array( 'hide_empty' => 0 ) );
	
	if ( $terms ) {
                print( '<select name="sa_resourcecategory" id="sa_resourcecategory" class="sa_resourcecategory">' );
                if ($resourcecategory != '') {
                    $properST = get_term_by('slug',$resourcecategory,'resourcecat');
                    printf( '<option value="%s">%s</option>', $properST->slug, $properST->name );
                } else {
                    print( '<option value="" selected="selected">Select a Category</option>');
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
<script type="text/javascript">
function openDiv(t) {
	var x = t.options[t.selectedIndex].value;
    var filediv = document.getElementById('filediv');
    var linkdiv = document.getElementById('linkdiv');
	var embeddiv = document.getElementById('embeddiv');
    if (x === "File") {
        filediv.style.display="block";
        linkdiv.style.display="none";
        embeddiv.style.display="none";  
    }
    if (x === "Link") {
        filediv.style.display="none";
        linkdiv.style.display="block";
        embeddiv.style.display="none";  
    }
    if (x === "Embed") {
        filediv.style.display="none";
        linkdiv.style.display="none";
        embeddiv.style.display="block";  
    }	
}

</script>

<?php
}

function handle_upload_field($post_ID, $post)
{
    if (!empty($_FILES['sa_upload_file']['name'])) {
        $upload = wp_handle_upload($_FILES['sa_upload_file']);
	if ( $upload ) {
			echo "File is valid, and was successfully uploaded.\n";
			var_dump($upload);
		} else {
			echo "Possible file upload attack!\n";
		}		
    }
}
add_action('wp_insert_post', 'handle_upload_field', 10, 2);

 add_action( 'save_post', 'saresource_save' );
 function saresource_save() { 
 
   global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

     if ($post->post_type == 'saresources') {
       save_res_field("sa_resourcetype");
       save_res_field("sa_resourcecategory");       
       save_res_field("sa_upload_file");
       save_res_field("sa_link");
       save_res_field("sa_embedcode");
       save_res_field("sa_sharing");	   
	   
     }
 }
 function save_res_field($event_field) {
    global $post;
    if(isset($_POST[$event_field])) {
        update_post_meta($post->ID, $event_field, $_POST[$event_field]);
    } else{
        delete_post_meta($post->ID, $event_field);
    }
 }

?>


    
       





