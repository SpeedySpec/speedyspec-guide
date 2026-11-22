<?php
// Sets an object's terms in a taxonomy by IDs, slugs or names, creating missing ones; with $append, keeps the others. Returns the term_taxonomy_ids; set_object_terms fires.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$ids = wp_set_object_terms( $post, array( 'beta', 'gamma' ), 'post_tag' );
$names = wp_get_object_terms( $post, 'post_tag', array( 'fields' => 'names' ) );
wp_set_object_terms( $post, 'delta', 'post_tag', true );
return array( count( $ids ), $names, wp_get_object_terms( $post, 'post_tag', array( 'fields' => 'names' ) ) );
