<?php
// Adds posts to the cache.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_cache_delete( $id, 'posts' );
$posts = array( get_post( $id ) );
update_post_cache( $posts );
return wp_cache_get( $id, 'posts' )->post_title;
