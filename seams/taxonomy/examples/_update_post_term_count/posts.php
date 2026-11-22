<?php
// A post taxonomy's count callback: counts published posts (and attachments of published posts) of the taxonomy's types in each term.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_insert_post( array( 'post_title' => 'Draft', 'post_status' => 'draft', 'post_category' => array( $local['term_id'] ) ) );
_update_post_term_count( array( $local['term_taxonomy_id'] ), get_taxonomy( 'category' ) );
return (int) $GLOBALS['wpdb']->get_var( "SELECT count FROM {$GLOBALS['wpdb']->term_taxonomy} WHERE term_taxonomy_id = {$local['term_taxonomy_id']}" );
