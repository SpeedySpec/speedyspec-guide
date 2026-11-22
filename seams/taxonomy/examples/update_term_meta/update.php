<?php
// Updates a term's meta, adding it when missing; shared terms refuse it with an error.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( is_int( update_term_meta( $news['term_id'], 'color', 'red' ) ), update_term_meta( $news['term_id'], 'color', 'blue' ), get_term_meta( $news['term_id'], 'color', true ) );
