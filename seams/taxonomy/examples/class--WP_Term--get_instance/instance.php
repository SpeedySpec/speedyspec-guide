<?php
// A term by ID as a WP_Term, from the cache or the database; with no taxonomy given, a shared term ID is ambiguous and gives false. to_array() gives its fields; data gives the old-style object.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$sport = wp_insert_term( 'Sport', 'category' );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$term = WP_Term::get_instance( $local['term_id'] );
return array( get_class( $term ), $term->parent, array_keys( $term->to_array() ), get_class( $term->data ), WP_Term::get_instance( $local['term_id'], 'post_tag' ), WP_Term::get_instance( 'x' ) );
