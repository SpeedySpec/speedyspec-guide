<?php
// The post ID of a comment by an author at a date, for importers to skip duplicates, or null.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author' => 'Ada', 'comment_content' => 'Hi', 'comment_date' => '2026-03-15 10:00:00', 'comment_approved' => 1 ) );
return array( (int) comment_exists( 'Ada', '2026-03-15 10:00:00' ) === $post, comment_exists( 'Grace', '2026-03-15 10:00:00' ) );
