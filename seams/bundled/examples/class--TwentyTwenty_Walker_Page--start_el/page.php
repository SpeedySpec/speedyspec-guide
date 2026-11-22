<?php
// Prints a page list item like a menu item: the current page marked with aria-current, and a toggle or icon for parents in the modal or primary menu.
guide_theme( 'twentytwenty' );
$parent = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Team', 'post_status' => 'publish', 'post_parent' => $parent ) );
$html = wp_list_pages( array( 'walker' => new TwentyTwenty_Walker_Page(), 'echo' => false, 'title_li' => '', 'show_toggles' => true, 'match_menu_classes' => true ) );
return array( str_contains( $html, 'menu-item-has-children' ), str_contains( $html, 'sub-menu-toggle' ), substr_count( $html, '<li ' ) );
