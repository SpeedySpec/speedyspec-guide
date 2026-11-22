<?php
// Anonymizes the comments left with an email for a privacy request, 500 a page: author Anonymous, email, URL, IP and agent cleared.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

$result = wp_comments_personal_data_eraser( 'ada@example.org' );
$comment = get_comment( $c );
return array( $result['items_removed'], $comment->comment_author, $comment->comment_author_email, $comment->comment_author_IP );
