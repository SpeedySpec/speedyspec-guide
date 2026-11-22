<?php
// Decides a comment's approval from the moderation and disallowed checks only: 1, 0, spam or trash; used when a comment is edited.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

update_option( 'disallowed_keys', 'casino' );
return array( wp_check_comment_data( array( 'comment_author' => 'Bob', 'comment_author_email' => 'bob@example.org', 'comment_author_url' => '', 'comment_content' => 'casino', 'comment_author_IP' => '10.0.0.2', 'comment_agent' => 'x', 'comment_type' => 'comment', 'user_id' => 0 ) ) );
