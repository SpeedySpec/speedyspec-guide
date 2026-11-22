<?php
// One field of a term, sanitized for a context ('display' by default); a missing field gives ''.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( get_term_field( 'name', $local['term_id'], 'category' ), get_term_field( 'parent', $local['term_id'], 'category', 'raw' ), get_term_field( 'nope', $local['term_id'], 'category' ), get_term_field( 'name', 999, 'category' ) );
