<?php
add_filter( 'pre_get_posts', 'cc_modify_search_query' );
function cc_modify_search_query( $query ) {

	// Target the site search
	// BP-Docs is very similar but is a post_type_archive
	if ( ! ( $query->is_main_query() && is_search() && ! is_post_type_archive() ) )
		return;

		// Limit post_types that are included in the main results loop
		$query->set( 'post_type', array(
	     'post', 'group_story', 'page', 'bp_doc'
		));

		$towrite = PHP_EOL . 'pre_get_posts query: ' . print_r($query, TRUE);
		$fp = fopen('what_the_search.txt', 'a');
		fwrite($fp, $towrite);
		fclose($fp);

	return $query;
}

function cc_post_type_flag(){
	$post_type = get_post_type();
	switch ( $post_type ) {
		case 'page':
			$retval = "Page";
			break;
		case 'group_story':
			$retval = "Group Narrative";
			break;
		case 'bp_doc':
			$retval = "Library Item";
			break;
		default:
			$retval = "Post";
			break;
	}

	echo '<span class="post-type-flag ' . $post_type . '">' . $retval . '</span>';
}