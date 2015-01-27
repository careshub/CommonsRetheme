<?php
/**
 * The sidebar used on the blog section including archives.
 *
 *
 * @package WordPress
 * @subpackage Commons Retheme
 * @since 0.3
 */

// Display the correct set of widgets
if ( is_category() ) {
    // Category archive pages
	if ( is_active_sidebar( 'category_sidebar' ) ) { ?>
        <div id="secondary" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'category_sidebar' ); ?>
        </div><!-- #secondary -->
    <?php }
} elseif ( is_tag() ) {
    // Category archive pages
    if ( is_active_sidebar( 'tag_sidebar' ) ) { ?>
        <div id="secondary" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'tag_sidebar' ); ?>
        </div><!-- #secondary -->
    <?php }    
} elseif ( is_home() ) {
    // Main blog page
    if ( is_active_sidebar( 'blog_sidebar' ) ) { ?>
        <div id="secondary" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'blog_sidebar' ); ?>
        </div><!-- #secondary -->
    <?php }    
} else {
    // When in doubt, use the main sidebar
    if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <div id="secondary" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div><!-- #secondary -->
    <?php }
}