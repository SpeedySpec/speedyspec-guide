<?php
// One field of a post, sanitized for a context, display by default; '' for unknown fields or posts.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return array( get_post_field( 'post_title', $id ), get_post_field( 'post_content', $id, 'raw' ), get_post_field( 'nope', $id ) );
