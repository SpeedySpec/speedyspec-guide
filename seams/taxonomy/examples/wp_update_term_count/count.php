<?php
// Recounts terms (by term_taxonomy_id), or queues them while counting is deferred.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$GLOBALS['wpdb']->update( $GLOBALS['wpdb']->term_taxonomy, array( 'count' => 99 ), array( 'term_taxonomy_id' => $local['term_taxonomy_id'] ) );
wp_update_term_count( array( $local['term_taxonomy_id'] ), 'category' );
return (int) $GLOBALS['wpdb']->get_var( "SELECT count FROM {$GLOBALS['wpdb']->term_taxonomy} WHERE term_taxonomy_id = {$local['term_taxonomy_id']}" );
