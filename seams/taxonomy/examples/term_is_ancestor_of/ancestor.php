<?php
// Whether one term is an ancestor of another in a taxonomy.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( term_is_ancestor_of( $news['term_id'], $local['term_id'], 'category' ), term_is_ancestor_of( $local['term_id'], $news['term_id'], 'category' ) );
