<?php
// Recounts a post's approved comments and stores the count; fires wp_update_comment_count.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

global $wpdb;
$wpdb->update( $wpdb->posts, array( 'comment_count' => 9 ), array( 'ID' => $post ) );
return array( wp_update_comment_count_now( $post ), get_post( $post )->comment_count );
