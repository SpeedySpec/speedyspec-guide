<?php
// Prints (or gives) a menu of pages, with a home link optionally, inside a container; the fallback of wp_nav_menu(); filtered by wp_page_menu.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Team', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
return wp_page_menu( array( 'echo' => false, 'show_home' => true ) );
