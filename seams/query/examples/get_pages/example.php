<?php
// Pages (or posts of another hierarchical type) matching arguments: parent, child_of, authors, include and exclude trees, sorting, hierarchical order; through WP_Query, cached.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
wp_insert_post( array( 'post_title' => 'C', 'post_type' => 'page', 'post_status' => 'publish' ) );
return array( wp_list_pluck( get_pages(), 'post_title' ), wp_list_pluck( get_pages( array( 'parent' => 0 ) ), 'post_title' ), wp_list_pluck( get_pages( array( 'child_of' => $a ) ), 'post_title' ) );
