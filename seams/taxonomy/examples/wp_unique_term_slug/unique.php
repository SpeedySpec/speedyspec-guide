<?php
// A slug unique for a term: in hierarchical taxonomies its parents' slugs are added first, then a number; wp_unique_term_slug filters it.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( wp_unique_term_slug( 'local', (object) array( 'taxonomy' => 'category', 'parent' => $news['term_id'] ) ), wp_unique_term_slug( 'alpha', (object) array( 'taxonomy' => 'post_tag' ) ), wp_unique_term_slug( 'fresh', (object) array( 'taxonomy' => 'post_tag' ) ) );
