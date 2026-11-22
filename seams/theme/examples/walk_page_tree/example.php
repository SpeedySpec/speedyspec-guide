<?php
// Walks pages with Walker_Page, or a given walker, to render them.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Team', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
return walk_page_tree( get_pages(), 0, 0, array() );
