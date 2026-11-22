<?php
// A term's meta: all keys, one key's values, or one value.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_term_meta( $news['term_id'], 'color', 'red' );
return array( get_term_meta( $news['term_id'], 'color' ), get_term_meta( $news['term_id'], 'color', true ), get_term_meta( $news['term_id'], 'nope', true ) );
