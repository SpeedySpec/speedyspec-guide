<?php
// Loads terms not yet cached into the cache, in one query.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
wp_cache_delete( $news['term_id'], 'terms' );
_prime_term_caches( array( $news['term_id'] ), false );
return wp_cache_get( $news['term_id'], 'terms' )->name;
