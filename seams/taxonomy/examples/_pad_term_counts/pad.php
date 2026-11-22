<?php
// Adds descendants' counts to each term's count, counting each object once, for hierarchical taxonomies.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$terms = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false ) );
_pad_term_counts( $terms, 'category' );
return wp_list_pluck( $terms, 'count', 'name' );
