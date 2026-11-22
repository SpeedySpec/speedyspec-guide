<?php
// The date of the latest approved comment, in a time zone (server, blog or GMT), cached; false when there is none.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );

$none = get_lastcommentmodified();
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Hi', 'comment_approved' => 1, 'comment_date' => '2026-02-03 04:05:06', 'comment_date_gmt' => '2026-02-03 04:05:06' ) );
return array( $none, get_lastcommentmodified( 'gmt' ) );
