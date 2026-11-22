<?php
// Terms can be ordered by meta and filtered by object, child_of, exclude and include; counts are padded with descendants when asked.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$sport = wp_insert_term( 'Sport', 'category' );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_term_meta( $news['term_id'], 'rank', 2 );
add_term_meta( $sport['term_id'], 'rank', 1 );
$by_rank = ( new WP_Term_Query( array( 'taxonomy' => 'category', 'hide_empty' => false, 'meta_key' => 'rank', 'orderby' => 'meta_value_num', 'fields' => 'names' ) ) )->terms;
$of_post = ( new WP_Term_Query( array( 'taxonomy' => array( 'category', 'post_tag' ), 'object_ids' => $post, 'fields' => 'names' ) ) )->terms;
$children = ( new WP_Term_Query( array( 'taxonomy' => 'category', 'hide_empty' => false, 'child_of' => $news['term_id'], 'fields' => 'names' ) ) )->terms;
$padded = ( new WP_Term_Query( array( 'taxonomy' => 'category', 'pad_counts' => true, 'hide_empty' => false ) ) )->terms;
return array( $by_rank, $of_post, $children, wp_list_pluck( $padded, 'count', 'name' ) );
