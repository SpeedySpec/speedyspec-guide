<?php
// Prints (or gives) a select of pages, hierarchical, with options for none; filtered by wp_dropdown_pages.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Team', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
return wp_dropdown_pages( array( 'echo' => 0, 'name' => 'page_id', 'show_option_none' => 'None' ) );
