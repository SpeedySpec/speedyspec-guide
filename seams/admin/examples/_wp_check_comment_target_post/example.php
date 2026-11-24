<?php
// Whether the current user may move a comment to another post: true, or an error saying why not.
wp_set_current_user( 1 );
$from    = wp_insert_post( array( 'post_title' => 'From', 'post_status' => 'publish' ) );
$to      = wp_insert_post( array( 'post_title' => 'To', 'post_status' => 'publish' ) );
$comment = get_comment( wp_insert_comment( array( 'comment_post_ID' => $from, 'comment_content' => 'Hello' ) ) );
return array( _wp_check_comment_target_post( $comment, $to ), _wp_check_comment_target_post( $comment, 0 )->get_error_message() );
