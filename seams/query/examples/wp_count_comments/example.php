<?php
// The number of comments by status for a post or the site, as an object; filtered by wp_count_comments.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Held', 'comment_approved' => 0 ) );
$counts = wp_count_comments( $post );
return array( $counts->approved, $counts->moderated, $counts->total_comments );
