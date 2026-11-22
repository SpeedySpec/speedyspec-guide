<?php
// Clears a taxonomy's cached term lists, and rebuilds the children map of a hierarchical one.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
delete_option( 'category_children' );
clean_taxonomy_cache( 'category' );
return get_option( 'category_children' );
