<?php
// Deletes a term's meta for a key (only a value when given).
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_term_meta( $news['term_id'], 'tag', 'a' );
add_term_meta( $news['term_id'], 'tag', 'b' );
return array( delete_term_meta( $news['term_id'], 'tag', 'a' ), get_term_meta( $news['term_id'], 'tag' ) );
