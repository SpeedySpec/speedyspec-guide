<?php
// The IDs of all descendants of a term in a hierarchical taxonomy; an empty array otherwise.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$deep = wp_insert_term( 'Deep', 'category', array( 'parent' => $local['term_id'] ) );
return array( array_map( 'intval', get_term_children( $news['term_id'], 'category' ) ), get_term_children( $deep['term_id'], 'category' ), get_term_children( 1, 'post_tag' ), get_term_children( 1, 'nope' )->get_error_code() );
