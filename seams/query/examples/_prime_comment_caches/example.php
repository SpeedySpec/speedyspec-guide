<?php
// Loads into the cache the comments of the given IDs that aren't there yet, with their meta when asked.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_cache_delete( $c, 'comment' );
_prime_comment_caches( array( $c ) );
return is_object( wp_cache_get( $c, 'comment' ) );
