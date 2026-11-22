<?php
// The number of terms matching arguments, empty ones included unless hidden.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( (int) wp_count_terms( array( 'taxonomy' => 'category' ) ), (int) wp_count_terms( array( 'taxonomy' => 'category', 'hide_empty' => true ) ) );
