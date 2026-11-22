<?php
// Whether a post is sticky: in the sticky_posts option; filtered by is_sticky.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$before = is_sticky( $id );
stick_post( $id );
return array( $before, is_sticky( $id ) );
