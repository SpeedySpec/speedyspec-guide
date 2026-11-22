<?php
// Fires the status change hooks (the new status first, then the old) when a comment's status changes: transition_comment_status, comment_{$old}_to_{$new}, and comment_{$new}_{$type}.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_transition_comment_status( 'approved', 'unapproved', get_comment( $c ) );
return array( did_action( 'transition_comment_status' ), did_action( 'comment_approved_to_unapproved' ), did_action( 'comment_unapproved_to_approved' ), did_action( 'comment_approved_comment' ) );
