<?php
/**
 * The sidebar used on a single member page.
 *
 *
 * @package WordPress
 * @subpackage Commons Retheme
 * @since 1.0
 */
?>
		<div id="tertiary" class="widget-area" role="complementary">

			<h3>Related Searches</h3>
			<ul>
				<li><a href="<?php 
				bp_groups_directory_permalink();
				echo '?s=' . urlencode( get_query_var( 's' ) );
				?>">Search for Hubs</a></li>
				<li><a href="<?php 
				bp_groups_directory_permalink();
				echo '?s=' . urlencode( get_query_var( 's' ) );
				?>">Search for Members</a></li>
				<?php if ( function_exists( 'bp_docs_archive_link' ) ) :	?> 
					<li><a href="<?php 
				bp_docs_archive_link();
				echo '?s=' . urlencode( get_query_var( 's' ) );
				?>">Search for Library Items</li>
				<?php endif; ?>
			</ul>

		   	
		<?php if ( is_active_sidebar( 'site_search' ) ) :
					dynamic_sidebar( 'site_search' ); 
			endif;
		?>
		</div><!-- #tertiary -->