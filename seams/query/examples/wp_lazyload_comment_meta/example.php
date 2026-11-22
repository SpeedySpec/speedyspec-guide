<?php
// Queues comments' meta to load together the first time any is read.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Hi', 'comment_approved' => 1 ) );
add_comment_meta( $c, 'mood', 'happy' );
wp_cache_delete( $c, 'comment_meta' );
wp_lazyload_comment_meta( array( $c ) );
$before = wp_cache_get( $c, 'comment_meta' );
return array( $before, get_comment_meta( $c, 'mood', true ) );
