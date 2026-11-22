<?php
// A comment's text cut to 20 words, without tags; filtered by comment_excerpt_length and get_comment_excerpt.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'https://ada.example', 'comment_author_IP' => '10.0.0.1', 'comment_date' => '2026-03-15 10:05:00', 'comment_date_gmt' => '2026-03-15 10:05:00', 'comment_approved' => 1 ) );
$GLOBALS['comment'] = get_comment( $c );
wp_update_comment( array( 'comment_ID' => $c, 'comment_content' => str_repeat( 'word ', 30 ) ) );
return get_comment_excerpt( $c );
