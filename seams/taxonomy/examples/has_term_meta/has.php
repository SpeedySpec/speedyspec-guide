<?php
// All of a term's meta rows (key, value, meta ID, term ID), or false.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_term_meta( $news['term_id'], 'color', 'red' );
$rows = has_term_meta( $news['term_id'] );
return array( $rows[0]['meta_key'], $rows[0]['meta_value'], array_keys( $rows[0] ), has_term_meta( $local['term_id'] ) );
