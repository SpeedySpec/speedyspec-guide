<?php
// The number of comments awaiting moderation on a post, or on each of several posts.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Hi', 'comment_approved' => 0 ) );
return array( get_pending_comments_num( $post ), get_pending_comments_num( array( $post ) ) );
