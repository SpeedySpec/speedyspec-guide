<?php
// Moves the main query's comment loop to its next comment, set as the global comment.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice', 'comment_approved' => 1 ) );
guide_go( "/?p=$id" );
$GLOBALS['wp_query']->comments = get_comments( array( 'post_id' => $id ) );
$GLOBALS['wp_query']->comment_count = 1;
the_comment();
return get_comment_text();
