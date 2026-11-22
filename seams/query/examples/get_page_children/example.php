<?php
// Every descendant of a page among a list of pages.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_parent' => $a ) );
$c = wp_insert_post( array( 'post_title' => 'C', 'post_type' => 'page', 'post_parent' => $b ) );
return wp_list_pluck( get_page_children( $a, get_pages( array( 'post_status' => 'draft' ) ) ), 'post_title' );
