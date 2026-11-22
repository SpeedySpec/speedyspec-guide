<?php
// The IDs of the objects in terms of taxonomies, ordered ascending by default; a missing taxonomy is an error.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$second = wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ) ) );
return array( get_objects_in_term( $local['term_id'], 'category' ) === array( (string) $post, (string) $second ), get_objects_in_term( $local['term_id'], 'category', array( 'order' => 'DESC' ) )[0] == $second, get_objects_in_term( 1, 'nope' )->get_error_code() );
