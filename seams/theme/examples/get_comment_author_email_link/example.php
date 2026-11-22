<?php
// A mailto link to the comment author's email, with the email (or text) obfuscated by antispambot(), randomly each time; filtered by comment_email.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_author_url' => 'https://ada.example', 'comment_author_IP' => '10.0.0.1', 'comment_date' => '2026-03-15 10:05:00', 'comment_date_gmt' => '2026-03-15 10:05:00', 'comment_approved' => 1 ) );
$GLOBALS['comment'] = get_comment( $c );
$link = get_comment_author_email_link( 'Mail Ada' );
return array( $link !== get_comment_author_email_link( 'Mail Ada' ) || str_contains( $link, '&#' ), html_entity_decode( $link ) );
