<?php
// Turns deferred comment counting on or off; while on, counts are updated once when it is turned off.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_defer_comment_counting( true );
wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Two', 'comment_approved' => 1 ) );
$during = get_post( $post )->comment_count;
wp_defer_comment_counting( false );
return array( $during, get_post( $post )->comment_count );
