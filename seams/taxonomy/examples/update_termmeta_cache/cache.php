<?php
// Loads the meta of terms into the cache in one query.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
add_term_meta( $news['term_id'], 'color', 'red' );
wp_cache_delete( $news['term_id'], 'term_meta' );
return update_termmeta_cache( array( $news['term_id'] ) );
