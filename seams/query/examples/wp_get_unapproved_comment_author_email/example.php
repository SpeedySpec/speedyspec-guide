<?php
// The email of a visitor who just left a pending comment, from the unapproved and moderation-hash query, or their cookie; so they can see their own pending comment.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_set_comment_status( $c, 'hold' );
$_GET['unapproved'] = $c;
$_GET['moderation-hash'] = wp_hash( get_comment( $c )->comment_date_gmt );
return wp_get_unapproved_comment_author_email();
