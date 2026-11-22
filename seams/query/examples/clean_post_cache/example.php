<?php
// Removes a post from the cache, with its terms and children, and bumps the posts' last changed time; fires clean_post_cache.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
get_post( $id );
clean_post_cache( $id );
return array( wp_cache_get( $id, 'posts' ), did_action( 'clean_post_cache' ) );
