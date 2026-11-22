<?php
// A term's parent ID in a taxonomy, or false.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( wp_get_term_taxonomy_parent_id( $local['term_id'], 'category' ) == $news['term_id'], wp_get_term_taxonomy_parent_id( 999, 'category' ) );
