<?php
// Whether the main query has comments left to loop over, after comments_template() loads them.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice', 'comment_approved' => 1 ) );
guide_go( "/?p=$id" );
the_post();
$GLOBALS['wp_query']->comments = get_comments( array( 'post_id' => $id ) );
$GLOBALS['wp_query']->comment_count = 1;
return have_comments();
