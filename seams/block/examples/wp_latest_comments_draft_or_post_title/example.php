<?php
// A post's title for the Latest Comments block, (no title) when empty.
$titled = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
$untitled = wp_insert_post( array( 'post_title' => '', 'post_content' => 'x', 'post_status' => 'publish' ) );
return array( wp_latest_comments_draft_or_post_title( $titled ), wp_latest_comments_draft_or_post_title( $untitled ) );
