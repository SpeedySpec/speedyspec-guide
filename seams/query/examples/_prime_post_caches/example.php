<?php
// Loads into the cache the posts of the given IDs that aren't there yet, with their terms and meta when asked.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_cache_delete( $id, 'posts' );
_prime_post_caches( array( $id ) );
return is_object( wp_cache_get( $id, 'posts' ) );
