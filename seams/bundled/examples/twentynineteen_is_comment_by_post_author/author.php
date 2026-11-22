<?php
// Whether a comment was written by the author of its post.
guide_theme( 'twentynineteen' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$by_author = get_comment( wp_insert_comment( array( 'comment_post_ID' => $post, 'user_id' => 1, 'comment_content' => 'Thanks' ) ) );
$by_guest = get_comment( wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Hi' ) ) );
return array( twentynineteen_is_comment_by_post_author( $by_author ), twentynineteen_is_comment_by_post_author( $by_guest ) );
