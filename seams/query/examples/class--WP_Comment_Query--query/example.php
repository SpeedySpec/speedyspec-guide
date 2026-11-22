<?php
// WP_Comment_Query turns query variables into SQL for comments (by post, author, status, type, parent, meta, date and search), runs it with caching, and can count, return IDs, or nest children in threads.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$parent = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Top', 'comment_approved' => 1 ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Reply', 'comment_approved' => 1, 'comment_parent' => $parent ) );
$q = new WP_Comment_Query( array( 'post_id' => $post, 'hierarchical' => 'threaded' ) );
$top = $q->comments;
return array( count( $top ), current( $top )->comment_content, wp_list_pluck( current( $top )->get_children(), 'comment_content' ), ( new WP_Comment_Query( array( 'post_id' => $post, 'count' => true ) ) )->get_comments() );
