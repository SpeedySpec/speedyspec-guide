<?php
// Removes comments from the cache and bumps the comment queries' last changed time; fires clean_comment_cache.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

get_comment( $c );
clean_comment_cache( $c );
return array( wp_cache_get( $c, 'comment' ), did_action( 'clean_comment_cache' ) );
