<?php
// The count callback for other taxonomies: counts every object in each term.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_insert_post( array( 'post_title' => 'Draft', 'post_status' => 'draft', 'post_category' => array( $local['term_id'] ) ) );
_update_generic_term_count( array( $local['term_taxonomy_id'] ), get_taxonomy( 'category' ) );
return (int) $GLOBALS['wpdb']->get_var( "SELECT count FROM {$GLOBALS['wpdb']->term_taxonomy} WHERE term_taxonomy_id = {$local['term_taxonomy_id']}" );
