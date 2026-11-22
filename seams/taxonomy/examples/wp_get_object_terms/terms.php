<?php
// The terms of objects in taxonomies, through WP_Term_Query; wp_get_object_terms and get_object_terms filter them.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( wp_list_pluck( wp_get_object_terms( $post, array( 'category', 'post_tag' ) ), 'name' ), wp_get_object_terms( $post, 'category', array( 'fields' => 'names' ) ), wp_get_object_terms( $post, 'nope' )->get_error_code() );
