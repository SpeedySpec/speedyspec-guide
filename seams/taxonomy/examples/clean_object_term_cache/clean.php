<?php
// Clears objects' cached terms in their type's taxonomies; clean_object_term_cache fires.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
get_the_terms( $post, 'category' );
$cached = false !== wp_cache_get( $post, 'category_relationships' );
clean_object_term_cache( $post, 'post' );
return array( $cached, wp_cache_get( $post, 'category_relationships' ) );
