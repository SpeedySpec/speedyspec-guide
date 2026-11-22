<?php
// Hooked to comment_post: emails the post author about an approved comment when comment notification is on.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

update_option( 'comments_notify', 1 );
return wp_new_comment_notify_postauthor( $c );
