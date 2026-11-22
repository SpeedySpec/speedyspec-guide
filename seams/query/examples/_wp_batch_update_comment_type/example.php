<?php
// Sets the type of comments with an empty type to comment, a batch at a time (filtered by wp_update_comment_type_batch_size), scheduling more until done; part of an upgrade.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

global $wpdb;
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Old', 'comment_approved' => 1 ) );
$wpdb->update( $wpdb->comments, array( 'comment_type' => '' ), array( 'comment_ID' => $c ) );
clean_comment_cache( $c );
update_option( 'finished_updating_comment_type', 0 );
_wp_batch_update_comment_type();
return array( get_comment( $c )->comment_type, get_option( 'finished_updating_comment_type' ) );
