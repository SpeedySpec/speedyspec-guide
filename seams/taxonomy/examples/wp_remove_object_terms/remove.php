<?php
// Removes terms from an object; delete_term_relationships and deleted_term_relationships fire.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_add_object_terms( $post, 'beta', 'post_tag' );
return array( wp_remove_object_terms( $post, 'alpha', 'post_tag' ), wp_get_object_terms( $post, 'post_tag', array( 'fields' => 'names' ) ) );
