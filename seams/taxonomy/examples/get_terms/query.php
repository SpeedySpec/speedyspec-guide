<?php
// Terms through WP_Term_Query: by taxonomy, with options for empty terms, parents, ordering, fields and counts. get_terms filters the result.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_insert_term( 'Empty', 'category' );
return array( wp_list_pluck( get_terms( array( 'taxonomy' => 'category' ) ), 'name' ), wp_list_pluck( get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false, 'orderby' => 'name' ) ), 'name' ), get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false, 'fields' => 'count' ) ), get_terms( array( 'taxonomy' => 'nope' ) )->get_error_code() );
