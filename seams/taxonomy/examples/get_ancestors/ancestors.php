<?php
// An object's ancestors, nearest first: a term's parents, or a hierarchical post's; get_ancestors filters them.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$deep = wp_insert_term( 'Deep', 'category', array( 'parent' => $local['term_id'] ) )['term_id'];
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'P', 'post_status' => 'publish' ) );
$child = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'C', 'post_parent' => $page, 'post_status' => 'publish' ) );
return array( get_ancestors( $deep, 'category' ) == array( $local['term_id'], $news['term_id'] ), get_ancestors( $child, 'page' ) == array( $page ), get_ancestors( 0 ) );
