<?php
// The number of comments by status (approved, awaiting moderation, spam, trash, post-trashed, all and total) for a post or the site.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Spam', 'comment_approved' => 'spam' ) );
return get_comment_count( $post );
