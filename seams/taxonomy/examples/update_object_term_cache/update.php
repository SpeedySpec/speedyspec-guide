<?php
// Loads the terms of objects of a type into the cache, for objects not cached yet.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
clean_object_term_cache( $post, 'post' );
update_object_term_cache( array( $post ), 'post' );
return array( wp_cache_get( $post, 'category_relationships' ) == array( $local['term_id'] ), wp_cache_get( $post, 'post_tag_relationships' ) !== false );
