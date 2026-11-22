<?php
// Whether a comment passes the moderation rules: not held by moderation keys or too many links, and with comment_previously_approved on, an author with an approved comment before.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

update_option( 'comment_max_links', 1 );
$links = check_comment( 'Ada', 'ada@example.org', '', 'see http://a.test and http://b.test', '', '', 'comment' );
update_option( 'moderation_keys', 'casino' );
$word = check_comment( 'Ada', 'ada@example.org', '', 'casino time', '', '', 'comment' );
update_option( 'comment_previously_approved', 0 );
return array( $links, $word, check_comment( 'Ada', 'ada@example.org', '', 'hello', '', '', 'comment' ) );
