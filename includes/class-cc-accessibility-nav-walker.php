<?php
/**
 * Navigation Menu template functions
 *
 * @package CommonsRetheme
 * @since 0.35
 */

/**
 * Add accessibility changes to the standard WP Nav Walker.
 *
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class CC_Accessibility_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     * We add 'role="menu"' to our submenu items for accessibility.
     *
     * @see Walker::start_lvl()
     *
     * @since 0.35
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth + 1);
        $indent_more = $indent . "\t";
        $output .= "\n$indent<div class=\"sub-nav\">\n$indent_more<ul class=\"sub-nav-group\">\n";
    }

    /**
     * Ends the list after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 0.35
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth + 1);
        $indent_more = $indent . "\t";
        $output .= "$indent_more</ul>\n$indent</div>\n";
    }


}