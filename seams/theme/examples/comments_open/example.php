<?php
// Whether a post accepts comments; filtered by comments_open.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
$closed = wp_insert_post( array( 'post_title' => 'Shut', 'post_status' => 'publish', 'comment_status' => 'closed' ) );
return array( comments_open( $id ), comments_open( $closed ) );
