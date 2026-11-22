<?php
// Turns a clause's terms into another field (term_taxonomy_id or term_id), looking them up by slug or name; terms that don't exist leave an empty list.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$sport = wp_insert_term( 'Sport', 'category' );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$clause = array( 'taxonomy' => 'category', 'terms' => array( 'news', 'sport', 'nope' ), 'field' => 'slug', 'include_children' => false );
( new WP_Tax_Query( array() ) )->transform_query( $clause, 'term_id' );
return array( $clause['field'], array_map( 'intval', $clause['terms'] ) == array( $news['term_id'], $sport['term_id'] ) );
