<?php
// A comment's reply link (a data-driven link for the threaded comments script, or log in to reply), within the thread depth; filtered by comment_reply_link.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'https://ada.example', 'comment_author_IP' => '10.0.0.1', 'comment_date' => '2026-03-15 10:05:00', 'comment_date_gmt' => '2026-03-15 10:05:00', 'comment_approved' => 1 ) );
$GLOBALS['comment'] = get_comment( $c );
update_option( 'thread_comments', 1 );
return get_comment_reply_link( array( 'depth' => 1, 'max_depth' => 5 ), $c, $id );
