<?php
// Walks pages with Walker_PageDropdown, or a given walker, to render select options.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Team', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
return walk_page_dropdown_tree( get_pages(), 0, array( 'selected' => $a ) );
