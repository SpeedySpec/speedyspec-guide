<?php
// A hierarchical taxonomy's children map, parent ID to child IDs, kept in the {$taxonomy}_children option.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return array( _get_term_hierarchy( 'category' ), _get_term_hierarchy( 'post_tag' ) );
