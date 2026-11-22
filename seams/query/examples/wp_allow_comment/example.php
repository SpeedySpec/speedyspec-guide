<?php
// Decides a new comment's approval: an error or wp_die() for a duplicate, flooding or disallowed words; 1, 0 or spam from the moderation checks; filtered by pre_comment_approved.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

$data = array( 'comment_post_ID' => $post, 'comment_author' => 'Bob', 'comment_author_email' => 'bob@example.org', 'comment_author_url' => '', 'comment_content' => 'Nice post', 'comment_parent' => 0, 'user_id' => 0, 'comment_author_IP' => '10.0.0.2', 'comment_agent' => 'x', 'comment_date_gmt' => current_time( 'mysql', 1 ), 'comment_type' => 'comment' );
$fresh = wp_allow_comment( $data, true );
$dup = wp_allow_comment( array_merge( $data, array( 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org' ) ), true );
return array( $fresh, $dup->get_error_code() );
