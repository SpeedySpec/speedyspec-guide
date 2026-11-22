<?php
// Adds comments to the cache, and loads their meta unless asked not to.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_cache_delete( $c, 'comment' );
update_comment_cache( array( get_comment( $c ) ) );
return wp_cache_get( $c, 'comment' )->comment_content;
