<?php
// A term by slug, name, ID or term_taxonomy_id, in a taxonomy (any taxonomy for term_taxonomy_id), or false.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( get_term_by( 'slug', 'local', 'category' )->name, get_term_by( 'name', 'News', 'category' )->slug, get_term_by( 'id', $local['term_id'], 'category' )->name, get_term_by( 'term_taxonomy_id', $news['term_taxonomy_id'] )->name, get_term_by( 'slug', 'nope', 'category' ), get_term_by( 'slug', 'news', 'nope' ) );
