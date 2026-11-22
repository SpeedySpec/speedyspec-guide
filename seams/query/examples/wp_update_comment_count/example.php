<?php
// Updates a post's comment count, or queues it while counting is deferred.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

global $wpdb;
$wpdb->update( $wpdb->posts, array( 'comment_count' => 9 ), array( 'ID' => $post ) );
clean_post_cache( $post );
wp_update_comment_count( $post );
return get_post( $post )->comment_count;
