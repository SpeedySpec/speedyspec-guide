<?php
// The current post's discussion: up to six unique comment authors (user IDs or emails) from its last 20 approved comments, and its comment count; kept for the post.
guide_theme( 'twentynineteen' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'user_id' => 1, 'comment_content' => 'A', 'comment_approved' => 1 ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author_email' => 'ada@example.org', 'comment_content' => 'B', 'comment_approved' => 1 ) );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_author_email' => 'ada@example.org', 'comment_content' => 'C', 'comment_approved' => 1 ) );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
return twentynineteen_get_discussion_data();
