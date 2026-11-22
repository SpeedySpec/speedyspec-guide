<?php
// The ID of the comment being replied to, from replytocom, when it is an approved comment on the post; 0 otherwise.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'https://ada.example', 'comment_author_IP' => '10.0.0.1', 'comment_date' => '2026-03-15 10:05:00', 'comment_date_gmt' => '2026-03-15 10:05:00', 'comment_approved' => 1 ) );
$GLOBALS['comment'] = get_comment( $c );
$_GET['replytocom'] = $c;
return array( _get_comment_reply_id( $id ) === $c, _get_comment_reply_id( 999 ) );
