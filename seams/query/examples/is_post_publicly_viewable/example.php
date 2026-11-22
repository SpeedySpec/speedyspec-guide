<?php
// Whether a post can be seen by visitors: its type and status are viewable; filtered by is_post_publicly_viewable.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$draft = wp_insert_post( array( 'post_title' => 'D' ) );
return array( is_post_publicly_viewable( $id ), is_post_publicly_viewable( $draft ) );
