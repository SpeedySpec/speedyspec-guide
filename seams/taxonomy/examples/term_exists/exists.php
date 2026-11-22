<?php
// A term's ID (and term_taxonomy_id in a taxonomy) by ID, slug or name, optionally under a parent; null when missing.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( term_exists( 'local', 'category' ), (int) term_exists( 'Local' ), term_exists( 'Local', 'category', $news['term_id'] ) !== null, term_exists( 'Local', 'category', 999 ), term_exists( 'nope' ), term_exists( '' ) );
