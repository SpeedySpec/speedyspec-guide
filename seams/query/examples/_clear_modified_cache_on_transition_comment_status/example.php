<?php
// Hooked to transition_comment_status: clears the last comment modified dates when a comment is approved or unapproved.
$post = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$c = wp_insert_comment( array( 'comment_post_ID' => $post, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_author_email' => 'ada@example.org', 'comment_approved' => 1 ) );

wp_cache_set( 'lastcommentmodified:gmt', 'x', 'timeinfo' );
_clear_modified_cache_on_transition_comment_status( 'approved', 'unapproved' );
return wp_cache_get( 'lastcommentmodified:gmt', 'timeinfo' );
