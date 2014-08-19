<?php
// Create new CPT for group stories. These are the posts, or narratives, collected from the group component.

add_action( 'init', 'register_cpt_group_story' );
function register_cpt_group_story() {

    $labels = array( 
        'name' => _x( 'Group Stories', 'group_story' ),
        'singular_name' => _x( 'Group Story', 'group_story' ),
        'add_new' => _x( 'Add New', 'group_story' ),
        'add_new_item' => _x( 'Add New Group Story', 'group_story' ),
        'edit_item' => _x( 'Edit Group Story', 'group_story' ),
        'new_item' => _x( 'New Group Story', 'group_story' ),
        'view_item' => _x( 'View Group Story', 'group_story' ),
        'search_items' => _x( 'Search Group Stories', 'group_story' ),
        'not_found' => _x( 'No group stories found', 'group_story' ),
        'not_found_in_trash' => _x( 'No group stories found in Trash', 'group_story' ),
        'parent_item_colon' => _x( 'Parent Group Story:', 'group_story' ),
        'menu_name' => _x( 'Group Stories', 'group_story' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Used to collect new posts ("Narratives") from spaces.',
        'supports' => array( 'title', 'editor', 'author', 'revisions' ),
        'taxonomies' => array( 'post_tag', 'related_groups' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 37,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'group_story', $args );
}

add_action( 'init', 'register_taxonomy_related_groups' );

function register_taxonomy_related_groups() {

    $labels = array( 
        'name' => _x( 'Related Groups', 'related_groups' ),
        'singular_name' => _x( 'Related Group', 'related_groups' ),
        'search_items' => _x( 'Search Related Groups', 'related_groups' ),
        'popular_items' => _x( 'Popular Related Groups', 'related_groups' ),
        'all_items' => _x( 'All Related Groups', 'related_groups' ),
        'parent_item' => _x( 'Parent Related Group', 'related_groups' ),
        'parent_item_colon' => _x( 'Parent Related Group:', 'related_groups' ),
        'edit_item' => _x( 'Edit Related Group', 'related_groups' ),
        'update_item' => _x( 'Update Related Group', 'related_groups' ),
        'add_new_item' => _x( 'Add New Related Group', 'related_groups' ),
        'new_item_name' => _x( 'New Related Group', 'related_groups' ),
        'separate_items_with_commas' => _x( 'Separate related groups with commas', 'related_groups' ),
        'add_or_remove_items' => _x( 'Add or remove related groups', 'related_groups' ),
        'choose_from_most_used' => _x( 'Choose from the most used related groups', 'related_groups' ),
        'menu_name' => _x( 'Related Groups', 'related_groups' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'related_groups', array('group_story'), $args );
}
/**
 * Putting the meta box creation in a class
 * Calls the class on the post edit screen.
 */
function call_group_story_meta_box() {

    return new group_stories_meta_box();
}
add_action( 'admin_init', 'call_group_story_meta_box' );

/** 
 * The class that handles meta box creation.
 */
class group_stories_meta_box {

    private $nonce = 'group_stories_custom_meta_box_nonce';
    private $meta_box_name = 'group_stories_custom_meta_box';

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box() {

        add_meta_box( 
            $this->meta_box_name, 
            'Related Docs', 
            array( $this, 'render_meta_box_content' ), 
            'group_story', 
            'normal', 
            'high'
            ); 
    }

    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {
    
        // Add an nonce field so we can check for it later.
        wp_nonce_field( $this->meta_box_name, $this->nonce );

        $meta_field = 'group_story_related_docs';

        // Use get_post_meta to retrieve an existing value from the database.
        $doc_associations = get_post_meta( $post->ID, $meta_field, true ); // Use true to actually get an unserialized array back

        // Get candidate docs: must be associated with the group, must be readable by anyone. We can search for docs that are associated with the group, then in the while loop ignore those with privacy not "read:anyone"
        
        //This assumes that each group only has one associated category, otherwise we'll have docs crossing over.
        $category_ids = wp_get_post_terms($post->ID, 'related_groups', array("fields" => "ids"));
        $group_ids = $this->get_group_ids( $category_ids[0] );

        $docs_args = array( 'group_id' =>  $group_ids );

        echo '<p class="howto">In order to associate a document with a group story, the doc must be able to be read by anyone and be associated with the group that is producing the story.</p>';
        if ( bp_docs_has_docs( $docs_args ) ) :
            echo '<ul>';
            while ( bp_docs_has_docs() ) : 
                bp_docs_the_doc();
                //Only allow to attach docs that have read set to anyone.
                // $doc = get_post();
                // print_r($doc);
                $doc_id = get_the_ID();
                $settings = bp_docs_get_doc_settings( $doc_id );
                if ( $settings['read'] == 'anyone') { 
                    ?>
                    <li>
                        <input type="checkbox" id="<?php echo $meta_field; ?>-<?php echo $doc_id; ?>" name="<?php echo $meta_field; ?>[]" value="<?php echo $doc_id; ?>" <?php checked( in_array( $doc_id , $doc_associations ) ); ?> />
                        <label for="<?php echo $meta_field; ?>-<?php echo $doc_id ?>"><?php the_title() ?></label>
                    </li>
                    <?php
                    // the_title();
                    // echo '<pre>' . PHP_EOL;
                    // print_r($settings);
                    // echo '</pre>';                
                }
                
            endwhile;
            echo '</ul>';
        endif;

        // Display the form, using the current value.
        ?>
        <!-- <label for="<?php echo $meta_field; ?>" class="description"><h4>Featured video URL</h4>
            <em>e.g.: http://www.youtube.com/watch?v=UueU0-EFido</em></label><br />
        <input type="text" id="<?php echo $meta_field; ?>" name="<?php echo $meta_field; ?>" value="<?php echo esc_attr( $value); ?>" size="75" /> -->

<?php
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
    
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // First, make sure the user can save the post and only fire when editing this post type
        if( get_post_type( $post_id ) == 'group_story' && $this->user_can_save( $post_id, $this->nonce ) ) {

            $meta_field = 'group_story_related_docs';
                    
            // Sanitize the user input.
            // $input = sanitize_text_field( $_POST[ $meta_field ] );

            // Update the meta field.
            // update_post_meta( $post_id, $meta_field, $input );

            if ( empty($_POST[ $meta_field ]) ) {
                //If this element of POST is empty, then we should delete any stored values if they exist
                delete_post_meta($post_id, $meta_field);
            }

            if ( !empty($_POST[ $meta_field ]) && is_array($_POST[ $meta_field ]) ) {
                    // delete_post_meta( $post_id, $meta_field );
                    // foreach ($_POST[ $meta_field ] as $association) {
                        update_post_meta($post_id, $meta_field, $_POST[ $meta_field ] );
                    // }
                }

        }

    }

    /*--------------------------------------------*
     * Helper Functions
     *--------------------------------------------*/

    /**
     * Determines whether or not the current user has the ability to save meta data associated with this post.
     *
     * @param       int     $post_id    The ID of the post being save
     * @param       bool                Whether or not the user has the ability to save this post.
     */
    public function user_can_save( $post_id, $nonce ) {
        
        // Don't save if the user hasn't submitted the changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return false;
        } // end if

        // Verify that the input is coming from the proper form
        if( ! wp_verify_nonce( $_POST[ $nonce ], $this->meta_box_name ) ) {
            return false;
        } // end if

        // Make sure the user has permissions to post
        // if( 'post' == $_POST['post_type'] ) {
        //  if( ! current_user_can( 'edit_post', $post_id ) ) {
        //      return;
        //  } // end if
        // } // end if/else

        return true;
     
    } // end user_can_save

    public function get_group_ids( $category_id ) {
        //Todo: This will need to be updated when we switch to buddyforms.
        // Getting the associated group is going to be kind of funky, since the blog_categories plugin stores the group => associated categories as serialized data.

        global $wpdb, $bp;
        // We want to look for meta_value LIKE '%\"1132\"%' so weve got to do some wrapping
        $category_id = '%"' . $category_id . '"%';
 
        $sql = $wpdb->prepare( "SELECT group_id FROM {$bp->groups->table_name_groupmeta} WHERE meta_key = %s AND meta_value LIKE %s", 'group_blog_cats', $category_id );
 
        return wp_parse_id_list( $wpdb->get_col( $sql ) );
    }

}
function get_associated_bp_docs() {
    $meta_field = 'group_story_related_docs';
    $post_id = get_the_ID();

    // Use get_post_meta to retrieve an existing value from the database.
    $doc_associations = get_post_meta( $post_id, $meta_field, true );
    if ($doc_associations) {
        echo '<h5>Associated Library Items</h5>
        <ul>';
        foreach ($doc_associations as $item) {
            $doc_title = get_the_title( $item );
            ?>
            <li>
                <a href="<?php echo get_permalink( $item ); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), $doc_title ) ); ?>" rel="bookmark"><?php echo $doc_title ?></a>
            </li>
            <?php
        }
        echo '</ul>';
    }
}
//Returns an array of WP_Post objects
function cc_get_associatable_bp_docs( $group_id ) {
    $docs_args = array( 'group_id' =>  array( $group_id ) );
    $good_docs = array();

    if ( bp_docs_has_docs( $docs_args ) ) :
        while ( bp_docs_has_docs() ) : 
            bp_docs_the_doc();
            //Only allow the attachment docs that have read set to anyone.
            $doc_id = get_the_ID();
            $settings = bp_docs_get_doc_settings( $doc_id );
            if ( $settings['read'] == 'anyone') { 
                global $post;
                $good_docs[] = $post;               
            }
            
        endwhile;
    endif;
    
    return $good_docs;
}
//This is only used in the "Blog Categories for Groups" form setup
function cc_get_associatable_bp_docs_narrative_form( $group_id = false ) {
    $group_id = !( $group_id ) ? bp_get_current_group_id() : $group_id ;
    
    if ( $good_docs = cc_get_associatable_bp_docs( $group_id ) ) {
        $attachable_docs = array();
        foreach ($good_docs as $doc) {
            $attachable_docs[] = array(
                    'value' => $doc->ID,
                    'label' => $doc->post_title,
                );
        }
        return $attachable_docs;
    } else {
        return false;
    }
}

function cc_get_associatable_maps_reports_narrative_form( $group_id , $item_type ) {

    if ( in_array( $item_type, array( 'map','report' ) ) && 
         function_exists( 'commons_group_library_pane_get_saved_maps_reports_for_group' ) && 
         $group_items = commons_group_library_pane_get_saved_maps_reports_for_group( $group_id, $item_type ) ) {

        $attachable_items = array();
        foreach ($group_items as $item) {
            $attachable_items[] = array(
                    'value' => $item['id'],
                    'label' => $item['title'],
                );
        }
    
        return $attachable_items;
    } else {
        return false;
    }
}
function get_associated_cc_maps_reports( $item_type ) {
    if ( !in_array($item_type, array( 'map','report' ) ) )
        return false;

    $meta_field = 'group_story_related_'. $item_type .'s';
    $post_id = get_the_ID();

    // Use get_post_meta to retrieve an existing value from the database.
    $map_associations = get_post_meta( $post_id, $meta_field, true );
    if ( $map_associations ) {
        echo '<h5>Associated '. ucwords( $item_type )  .'s </h5>
        <ul>';
        foreach ($map_associations as $item) {
            // $doc_title = get_the_title( $item );
            $single_item = commons_group_library_pane_get_single_map_report( $item, $item_type );
            // print_r($single_item);
            ?>
            <li>
                <a href="<?php echo $single_item['link']; ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), $single_item['title'] ) ); ?>"><?php echo $single_item['title']; ?></a>
            </li>
            <?php
        }
        echo '</ul>';
    }
}