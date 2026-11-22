<?php
// Queues term IDs for their meta to be loaded together the first time any term's meta is read.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$terms = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false ) );
$ids = wp_list_pluck( $terms, 'term_id' );
return array( wp_lazyload_term_meta( $ids ) );
