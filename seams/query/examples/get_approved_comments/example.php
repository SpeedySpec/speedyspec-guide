<?php
// A post's approved comments, oldest first; with arguments, a WP_Comment_Query on top.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Held', 'comment_approved' => 0 ) );
return array( wp_list_pluck( get_approved_comments( $post ), 'comment_content' ), get_approved_comments( $post, array( 'count' => true ) ) );
