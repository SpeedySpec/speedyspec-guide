<?php
// The terms among a list that descend from a term, as given (objects or IDs).
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$terms = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false ) );
return wp_list_pluck( _get_term_children( $news['term_id'], $terms, 'category' ), 'name' );
